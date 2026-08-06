<?php
/**
 * ZaminYab Secure Code Injection Output
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Output injected header code.
 */
function zaminyab_output_head_code() {
    // 1. Output custom CSS block
    $custom_css = zaminyab_get_option( 'custom_css' );
    if ( ! empty( $custom_css ) ) {
        echo "\n<!-- ZaminYab Custom CSS -->\n";
        echo "<style type=\"text/css\">\n";
        echo wp_strip_all_tags( $custom_css ) . "\n";
        echo "</style>\n";
    }

    // 2. Output general head html
    $head_code = zaminyab_get_option( 'head_code' );
    if ( ! empty( $head_code ) ) {
        echo "\n<!-- ZaminYab Head Injection -->\n";
        if ( current_user_can( 'unfiltered_html' ) ) {
            echo $head_code . "\n";
        } else {
            echo wp_kses_post( $head_code ) . "\n";
        }
    }
}
add_action( 'wp_head', 'zaminyab_output_head_code', 100 );

/**
 * Output injected footer code.
 */
function zaminyab_output_footer_code() {
    // 1. Output custom JS block
    $custom_js = zaminyab_get_option( 'custom_js' );
    if ( ! empty( $custom_js ) ) {
        echo "\n<!-- ZaminYab Custom JS -->\n";
        echo "<script type=\"text/javascript\">\n";
        echo "/* <![CDATA[ */\n";
        echo wp_strip_all_tags( $custom_js ) . "\n";
        echo "/* ]]> */\n";
        echo "</script>\n";
    }

    // 2. Output general body html
    $body_code = zaminyab_get_option( 'body_code' );
    if ( ! empty( $body_code ) ) {
        echo "\n<!-- ZaminYab Body Injection -->\n";
        if ( current_user_can( 'unfiltered_html' ) ) {
            echo $body_code . "\n";
        } else {
            echo wp_kses_post( $body_code ) . "\n";
        }
    }
}
add_action( 'wp_footer', 'zaminyab_output_footer_code', 100 );
