<?php
/**
 * Shortcodes definitions
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. Advanced search form shortcode [zaminyab_search]
function zaminyab_search_shortcode() {
    ob_start();
    get_template_part( 'template-parts/listing-filters' );
    return ob_get_clean();
}
add_shortcode( 'zaminyab_search', 'zaminyab_search_shortcode' );

// 2. Frontend submission form [zaminyab_submit_listing]
function zaminyab_submit_listing_shortcode() {
    ob_start();
    get_template_part( 'templates/page-submit-listing' );
    return ob_get_clean();
}
add_shortcode( 'zaminyab_submit_listing', 'zaminyab_submit_listing_shortcode' );

// 3. Latest land listings [zaminyab_latest_listings count="8"]
function zaminyab_latest_listings_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'count' => '8',
    ), $atts );

    $query = new WP_Query( array(
        'post_type'      => 'land_listing',
        'post_status'    => 'publish',
        'posts_per_page' => intval( $a['count'] ),
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );

    ob_start();
    if ( $query->have_posts() ) {
        echo '<div class="grid grid-2-sm grid-3-md grid-4-lg">';
        while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part( 'template-parts/listing-card' );
        }
        echo '</div>';
        wp_reset_postdata();
    } else {
        get_template_part( 'template-parts/empty-state' );
    }
    return ob_get_clean();
}
add_shortcode( 'zaminyab_latest_listings', 'zaminyab_latest_listings_shortcode' );

// 4. Featured listings [zaminyab_featured_listings count="8"]
function zaminyab_featured_listings_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'count' => '8',
    ), $atts );

    $query = new WP_Query( array(
        'post_type'      => 'land_listing',
        'post_status'    => 'publish',
        'posts_per_page' => intval( $a['count'] ),
        'meta_query'     => array(
            array(
                'key'   => '_is_featured',
                'value' => '1',
            ),
        ),
    ) );

    ob_start();
    if ( $query->have_posts() ) {
        echo '<div class="grid grid-2-sm grid-3-md grid-4-lg">';
        while ( $query->have_posts() ) {
            $query->the_post();
            get_template_part( 'template-parts/listing-card' );
        }
        echo '</div>';
        wp_reset_postdata();
    } else {
        // Fallback to latest
        echo do_shortcode( '[zaminyab_latest_listings count="' . esc_attr( $a['count'] ) . '"]' );
    }
    return ob_get_clean();
}
add_shortcode( 'zaminyab_featured_listings', 'zaminyab_featured_listings_shortcode' );

// 5. User Dashboard [zaminyab_user_dashboard]
function zaminyab_user_dashboard_shortcode() {
    if ( ! is_user_logged_in() ) {
        return '<p class="text-justify" style="padding:24px;background:#fff;border-radius:8px;border:1px solid #ddd;">برای مشاهده داشبورد ابتدا باید وارد حساب کاربری خود شوید.</p>';
    }

    ob_start();
    get_template_part( 'templates/page-dashboard' );
    return ob_get_clean();
}
add_shortcode( 'zaminyab_user_dashboard', 'zaminyab_user_dashboard_shortcode' );

// 6. Favorites page [zaminyab_favorites]
function zaminyab_favorites_shortcode() {
    ob_start();
    get_template_part( 'templates/page-favorites' );
    return ob_get_clean();
}
add_shortcode( 'zaminyab_favorites', 'zaminyab_favorites_shortcode' );

// 7. Contact Buttons [zaminyab_contact_buttons]
function zaminyab_contact_buttons_shortcode() {
    $phone = zaminyab_get_option( 'phone_number' );
    $mobile = zaminyab_get_option( 'mobile_number' );
    $whatsapp = zaminyab_get_option( 'whatsapp_number' );
    $bale = zaminyab_get_option( 'bale_link' );
    $rubika = zaminyab_get_option( 'rubika_link' );
    $eitaa = zaminyab_get_option( 'eitaa_link' );

    ob_start();
    ?>
    <div class="zaminyab-contact-buttons" style="display:flex;flex-wrap:wrap;gap:12px;margin:20px 0;">
        <?php if ( ! empty( $phone ) ) : ?>
            <a href="tel:<?php echo esc_attr( $phone ); ?>" class="btn-secondary" style="padding:10px 16px;border-radius:8px;color:#fff;font-weight:bold;display:flex;align-items:center;gap:8px;">
                <?php echo zaminyab_get_svg_icon( 'phone' ); ?> تماس ثابت
            </a>
        <?php endif; ?>
        <?php if ( ! empty( $mobile ) ) : ?>
            <a href="tel:<?php echo esc_attr( $mobile ); ?>" class="btn-accent" style="padding:10px 16px;border-radius:8px;color:#fff;font-weight:bold;display:flex;align-items:center;gap:8px;">
                <?php echo zaminyab_get_svg_icon( 'phone' ); ?> تماس موبایل
            </a>
        <?php endif; ?>
        <?php if ( ! empty( $whatsapp ) ) : ?>
            <a href="https://wa.me/<?php echo esc_attr( $whatsapp ); ?>" class="btn-primary" style="padding:10px 16px;border-radius:8px;color:#fff;font-weight:bold;display:flex;align-items:center;gap:8px;">
                <?php echo zaminyab_get_svg_icon( 'whatsapp' ); ?> واتس‌اپ
            </a>
        <?php endif; ?>
        <?php if ( ! empty( $bale ) ) : ?>
            <a href="<?php echo esc_url( $bale ); ?>" class="btn-outline" style="padding:10px 16px;border-radius:8px;font-weight:bold;display:flex;align-items:center;gap:8px;">
                پیام‌رسان بله
            </a>
        <?php endif; ?>
        <?php if ( ! empty( $rubika ) ) : ?>
            <a href="<?php echo esc_url( $rubika ); ?>" class="btn-outline" style="padding:10px 16px;border-radius:8px;font-weight:bold;display:flex;align-items:center;gap:8px;">
                روبیکا
            </a>
        <?php endif; ?>
        <?php if ( ! empty( $eitaa ) ) : ?>
            <a href="<?php echo esc_url( $eitaa ); ?>" class="btn-outline" style="padding:10px 16px;border-radius:8px;font-weight:bold;display:flex;align-items:center;gap:8px;">
                ایتا
            </a>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'zaminyab_contact_buttons', 'zaminyab_contact_buttons_shortcode' );
