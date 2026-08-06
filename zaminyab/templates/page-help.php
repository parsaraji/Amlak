<?php
/**
 * Template Name: الگوی راهنمای سایت
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
        <h1 style="font-size:20px; font-weight:bold; margin-bottom:20px; border-bottom:1px solid var(--border-color); padding-bottom:12px;">راهنما و سوالات متداول کاربران</h1>

        <div class="entry-content text-justify" style="font-size:14px; color:var(--text-color); line-height:1.8;">
            <h2 style="font-size:15px; font-weight:bold; margin-bottom:8px;">چگونه یک آگهی موفق ثبت کنم؟</h2>
            <p>
                برای جذب سریع‌تر خریداران، در گام اول عنوان جذابی با جزئیات دقیق انتخاب کنید. سپس تمامی انشعابات زمین (آب، برق، گاز) و وضعیت دقیق سند (تک برگ، مشاع، قولنامه‌ای) را صادقانه علامت‌گذاری کرده و حداقل ۳ تصویر با کیفیت و واقعی از زوایای مختلف زمین در سامانه بارگذاری نمایید.
            </p>

            <h2 style="font-size:15px; font-weight:bold; margin-top:24px; margin-bottom:8px;">ثبت آگهی هزینه دارد؟</h2>
            <p>
                خیر، ثبت آگهی‌های معمولی زمین در سامانه زمین‌یاب کاملاً رایگان است. تنها برای ویژه کردن آگهی جهت قرارگیری در صدر جستجوها ممکن است هزینه اندکی دریافت شود.
            </p>
        </div>
    </article>
</main>

<?php get_footer(); ?>
