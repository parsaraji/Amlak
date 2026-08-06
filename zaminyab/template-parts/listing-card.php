<?php
/**
 * Polished reusable Listing Card template part
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post_id     = get_the_ID();
$price_total = get_post_meta( $post_id, '_price_total', true );
$price_meter = get_post_meta( $post_id, '_price_meter', true );
$area_size   = get_post_meta( $post_id, '_area_size', true );
$is_featured = get_post_meta( $post_id, '_is_featured', true );
$is_urgent   = get_post_meta( $post_id, '_is_urgent', true );

// Grab rent metrics
$rent_rent   = get_post_meta( $post_id, '_rent_monthly', true );
$rent_deposit= get_post_meta( $post_id, '_rent_deposit', true );

// Land type first term
$terms_type = get_the_terms( $post_id, 'land_type' );
$land_type_name = ( ! empty( $terms_type ) ) ? $terms_type[0]->name : 'زمین';

// Location first term (Region / City)
$terms_loc = get_the_terms( $post_id, 'land_location' );
$loc_name = ( ! empty( $terms_loc ) ) ? $terms_loc[0]->name : 'نامشخص';

// Status first term (فروش / اجاره)
$terms_status = get_the_terms( $post_id, 'land_status' );
$status_name  = ( ! empty( $terms_status ) ) ? $terms_status[0]->name : '';
?>

<div class="listing-card">
    <div class="listing-card-image" style="aspect-ratio: 1/1;">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'zaminyab-square' ); ?>
            <?php else : ?>
                <div style="height:100%; display:flex; align-items:center; justify-content:center; background:#fafaf9; color:var(--text-muted);">
                    <?php echo zaminyab_get_svg_icon( 'land', 'large' ); ?>
                </div>
            <?php endif; ?>
        </a>

        <!-- Badges -->
        <?php if ( $is_urgent === '1' ) : ?>
            <span class="listing-badge badge-danger">فوری</span>
        <?php elseif ( $is_featured === '1' ) : ?>
            <span class="listing-badge badge-accent">ویژه</span>
        <?php elseif ( ! empty($status_name) ) : ?>
            <span class="listing-badge badge-primary"><?php echo esc_html($status_name); ?></span>
        <?php endif; ?>

        <!-- Favorite Toggle button -->
        <button class="listing-favorite-btn" onclick="toggleFavorite(<?php echo $post_id; ?>, this)" aria-label="افزودن به علاقه‌مندی‌ها">
            <?php if ( zaminyab_is_post_favorited( $post_id ) ) : ?>
                <?php echo zaminyab_get_svg_icon( 'heart-filled' ); ?>
            <?php else : ?>
                <?php echo zaminyab_get_svg_icon( 'heart' ); ?>
            <?php endif; ?>
        </button>
    </div>

    <div class="listing-card-content">
        <div class="listing-card-meta">
            <span><?php echo esc_html( $land_type_name ); ?></span>
            <span>•</span>
            <span><?php echo esc_html( $loc_name ); ?></span>
        </div>

        <h3 class="listing-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <!-- Core metrics (m2) -->
        <div class="listing-card-specs">
            <div class="listing-card-spec-item">
                <?php echo zaminyab_get_svg_icon( 'area' ); ?>
                <span><?php echo zaminyab_format_area( $area_size ); ?></span>
            </div>
        </div>

        <div class="listing-card-footer">
            <div class="listing-card-prices">
                <?php if ( ! empty($rent_deposit) || ! empty($rent_rent) ) : ?>
                    <div class="listing-card-price" style="font-size: 13px; color: var(--accent-color);">
                        رهن: <?php echo zaminyab_format_price( $rent_deposit ); ?>
                    </div>
                    <div class="listing-card-price-per-meter" style="font-size: 13px; color: var(--secondary-color);">
                        اجاره: <?php echo zaminyab_format_price( $rent_rent ); ?>
                    </div>
                <?php else : ?>
                    <div class="listing-card-price"><?php echo zaminyab_format_price( $price_total ); ?></div>
                    <?php if ( ! empty( $price_meter ) ) : ?>
                        <div class="listing-card-price-per-meter"><?php echo zaminyab_format_price( $price_meter ); ?> هر متر</div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
