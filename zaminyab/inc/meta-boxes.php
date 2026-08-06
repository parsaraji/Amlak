<?php
/**
 * ZaminYab Custom Meta Boxes for land_listing CPT
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register the meta box.
 */
function zaminyab_register_listing_metaboxes() {
    add_meta_box(
        'zaminyab_listing_meta',
        'مشخصات و جزئیات آگهی زمین',
        'zaminyab_listing_meta_box_callback',
        'land_listing',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'zaminyab_register_listing_metaboxes' );

/**
 * Render the meta box callback.
 */
function zaminyab_listing_meta_box_callback( $post ) {
    // Add nonce for security
    wp_nonce_field( 'zaminyab_save_meta_box_data', 'zaminyab_meta_box_nonce' );

    // Get current values
    $price_total = get_post_meta( $post->ID, '_price_total', true );
    $price_meter = get_post_meta( $post->ID, '_price_meter', true );
    $area_size   = get_post_meta( $post->ID, '_area_size', true );

    $seller_name    = get_post_meta( $post->ID, '_seller_name', true );
    $seller_phone   = get_post_meta( $post->ID, '_seller_phone', true );
    $seller_whatsapp= get_post_meta( $post->ID, '_seller_whatsapp', true );
    $seller_bale    = get_post_meta( $post->ID, '_seller_bale', true );
    $seller_rubika  = get_post_meta( $post->ID, '_seller_rubika', true );
    $seller_eitaa   = get_post_meta( $post->ID, '_seller_eitaa', true );

    $allow_direct_call = get_post_meta( $post->ID, '_allow_direct_call', true );
    $click_to_reveal   = get_post_meta( $post->ID, '_click_to_reveal', true );

    $land_width   = get_post_meta( $post->ID, '_land_width', true );
    $land_length  = get_post_meta( $post->ID, '_land_length', true );
    $land_passage = get_post_meta( $post->ID, '_land_passage', true );

    $has_water            = get_post_meta( $post->ID, '_has_water', true );
    $has_electricity      = get_post_meta( $post->ID, '_has_electricity', true );
    $has_gas              = get_post_meta( $post->ID, '_has_gas', true );
    $has_phone            = get_post_meta( $post->ID, '_has_phone', true );
    $has_wall             = get_post_meta( $post->ID, '_has_wall', true );
    $has_building_permit  = get_post_meta( $post->ID, '_has_building_permit', true );
    $inside_plan          = get_post_meta( $post->ID, '_inside_plan', true );
    $can_subdivide        = get_post_meta( $post->ID, '_can_subdivide', true );

    $approx_address       = get_post_meta( $post->ID, '_approx_address', true );
    $latitude             = get_post_meta( $post->ID, '_latitude', true );
    $longitude            = get_post_meta( $post->ID, '_longitude', true );
    $map_zoom             = get_post_meta( $post->ID, '_map_zoom', true );
    $approx_mode          = get_post_meta( $post->ID, '_approx_mode', true );

    $gallery_images       = get_post_meta( $post->ID, '_gallery_images', true );
    $video_url            = get_post_meta( $post->ID, '_video_url', true );
    $is_featured          = get_post_meta( $post->ID, '_is_featured', true );
    $is_urgent            = get_post_meta( $post->ID, '_is_urgent', true );

    ?>
    <div id="zaminyab-meta-box">
        <!-- 1. Basic price and size -->
        <h3>قیمت و متراژ</h3>
        <div class="zaminyab-metabox-row">
            <label for="price_total">قیمت کل (تومان):</label>
            <input type="text" id="price_total" name="price_total" value="<?php echo esc_attr( $price_total ); ?>" class="regular-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="price_meter">قیمت هر متر (تومان):</label>
            <input type="text" id="price_meter" name="price_meter" value="<?php echo esc_attr( $price_meter ); ?>" class="regular-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="area_size">متراژ کل زمین (متر مربع):</label>
            <input type="text" id="area_size" name="area_size" value="<?php echo esc_attr( $area_size ); ?>" class="regular-text">
        </div>

        <hr>

        <!-- 2. Contact details -->
        <h3>اطلاعات تماس فروشنده</h3>
        <div class="zaminyab-metabox-row">
            <label for="seller_name">نام فروشنده:</label>
            <input type="text" id="seller_name" name="seller_name" value="<?php echo esc_attr( $seller_name ); ?>" class="regular-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="seller_phone">شماره تماس:</label>
            <input type="text" id="seller_phone" name="seller_phone" value="<?php echo esc_attr( $seller_phone ); ?>" class="regular-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="seller_whatsapp">شماره واتس‌اپ:</label>
            <input type="text" id="seller_whatsapp" name="seller_whatsapp" value="<?php echo esc_attr( $seller_whatsapp ); ?>" class="regular-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="seller_bale">شناسه/لینک بله:</label>
            <input type="text" id="seller_bale" name="seller_bale" value="<?php echo esc_attr( $seller_bale ); ?>" class="regular-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="seller_rubika">شناسه/لینک روبیکا:</label>
            <input type="text" id="seller_rubika" name="seller_rubika" value="<?php echo esc_attr( $seller_rubika ); ?>" class="regular-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="seller_eitaa">شناسه/لینک ایتا:</label>
            <input type="text" id="seller_eitaa" name="seller_eitaa" value="<?php echo esc_attr( $seller_eitaa ); ?>" class="regular-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label>
                <input type="checkbox" name="allow_direct_call" value="1" <?php checked( $allow_direct_call, '1' ); ?>>
                امکان تماس مستقیم تلفنی برقرار باشد
            </label>
        </div>
        <div class="zaminyab-metabox-row">
            <label>
                <input type="checkbox" name="click_to_reveal" value="1" <?php checked( $click_to_reveal, '1' ); ?>>
                شماره تلفن بعد از کلیک نمایش داده شود
            </label>
        </div>

        <hr>

        <!-- 3. Land Specs -->
        <h3>ابعاد و امکانات زمین</h3>
        <div class="zaminyab-metabox-row">
            <label for="land_width">بر زمین (متر):</label>
            <input type="text" id="land_width" name="land_width" value="<?php echo esc_attr( $land_width ); ?>" class="small-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="land_length">طول زمین (متر):</label>
            <input type="text" id="land_length" name="land_length" value="<?php echo esc_attr( $land_length ); ?>" class="small-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="land_passage">عرض گذر / کوچه (متر):</label>
            <input type="text" id="land_passage" name="land_passage" value="<?php echo esc_attr( $land_passage ); ?>" class="small-text">
        </div>

        <div class="zaminyab-metabox-row">
            <label>امکانات زیرساختی:</label>
            <div class="zaminyab-metabox-checkbox-list">
                <label><input type="checkbox" name="has_water" value="1" <?php checked( $has_water, '1' ); ?>> آب</label>
                <label><input type="checkbox" name="has_electricity" value="1" <?php checked( $has_electricity, '1' ); ?>> برق</label>
                <label><input type="checkbox" name="has_gas" value="1" <?php checked( $has_gas, '1' ); ?>> گاز</label>
                <label><input type="checkbox" name="has_phone" value="1" <?php checked( $has_phone, '1' ); ?>> تلفن</label>
                <label><input type="checkbox" name="has_wall" value="1" <?php checked( $has_wall, '1' ); ?>> دیوارکشی</label>
                <label><input type="checkbox" name="has_building_permit" value="1" <?php checked( $has_building_permit, '1' ); ?>> مجوز ساخت</label>
                <label><input type="checkbox" name="inside_plan" value="1" <?php checked( $inside_plan, '1' ); ?>> داخل بافت</label>
                <label><input type="checkbox" name="can_subdivide" value="1" <?php checked( $can_subdivide, '1' ); ?>> قابلیت تفکیک</label>
            </div>
        </div>

        <hr>

        <!-- 4. Location and Map -->
        <h3>آدرس و نقشه</h3>
        <div class="zaminyab-metabox-row">
            <label for="approx_address">آدرس تقریبی:</label>
            <textarea id="approx_address" name="approx_address" rows="2" class="large-text"><?php echo esc_textarea( $approx_address ); ?></textarea>
        </div>
        <div class="zaminyab-metabox-row">
            <label for="latitude">عرض جغرافیایی (Latitude):</label>
            <input type="text" id="latitude" name="latitude" value="<?php echo esc_attr( $latitude ); ?>" class="regular-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="longitude">طول جغرافیایی (Longitude):</label>
            <input type="text" id="longitude" name="longitude" value="<?php echo esc_attr( $longitude ); ?>" class="regular-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="map_zoom">بزرگنمایی نقشه (Zoom):</label>
            <input type="text" id="map_zoom" name="map_zoom" value="<?php echo esc_attr( $map_zoom ? $map_zoom : '12' ); ?>" class="small-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label>
                <input type="checkbox" name="approx_mode" value="1" <?php checked( $approx_mode, '1' ); ?>>
                حالت موقعیت تقریبی (برای حفظ حریم خصوصی)
            </label>
        </div>

        <hr>

        <!-- 5. Media & Promotional -->
        <h3>رسانه و تبلیغ</h3>
        <div class="zaminyab-metabox-row">
            <label for="video_url">آدرس ویدیو آگهی (آپارات/یوتیوب):</label>
            <input type="text" id="video_url" name="video_url" value="<?php echo esc_attr( $video_url ); ?>" class="regular-text">
        </div>
        <div class="zaminyab-metabox-row">
            <label for="gallery_images">شناسه‌های گالری تصاویر (جدا شده با کاما):</label>
            <input type="text" id="gallery_images" name="gallery_images" value="<?php echo esc_attr( $gallery_images ); ?>" class="regular-text">
            <p class="description">آی‌دی‌های تصاویر پیوست شده به این پست (مانند: 12,45,67)</p>
        </div>

        <hr>

        <!-- 6. Special markers -->
        <h3>نشان‌گذاری ویژه</h3>
        <div class="zaminyab-metabox-row">
            <label>
                <input type="checkbox" name="is_featured" value="1" <?php checked( $is_featured, '1' ); ?>>
                آگهی ویژه (جهت نمایش در بخش ویژه و بالای لیست‌ها)
            </label>
        </div>
        <div class="zaminyab-metabox-row">
            <label>
                <input type="checkbox" name="is_urgent" value="1" <?php checked( $is_urgent, '1' ); ?>>
                آگهی فوری (نمایش برچسب فوری قرمز رنگ روی کارت آگهی)
            </label>
        </div>
    </div>
    <?php
}

/**
 * Save meta box data.
 */
function zaminyab_save_listing_meta( $post_id ) {
    // Check if nonce is set
    if ( ! isset( $_POST['zaminyab_meta_box_nonce'] ) ) {
        return;
    }

    // Verify nonce
    if ( ! wp_verify_nonce( $_POST['zaminyab_meta_box_nonce'], 'zaminyab_save_meta_box_data' ) ) {
        return;
    }

    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check user permissions
    if ( isset( $_POST['post_type'] ) && 'land_listing' === $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    } else {
        return;
    }

    // Sanitize and save fields
    $fields = array(
        'price_total'        => '_price_total',
        'price_meter'        => '_price_meter',
        'area_size'          => '_area_size',
        'seller_name'        => '_seller_name',
        'seller_phone'       => '_seller_phone',
        'seller_whatsapp'    => '_seller_whatsapp',
        'seller_bale'        => '_seller_bale',
        'seller_rubika'      => '_seller_rubika',
        'seller_eitaa'       => '_seller_eitaa',
        'land_width'         => '_land_width',
        'land_length'        => '_land_length',
        'land_passage'       => '_land_passage',
        'approx_address'     => '_approx_address',
        'latitude'           => '_latitude',
        'longitude'          => '_longitude',
        'map_zoom'           => '_map_zoom',
        'gallery_images'     => '_gallery_images',
        'video_url'          => '_video_url',
    );

    foreach ( $fields as $key => $meta_key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }

    // Save checkbox fields
    $checkboxes = array(
        'allow_direct_call'   => '_allow_direct_call',
        'click_to_reveal'     => '_click_to_reveal',
        'has_water'           => '_has_water',
        'has_electricity'     => '_has_electricity',
        'has_gas'             => '_has_gas',
        'has_phone'           => '_has_phone',
        'has_wall'            => '_has_wall',
        'has_building_permit' => '_has_building_permit',
        'inside_plan'         => '_inside_plan',
        'can_subdivide'       => '_can_subdivide',
        'approx_mode'         => '_approx_mode',
        'is_featured'         => '_is_featured',
        'is_urgent'           => '_is_urgent',
    );

    foreach ( $checkboxes as $key => $meta_key ) {
        $value = isset( $_POST[ $key ] ) ? '1' : '0';
        update_post_meta( $post_id, $meta_key, $value );
    }
}
add_action( 'save_post', 'zaminyab_save_listing_meta' );
