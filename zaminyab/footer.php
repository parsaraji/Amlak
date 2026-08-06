<?php
/**
 * ZaminYab Footer Template
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

    <!-- Full-Width Footer -->
    <footer class="site-footer" style="width: 100%;">
        <div class="container footer-grid" style="width: 100%; max-width: var(--container-width); margin: 0 auto; padding: 0 16px;">
            <!-- Widget 1: About site -->
            <div class="footer-widget">
                <h4 class="footer-widget-title">درباره زمین‌یاب</h4>
                <p class="text-justify" style="color: #a8a29e; font-size: 13px;">
                    زمین‌یاب بزرگترین پلتفرم تخصصی آگهی‌های خرید، فروش و معاوضه انواع زمین، باغ، زمین‌های تجاری، صنعتی و کشاورزی در ایران است. با زمین‌یاب بدون واسطه معامله کنید.
                </p>
            </div>

            <!-- Widget 2: Quick links -->
            <div class="footer-widget">
                <h4 class="footer-widget-title">لینک‌های مهم</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">درباره ما</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">تماس با ما</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/rules/' ) ); ?>">قوانین و مقررات</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/help/' ) ); ?>">راهنمای ثبت آگهی</a></li>
                </ul>
            </div>

            <!-- Widget 3: Land Types -->
            <div class="footer-widget">
                <h4 class="footer-widget-title">دسته‌بندی زمین‌ها</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url( home_url( '/land/?s_type=residential' ) ); ?>">زمین مسکونی</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/land/?s_type=farm' ) ); ?>">زمین کشاورزی</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/land/?s_type=garden' ) ); ?>">باغ و باغچه</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/land/?s_type=industry' ) ); ?>">زمین صنعتی</a></li>
                </ul>
            </div>

            <!-- Widget 4: Contact details -->
            <div class="footer-widget">
                <h4 class="footer-widget-title">تماس با ما</h4>
                <p style="color: #a8a29e; font-size: 13px; margin-bottom: 8px;">
                    تلفن ثابت: <?php echo esc_html( zaminyab_get_option( 'phone_number', 'ثبت نشده' ) ); ?>
                </p>
                <p style="color: #a8a29e; font-size: 13px; margin-bottom: 8px;">
                    آدرس دفتر: <?php echo esc_html( zaminyab_get_option( 'contact_address', 'ثبت نشده' ) ); ?>
                </p>

                <!-- Expanded Social Links in Footer -->
                <div style="display:flex; flex-wrap:wrap; gap: 8px; margin-top: 12px;">
                    <?php if ( zaminyab_get_option( 'whatsapp_number' ) ) : ?>
                        <a href="https://wa.me/<?php echo esc_attr( zaminyab_get_option( 'whatsapp_number' ) ); ?>" class="btn-outline" style="padding: 4px 8px; font-size: 11px; height: 28px; line-height: 20px; display: inline-flex; align-items: center; gap: 4px; color: #15803d; border-color: #15803d;">
                            <?php echo zaminyab_get_svg_icon( 'whatsapp' ); ?> واتس‌اپ
                        </a>
                    <?php endif; ?>
                    <?php if ( zaminyab_get_option( 'bale_link' ) ) : ?>
                        <a href="<?php echo esc_url( zaminyab_get_option( 'bale_link' ) ); ?>" class="btn-outline" style="padding: 4px 8px; font-size: 11px; height: 28px; line-height: 20px; display: inline-flex; align-items: center;">
                            بله
                        </a>
                    <?php endif; ?>
                    <?php if ( zaminyab_get_option( 'rubika_link' ) ) : ?>
                        <a href="<?php echo esc_url( zaminyab_get_option( 'rubika_link' ) ); ?>" class="btn-outline" style="padding: 4px 8px; font-size: 11px; height: 28px; line-height: 20px; display: inline-flex; align-items: center;">
                            روبیکا
                        </a>
                    <?php endif; ?>
                    <?php if ( zaminyab_get_option( 'eitaa_link' ) ) : ?>
                        <a href="<?php echo esc_url( zaminyab_get_option( 'eitaa_link' ) ); ?>" class="btn-outline" style="padding: 4px 8px; font-size: 11px; height: 28px; line-height: 20px; display: inline-flex; align-items: center;">
                            ایتا
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p>تمامی حقوق مادی و معنوی این وب‌سایت متعلق به سامانه زمین‌یاب می‌باشد. طراحی شده برای ثبت و جستجوی آسان زمین.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Sticky Bottom Nav -->
    <?php if ( zaminyab_get_option( 'mobile_bottom_nav_on', '1' ) === '1' ) : ?>
        <nav class="mobile-bottom-nav">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-bottom-nav-item active">
                <?php echo zaminyab_get_svg_icon( 'home' ); ?>
                <span>خانه</span>
            </a>
            <a href="<?php echo esc_url( home_url( '/land/' ) ); ?>" class="mobile-bottom-nav-item">
                <?php echo zaminyab_get_svg_icon( 'search' ); ?>
                <span>جستجو</span>
            </a>
            <a href="<?php echo esc_url( home_url( '/submit-listing/' ) ); ?>" class="mobile-bottom-nav-item">
                <?php echo zaminyab_get_svg_icon( 'plus' ); ?>
                <span>ثبت آگهی</span>
            </a>
            <a href="<?php echo esc_url( home_url( '/favorites/' ) ); ?>" class="mobile-bottom-nav-item">
                <?php echo zaminyab_get_svg_icon( 'heart' ); ?>
                <span>علاقه‌مندی‌ها</span>
            </a>
            <a href="<?php echo esc_url( home_url( '/dashboard/' ) ); ?>" class="mobile-bottom-nav-item">
                <?php echo zaminyab_get_svg_icon( 'user' ); ?>
                <span>حساب من</span>
            </a>
        </nav>
    <?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
