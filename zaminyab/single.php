<?php
/**
 * ZaminYab Single Listing Detail Page
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<!-- Breadcrumbs -->
<?php zaminyab_breadcrumbs(); ?>

<main id="primary" class="site-main container" style="margin-top:20px;">
    <?php while ( have_posts() ) : the_post();
        $post_id = get_the_ID();

        // Grab custom fields
        $price_total = get_post_meta( $post_id, '_price_total', true );
        $price_meter = get_post_meta( $post_id, '_price_meter', true );
        $area_size   = get_post_meta( $post_id, '_area_size', true );
        $seller_name = get_post_meta( $post_id, '_seller_name', true );
        $seller_phone= get_post_meta( $post_id, '_seller_phone', true );

        $land_width   = get_post_meta( $post_id, '_land_width', true );
        $land_length  = get_post_meta( $post_id, '_land_length', true );
        $land_passage = get_post_meta( $post_id, '_land_passage', true );

        $has_water            = get_post_meta( $post_id, '_has_water', true );
        $has_electricity      = get_post_meta( $post_id, '_has_electricity', true );
        $has_gas              = get_post_meta( $post_id, '_has_gas', true );
        $has_phone            = get_post_meta( $post_id, '_has_phone', true );
        $has_wall             = get_post_meta( $post_id, '_has_wall', true );
        $has_building_permit  = get_post_meta( $post_id, '_has_building_permit', true );
        $inside_plan          = get_post_meta( $post_id, '_inside_plan', true );
        $can_subdivide        = get_post_meta( $post_id, '_can_subdivide', true );

        $gallery_images       = get_post_meta( $post_id, '_gallery_images', true );
        $video_url            = get_post_meta( $post_id, '_video_url', true );
        $approx_address       = get_post_meta( $post_id, '_approx_address', true );

        ?>
        <div style="display: grid; grid-template-columns: 1fr; gap: 24px; align-items: start;">

            <!-- Left main column: Info, specs, description, map -->
            <div style="grid-column: span 1;">

                <!-- 1. Header block -->
                <div style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:24px; margin-bottom:24px;">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                        <h1 style="font-size:20px; font-weight:bold; color:var(--text-color);"><?php the_title(); ?></h1>
                        <button class="listing-favorite-btn" onclick="toggleFavorite(<?php echo $post_id; ?>, this)" aria-label="افزودن به علاقه‌مندی‌ها" style="position:static; border:1px solid var(--border-color); border-radius:50%; width:40px; height:40px;">
                            <?php if ( zaminyab_is_post_favorited( $post_id ) ) : ?>
                                <?php echo zaminyab_get_svg_icon( 'heart-filled' ); ?>
                            <?php else : ?>
                                <?php echo zaminyab_get_svg_icon( 'heart' ); ?>
                            <?php endif; ?>
                        </button>
                    </div>

                    <div style="display:flex; flex-wrap:wrap; gap:16px; font-size:12px; color:var(--text-muted); margin-bottom:20px;">
                        <span>ثبت در تاریخ: <?php echo get_the_date(); ?></span>
                        <span>شناسه آگهی: <?php echo zaminyab_to_persian_digits($post_id); ?></span>
                    </div>

                    <div class="listing-detail-grid">
                        <div class="listing-detail-item">
                            <span class="listing-detail-label">قیمت کل:</span>
                            <span class="listing-detail-value" style="color:var(--secondary-color);"><?php echo zaminyab_format_price($price_total); ?></span>
                        </div>
                        <div class="listing-detail-item">
                            <span class="listing-detail-label">قیمت هر متر:</span>
                            <span class="listing-detail-value"><?php echo zaminyab_format_price($price_meter); ?></span>
                        </div>
                        <div class="listing-detail-item">
                            <span class="listing-detail-label">متراژ زمین:</span>
                            <span class="listing-detail-value"><?php echo zaminyab_format_area($area_size); ?></span>
                        </div>
                        <div class="listing-detail-item">
                            <span class="listing-detail-label">نوع سند:</span>
                            <span class="listing-detail-value">
                                <?php
                                $terms = get_the_terms( $post_id, 'land_document_type' );
                                echo ( ! empty($terms) ) ? esc_html($terms[0]->name) : 'قولنامه‌ای';
                                ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- 2. Gallery Block -->
                <div class="single-listing-gallery">
                    <div class="gallery-main" id="galleryMain">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" id="mainGalleryImage">
                        <?php else : ?>
                            <div style="height:100%; display:flex; align-items:center; justify-content:center; background:#f5f5f4; color:var(--text-muted);">
                                <?php echo zaminyab_get_svg_icon('land', 'large'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ( ! empty($gallery_images) ) :
                        $img_ids = explode( ',', $gallery_images ); ?>
                        <div class="gallery-thumbs">
                            <?php foreach ( $img_ids as $img_id ) :
                                $url = wp_get_attachment_image_url( $img_id, 'large' ); ?>
                                <div class="gallery-thumb-item" onclick="switchGalleryImage('<?php echo esc_url($url); ?>', this)">
                                    <img src="<?php echo wp_get_attachment_image_url( $img_id, 'thumbnail' ); ?>" alt="تصویر زمین">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- 3. Details Spec table -->
                <div style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:24px; margin-bottom:24px;">
                    <h3 style="font-size:16px; font-weight:bold; margin-bottom:16px; border-bottom:1px solid var(--border-color); padding-bottom:8px;">مشخصات و ابعاد زمین</h3>
                    <div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:16px; font-size:14px;">
                        <div>بر زمین: <strong><?php echo esc_html( $land_width ? zaminyab_to_persian_digits($land_width) . ' متر' : 'ثبت نشده' ); ?></strong></div>
                        <div>طول زمین: <strong><?php echo esc_html( $land_length ? zaminyab_to_persian_digits($land_length) . ' متر' : 'ثبت نشده' ); ?></strong></div>
                        <div>عرض گذر / کوچه: <strong><?php echo esc_html( $land_passage ? zaminyab_to_persian_digits($land_passage) . ' متر' : 'ثبت نشده' ); ?></strong></div>
                    </div>
                </div>

                <!-- 4. Utilities / Facilities checklist -->
                <div style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:24px; margin-bottom:24px;">
                    <h3 style="font-size:16px; font-weight:bold; margin-bottom:16px; border-bottom:1px solid var(--border-color); padding-bottom:8px;">امکانات و انشعابات</h3>
                    <div class="listing-features-grid">
                        <div class="listing-feature-item <?php echo ($has_water === '1') ? 'yes' : 'no'; ?>">
                            <?php echo zaminyab_get_svg_icon( ($has_water === '1') ? 'check' : 'close' ); ?> انشعاب آب
                        </div>
                        <div class="listing-feature-item <?php echo ($has_electricity === '1') ? 'yes' : 'no'; ?>">
                            <?php echo zaminyab_get_svg_icon( ($has_electricity === '1') ? 'check' : 'close' ); ?> انشعاب برق
                        </div>
                        <div class="listing-feature-item <?php echo ($has_gas === '1') ? 'yes' : 'no'; ?>">
                            <?php echo zaminyab_get_svg_icon( ($has_gas === '1') ? 'check' : 'close' ); ?> انشعاب گاز
                        </div>
                        <div class="listing-feature-item <?php echo ($has_phone === '1') ? 'yes' : 'no'; ?>">
                            <?php echo zaminyab_get_svg_icon( ($has_phone === '1') ? 'check' : 'close' ); ?> خط تلفن
                        </div>
                        <div class="listing-feature-item <?php echo ($has_wall === '1') ? 'yes' : 'no'; ?>">
                            <?php echo zaminyab_get_svg_icon( ($has_wall === '1') ? 'check' : 'close' ); ?> دیوارکشی
                        </div>
                        <div class="listing-feature-item <?php echo ($has_building_permit === '1') ? 'yes' : 'no'; ?>">
                            <?php echo zaminyab_get_svg_icon( ($has_building_permit === '1') ? 'check' : 'close' ); ?> پروانه ساخت
                        </div>
                        <div class="listing-feature-item <?php echo ($inside_plan === '1') ? 'yes' : 'no'; ?>">
                            <?php echo zaminyab_get_svg_icon( ($inside_plan === '1') ? 'check' : 'close' ); ?> داخل بافت هادی
                        </div>
                        <div class="listing-feature-item <?php echo ($can_subdivide === '1') ? 'yes' : 'no'; ?>">
                            <?php echo zaminyab_get_svg_icon( ($can_subdivide === '1') ? 'check' : 'close' ); ?> قابلیت تفکیک
                        </div>
                    </div>
                </div>

                <!-- 5. Description Block -->
                <div style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:24px; margin-bottom:24px;">
                    <h3 style="font-size:16px; font-weight:bold; margin-bottom:16px; border-bottom:1px solid var(--border-color); padding-bottom:8px;">توضیحات تکمیلی آگهی</h3>
                    <div class="text-justify" style="font-size:14px; color:var(--text-color);">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- 6. Map Block -->
                <div style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:24px; margin-bottom:24px;">
                    <h3 style="font-size:16px; font-weight:bold; margin-bottom:16px; border-bottom:1px solid var(--border-color); padding-bottom:8px;">موقعیت مکانی روی نقشه</h3>
                    <?php if ( ! empty($approx_address) ) : ?>
                        <p style="font-size:13px; margin-bottom:12px;">آدرس تقریبی: <strong><?php echo esc_html($approx_address); ?></strong></p>
                    <?php endif; ?>
                    <?php zaminyab_render_map( $post_id ); ?>
                </div>

            </div>
        </div>
    <?php endwhile; ?>
</main>

<!-- Sticky Mobile Contact bar at very bottom -->
<?php if ( wp_is_mobile() ) : ?>
    <div class="mobile-sticky-contact">
        <button onclick="revealSellerNumber(this)" data-number="<?php echo esc_attr($seller_phone); ?>" class="btn-primary" style="border-radius:8px;font-size:14px;font-weight:bold;">
            <?php echo zaminyab_get_svg_icon('phone'); ?> تماس تلفنی
        </button>
        <?php if ( zaminyab_get_option( 'whatsapp_number' ) ) : ?>
            <a href="https://wa.me/<?php echo esc_attr( zaminyab_get_option('whatsapp_number') ); ?>" class="btn-secondary" style="border-radius:8px;font-size:14px;font-weight:bold;display:flex;align-items:center;justify-content:center;color:#fff;">
                واتس‌اپ
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<script type="text/javascript">
function switchGalleryImage(imgUrl, element) {
    document.getElementById('mainGalleryImage').src = imgUrl;
    // Highlight active thumbnail
    var thumbs = document.getElementsByClassName('gallery-thumb-item');
    for (var i = 0; i < thumbs.length; i++) {
        thumbs[i].classList.remove('active');
    }
    element.classList.add('active');
}

function revealSellerNumber(button) {
    var num = button.getAttribute('data-number');
    if (num) {
        button.innerHTML = '<?php echo zaminyab_get_svg_icon('phone'); ?> ' + num;
        button.onclick = function() {
            window.location.href = 'tel:' + num;
        };
    }
}
</script>

<?php get_footer(); ?>
