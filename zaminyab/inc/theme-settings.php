<?php
/**
 * ZaminYab Settings Panel Helper Functions
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get option helper.
 */
function zaminyab_get_option( $option_name, $default = '' ) {
    $options = get_option( 'zaminyab_theme_options' );
    if ( isset( $options[ $option_name ] ) && $options[ $option_name ] !== '' ) {
        return $options[ $option_name ];
    }
    return $default;
}

/**
 * Register ZaminYab theme settings.
 */
function zaminyab_register_theme_settings() {
    register_setting( 'zaminyab_settings_group', 'zaminyab_theme_options', 'zaminyab_sanitize_theme_options' );
}
add_action( 'admin_init', 'zaminyab_register_theme_settings' );

/**
 * Sanitize theme options before saving.
 */
function zaminyab_sanitize_theme_options( $input ) {
    $output = array();

    // Loop through and sanitize each field
    if ( is_array( $input ) ) {
        foreach ( $input as $key => $value ) {
            // Check capabilities and allow raw JS/CSS/HTML for administrators only
            if ( in_array( $key, array( 'custom_css', 'custom_js', 'header_html', 'footer_html', 'head_code', 'body_code' ), true ) ) {
                if ( current_user_can( 'unfiltered_html' ) ) {
                    $output[ $key ] = $value; // Allow raw scripts for admin
                } else {
                    $output[ $key ] = wp_kses_post( $value );
                }
            } else {
                $output[ $key ] = sanitize_text_field( $value );
            }
        }
    }

    return $output;
}

/**
 * Create Admin Menu.
 */
function zaminyab_add_admin_menu() {
    add_menu_page(
        'تنظیمات قالب زمین‌یاب',
        'تنظیمات زمین‌یاب',
        'manage_options',
        'zaminyab_settings',
        'zaminyab_render_settings_page',
        'dashicons-admin-generic',
        60
    );
}
add_action( 'admin_menu', 'zaminyab_add_admin_menu' );

/**
 * Render admin options page with Tabs.
 */
