<?php
/**
 * Template Name: الگوی جستجوی نقشه
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<!-- Breadcrumbs -->
<?php zaminyab_breadcrumbs(); ?>

<main id="primary" class="site-main container" style="margin-top:20px;">
    <h1 style="font-size:24px; font-weight:bold; margin-bottom:12px;">جستجوی هوشمند زمین روی نقشه</h1>
    <p class="text-justify" style="color:var(--text-muted); font-size:14px; margin-bottom:24px;">با جابجایی روی نقشه یا کلیک بر روی مناطق مختلف کشور، آگهی‌های فروش زمین در آن مناطق را فوراً مشاهده نمایید.</p>

    <!-- Map interface wrapper -->
    <div style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:24px; margin-bottom:40px;">
        <?php zaminyab_render_map(); ?>
    </div>
</main>

<?php get_footer(); ?>
