<?php
/**
 * Template Name: الگوی علاقه‌مندی‌ها
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<!-- Breadcrumbs -->
<?php zaminyab_breadcrumbs(); ?>

<main id="primary" class="site-main container">
    <?php get_template_part( 'template-parts/favorites-content' ); ?>
</main>

<?php get_footer(); ?>
