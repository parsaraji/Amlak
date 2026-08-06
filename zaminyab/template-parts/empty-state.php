<?php
/**
 * ZaminYab empty state component
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="empty-state">
    <div class="empty-state-icon">
        <?php echo zaminyab_get_svg_icon( 'warning' ); ?>
    </div>
    <h3 style="font-size: 16px; font-weight: bold; margin-bottom: 8px;">هیچ موردی یافت نشد!</h3>
    <p class="text-justify" style="text-align: center; color: var(--text-muted); font-size: 13px; max-width: 400px; margin: 0 auto 20px;">
        متاسفانه با معیارهای جستجوی انتخابی شما، آگهی زمینی پیدا نشد. لطفاً فیلترها را حذف کنید یا عبارت جستجو را تغییر دهید.
    </p>
</div>
