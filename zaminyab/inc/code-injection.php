<?php
/**
 * ZaminYab Secure Code Injection Output (Global and Per-Page)
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

    // 2. Output general head html (Output directly without visitor permission checks)
    $head_code = zaminyab_get_option( 'head_code' );
    if ( ! empty( $head_code ) ) {
        echo "\n<!-- ZaminYab Head Injection -->\n";
        echo $head_code . "\n";
    }

    // 3. Per-post/page CSS injection
    if ( is_singular() ) {
        $post_id = get_the_ID();
        $page_css = get_post_meta( $post_id, '_custom_page_css', true );
        if ( ! empty( $page_css ) ) {
            echo "\n<!-- ZaminYab Page-Specific CSS -->\n";
            echo "<style type=\"text/css\">\n";
            echo wp_strip_all_tags( $page_css ) . "\n";
            echo "</style>\n";
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

    // 2. Output general body html (Output directly without visitor permission checks)
    $body_code = zaminyab_get_option( 'body_code' );
    if ( ! empty( $body_code ) ) {
        echo "\n<!-- ZaminYab Body Injection -->\n";
        echo $body_code . "\n";
    }

    // 3. Per-post/page JS injection
    if ( is_singular() ) {
        $post_id = get_the_ID();
        $page_js = get_post_meta( $post_id, '_custom_page_js', true );
        if ( ! empty( $page_js ) ) {
            echo "\n<!-- ZaminYab Page-Specific JS -->\n";
            echo "<script type=\"text/javascript\">\n";
            echo "/* <![CDATA[ */\n";
            echo wp_strip_all_tags( $page_js ) . "\n";
            echo "/* ]]> */\n";
            echo "</script>\n";
        }
    }
}
add_action( 'wp_footer', 'zaminyab_output_footer_code', 100 );