function zaminyab_render_settings_page() {
    // Check user capability
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Show saved settings notice
    if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error( 'zaminyab_messages', 'zaminyab_message', 'تنظیمات با موفقیت ذخیره شدند.', 'updated' );
    }

    settings_errors( 'zaminyab_messages' );
    ?>
    <div class="wrap zaminyab-admin-wrap">
        <div class="zaminyab-admin-header">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <span class="zaminyab-admin-version">نسخه ۱.۰.۰</span>
        </div>

        <form action="options.php" method="post" id="zaminyab-settings-form">
            <?php settings_fields( 'zaminyab_settings_group' ); ?>

            <div class="zaminyab-admin-container">
                <div class="zaminyab-admin-sidebar">
                    <ul class="zaminyab-admin-menu">
                        <li class="active"><a href="#tab-general">تنظیمات عمومی</a></li>
                        <li><a href="#tab-contact">اطلاعات تماس</a></li>
                        <li><a href="#tab-map">تنظیمات نقشه</a></li>
                        <li><a href="#tab-design">طراحی و رنگ‌بندی</a></li>
                        <li><a href="#tab-listings">تنظیمات آگهی‌ها</a></li>
                        <li><a href="#tab-injection">تزریق کد سفارشی</a></li>
                        <li><a href="#tab-login">صفحه ورود اختصاصی</a></li>
                        <li><a href="#tab-docs">راهنما و مستندات</a></li>
                    </ul>
                </div>

                <div class="zaminyab-admin-content">

                    <!-- TAB 1: GENERAL -->
                    <div id="tab-general" class="zaminyab-tab-content active">
                        <h2>تنظیمات عمومی وب‌سایت</h2>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="logo_url">آدرس لوگوی سایت:</label>
                            <input type="text" id="logo_url" name="zaminyab_theme_options[logo_url]" value="<?php echo esc_attr( zaminyab_get_option('logo_url') ); ?>" class="regular-text">
                            <p class="zaminyab-field-desc">لوگوی اصلی هدر سایت را در رسانه آپلود کنید و آدرس آن را اینجا قرار دهید.</p>
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="mobile_logo_url">آدرس لوگوی موبایل:</label>
                            <input type="text" id="mobile_logo_url" name="zaminyab_theme_options[mobile_logo_url]" value="<?php echo esc_attr( zaminyab_get_option('mobile_logo_url') ); ?>" class="regular-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="default_listing_status">وضعیت پیش‌فرض آگهی‌های ارسالی:</label>
                            <select id="default_listing_status" name="zaminyab_theme_options[default_listing_status]">
                                <option value="pending" <?php selected( zaminyab_get_option('default_listing_status', 'pending'), 'pending' ); ?>>در انتظار بررسی (پیش‌فرض)</option>
                                <option value="publish" <?php selected( zaminyab_get_option('default_listing_status'), 'publish' ); ?>>انتشار فوری</option>
                                <option value="draft" <?php selected( zaminyab_get_option('default_listing_status'), 'draft' ); ?>>پیش‌نویس</option>
                            </select>
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label">
                                <input type="checkbox" name="zaminyab_theme_options[enable_guest_submission]" value="1" <?php checked( zaminyab_get_option('enable_guest_submission', '0'), '1' ); ?>>
                                امکان ثبت آگهی برای کاربران مهمان فعال باشد
                            </label>
                            <p class="zaminyab-field-desc">در صورت غیرفعال بودن، کاربران ابتدا باید وارد سایت شوند.</p>
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label">
                                <input type="checkbox" name="zaminyab_theme_options[enable_favorites]" value="1" <?php checked( zaminyab_get_option('enable_favorites', '1'), '1' ); ?>>
                                امکان افزودن آگهی‌ها به لیست علاقه‌مندی‌ها فعال باشد
                            </label>
                        </div>
                    </div>

                    <!-- TAB 2: CONTACT -->
                    <div id="tab-contact" class="zaminyab-tab-content">
                        <h2>اطلاعات تماس و شبکه‌های اجتماعی بومی</h2>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="phone_number">تلفن ثابت:</label>
                            <input type="text" id="phone_number" name="zaminyab_theme_options[phone_number]" value="<?php echo esc_attr( zaminyab_get_option('phone_number') ); ?>" class="regular-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="mobile_number">شماره موبایل پشتیبانی:</label>
                            <input type="text" id="mobile_number" name="zaminyab_theme_options[mobile_number]" value="<?php echo esc_attr( zaminyab_get_option('mobile_number') ); ?>" class="regular-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="whatsapp_number">شماره واتس‌اپ پشتیبانی:</label>
                            <input type="text" id="whatsapp_number" name="zaminyab_theme_options[whatsapp_number]" value="<?php echo esc_attr( zaminyab_get_option('whatsapp_number') ); ?>" class="regular-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="bale_link">آدرس یا شناسه پیام‌رسان بله:</label>
                            <input type="text" id="bale_link" name="zaminyab_theme_options[bale_link]" value="<?php echo esc_attr( zaminyab_get_option('bale_link') ); ?>" class="regular-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="rubika_link">آدرس یا شناسه پیام‌رسان روبیکا:</label>
                            <input type="text" id="rubika_link" name="zaminyab_theme_options[rubika_link]" value="<?php echo esc_attr( zaminyab_get_option('rubika_link') ); ?>" class="regular-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="eitaa_link">آدرس یا شناسه پیام‌رسان ایتا:</label>
                            <input type="text" id="eitaa_link" name="zaminyab_theme_options[eitaa_link]" value="<?php echo esc_attr( zaminyab_get_option('eitaa_link') ); ?>" class="regular-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="contact_email">ایمیل پشتیبانی:</label>
                            <input type="email" id="contact_email" name="zaminyab_theme_options[contact_email]" value="<?php echo esc_attr( zaminyab_get_option('contact_email') ); ?>" class="regular-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="contact_address">آدرس دفتر مرکزی:</label>
                            <input type="text" id="contact_address" name="zaminyab_theme_options[contact_address]" value="<?php echo esc_attr( zaminyab_get_option('contact_address') ); ?>" class="regular-text">
                        </div>
                    </div>

                    <!-- TAB 3: MAPS -->
                    <div id="tab-map" class="zaminyab-tab-content">
                        <h2>تنظیمات نقشه آگهی‌ها</h2>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label">
                                <input type="checkbox" name="zaminyab_theme_options[enable_maps]" value="1" <?php checked( zaminyab_get_option('enable_maps', '1'), '1' ); ?>>
                                سیستم نقشه‌ها روی سایت فعال باشد
                            </label>
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="map_provider">سرویس‌دهنده نقشه:</label>
                            <select id="map_provider" name="zaminyab_theme_options[map_provider]">
                                <option value="osm" <?php selected( zaminyab_get_option('map_provider', 'osm'), 'osm' ); ?>>OpenStreetMap (بدون نیاز به کلید API)</option>
                                <option value="neshan" <?php selected( zaminyab_get_option('map_provider'), 'neshan' ); ?>>نقشه ایرانی نشان</option>
                            </select>
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="map_api_key">کلید API نقشه (در صورت نیاز):</label>
                            <input type="text" id="map_api_key" name="zaminyab_theme_options[map_api_key]" value="<?php echo esc_attr( zaminyab_get_option('map_api_key') ); ?>" class="regular-text">
                            <p class="zaminyab-field-desc">برای سرویس نشان کلید خود را از پرتال توسعه‌دهندگان نشان دریافت و اینجا وارد کنید.</p>
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="default_latitude">عرض جغرافیایی پیش‌فرض (Latitude):</label>
                            <input type="text" id="default_latitude" name="zaminyab_theme_options[default_latitude]" value="<?php echo esc_attr( zaminyab_get_option('default_latitude', '35.6892') ); ?>" class="small-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="default_longitude">طول جغرافیایی پیش‌فرض (Longitude):</label>
                            <input type="text" id="default_longitude" name="zaminyab_theme_options[default_longitude]" value="<?php echo esc_attr( zaminyab_get_option('default_longitude', '51.3890') ); ?>" class="small-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="default_zoom">بزرگنمایی پیش‌فرض نقشه:</label>
                            <input type="text" id="default_zoom" name="zaminyab_theme_options[default_zoom]" value="<?php echo esc_attr( zaminyab_get_option('default_zoom', '12') ); ?>" class="small-text">
                        </div>
                    </div>

                    <!-- TAB 4: DESIGN -->
                    <div id="tab-design" class="zaminyab-tab-content">
                        <h2>تنظیمات استایل و طراحی وب‌سایت</h2>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="primary_color">رنگ اصلی (Teal Accents):</label>
                            <input type="color" id="primary_color" name="zaminyab_theme_options[primary_color]" value="<?php echo esc_attr( zaminyab_get_option('primary_color', '#0d9488') ); ?>">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="secondary_color">رنگ فرعی (Muted Green):</label>
                            <input type="color" id="secondary_color" name="zaminyab_theme_options[secondary_color]" value="<?php echo esc_attr( zaminyab_get_option('secondary_color', '#15803d') ); ?>">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="accent_color">رنگ تأکیدی (Champagne Gold):</label>
                            <input type="color" id="accent_color" name="zaminyab_theme_options[accent_color]" value="<?php echo esc_attr( zaminyab_get_option('accent_color', '#d97706') ); ?>">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label">
                                <input type="checkbox" name="zaminyab_theme_options[header_sticky]" value="1" <?php checked( zaminyab_get_option('header_sticky', '1'), '1' ); ?>>
                                منوی اصلی (Header) چسبان و استیکی باشد
                            </label>
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label">
                                <input type="checkbox" name="zaminyab_theme_options[mobile_bottom_nav_on]" value="1" <?php checked( zaminyab_get_option('mobile_bottom_nav_on', '1'), '1' ); ?>>
                                منوی ناوبری چسبان پایین در موبایل فعال باشد
                            </label>
                        </div>
                    </div>

                    <!-- TAB 5: LISTINGS -->
                    <div id="tab-listings" class="zaminyab-tab-content">
                        <h2>تنظیمات فیلدها و رفتار آگهی‌ها</h2>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="listings_per_page">تعداد آگهی در هر صفحه:</label>
                            <input type="number" id="listings_per_page" name="zaminyab_theme_options[listings_per_page]" value="<?php echo esc_attr( zaminyab_get_option('listings_per_page', '12') ); ?>" class="small-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="max_gallery_images">حداکثر تعداد تصاویر گالری برای هر آگهی:</label>
                            <input type="number" id="max_gallery_images" name="zaminyab_theme_options[max_gallery_images]" value="<?php echo esc_attr( zaminyab_get_option('max_gallery_images', '8') ); ?>" class="small-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="max_upload_size">حداکثر حجم مجاز آپلود تصویر (مگابایت):</label>
                            <input type="number" id="max_upload_size" name="zaminyab_theme_options[max_upload_size]" value="<?php echo esc_attr( zaminyab_get_option('max_upload_size', '4') ); ?>" class="small-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label">
                                <input type="checkbox" name="zaminyab_theme_options[enable_urgent_listings]" value="1" <?php checked( zaminyab_get_option('enable_urgent_listings', '1'), '1' ); ?>>
                                قابلیت تعریف آگهی‌های فوری فعال باشد
                            </label>
                        </div>
                    </div>

                    <!-- TAB 6: INJECTION -->
                    <div id="tab-injection" class="zaminyab-tab-content">
                        <h2>تزریق کد سفارشی (CSS، JS، HTML)</h2>

                        <div class="zaminyab-warning-box">
                            <strong>هشدار بسیار مهم:</strong> وارد کردن هرگونه کدهای نامعتبر یا خطا در این بخش می‌تواند منجر به شکست ساختار قالب یا عدم کارکرد صحیح سایت شود. دسترسی به این بخش فقط برای کاربران مدیر ارشد سایت امکان‌پذیر است.
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="custom_css">استایل‌های CSS سفارشی (بدون تگ style):</label>
                            <textarea id="custom_css" name="zaminyab_theme_options[custom_css]" rows="8" class="large-text code" style="direction:ltr;text-align:left;"><?php echo esc_textarea( zaminyab_get_option('custom_css') ); ?></textarea>
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="custom_js">کدهای جاوا اسکریپت سفارشی (بدون تگ script):</label>
                            <textarea id="custom_js" name="zaminyab_theme_options[custom_js]" rows="8" class="large-text code" style="direction:ltr;text-align:left;"><?php echo esc_textarea( zaminyab_get_option('custom_js') ); ?></textarea>
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="head_code">کدهای درون هدر (قبل از بسته شدن تگ head):</label>
                            <textarea id="head_code" name="zaminyab_theme_options[head_code]" rows="5" class="large-text code" style="direction:ltr;text-align:left;"><?php echo esc_textarea( zaminyab_get_option('head_code') ); ?></textarea>
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="body_code">کدهای درون فوتر (قبل از بسته شدن تگ body):</label>
                            <textarea id="body_code" name="zaminyab_theme_options[body_code]" rows="5" class="large-text code" style="direction:ltr;text-align:left;"><?php echo esc_textarea( zaminyab_get_option('body_code') ); ?></textarea>
                        </div>
                    </div>

                    <!-- TAB 7: LOGIN -->
                    <div id="tab-login" class="zaminyab-tab-content">
                        <h2>شخصی‌سازی صفحه ورود وردپرس</h2>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label">
                                <input type="checkbox" name="zaminyab_theme_options[enable_custom_login]" value="1" <?php checked( zaminyab_get_option('enable_custom_login', '1'), '1' ); ?>>
                                قالب سفارشی و زیبای ایرانی برای صفحه ورود وردپرس فعال باشد
                            </label>
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="login_logo_url">لوگوی اختصاصی صفحه ورود:</label>
                            <input type="text" id="login_logo_url" name="zaminyab_theme_options[login_logo_url]" value="<?php echo esc_attr( zaminyab_get_option('login_logo_url') ); ?>" class="regular-text">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="login_bg_color">رنگ پس‌زمینه صفحه ورود:</label>
                            <input type="color" id="login_bg_color" name="zaminyab_theme_options[login_bg_color]" value="<?php echo esc_attr( zaminyab_get_option('login_bg_color', '#fafaf9') ); ?>">
                        </div>

                        <div class="zaminyab-field-group">
                            <label class="zaminyab-field-label" for="login_custom_message">متن خوش‌آمدگویی سفارشی در صفحه ورود:</label>
                            <textarea id="login_custom_message" name="zaminyab_theme_options[login_custom_message]" rows="3" class="large-text"><?php echo esc_textarea( zaminyab_get_option('login_custom_message', 'به سامانه بزرگ خرید و فروش زمین زمین‌یاب خوش آمدید.') ); ?></textarea>
                        </div>
                    </div>

                    <!-- TAB 8: DOCUMENTATION & HELP (Redirected to proper view render) -->
                    <div id="tab-docs" class="zaminyab-tab-content">
                        <?php if ( function_exists('zaminyab_render_docs_content') ) { zaminyab_render_docs_content(); } ?>
                    </div>

                </div>
            </div>

            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary button-large" value="ذخیره تغییرات تنظیمات زمین‌یاب">
            </p>
        </form>
    </div>

    <!-- Simple admin tab switcher script inside layout -->
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.zaminyab-admin-menu li a').on('click', function(e) {
            e.preventDefault();
            var targetTab = $(this).attr('href');

            // Set active class on menu item
            $('.zaminyab-admin-menu li').removeClass('active');
            $(this).parent().addClass('active');

            // Show corresponding tab content
            $('.zaminyab-tab-content').removeClass('active');
            $(targetTab).addClass('active');
        });
    });
    </script>
    <?php
}
