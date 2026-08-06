<?php
/**
 * Template Name: الگوی قوانین ثبت آگهی
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
    <article class="zaminyab-page-card">
        <h1 style="font-size:20px; font-weight:bold; margin-bottom:20px; border-bottom:1px solid var(--border-color); padding-bottom:12px;">قوانین و ضوابط ثبت آگهی زمین</h1>

        <div class="entry-content text-justify" style="font-size:14px; color:var(--text-color); line-height:1.8;">
            <p>
                جهت حفظ کیفیت سامانه زمین‌یاب و پیشگیری از هرگونه کلاهبرداری یا سوءاستفاده احتمالی، تمامی کاربران و آگهی‌دهندگان محترم موظف به رعایت کامل قوانین زیر می‌باشند:
            </p>
            <ol style="margin-top:16px; padding-right:20px; display:flex; flex-direction:column; gap:12px;">
                <li><strong>مالکیت قانونی:</strong> آگهی‌دهنده باید مالک قانونی زمین یا نماینده/مشاور رسمی صاحب ملک با معرفی‌نامه معتبر باشد.</li>
                <li><strong>توضیحات واقعی:</strong> درج هرگونه اطلاعات خلاف واقع، قیمت‌های نجومی یا فاقد صحت در متراژ و کاربری ممنوع بوده و آگهی بلافاصله رد خواهد شد.</li>
                <li><strong>تصاویر واقعی زمین:</strong> تصاویر ارسالی باید متعلق به خود ملک باشد. استفاده از تصاویر اینترنتی، تزئینی و یا نامرتبط منجر به تایید نشدن آگهی خواهد شد.</li>
                <li><strong>تعیین کاربری صحیح:</strong> تداخل یا فریب در ثبت کاربری زمین (مثلاً معرفی زمین کشاورزی به عنوان مسکونی بدون تغییر کاربری رسمی) شرعاً و قانوناً مجاز نبوده و آگهی مسدود می‌گردد.</li>
            </ol>
        </div>
    </article>
</main>

<?php get_footer(); ?>
