<?php
/**
 * Template Name: الگوی تماس با ما
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
    <div class="zaminyab-page-card">
        <h1 style="font-size:20px; font-weight:bold; margin-bottom:24px; border-bottom:1px solid var(--border-color); padding-bottom:12px;">تماس با پشتیبانی زمین‌یاب</h1>

        <div class="grid grid-2-md" style="gap:24px;">
            <!-- Form Card -->
            <div style="background:#fafaf9; border:1px solid var(--border-color); border-radius:8px; padding:20px;">
                <h2 style="font-size:15px; font-weight:bold; margin-bottom:16px;">ارسال پیام مستقیم به مدیریت</h2>

                <form action="#" method="post">
                    <div class="form-group">
                        <label for="contact_name">نام و نام خانوادگی شما:</label>
                        <input type="text" id="contact_name" name="contact_name" required>
                    </div>
                    <div class="form-group" style="margin-top:12px;">
                        <label for="contact_phone">شماره همراه تماس:</label>
                        <input type="text" id="contact_phone" name="contact_phone" required>
                    </div>
                    <div class="form-group" style="margin-top:12px;">
                        <label for="contact_message">متن پیام یا انتقاد شما:</label>
                        <textarea id="contact_message" name="contact_message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="margin-top:20px; width:100%; height:44px; border-radius:8px;">ارسال پیام</button>
                </form>
            </div>

            <!-- Contact info card -->
            <div style="background:#fafaf9; border:1px solid var(--border-color); border-radius:8px; padding:20px;">
                <h2 style="font-size:15px; font-weight:bold; margin-bottom:16px;">راه‌های ارتباطی بومی و آنلاین</h2>
                <p class="text-justify" style="color:var(--text-muted); font-size:13px; margin-bottom:24px;">کارشناسان ما در سریع‌ترین زمان ممکن پاسخگوی سوالات و راهنمایی‌های شما خریداران و فروشندگان گرامی زمین هستند.</p>

                <div style="display:flex; flex-direction:column; gap:16px; font-size:13px;">
                    <div>تلفن پشتیبانی ثابت: <strong><?php echo esc_html( zaminyab_get_option( 'phone_number', '۰۲۱-۱۲۳۴۵۶۷۸' ) ); ?></strong></div>
                    <div>شماره همراه مدیر: <strong><?php echo esc_html( zaminyab_get_option( 'mobile_number', '۰۹۱۲۳۴۵۶۷۸۹' ) ); ?></strong></div>
                    <div>آدرس دفتر مرکزی: <strong><?php echo esc_html( zaminyab_get_option( 'contact_address', 'تهران، خیابان ولیعصر، ساختمان زمین‌یاب' ) ); ?></strong></div>
                </div>

                <div style="margin-top:32px; border-top:1px solid var(--border-color); padding-top:20px;">
                    <h3 style="font-size:13px; font-weight:bold; margin-bottom:12px;">پیام‌رسان‌های بومی ما:</h3>
                    <?php echo do_shortcode( '[zaminyab_contact_buttons]' ); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
