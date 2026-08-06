<?php
/**
 * ZaminYab Default Index Template
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<main id="primary" class="site-main container">
    <div style="padding: 40px 0;">
        <h1 style="font-size:24px; font-weight:bold; margin-bottom:20px;"><?php single_post_title(); ?></h1>

        <?php if ( have_posts() ) : ?>
            <div class="grid grid-2-sm grid-3-md grid-4-lg">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('listing-card'); ?>>
                        <div class="listing-card-content" style="padding:20px;">
                            <h2 style="font-size:16px; font-weight:bold; margin-bottom:10px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div style="font-size:13px; color:var(--text-muted); margin-bottom:12px;"><?php the_excerpt(); ?></div>
                            <div style="font-size:11px; color:var(--text-muted);"><?php echo get_the_date(); ?></div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <?php get_template_part( 'template-parts/empty-state' ); ?>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
