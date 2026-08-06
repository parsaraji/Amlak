<?php
/**
 * ZaminYab Page template
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
    <article id="post-<?php the_ID(); ?>" <?php post_class('zaminyab-page-card'); ?>>
        <h1 style="font-size:20px; font-weight:bold; margin-bottom:20px; border-bottom:1px solid var(--border-color); padding-bottom:12px;"><?php the_title(); ?></h1>
        <div class="entry-content text-justify" style="font-size:14px; color:var(--text-color); line-height: 1.8;">
            <?php the_content(); ?>
        </div>
    </article>
</main>

<?php get_footer(); ?>
