<?php
/**
 * ZaminYab Archive Template (Persian Lands Catalog)
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
    <div style="display: grid; grid-template-columns: 1fr; gap: 24px; margin-top: 20px; align-items: start;">
        <?php if ( ! wp_is_mobile() ) : ?>
            <div style="grid-column: span 1;">
                <!-- Desktop Sidebar Filters -->
                <?php get_template_part( 'template-parts/listing-filters' ); ?>
            </div>
        <?php endif; ?>

        <div style="grid-column: span 1;">
            <div class="section-header" style="margin-top:0;">
                <h1 class="section-title">آگهی‌های فروش زمین</h1>
                <!-- Sorting & Filters buttons for mobile -->
                <div style="display:flex; gap:8px;">
                    <?php if ( wp_is_mobile() ) : ?>
                        <button class="btn-outline" onclick="toggleMobileFilters()" style="padding: 6px 12px; font-size: 12px; border-radius: 20px;">
                            <?php echo zaminyab_get_svg_icon('filter'); ?> فیلترها
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Main query loop -->
            <?php
            $query = zaminyab_get_search_query();
            if ( $query->have_posts() ) : ?>
                <div class="grid grid-2-sm grid-3-md grid-4-lg">
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <?php get_template_part( 'template-parts/listing-card' ); ?>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <?php
                get_template_part( 'template-parts/pagination', null, array( 'query' => $query ) );
                wp_reset_postdata();
                ?>
            <?php else : ?>
                <?php get_template_part( 'template-parts/empty-state' ); ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- Mobile drawer filters overlay -->
<?php if ( wp_is_mobile() ) : ?>
    <div class="mobile-sidebar" id="mobileFilters">
        <div class="mobile-sidebar-header">
            <strong>فیلترهای جستجوی زمین</strong>
            <button class="mobile-sidebar-close" onclick="toggleMobileFilters()">
                <?php echo zaminyab_get_svg_icon('close'); ?>
            </button>
        </div>
        <div class="mobile-sidebar-body">
            <?php get_template_part( 'template-parts/listing-filters' ); ?>
        </div>
    </div>
    <div class="mobile-sidebar-overlay" id="mobileFiltersOverlay" onclick="toggleMobileFilters()"></div>
<?php endif; ?>

<?php get_footer(); ?>
