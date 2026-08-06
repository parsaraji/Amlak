<?php
/**
 * Template Name: الگوی ثبت آگهی فروش زمین
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. Success Screen Handling
$success_post_id = isset( $_GET['submit_success'] ) ? intval( $_GET['submit_success'] ) : 0;
$edit_success    = isset( $_GET['edit_success'] ) && $_GET['edit_success'] === '1';

if ( $success_post_id || $edit_success ) {
    get_header(); ?>
    <main id="primary" class="site-main container">
        <div style="max-width: 600px; margin: 80px auto; text-align: center; background: #fff; border: 1px solid var(--border-color); border-radius: 12px; padding: 48px 32px; box-shadow: var(--shadow-sm);">
            <div style="width: 64px; height: 64px; background-color: #f0fdf4; color: var(--secondary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                <?php echo zaminyab_get_svg_icon( 'check' ); ?>
            </div>

            <?php if ( $edit_success ) : ?>
                <h1 style="font-size: 22px; font-weight: bold; margin-bottom: 16px; color: var(--text-color);">بروزرسانی با موفقیت انجام شد!</h1>
                <p class="text-justify" style="text-align: center; color: var(--text-muted); margin-bottom: 32px;">
                    تغییرات شما در آگهی زمین ذخیره گردید و پس از تایید مدیر روی وب‌سایت نمایش داده خواهد شد.
                </p>
            <?php else : ?>
                <h1 style="font-size: 22px; font-weight: bold; margin-bottom: 16px; color: var(--text-color);">آگهی شما با موفقیت ثبت شد!</h1>
                <p class="text-justify" style="text-align: center; color: var(--text-muted); margin-bottom: 32px;">
                    با تشکر از شما، آگهی زمین شما با موفقیت ثبت گردید. آگهی شما پس از بررسی و تایید کارشناسان در کوتاه‌ترین زمان روی وب‌سایت منتشر خواهد شد.
                </p>
            <?php endif; ?>

            <div style="display: flex; gap: 12px; justify-content: center;">
                <?php if ( $success_post_id ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $success_post_id ) ); ?>" class="btn-primary" style="padding: 10px 20px; border-radius: 8px;">
                        مشاهده پیش‌نمایش آگهی
                    </a>
                <?php endif; ?>
                <a href="<?php echo esc_url( home_url( '/dashboard/' ) ); ?>" class="btn-outline" style="padding: 10px 20px; border-radius: 8px;">
                    مدیریت آگهی‌های من (داشبورد)
                </a>
            </div>
        </div>
    </main>
    <?php get_footer();
    exit;
}

// 2. Pre-populate Fields for Post Editing
$is_editing = false;
$edit_id    = isset( $_GET['edit_id'] ) ? intval( $_GET['edit_id'] ) : 0;

$title           = '';
$description     = '';
$land_type_id    = 0;
$land_usage_id   = 0;
$land_location_id= 0;
$land_status_id  = 0;
$land_doc_id     = 0;

$price_total     = '';
$price_meter     = '';
$rent_monthly    = '';
$rent_deposit    = '';

$seller_name     = '';
$seller_phone    = '';
$seller_whatsapp = '';
$seller_bale     = '';
$seller_rubika   = '';
$seller_eitaa    = '';
$land_width      = '';
$land_length     = '';
$land_passage    = '';

$soil_type       = '';
$water_rights    = '';
$industrial_power= '';
$commercial_permit= '';

$approx_address  = '';
$latitude        = '35.6892';
$longitude       = '51.3890';
$map_zoom        = '12';

$allow_direct_call   = '0';
$click_to_reveal     = '0';
$has_water           = '0';
$has_electricity     = '0';
$has_gas             = '0';
$has_phone           = '0';
$has_wall            = '0';
$has_building_permit = '0';
$inside_plan         = '0';
$can_subdivide       = '0';
$approx_mode         = '0';
$video_url           = '';

// Ensure anyone can submit/register if settings or WP setup allows it
if ( ! is_user_logged_in() ) {
    $guest_allowed = zaminyab_get_option( 'enable_guest_submission', '1' ); // default to guest allowed if needed
    if ( $guest_allowed !== '1' ) {
        wp_redirect( wp_login_url() );
        exit;
    }
}

if ( $edit_id ) {
    if ( ! is_user_logged_in() ) {
        wp_redirect( wp_login_url() );
        exit;
    }

    $post_to_edit = get_post( $edit_id );
    if ( $post_to_edit && intval( $post_to_edit->post_author ) === get_current_user_id() ) {
        $is_editing  = true;
        $title       = $post_to_edit->post_title;
        $description = $post_to_edit->post_content;

        // Grab tax terms
        $types = get_the_terms( $edit_id, 'land_type' );
        if ( ! empty( $types ) ) { $land_type_id = $types[0]->term_id; }

        $usages = get_the_terms( $edit_id, 'land_usage' );
        if ( ! empty( $usages ) ) { $land_usage_id = $usages[0]->term_id; }

        $locs = get_the_terms( $edit_id, 'land_location' );
        if ( ! empty( $locs ) ) { $land_location_id = $locs[0]->term_id; }

        $statuses = get_the_terms( $edit_id, 'land_status' );
        if ( ! empty( $statuses ) ) { $land_status_id = $statuses[0]->term_id; }

        $docs = get_the_terms( $edit_id, 'land_document_type' );
        if ( ! empty( $docs ) ) { $land_doc_id = $docs[0]->term_id; }

        // Grab Meta values
        $price_total     = get_post_meta( $edit_id, '_price_total', true );
        $price_meter     = get_post_meta( $edit_id, '_price_meter', true );
        $rent_monthly    = get_post_meta( $edit_id, '_rent_monthly', true );
        $rent_deposit    = get_post_meta( $edit_id, '_rent_deposit', true );

        $seller_name     = get_post_meta( $edit_id, '_seller_name', true );
        $seller_phone    = get_post_meta( $edit_id, '_seller_phone', true );
        $seller_whatsapp = get_post_meta( $edit_id, '_seller_whatsapp', true );
        $seller_bale     = get_post_meta( $edit_id, '_seller_bale', true );
        $seller_rubika   = get_post_meta( $edit_id, '_seller_rubika', true );
        $seller_eitaa    = get_post_meta( $edit_id, '_seller_eitaa', true );
        $land_width      = get_post_meta( $edit_id, '_land_width', true );
        $land_length     = get_post_meta( $edit_id, '_land_length', true );
        $land_passage    = get_post_meta( $edit_id, '_land_passage', true );

        $soil_type       = get_post_meta( $edit_id, '_soil_type', true );
        $water_rights    = get_post_meta( $edit_id, '_water_rights', true );
        $industrial_power= get_post_meta( $edit_id, '_industrial_power', true );
        $commercial_permit= get_post_meta( $edit_id, '_commercial_permit', true );

        $approx_address  = get_post_meta( $edit_id, '_approx_address', true );

        $lat_val = get_post_meta( $edit_id, '_latitude', true );
        $lng_val = get_post_meta( $edit_id, '_longitude', true );
        if ( ! empty( $lat_val ) ) { $latitude = $lat_val; }
        if ( ! empty( $lng_val ) ) { $longitude = $lng_val; }

        $zoom_val = get_post_meta( $edit_id, '_map_zoom', true );
        if ( ! empty( $zoom_val ) ) { $map_zoom = $zoom_val; }

        $allow_direct_call   = get_post_meta( $edit_id, '_allow_direct_call', true );
        $click_to_reveal     = get_post_meta( $edit_id, '_click_to_reveal', true );
        $has_water           = get_post_meta( $edit_id, '_has_water', true );
        $has_electricity     = get_post_meta( $edit_id, '_has_electricity', true );
        $has_gas             = get_post_meta( $edit_id, '_has_gas', true );
        $has_phone           = get_post_meta( $edit_id, '_has_phone', true );
        $has_wall            = get_post_meta( $edit_id, '_has_wall', true );
        $has_building_permit = get_post_meta( $edit_id, '_has_building_permit', true );
        $inside_plan         = get_post_meta( $edit_id, '_inside_plan', true );
        $can_subdivide       = get_post_meta( $edit_id, '_can_subdivide', true );
        $approx_mode         = get_post_meta( $edit_id, '_approx_mode', true );
        $video_url           = get_post_meta( $edit_id, '_video_url', true );
    } else {
        wp_die( 'شما دسترسی لازم به این بخش را ندارید.' );
    }
}

get_header(); ?>

<main id="primary" class="site-main container">
    <div style="max-width: 800px; margin: 40px auto;">

        <h1 style="font-size:24px; font-weight:bold; text-align:center; margin-bottom:12px;">
            <?php echo $is_editing ? 'ویرایش آگهی ملک و زمین' : 'ثبت آگهی جدید ملک و زمین'; ?>
        </h1>
        <p class="text-justify" style="text-align:center; color:var(--text-muted); font-size:14px; margin-bottom:32px;">
            مشخصات زمین یا ملک خود را با دقت وارد و بروزرسانی نمایید (پشتیبانی کامل از خرید، فروش، رهن و اجاره).
        </p>

        <!-- Multi-step Wizard Navigation tabs -->
        <div class="submit-steps-nav">
            <div class="submit-step-nav-item active" id="step-nav-1">
                <span class="submit-step-number">۱</span>
                <span class="submit-step-label">اطلاعات اصلی</span>
            </div>
            <div class="submit-step-nav-item" id="step-nav-2">
                <span class="submit-step-number">۲</span>
                <span class="submit-step-label">موقعیت مکانی</span>
            </div>
            <div class="submit-step-nav-item" id="step-nav-3">
                <span class="submit-step-number">۳</span>
                <span class="submit-step-label">مشخصات زمین</span>
            </div>
            <div class="submit-step-nav-item" id="step-nav-4">
                <span class="submit-step-number">۴</span>
                <span class="submit-step-label">تصاویر و رسانه</span>
            </div>
            <div class="submit-step-nav-item" id="step-nav-5">
                <span class="submit-step-number">۵</span>
                <span class="submit-step-label">اطلاعات تماس</span>
            </div>
        </div>

        <form action="" method="post" enctype="multipart/form-data" id="submitListingForm">
            <?php wp_nonce_field( 'zaminyab_submit_listing_action', 'zaminyab_frontend_submit_nonce' ); ?>

            <?php if ( $is_editing ) : ?>
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
            <?php endif; ?>

            <!-- Step 1: Basic Info -->
            <div class="submit-form-panel submit-step-content active" id="step-panel-1">
                <h2 style="font-size:16px; font-weight:bold; margin-bottom:20px;">گام ۱: اطلاعات اصلی آگهی</h2>

                <div class="form-group">
                    <label for="title">عنوان آگهی (مسکونی، تجاری، فروش، اجاره):</label>
                    <input type="text" id="title" name="title" value="<?php echo esc_attr($title); ?>" placeholder="مانند: آپارتمان مسکونی ۱۲۰ متری رهن کامل در تهرانپارس" required>
                    <p class="description" style="font-size:11px; color:var(--text-muted);">یک عنوان توصیفی کوتاه و جذاب بنویسید.</p>
                </div>

                <div class="form-group-grid">
                    <div class="form-group">
                        <label for="land_type">نوع ملک/زمین:</label>
                        <select id="land_type" name="land_type" required>
                            <?php
                            $types = get_terms( array( 'taxonomy' => 'land_type', 'hide_empty' => false ) );
                            foreach ( $types as $type ) {
                                echo '<option value="' . esc_attr($type->term_id) . '" ' . selected($land_type_id, $type->term_id, false) . '>' . esc_html($type->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="land_status">نوع معامله (فروش، اجاره، رهن):</label>
                        <select id="land_status" name="land_status" onchange="toggleRentFields(this.value)" required>
                            <?php
                            $statuses = get_terms( array( 'taxonomy' => 'land_status', 'hide_empty' => false ) );
                            foreach ( $statuses as $st ) {
                                echo '<option value="' . esc_attr($st->term_id) . '" data-name="' . esc_attr($st->name) . '" ' . selected($land_status_id, $st->term_id, false) . '>' . esc_html($st->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="margin-top:16px;">
                    <label for="land_usage">کاربری زمین/ملک:</label>
                    <select id="land_usage" name="land_usage">
                        <?php
                        $usages = get_terms( array( 'taxonomy' => 'land_usage', 'hide_empty' => false ) );
                        foreach ( $usages as $usage ) {
                            echo '<option value="' . esc_attr($usage->term_id) . '" ' . selected($land_usage_id, $usage->term_id, false) . '>' . esc_html($usage->name) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group" style="margin-top:16px;">
                    <label for="description">توضیحات کامل آگهی:</label>
                    <textarea id="description" name="description" rows="6" placeholder="توضیحات کاملی درباره ویژگی‌ها، دسترسی‌ها و جزئیات زمین ارائه دهید..." required><?php echo esc_textarea($description); ?></textarea>
                </div>

                <div class="form-navigation">
                    <span></span>
                    <button type="button" class="btn-primary" onclick="nextFormStep(1)">گام بعدی</button>
                </div>
            </div>

            <!-- Step 2: Location -->
            <div class="submit-form-panel submit-step-content" id="step-panel-2">
                <h2 style="font-size:16px; font-weight:bold; margin-bottom:20px;">گام ۲: موقعیت مکانی زمین</h2>

                <div class="form-group-grid">
                    <div class="form-group">
                        <label for="land_location">استان و شهر:</label>
                        <select id="land_location" name="land_location" required>
                            <?php
                            $locations = get_terms( array( 'taxonomy' => 'land_location', 'hide_empty' => false ) );
                            foreach ( $locations as $loc ) {
                                echo '<option value="' . esc_attr($loc->term_id) . '" ' . selected($land_location_id, $loc->term_id, false) . '>' . esc_html($loc->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="approx_address">آدرس تقریبی زمین:</label>
                        <input type="text" id="approx_address" name="approx_address" value="<?php echo esc_attr($approx_address); ?>" placeholder="جاده اصلی، فرعی دوم، نبش کوچه...">
                    </div>
                </div>

                <!-- Live Map Selection -->
                <div class="form-group" style="margin-top:20px;">
                    <label>موقعیت جغرافیایی روی نقشه:</label>
                    <p style="font-size:12px; color:var(--text-muted); margin-bottom:8px;">روی نقشه کلیک کنید تا مارکر قرمز رنگ جابجا شود.</p>

                    <div id="zaminyab-leaflet-map" class="map-container"
                         data-lat="<?php echo esc_attr( $latitude ); ?>"
                         data-lng="<?php echo esc_attr( $longitude ); ?>"
                         data-zoom="<?php echo esc_attr( $map_zoom ); ?>"
                         data-approx="0">
                    </div>

                    <input type="hidden" id="latitude" name="latitude" value="<?php echo esc_attr($latitude); ?>">
                    <input type="hidden" id="longitude" name="longitude" value="<?php echo esc_attr($longitude); ?>">
                    <input type="hidden" id="map_zoom" name="map_zoom" value="<?php echo esc_attr($map_zoom); ?>">
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="approx_mode" value="1" <?php checked($approx_mode, '1'); ?>> موقعیت مکانی به صورت تقریبی نمایش داده شود (حفظ حریم خصوصی)
                    </label>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-muted" onclick="prevFormStep(2)">گام قبلی</button>
                    <button type="button" class="btn-primary" onclick="nextFormStep(2)">گام بعدی</button>
                </div>
            </div>

            <!-- Step 3: Land Specs -->
            <div class="submit-form-panel submit-step-content" id="step-panel-3">
                <h2 style="font-size:16px; font-weight:bold; margin-bottom:20px;">گام ۳: مشخصات و مبالغ معامله</h2>

                <div class="form-group-grid">
                    <div class="form-group">
                        <label for="area_size">متراژ کل (متر مربع):</label>
                        <input type="number" id="area_size" name="area_size" value="<?php echo esc_attr($area_size); ?>" placeholder="مثال: ۵۰۰" required>
                    </div>
                    <div class="form-group">
                        <label for="land_document">نوع سند ملک:</label>
                        <select id="land_document" name="land_document">
                            <?php
                            $docs_terms = get_terms( array( 'taxonomy' => 'land_document_type', 'hide_empty' => false ) );
                            foreach ( $docs_terms as $doc ) {
                                echo '<option value="' . esc_attr($doc->term_id) . '" ' . selected($land_doc_id, $doc->term_id, false) . '>' . esc_html($doc->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Price fields (Show/hide based on sale status) -->
                <div id="zaminyabSaleFields" class="form-group-grid" style="margin-top:16px;">
                    <div class="form-group">
                        <label for="price_total">قیمت کل (تومان):</label>
                        <input type="number" id="price_total" name="price_total" value="<?php echo esc_attr($price_total); ?>" placeholder="قیمت کل به تومان">
                    </div>
                    <div class="form-group">
                        <label for="price_meter">قیمت هر متر (تومان):</label>
                        <input type="number" id="price_meter" name="price_meter" value="<?php echo esc_attr($price_meter); ?>" placeholder="قیمت هر متر مربع">
                    </div>
                </div>

                <!-- Rent fields (Show/hide based on rent status) -->
                <div id="zaminyabRentFields" class="form-group-grid" style="margin-top:16px; display: none;">
                    <div class="form-group">
                        <label for="rent_deposit">مبلغ ودیعه / رهن (تومان):</label>
                        <input type="number" id="rent_deposit" name="rent_deposit" value="<?php echo esc_attr($rent_deposit); ?>" placeholder="مبلغ رهن به تومان">
                    </div>
                    <div class="form-group">
                        <label for="rent_monthly">اجاره ماهیانه (تومان):</label>
                        <input type="number" id="rent_monthly" name="rent_monthly" value="<?php echo esc_attr($rent_monthly); ?>" placeholder="مبلغ اجاره ماهیانه">
                    </div>
                </div>

                <div class="form-group-grid" style="margin-top:16px;">
                    <div class="form-group">
                        <label for="land_width">بر زمین (متر):</label>
                        <input type="number" id="land_width" name="land_width" value="<?php echo esc_attr($land_width); ?>" placeholder="مثال: ۲۰">
                    </div>
                    <div class="form-group">
                        <label for="land_length">طول زمین (متر):</label>
                        <input type="number" id="land_length" name="land_length" value="<?php echo esc_attr($land_length); ?>" placeholder="مثال: ۲۵">
                    </div>
                </div>

                <div class="form-group">
                    <label for="land_passage">عرض گذر یا کوچه (متر):</label>
                    <input type="number" id="land_passage" name="land_passage" value="<?php echo esc_attr($land_passage); ?>" placeholder="مثال: ۸">
                </div>

                <!-- Expanded specific inputs matching real-world premium directories -->
                <div class="form-group-grid" style="margin-top:16px; background:#f1f5f9; padding:16px; border-radius:8px;">
                    <div class="form-group">
                        <label for="soil_type">نوع خاک (کشاورزی):</label>
                        <input type="text" id="soil_type" name="soil_type" value="<?php echo esc_attr($soil_type); ?>" placeholder="شنی، لومی، رسی...">
                    </div>
                    <div class="form-group">
                        <label for="water_rights">حقابه زراعی (ساعت در هفته):</label>
                        <input type="text" id="water_rights" name="water_rights" value="<?php echo esc_attr($water_rights); ?>" placeholder="۲ ساعت در هفته">
                    </div>
                    <div class="form-group">
                        <label for="industrial_power">قدرت برق صنعتی (آمپر/کیلووات):</label>
                        <input type="text" id="industrial_power" name="industrial_power" value="<?php echo esc_attr($industrial_power); ?>" placeholder="۵۰ کیلووات سه فاز">
                    </div>
                    <div class="form-group">
                        <label for="commercial_permit">پروانه احداث تجاری:</label>
                        <input type="text" id="commercial_permit" name="commercial_permit" value="<?php echo esc_attr($commercial_permit); ?>" placeholder="مجوز تجاری دارد / طبقات...">
                    </div>
                </div>

                <div class="form-group" style="margin-top:20px;">
                    <label>انشعابات و امکانات موجود:</label>
                    <div class="listing-features-grid" style="background:#fafaf9; padding:16px; border-radius:8px; grid-template-columns: repeat(2, minmax(0,1fr));">
                        <label><input type="checkbox" name="has_water" value="1" <?php checked($has_water, '1'); ?>> انشعاب آب</label>
                        <label><input type="checkbox" name="has_electricity" value="1" <?php checked($has_electricity, '1'); ?>> انشعاب برق</label>
                        <label><input type="checkbox" name="has_gas" value="1" <?php checked($has_gas, '1'); ?>> انشعاب گاز</label>
                        <label><input type="checkbox" name="has_phone" value="1" <?php checked($has_phone, '1'); ?>> خط تلفن</label>
                        <label><input type="checkbox" name="has_wall" value="1" <?php checked($has_wall, '1'); ?>> دیوارکشی شده</label>
                        <label><input type="checkbox" name="has_building_permit" value="1" <?php checked($has_building_permit, '1'); ?>> پروانه ساخت</label>
                        <label><input type="checkbox" name="inside_plan" value="1" <?php checked($inside_plan, '1'); ?>> داخل طرح هادی بافت</label>
                        <label><input type="checkbox" name="can_subdivide" value="1" <?php checked($can_subdivide, '1'); ?>> قابلیت قطعه‌بندی و تفکیک</label>
                    </div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-muted" onclick="prevFormStep(3)">گام قبلی</button>
                    <button type="button" class="btn-primary" onclick="nextFormStep(3)">گام بعدی</button>
                </div>
            </div>

            <!-- Step 4: Media -->
            <div class="submit-form-panel submit-step-content" id="step-panel-4">
                <h2 style="font-size:16px; font-weight:bold; margin-bottom:20px;">گام ۴: آپلود تصاویر و مستندات</h2>

                <div class="form-group" style="border:2px dashed var(--border-color); border-radius:12px; padding:40px; text-align:center;">
                    <div class="empty-state-icon" style="color:var(--primary-color); width:48px; height:48px; margin: 0 auto 16px;">
                        <?php echo zaminyab_get_svg_icon('camera'); ?>
                    </div>
                    <label for="gallery_files" style="cursor:pointer; display:block; font-weight:bold; margin-bottom:8px;">انتخاب و آپلود تصاویر زمین</label>
                    <p style="font-size:12px; color:var(--text-muted); margin-bottom:16px;">تصاویری از نماهای مختلف زمین خود را انتخاب کنید (حداکثر ۸ تصویر)</p>
                    <input type="file" id="gallery_files" name="gallery_files[]" multiple accept="image/*" style="display:none;">
                    <button type="button" class="btn-outline" onclick="document.getElementById('gallery_files').click()">انتخاب فایل‌ها</button>
                </div>

                <!-- Preview list placeholder -->
                <div id="imagePreviewContainer" style="display:flex; flex-wrap:wrap; gap:8px; margin-top:16px;"></div>

                <div class="form-navigation">
                    <button type="button" class="btn-muted" onclick="prevFormStep(4)">گام قبلی</button>
                    <button type="button" class="btn-primary" onclick="nextFormStep(4)">گام بعدی</button>
                </div>
            </div>

            <!-- Step 5: Contact -->
            <div class="submit-form-panel submit-step-content" id="step-panel-5">
                <h2 style="font-size:16px; font-weight:bold; margin-bottom:20px;">گام ۵: اطلاعات تماس فروشنده</h2>

                <div class="form-group-grid">
                    <div class="form-group">
                        <label for="seller_name">نام کامل فروشنده:</label>
                        <input type="text" id="seller_name" name="seller_name" value="<?php echo esc_attr($seller_name); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="seller_phone">شماره همراه تماس مستقیم:</label>
                        <input type="text" id="seller_phone" name="seller_phone" value="<?php echo esc_attr($seller_phone); ?>" required placeholder="۰۹۱۲۳۴۵۶۷۸۹">
                    </div>
                </div>

                <div class="form-group-grid" style="margin-top:16px;">
                    <div class="form-group">
                        <label for="seller_whatsapp">شماره واتس‌اپ فروشنده:</label>
                        <input type="text" id="seller_whatsapp" name="seller_whatsapp" value="<?php echo esc_attr($seller_whatsapp); ?>">
                    </div>
                    <div class="form-group">
                        <label for="seller_eitaa">شناسه یا لینک پیام‌رسان ایتا:</label>
                        <input type="text" id="seller_eitaa" name="seller_eitaa" value="<?php echo esc_attr($seller_eitaa); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="click_to_reveal" value="1" <?php checked($click_to_reveal, '1'); ?>> شماره تلفن به صورت کلیک‌کد پنهان باشد و بعد از کلیک نمایش داده شود.
                    </label>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-muted" onclick="prevFormStep(5)">گام قبلی</button>
                    <button type="submit" class="btn-primary" style="background-color:var(--secondary-color);">
                        <?php echo $is_editing ? 'بروزرسانی نهایی آگهی زمین' : 'ثبت نهایی و انتشار آگهی زمین'; ?>
                    </button>
                </div>
            </div>

        </form>

    </div>
</main>

<script type="text/javascript">
function toggleRentFields(statusId) {
    var select = document.getElementById('land_status');
    var selectedOption = select.options[select.selectedIndex];
    var statusName = selectedOption.getAttribute('data-name') || '';

    var saleFields = document.getElementById('zaminyabSaleFields');
    var rentFields = document.getElementById('zaminyabRentFields');

    if (statusName.includes('اجاره') || statusName.includes('رهن')) {
        saleFields.style.display = 'none';
        rentFields.style.display = 'grid';
    } else {
        saleFields.style.display = 'grid';
        rentFields.style.display = 'none';
    }
}

function nextFormStep(currentStep) {
    var title = document.getElementById('title');
    if (currentStep === 1 && !title.value) {
        alert('لطفاً عنوان آگهی را پر کنید.');
        return;
    }

    document.getElementById('step-panel-' + currentStep).classList.remove('active');
    document.getElementById('step-nav-' + currentStep).classList.remove('active');
    document.getElementById('step-nav-' + currentStep).classList.add('completed');

    var nextStep = currentStep + 1;
    document.getElementById('step-panel-' + nextStep).classList.add('active');
    document.getElementById('step-nav-' + nextStep).classList.add('active');
}

function prevFormStep(currentStep) {
    document.getElementById('step-panel-' + currentStep).classList.remove('active');
    document.getElementById('step-nav-' + currentStep).classList.remove('active');

    var prevStep = currentStep - 1;
    document.getElementById('step-panel-' + prevStep).classList.add('active');
    document.getElementById('step-nav-' + prevStep).classList.add('active');
    document.getElementById('step-nav-' + prevStep).classList.remove('completed');
}

document.getElementById('gallery_files').addEventListener('change', function(e) {
    var preview = document.getElementById('imagePreviewContainer');
    preview.innerHTML = '';
    for (var i = 0; i < e.target.files.length; i++) {
        var file = e.target.files[i];
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(event) {
                var div = document.createElement('div');
                div.style.width = '80px';
                div.style.height = '80px';
                div.style.borderRadius = '6px';
                div.style.overflow = 'hidden';
                div.innerHTML = '<img src="' + event.target.result + '" style="width:100%; height:100%; object-fit:cover;">';
                preview.appendChild(div);
            };
        })(file);
        reader.readAsDataURL(file);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Initial check on load
    var select = document.getElementById('land_status');
    if (select) {
        toggleRentFields(select.value);
    }
});
</script>

<?php get_footer(); ?>
