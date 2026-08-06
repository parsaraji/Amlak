<?php
/**
 * ZaminYab setup functions
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! function_exists( 'zaminyab_setup' ) ) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function zaminyab_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        // Set default post thumbnail size.
        set_post_thumbnail_size( 360, 240, true );

        // Add support for custom logo.
        add_theme_support( 'custom-logo', array(
            'height'      => 80,
            'width'       => 240,
            'flex-width'  => true,
            'flex-height' => true,
        ) );

        // Register navigation menus.
        register_nav_menus( array(
            'primary-menu' => esc_html__( 'منوی اصلی', 'zaminyab' ),
            'footer-menu'  => esc_html__( 'منوی فوتر', 'zaminyab' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );
    }
}
add_action( 'after_setup_theme', 'zaminyab_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function zaminyab_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'zaminyab_content_width', 1200 );
}
add_action( 'after_setup_theme', 'zaminyab_content_width', 0 );
