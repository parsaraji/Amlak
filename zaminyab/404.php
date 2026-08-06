<?php
/**
 * ZaminYab 404 Error Page
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<main id="primary" class="site-main container">
    <div style="text-align: center; padding: 80px 24px; max-width: 600px; margin: 0 auto;">
        <div style="font-size: 80px; font-weight: bold; color: var(--primary-color); line-height: 1; margin-bottom: 24px;">۴۰۴</div>
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 16px; color: var(--text-color);">صفحه مورد نظر پیدا نشد!</h1>
        <p class="text-justify" style="text-align: center; color: var(--text-muted); margin-bottom: 32px;">
            متاسفانه آدرس یا صفحه‌ای که به دنبال آن بوده‌اید وجود ندارد یا حذف شده است. لطفاً کلمه کلیدی دیگری را جستجو کنید یا به صفحه نخست سایت بازگردید.
        </p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary" style="padding: 10px 20px; border-radius: 8px;">
                <?php echo zaminyab_get_svg_icon( 'home' ); ?> بازگشت به صفحه اصلی
            </a>
            <a href="<?php echo esc_url( home_url( '/land/' ) ); ?>" class="btn-outline" style="padding: 10px 20px; border-radius: 8px;">
                <?php echo zaminyab_get_svg_icon( 'search' ); ?> آرشیو آگهی‌ها
            </a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
