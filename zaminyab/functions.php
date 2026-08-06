<?php
/**
 * ZaminYab Functions Loader
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load backend modules
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/taxonomies.php';
require_once get_template_directory() . '/inc/meta-boxes.php';
require_once get_template_directory() . '/inc/svg-icons.php';
require_once get_template_directory() . '/inc/theme-settings.php';
require_once get_template_directory() . '/inc/code-injection.php';
require_once get_template_directory() . '/inc/login-customizer.php';
require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/seo.php';
require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/search-handler.php';
require_once get_template_directory() . '/inc/frontend-submit.php';
require_once get_template_directory() . '/inc/map-functions.php';
require_once get_template_directory() . '/inc/documentation-panel.php';

// Shortcodes registration
require_once get_template_directory() . '/inc/shortcodes.php';
