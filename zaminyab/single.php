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

<main id="primary" class="site-main container" style="margin-top:20px; margin-bottom:40px;">
    <?php while ( have_posts() ) : the_post();
        $post_id = get_the_ID();

        // Grab custom fields
        $price_total = get_post_meta( $post_id, '_price_total', true );
        $price_meter = get_post_meta( $post_id, '_price_meter', true );
        $area_size   = get_post_meta( $post_id, '_area_size', true );
        $seller_name = get_post_meta( $post_id, '_seller_name', true );
        $seller_phone= get_post_meta( $post_id, '_seller_phone', true );

        $rent_rent   = get_post_meta( $post_id, '_rent_monthly', true );
        $rent_deposit= get_post_meta( $post_id, '_rent_deposit', true );

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

        $soil_type            = get_post_meta( $post_id, '_soil_type', true );
        $water_rights         = get_post_meta( $post_id, '_water_rights', true );
        $industrial_power     = get_post_meta( $post_id, '_industrial_power', true );
        $commercial_permit    = get_post_meta( $post_id, '_commercial_permit', true );

        $gallery_images       = get_post_meta( $post_id, '_gallery_images', true );
        $approx_address       = get_post_meta( $post_id, '_approx_address', true );

        ?>
        <div style="display: grid; grid-template-columns: 1fr; gap: 24px; align-items: start;">

            <!-- Left main column: Info, specs, description, map -->
            <div style="grid-column: span 1;">

                <!-- 1. Header block -->
                <div style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:20px; margin-bottom:20px; box-shadow: var(--shadow-sm);">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                        <h1 style="font-size:18px; font-weight:bold; color:var(--text-color); margin: 0; line-height: 1.5;"><?php the_title(); ?></h1>
                        <button class="listing-favorite-btn" onclick="toggleFavorite(<?php echo $post_id; ?>, this)" aria-label="افزودن به علاقه‌مندی‌ها" style="position:static; border:1px solid var(--border-color); border-radius:50%; width:36px; height:36px; flex-shrink:0;">
                            <?php if ( zaminyab_is_post_favorited( $post_id ) ) : ?>
                                <?php echo zaminyab_get_svg_icon( 'heart-filled' ); ?>
                            <?php else : ?>
                                <?php echo zaminyab_get_svg_icon( 'heart' ); ?>
                            <?php endif; ?>
                        </button>
                    </div>

                    <div style="display:flex; flex-wrap:wrap; gap:12px; font-size:11px; color:var(--text-muted); margin-bottom:16px;">
                        <span>ثبت در تاریخ: <?php echo zaminyab_get_jalali_date(); ?></span>
                        <span>•</span>
                        <span>شناسه آگهی: <?php echo zaminyab_to_persian_digits($post_id); ?></span>
                    </div>

                    <div class="listing-detail-grid" style="margin: 0; padding: 12px; background: #fafaf9; border-radius: 8px;">
                        <?php if ( ! empty($rent_deposit) || ! empty($rent_rent) ) : ?>
                            <div class="listing-detail-item">
                                <span class="listing-detail-label">ودیعه (رهن):</span>
                                <span class="listing-detail-value" style="color:var(--accent-color); font-size: 13px;"><?php echo zaminyab_format_price($rent_deposit); ?></span>
                            </div>
                            <div class="listing-detail-item">
                                <span class="listing-detail-label">اجاره ماهیانه:</span>
                                <span class="listing-detail-value" style="color:var(--secondary-color); font-size: 13px;"><?php echo zaminyab_format_price($rent_rent); ?></span>
                            </div>
                        <?php else : ?>
                            <div class="listing-detail-item">
                                <span class="listing-detail-label">قیمت کل:</span>
                                <span class="listing-detail-value" style="color:var(--secondary-color); font-size: 13px;"><?php echo zaminyab_format_price($price_total); ?></span>
                            </div>
                            <div class="listing-detail-item">
                                <span class="listing-detail-label">قیمت هر متر:</span>
                                <span class="listing-detail-value" style="font-size: 13px;"><?php echo zaminyab_format_price($price_meter); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="listing-detail-item">
                            <span class="listing-detail-label">متراژ زمین:</span>
                            <span class="listing-detail-value" style="font-size: 13px;"><?php echo zaminyab_format_area($area_size); ?></span>
                        </div>
                        <div class="listing-detail-item">
                            <span class="listing-detail-label">نوع سند:</span>
                            <span class="listing-detail-value" style="font-size: 13px;">
                                <?php
                                $terms = get_the_terms( $post_id, 'land_document_type' );
                                echo ( ! empty($terms) ) ? esc_html($terms[0]->name) : 'قولنامه‌ای';
                                ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- 2. Interactive Image Slider/Carousel Gallery Block -->
                <div class="single-listing-gallery" style="margin-bottom: 20px; background-color: #1c1917; position: relative; border-radius: 12px; overflow: hidden; direction: ltr !important;">
                    <div class="gallery-slider-container" style="position: relative; aspect-ratio: 16/10; display: flex; align-items: center; overflow: hidden; direction: ltr !important;">

                        <!-- Track for slides -->
                        <div id="zaminyabGalleryTrack" style="display: flex; width: 100%; height: 100%; transition: transform 0.4s ease-out;">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="gallery-slide" style="min-width: 100%; flex: 0 0 100%; flex-shrink: 0; height: 100%; display: flex; align-items: center; justify-content: center; background: #000;">
                                    <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" style="max-width:100%; max-height:100%; object-fit:contain;">
                                </div>
                            <?php endif; ?>

                            <?php
                            if ( ! empty($gallery_images) ) :
                                $img_ids = explode( ',', $gallery_images );
                                foreach ( $img_ids as $img_id ) :
                                    $url = wp_get_attachment_image_url( $img_id, 'large' ); ?>
                                    <div class="gallery-slide" style="min-width: 100%; flex: 0 0 100%; flex-shrink: 0; height: 100%; display: flex; align-items: center; justify-content: center; background: #000;">
                                        <img src="<?php echo esc_url($url); ?>" alt="تصویر گالری زمین" style="max-width:100%; max-height:100%; object-fit:contain;">
                                    </div>
                                <?php endforeach;
                            endif; ?>
                        </div>

                        <!-- Prev/Next Chevron Controls -->
                        <button onclick="slidePrev()" aria-label="تصویر قبلی" style="position: absolute; right: 12px; z-index: 10; background: rgba(0,0,0,0.6); border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; color: #fff; border: none; cursor: pointer;">
                            &#10095;
                        </button>
                        <button onclick="slideNext()" aria-label="تصویر بعدی" style="position: absolute; left: 12px; z-index: 10; background: rgba(0,0,0,0.6); border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; color: #fff; border: none; cursor: pointer;">
                            &#10094;
                        </button>
                    </div>

                    <!-- Dots Indicators -->
                    <div id="zaminyabGalleryDots" style="position: absolute; bottom: 12px; left: 0; right: 0; display: flex; justify-content: center; gap: 6px; z-index: 15;">
                    </div>
                </div>

                <!-- 3. Details Spec table -->
                <div style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:20px; margin-bottom:20px; box-shadow: var(--shadow-sm);">
                    <h3 style="font-size:15px; font-weight:bold; margin-bottom:12px; border-bottom:1px solid var(--border-color); padding-bottom:8px;">مشخصات و ابعاد زمین</h3>
                    <div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:12px; font-size:13px;">
                        <div>بر زمین: <strong><?php echo esc_html( $land_width ? zaminyab_to_persian_digits($land_width) . ' متر' : 'ثبت نشده' ); ?></strong></div>
                        <div>طول زمین: <strong><?php echo esc_html( $land_length ? zaminyab_to_persian_digits($land_length) . ' متر' : 'ثبت نشده' ); ?></strong></div>
                        <div>عرض گذر / کوچه: <strong><?php echo esc_html( $land_passage ? zaminyab_to_persian_digits($land_passage) . ' متر' : 'ثبت نشده' ); ?></strong></div>

                        <?php if ( ! empty($soil_type) ) : ?>
                            <div>نوع خاک: <strong><?php echo esc_html($soil_type); ?></strong></div>
                        <?php endif; ?>
                        <?php if ( ! empty($water_rights) ) : ?>
                            <div>حقابه زراعی: <strong><?php echo esc_html($water_rights); ?></strong></div>
                        <?php endif; ?>
                        <?php if ( ! empty($industrial_power) ) : ?>
                            <div>برق صنعتی: <strong><?php echo esc_html($industrial_power); ?></strong></div>
                        <?php endif; ?>
                        <?php if ( ! empty($commercial_permit) ) : ?>
                            <div>مجوز تجاری: <strong><?php echo esc_html($commercial_permit); ?></strong></div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 4. Utilities / Facilities checklist -->
                <div style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:20px; margin-bottom:20px; box-shadow: var(--shadow-sm);">
                    <h3 style="font-size:15px; font-weight:bold; margin-bottom:12px; border-bottom:1px solid var(--border-color); padding-bottom:8px;">امکانات و انشعابات</h3>
                    <div class="listing-features-grid" style="margin: 0; grid-template-columns: repeat(2, minmax(0, 1fr));">
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
                <div style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:20px; margin-bottom:20px; box-shadow: var(--shadow-sm);">
                    <h3 style="font-size:15px; font-weight:bold; margin-bottom:12px; border-bottom:1px solid var(--border-color); padding-bottom:8px;">توضیحات تکمیلی آگهی</h3>
                    <div class="text-justify" style="font-size:13px; color:var(--text-color); line-height: 1.7;">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- 6. Map Block -->
                <div style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:20px; margin-bottom:20px; box-shadow: var(--shadow-sm);">
                    <h3 style="font-size:15px; font-weight:bold; margin-bottom:12px; border-bottom:1px solid var(--border-color); padding-bottom:8px;">موقعیت مکانی روی نقشه</h3>
                    <?php if ( ! empty($approx_address) ) : ?>
                        <p style="font-size:13px; margin-bottom:12px;">آدرس تقریبی: <strong><?php echo esc_html($approx_address); ?></strong></p>
                    <?php endif; ?>
                    <?php zaminyab_render_map( $post_id ); ?>
                </div>

            </div>
        </div>
    <?php endwhile; ?>
