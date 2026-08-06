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

get_header(); ?>
<!-- Breadcrumbs -->
<?php zaminyab_breadcrumbs(); ?>

<main id="primary" class="site-main container">
    <?php get_template_part( 'template-parts/form-submit-listing' ); ?>
</main>
<?php get_footer(); ?>
