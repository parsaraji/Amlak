<?php
/**
 * ZaminYab setup functions and programmatic page installer
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

        // Define square crop image size (Center-cropped square images)
        add_image_size( 'zaminyab-square', 600, 600, array( 'center', 'center' ) );

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
 * Programmatically create essential directory pages on theme activation.
 */
function zaminyab_create_essential_pages() {
    $pages = array(
        'submit-listing' => array(
            'title'     => 'ثبت آگهی فروش زمین',
            'content'   => '[zaminyab_submit_listing]',
            'template'  => 'templates/page-submit-listing.php',
        ),
        'dashboard' => array(
            'title'     => 'داشبورد آگهی‌های من',
            'content'   => '[zaminyab_user_dashboard]',
            'template'  => 'templates/page-dashboard.php',
        ),
        'favorites' => array(
            'title'     => 'علاقه‌مندی‌ها',
            'content'   => '[zaminyab_favorites]',
            'template'  => 'templates/page-favorites.php',
        ),
        'map-search' => array(
            'title'     => 'جستجو روی نقشه',
            'content'   => '[zaminyab_map_search]',
            'template'  => 'templates/page-map-search.php',
        ),
        'contact' => array(
            'title'     => 'تماس با ما',
            'content'   => '',
            'template'  => 'templates/page-contact.php',
        ),
        'about' => array(
            'title'     => 'درباره ما',
            'content'   => '',
            'template'  => 'templates/page-about.php',
        ),
        'rules' => array(
            'title'     => 'قوانین ثبت آگهی',
            'content'   => '',
            'template'  => 'templates/page-rules.php',
        ),
        'help' => array(
            'title'     => 'راهنما',
            'content'   => '',
            'template'  => 'templates/page-help.php',
        ),
    );

    foreach ( $pages as $slug => $page_data ) {
        // Check if page already exists
        $check_page = get_page_by_path( $slug );
        if ( ! $check_page ) {
            $page_id = wp_insert_post( array(
                'post_title'    => $page_data['title'],
                'post_content'  => $page_data['content'],
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_name'     => $slug,
            ) );

            if ( $page_id && ! is_wp_error( $page_id ) && ! empty( $page_data['template'] ) ) {
                update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
            }
        }
    }
}
add_action( 'after_switch_theme', 'zaminyab_create_essential_pages' );
add_action( 'init', 'zaminyab_create_essential_pages', 90 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function zaminyab_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'zaminyab_content_width', 1200 );
}
add_action( 'after_setup_theme', 'zaminyab_content_width', 0 );
