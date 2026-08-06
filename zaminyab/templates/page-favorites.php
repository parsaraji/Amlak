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
    <div class="zaminyab-page-card">
        <?php get_template_part( 'template-parts/favorites-content' ); ?>
    </div>
</main>

<?php get_footer(); ?>
