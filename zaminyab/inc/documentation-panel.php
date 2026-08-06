<?php
/**
 * ZaminYab Documentation Help Panel inside Admin Theme settings
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Output the complete Farsi developer/admin manual inside Theme Settings.
 */
function zaminyab_render_docs_content() {
    ?>
    <div class="zaminyab-docs-wrap" style="line-height:1.8; font-family:'Shabnam', sans-serif;">
        <h2>دفترچه راهنما و مستندات پوسته زمین‌یاب (ZaminYab Directory Theme)</h2>
        <p class="text-justify">
            به بخش مستندات رسمی قالب اختصاصی <strong>زمین‌یاب</strong> خوش آمدید. این پوسته با معماری مدرن، کاملاً موبایل‌محور (Mobile-First)، راست‌چین استاندارد (RTL) و با تکیه بر فونت زیبای شبنم و بدون وابستگی به کتابخانه‌های خارجی سنگین طراحی شده است.
        </p>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">

        <!-- 1. Quick Start -->
        <h3>۱. شروع سریع (Quick Start)</h3>
        <ul>
            <li>پس از فعال‌سازی قالب، برگه های ضروری به صورت کامپایل شده و خودکار ایجاد می‌شوند.</li>
            <li>برای تعریف منوها به مسیر <strong>نمایش &gt; فهرست‌ها</strong> مراجعه کنید.</li>
            <li>برای سفارشی‌سازی اطلاعات تماس و کلیدهای نقشه، به زبانه‌های بالای همین پنل مراجعه کنید.</li>
        </ul>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">

        <!-- 2. Essential Pages -->
        <h3>۲. صفحات ضروری سامانه (Essential Pages)</h3>
        <p class="text-justify">
            برای راه‌اندازی بخش‌های مختلف، برگه‌های زیر به طور خودکار ساخته شده‌اند و آماده استفاده می‌باشند:
        </p>
        <table class="wp-list-table widefat fixed striped" style="margin: 10px 0; border: 1px solid #ccd0d4;">
            <thead>
                <tr>
                    <th style="padding: 10px;">عنوان برگه پیشنهادی</th>
                    <th style="padding: 10px;">نام الگوی برگه (Page Template)</th>
                    <th style="padding: 10px;">عملکرد</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 10px;">ثبت آگهی جدید</td>
                    <td style="padding: 10px;"><code>الگوی ثبت آگهی فروش زمین</code></td>
                    <td style="padding: 10px;">فرم چندمرحله‌ای پیشرفته با نقشه برای ثبت آگهی ملک و زمین (خرید/فروش/رهن/اجاره)</td>
                </tr>
                <tr>
                    <td style="padding: 10px;">داشبورد کاربری من</td>
                    <td style="padding: 10px;"><code>الگوی داشبورد کاربری</code></td>
                    <td style="padding: 10px;">مدیریت، حذف و ویرایش آگهی‌ها توسط کاربر نویسنده</td>
                </tr>
                <tr>
                    <td style="padding: 10px;">علاقه‌مندی‌های من</td>
                    <td style="padding: 10px;"><code>الگوی علاقه‌مندی‌ها</code></td>
                    <td style="padding: 10px;">لیست نشان‌شده‌های کاربر به همراه هماهنگ‌سازی دیتابیس</td>
                </tr>
                <tr>
                    <td style="padding: 10px;">جستجو روی نقشه</td>
                    <td style="padding: 10px;"><code>الگوی جستجوی نقشه</code></td>
                    <td style="padding: 10px;">جستجوی پیشرفته به همراه نقشه Leaflet</td>
                </tr>
            </tbody>
        </table>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">

        <!-- 3. Child Theme Guide -->
        <h3>۳. راهنمای ایجاد نسخه فرزند پوسته (Child Theme Guide)</h3>
        <p class="text-justify">
            برای اعمال هرگونه ویرایش و کدهای اختصاصی بدون مخدوش شدن کدهای اصلی پوسته در بروزرسانی‌ها، توصیه می‌شود حتماً از نسخه چایلد (Child Theme) استفاده کنید.
        </p>
        <div style="background: #f8fafc; padding: 15px; border-radius: 6px; border: 1px solid #e2e8f0; margin-top: 10px;">
            <p><strong>روش گام به گام ساخت چایلد تم زمین‌یاب:</strong></p>
            <ol style="margin-top: 8px; padding-right: 20px;">
                <li>در مسیر <code>wp-content/themes/</code> یک پوشه جدید به نام <code>zaminyab-child</code> ایجاد کنید.</li>
                <li>یک فایل به نام <code>style.css</code> درون این پوشه ساخته و کدهای زیر را در آن قرار دهید:
<pre style="direction: ltr; text-align: left; background: #1e293b; color: #f8fafc; padding: 10px; border-radius: 4px; overflow-x: auto;">
/*
Theme Name: ZaminYab Child
Theme URI: https://zaminyab.ir
Template: zaminyab
Version: 1.0.0
Text Domain: zaminyab-child
*/
</pre>
                </li>
                <li>یک فایل به نام <code>functions.php</code> ایجاد کرده و کدهای زیر را جهت لود صحیح شیوه نامه‌ها درج کنید:
<pre style="direction: ltr; text-align: left; background: #1e293b; color: #f8fafc; padding: 10px; border-radius: 4px; overflow-x: auto;">
&lt;?php
add_action( 'wp_enqueue_scripts', 'zaminyab_child_styles' );
function zaminyab_child_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
}
</pre>
                </li>
                <li>وارد بخش <strong>پوسته ها</strong> در پیشخوان وردپرس شده و پوسته فرزند ZaminYab Child را فعال کنید.</li>
            </ol>
        </div>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">

        <!-- 4. SMS Gateway Integration Guide -->
        <h3>۴. راهنمای اتصال به پنل‌های پیامکی ایرانی (SMS Gateway Integration Guide)</h3>
        <p class="text-justify">
            برای اعتبارسنجی شماره همراه کاربران و اطلاع‌رسانی پیامکی آگهی‌های جدید، می‌توانید از متد بومی و قدرتمند <code>wp_remote_post</code> وردپرس استفاده کنید. در زیر کدهای آماده برای اتصال به معروف‌ترین سامانه‌های پیامکی کشور خدمت شما ارائه شده است:
        </p>

        <div style="background: #f8fafc; padding: 15px; border-radius: 6px; border: 1px solid #e2e8f0; margin-top: 10px;">
            <h4 style="color:#0f766e; margin-top: 0;">نمونه کدهای اتصال برای توسعه‌دهندگان (قرارگیری در functions.php پوسته فرزند):</h4>

            <p><strong>الف) اتصال به وب‌سرویس فراز اس‌ام‌اس (FarazSMS / IPPanel):</strong></p>
