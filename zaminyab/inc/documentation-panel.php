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
    <div class="zaminyab-docs-wrap" style="line-height:1.8;">
        <h2>دفترچه راهنما و مستندات پوسته زمین‌یاب (ZaminYab Directory Theme)</h2>
        <p class="text-justify">
            به بخش مستندات رسمی قالب اختصاصی <strong>زمین‌یاب</strong> خوش آمدید. این پوسته با معماری مدرن، کاملاً موبایل‌محور (Mobile-First)، راست‌چین استاندارد (RTL) و با تکیه بر فونت زیبای شبنم و بدون وابستگی به کتابخانه‌های خارجی سنگین، مخصوص خرید، فروش و معاوضه انواع زمین طراحی شده است.
        </p>

        <hr>

        <h3>۱. شروع سریع (Quick Start)</h3>
        <ul>
            <li>پس از فعال‌سازی قالب، دسته‌بندی‌ها و ترم‌های استاندارد به طور خودکار به ساختار وردپرس افزوده می‌شوند.</li>
            <li>برای تعریف منوها به مسیر <strong>نمایش &gt; فهرست‌ها</strong> مراجعه کنید.</li>
            <li>برای سفارشی‌سازی اطلاعات تماس و کلیدهای نقشه، به زبانه‌های بالای همین پنل مراجعه کنید.</li>
        </ul>

        <h3>۲. صفحات ضروری سامانه (Essential Pages)</h3>
        <p class="text-justify">
            برای راه‌اندازی بخش‌های مختلف، برگه جدید بسازید و الگو (Template) مربوط به آن را تنظیم کنید:
        </p>
        <table class="wp-list-table widefat fixed striped" style="margin: 10px 0;">
            <thead>
                <tr>
                    <th>عنوان برگه پیشنهادی</th>
                    <th>نام الگوی برگه (Page Template)</th>
                    <th>عملکرد</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ثبت آگهی جدید</td>
                    <td><code>الگوی ثبت آگهی فروش زمین</code></td>
                    <td>فرم ۶ مرحله‌ای با نقشه برای ثبت آگهی زمین</td>
                </tr>
                <tr>
                    <td>داشبورد کاربری من</td>
                    <td><code>الگوی داشبورد کاربری</code></td>
                    <td>مدیریت، حذف و مشاهده وضعیت آگهی‌ها</td>
                </tr>
                <tr>
                    <td>علاقه‌مندی‌های من</td>
                    <td><code>الگوی علاقه‌مندی‌ها</code></td>
                    <td>لیست نشان‌شده‌های کاربر</td>
                </tr>
                <tr>
                    <td>جستجو روی نقشه</td>
                    <td><code>الگوی جستجوی نقشه</code></td>
                    <td>جستجوی پیشرفته به همراه نقشه Leaflet</td>
                </tr>
            </tbody>
        </table>

        <h3>۳. لیست شورت‌کدهای اختصاصی قالب</h3>
        <p>در صورتی که می‌خواهید بخش‌های مختلف را در برگه‌های عادی به نمایش بگذارید، از شورت‌کدهای زیر استفاده کنید:</p>
        <ul>
            <li><code>[zaminyab_search]</code>: نمایش فرم پیشرفته فیلتر و جستجوی زمین.</li>
            <li><code>[zaminyab_submit_listing]</code>: نمایش فرم کامل ثبت آگهی چندمرحله‌ای برای مهمانان و کاربران.</li>
            <li><code>[zaminyab_latest_listings count="8"]</code>: نمایش جدیدترین آگهی‌های ثبت شده زمین.</li>
            <li><code>[zaminyab_featured_listings count="8"]</code>: نمایش آگهی‌های علامت‌گذاری شده به عنوان "ویژه".</li>
            <li><code>[zaminyab_user_dashboard]</code>: نمایش پنل کاربری برای ویرایش و حذف آگهی‌های کاربر جاری.</li>
            <li><code>[zaminyab_favorites]</code>: نمایش آگهی‌های نشان‌شده کاربر.</li>
        </ul>

        <h3>۴. راهنمای امنیت و مدیریت فایل‌ها</h3>
        <p class="text-justify">
            تمام فرم‌های ثبت‌نام، ورود و ثبت آگهی این قالب مجهز به فیلترهای قدرتمند ضداسپم (WordPress Nonce) و متدهای ایمن‌سازی <code>sanitize_text_field</code> و خروجی‌های Escaped هستند. تصاویر آپلود شده به صورت مستقیم با فرآیندهای بومی رسانه وردپرس مدیریت می‌شوند.
        </p>

        <h3>۵. عیب‌یابی و خطاهای رایج</h3>
        <p class="text-justify">
            <strong>عدم نمایش نقشه:</strong> اگر نقشه بارگذاری نمی‌شود، ابتدا بررسی کنید آیا کتابخانه لود شده است یا خیر. در صورت انتخاب نقشه ایرانی "نشان"، حتماً باید کلید API معتبر خود را در بخش تنظیمات نقشه وارد نمایید.
        </p>
    </div>
    <?php
}
