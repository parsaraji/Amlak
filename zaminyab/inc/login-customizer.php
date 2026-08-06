<?php
/**
 * ZaminYab Login Screen Customizer
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue custom login style sheet if enabled.
 */
function zaminyab_login_stylesheet() {
    $enable_custom = zaminyab_get_option( 'enable_custom_login', '1' );
    if ( $enable_custom !== '1' ) {
        return;
    }

    wp_enqueue_style( 'zaminyab-login-css', get_template_directory_uri() . '/assets/css/login.css', array(), '1.0.0' );

    // Inline customized CSS from theme settings
    $login_bg = zaminyab_get_option( 'login_bg_color', '#fafaf9' );
    $logo_url = zaminyab_get_option( 'login_logo_url' );
    if ( empty($logo_url) ) {
        $logo_url = zaminyab_get_option( 'logo_url' );
    }

    $custom_style = "body.login { background-color: " . esc_attr( $login_bg ) . " !important; }";
    if ( ! empty( $logo_url ) ) {
        $custom_style .= " #login h1 a { background-image: url(" . esc_url( $logo_url ) . ") !important; }";
    }
    wp_add_inline_style( 'zaminyab-login-css', $custom_style );
}
add_action( 'login_enqueue_scripts', 'zaminyab_login_stylesheet' );

/**
 * Customize login logo URL to redirect to home.
 */
function zaminyab_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'zaminyab_login_logo_url' );

/**
 * Customize login logo title attribute.
 */
function zaminyab_login_logo_title() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'zaminyab_login_logo_title' );

/**
 * Render custom welcome message inside login box.
 */
function zaminyab_login_custom_message( $message ) {
    $enable_custom = zaminyab_get_option( 'enable_custom_login', '1' );
    if ( $enable_custom !== '1' ) {
        return $message;
    }

    $msg = zaminyab_get_option( 'login_custom_message' );
    if ( ! empty( $msg ) ) {
        return '<p class="message" style="border-right: 4px solid #0d9488 !important; border-left: none !important; direction:rtl; text-align:justify;">' . esc_html( $msg ) . '</p>';
    }
    return $message;
}
add_filter( 'login_message', 'zaminyab_login_custom_message' );