</main>

<!-- Sticky Contact Bar at very bottom of screen -->
<div class="mobile-sticky-contact" style="background:#fff; box-shadow:0 -4px 10px rgba(0,0,0,0.06); padding: 12px 16px; border-top:1px solid var(--border-color); z-index: 10001;">
    <button onclick="revealSellerNumber(this)" data-number="<?php echo esc_attr($seller_phone); ?>" class="btn-primary" style="height: 44px; border-radius:8px; font-size:13px; font-weight:bold; flex: 1;">
        <?php echo zaminyab_get_svg_icon('phone'); ?> تماس تلفنی با <?php echo esc_html($seller_name ? $seller_name : 'فروشنده'); ?>
    </button>
    <?php if ( zaminyab_get_option( 'whatsapp_number' ) ) : ?>
        <a href="https://wa.me/<?php echo esc_attr( zaminyab_get_option('whatsapp_number') ); ?>" class="btn-secondary" style="height: 44px; width: 44px; border-radius:8px; display:flex; align-items:center; justify-content:center; color:#fff;">
            <?php echo zaminyab_get_svg_icon('whatsapp'); ?>
        </a>
    <?php endif; ?>
</div>

<!-- Inline Carousel Controller JS -->
<script type="text/javascript">
var slideIndex = 0;
var track = document.getElementById('zaminyabGalleryTrack');
var slides = document.getElementsByClassName('gallery-slide');
var dotsContainer = document.getElementById('zaminyabGalleryDots');