<pre style="direction: ltr; text-align: left; background: #1e293b; color: #f8fafc; padding: 10px; border-radius: 4px; overflow-x: auto;">
function zaminyab_send_sms_faraz( $to, $code ) {
    $url = 'https://ippanel.com/services.jspd';
    $body = array(
        'op'       => 'pattern',
        'user'     => 'YOUR_USERNAME',
        'pass'     => 'YOUR_PASSWORD',
        'from'     => 'YOUR_SENDER_NUMBER',
        'to'       => $to,
        'pattern_code' => 'YOUR_PATTERN_CODE', // کد پترن تعریف شده
        'input_data'   => json_encode( array( 'code' => $code ) )
    );

    $response = wp_remote_post( $url, array(
        'body'    => $body,
        'timeout' => 15,
    ));

    return ! is_wp_error( $response );
}
</pre>

            <p style="margin-top: 15px;"><strong>ب) اتصال به وب‌سرویس کاوه نگار (Kavenegar):</strong></p>
<pre style="direction: ltr; text-align: left; background: #1e293b; color: #f8fafc; padding: 10px; border-radius: 4px; overflow-x: auto;">
function zaminyab_send_sms_kavenegar( $to, $code ) {
    $api_key = 'YOUR_KAVENEGAR_API_KEY';
    $url = "https://api.kavenegar.com/v1/{$api_key}/verify/lookup.json";

    $body = array(
        'receptor' => $to,
        'token'    => $code,
        'template' => 'YOUR_TEMPLATE_NAME' // نام قالب اعتبارسنجی
    );

    $response = wp_remote_post( $url, array(
        'body'    => $body,
        'timeout' => 15,
    ));

    return ! is_wp_error( $response );
}
</pre>
        </div>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">

        <!-- 5. General Security and FAQs -->
        <h3>۵. عیب‌یابی و سؤالات متداول</h3>
        <p class="text-justify">
            <strong>تایید نشدن تصاویر آپلود شده:</strong> فرم ثبت آگهی این قالب دارای بخش امنیتی Nonce است. در صورتی که هاست شما دسترسی‌های فیلتر شده داشته باشد، آپلود تصاویر ممکن است با اختلال مواجه شود. بررسی کنید تگ‌های فرم دارای ویژگی <code>enctype="multipart/form-data"</code> باشند.
        </p>
    </div>
    <?php
}
