<?php
/**
 * Template Name: الگوی علاقه‌مندی‌ها
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
    <div style="margin:40px 0;">
        <h1 style="font-size:24px; font-weight:bold; margin-bottom:12px;">آگهی‌های نشان‌شده و علاقه‌مندی‌ها</h1>
        <p class="text-justify" style="color:var(--text-muted); font-size:14px; margin-bottom:32px;">لیست زمین‌هایی که توسط شما علامت‌گذاری شده است تا در مراجعات بعدی دسترسی سریع‌تری داشته باشید.</p>

        <?php
        if ( is_user_logged_in() ) {
            $user_id = get_current_user_id();
            $favorites = get_user_meta( $user_id, '_zaminyab_favorites', true );

            if ( ! empty( $favorites ) && is_array( $favorites ) ) {
                $query = new WP_Query( array(
                    'post_type' => 'land_listing',
                    'post__in'  => $favorites,
                    'posts_per_page' => -1,
                ) );

                if ( $query->have_posts() ) {
                    echo '<div class="grid grid-2-sm grid-3-md grid-4-lg">';
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        get_template_part( 'template-parts/listing-card' );
                    }
                    echo '</div>';
                    wp_reset_postdata();
                } else {
                    get_template_part( 'template-parts/empty-state' );
                }
            } else {
                get_template_part( 'template-parts/empty-state' );
            }
        } else {
            ?>
            <!-- Inform guests they can register to synchronize or look in browser -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <?php echo zaminyab_get_svg_icon('user'); ?>
                </div>
                <h3 style="font-size:16px; font-weight:bold; margin-bottom:8px;">نیاز به ورود به حساب کاربری</h3>
                <p class="text-justify" style="text-align:center; color:var(--text-muted); font-size:13px; max-width:400px; margin: 0 auto 20px;">
                    جهت ثبت و همگام‌سازی همیشگی آگهی‌های نشان‌شده روی تمامی دستگاه‌ها، ابتدا وارد حساب کاربری خود شوید.
                </p>
                <a href="<?php echo esc_url( wp_login_url() ); ?>" class="btn-primary" style="padding:10px 20px; border-radius:8px;">ورود به حساب کاربری</a>
            </div>
            <?php
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>