function initCarousel() {
    if (!track || slides.length === 0) return;

    // Generate dots
    dotsContainer.innerHTML = '';
    for (var i = 0; i < slides.length; i++) {
        var dot = document.createElement('button');
        dot.style.width = '8px';
        dot.style.height = '8px';
        dot.style.borderRadius = '50%';
        dot.style.backgroundColor = (i === 0) ? 'var(--primary-color)' : 'rgba(255,255,255,0.4)';
        dot.style.border = 'none';
        dot.style.padding = '0';
        dot.style.cursor = 'pointer';
        dot.setAttribute('onclick', 'setSlide(' + i + ')');
        dot.className = 'gallery-dot';
        dotsContainer.appendChild(dot);
    }
}

function updateSlidePosition() {
    if (!track) return;
    var percentage = slideIndex * -100;
    track.style.transform = 'translateX(' + percentage + '%)';

    // Update active dot
    var dots = document.getElementsByClassName('gallery-dot');
    for (var i = 0; i < dots.length; i++) {
        dots[i].style.backgroundColor = (i === slideIndex) ? 'var(--primary-color)' : 'rgba(255,255,255,0.4)';
    }
}

function slideNext() {
    slideIndex = (slideIndex + 1) % slides.length;
    updateSlidePosition();
}

function slidePrev() {
    slideIndex = (slideIndex - 1 + slides.length) % slides.length;
    updateSlidePosition();
}

function setSlide(index) {
    slideIndex = index;
    updateSlidePosition();
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

document.addEventListener('DOMContentLoaded', function() {
    initCarousel();
});
</script>

<?php get_footer(); ?>
