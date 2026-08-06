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
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:32px; margin-top:20px; margin-bottom:40px;">
        <h1 style="font-size:24px; font-weight:bold; margin-bottom:24px; border-bottom:1px solid var(--border-color); padding-bottom:12px;"><?php the_title(); ?></h1>
        <div class="entry-content text-justify" style="font-size:15px; color:var(--text-color);">
            <?php the_content(); ?>
        </div>
    </article>
</main>

<?php get_footer(); ?>
