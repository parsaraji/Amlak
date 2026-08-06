<?php
/**
 * ZaminYab enqueue scripts and styles
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue scripts and styles.
 */
function zaminyab_scripts() {
    // Theme stylesheet
    wp_enqueue_style( 'zaminyab-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Theme main stylesheet
    wp_enqueue_style( 'zaminyab-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0' );

    // RTL stylesheet (if is_rtl is true, WordPress handles this natively, but we can enqueue rtl.css if needed)
    if ( is_rtl() ) {
        wp_enqueue_style( 'zaminyab-rtl', get_template_directory_uri() . '/assets/css/rtl.css', array( 'zaminyab-main' ), '1.0.0' );
    }

    // Leaflet (OpenStreetMap) assets if maps are enabled and map provider is set to leaflet/osm
    $maps_enabled = zaminyab_get_option( 'enable_maps', '1' );
    $map_provider = zaminyab_get_option( 'map_provider', 'osm' );
    if ( $maps_enabled === '1' ) {
        if ( $map_provider === 'osm' ) {
            wp_enqueue_style( 'leaflet-css', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4' );
            wp_enqueue_script( 'leaflet-js', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true );
        } elseif ( $map_provider === 'neshan' ) {
            wp_enqueue_style( 'neshan-sdk-css', 'https://static.neshan.org/sdk/leaflet/1.4.0/neshan-sdk.css', array(), '1.4.0' );
            wp_enqueue_script( 'neshan-sdk-js', 'https://static.neshan.org/sdk/leaflet/1.4.0/neshan-sdk.js', array(), '1.4.0', true );
        }
    }

    // Main Theme script
    wp_enqueue_script( 'zaminyab-main-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.0', true );

    // Enqueue specific script files depending on templates / pages
    if ( is_page_template( 'templates/page-submit-listing.php' ) || is_singular( 'land_listing' ) ) {
        wp_enqueue_script( 'zaminyab-submit-listing', get_template_directory_uri() . '/assets/js/submit-listing.js', array( 'jquery' ), '1.0.0', true );
    }

    if ( is_archive() || is_search() || is_page_template( 'templates/page-map-search.php' ) ) {
        wp_enqueue_script( 'zaminyab-search', get_template_directory_uri() . '/assets/js/search.js', array( 'jquery' ), '1.0.0', true );
    }

    if ( $maps_enabled === '1' ) {
        wp_enqueue_script( 'zaminyab-map', get_template_directory_uri() . '/assets/js/map.js', array( 'jquery' ), '1.0.0', true );
    }

    // Localize script for ajax functionality
    wp_localize_script( 'zaminyab-main-js', 'zaminyab_ajax_obj', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'zaminyab_ajax_nonce' ),
        'favorites_enabled' => zaminyab_get_option( 'enable_favorites', '1' ),
        'map_provider' => $map_provider,
        'default_lat' => zaminyab_get_option( 'default_latitude', '35.6892' ),
        'default_lng' => zaminyab_get_option( 'default_longitude', '51.3890' ),
        'default_zoom' => zaminyab_get_option( 'default_zoom', '12' ),
        'msg_no_location' => 'موقعیت مکانی روی نقشه تنظیم نشده است.',
    ) );
}
add_action( 'wp_enqueue_scripts', 'zaminyab_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function zaminyab_admin_scripts() {
    wp_enqueue_style( 'zaminyab-admin-style', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0.0' );
    wp_enqueue_script( 'zaminyab-admin-js', get_template_directory_uri() . '/assets/js/admin.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'zaminyab_admin_scripts' );
