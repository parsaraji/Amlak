<?php
/**
 * ZaminYab Front Page Template (Homepage)
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<!-- Hero Search Area -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">سامانه تخصصی خرید و فروش زمین</h1>
        <p class="hero-subtitle text-justify" style="text-align: center;">جستجو و واگذاری مستقیم زمین مسکونی، کشاورزی، باغ و باغچه، تجاری و صنعتی در سراسر کشور بدون واسطه</p>

        <!-- Search filter box component -->
        <div class="hero-search-box">
            <form action="<?php echo esc_url( home_url( '/land/' ) ); ?>" method="get">
                <div class="search-box-row">
                    <div class="search-box-input">
                        <?php echo zaminyab_get_svg_icon( 'search' ); ?>
                        <input type="text" name="s_keyword" placeholder="کلمه کلیدی (مثلا: باغچه، هکتار، سنددار)">
                    </div>

                    <div class="search-box-input">
                        <?php echo zaminyab_get_svg_icon( 'location' ); ?>
                        <select name="s_location">
                            <option value="">همه استان‌ها و شهرها</option>
                            <?php
                            $locations = get_terms( array( 'taxonomy' => 'land_location', 'hide_empty' => false ) );
                            foreach ( $locations as $loc ) {
                                echo '<option value="' . esc_attr( $loc->term_id ) . '">' . esc_html( $loc->name ) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="search-box-input">
                        <?php echo zaminyab_get_svg_icon( 'land' ); ?>
                        <select name="s_type">
                            <option value="">نوع زمین (همه)</option>
                            <?php
                            $types = get_terms( array( 'taxonomy' => 'land_type', 'hide_empty' => false ) );
                            foreach ( $types as $type ) {
                                echo '<option value="' . esc_attr( $type->term_id ) . '">' . esc_html( $type->name ) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn-primary">
                        جستجوی زمین
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Quick Categories Icons -->
<div class="quick-categories">
    <div class="quick-categories-grid">
        <a href="<?php echo esc_url( home_url( '/land/?s_type=residential' ) ); ?>" class="quick-category-item">
            <div class="quick-category-icon"><?php echo zaminyab_get_svg_icon( 'home' ); ?></div>
            <span>زمین مسکونی</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/land/?s_type=farm' ) ); ?>" class="quick-category-item">
            <div class="quick-category-icon"><?php echo zaminyab_get_svg_icon( 'farm' ); ?></div>
            <span>زمین کشاورزی</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/land/?s_type=garden' ) ); ?>" class="quick-category-item">
            <div class="quick-category-icon"><?php echo zaminyab_get_svg_icon( 'land' ); ?></div>
            <span>باغ و باغچه</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/land/?s_type=industrial' ) ); ?>" class="quick-category-item">
            <div class="quick-category-icon"><?php echo zaminyab_get_svg_icon( 'industry' ); ?></div>
            <span>زمین صنعتی</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/land/?s_type=commercial' ) ); ?>" class="quick-category-item">
            <div class="quick-category-icon"><?php echo zaminyab_get_svg_icon( 'document' ); ?></div>
            <span>زمین تجاری</span>
        </a>
        <a href="<?php echo esc_url( home_url( '/map-search/' ) ); ?>" class="quick-category-item">
            <div class="quick-category-icon"><?php echo zaminyab_get_svg_icon( 'map' ); ?></div>
            <span>جستجوی نقشه</span>
        </a>
    </div>
</div>

<main id="primary" class="site-main container">

    <!-- Featured Listings section -->
    <div class="section-header">
        <h2 class="section-title">آگهی‌های ویژه و پیشنهادی</h2>
        <a href="<?php echo esc_url( home_url( '/land/' ) ); ?>" class="btn-outline" style="padding: 6px 16px; border-radius: 20px; font-size:12px;">مشاهده همه</a>
    </div>
    <?php echo do_shortcode( '[zaminyab_featured_listings count="4"]' ); ?>

    <!-- Latest Listings Section -->
    <div class="section-header" style="margin-top: 60px;">
        <h2 class="section-title">جدیدترین آگهی‌های ثبت شده زمین</h2>
        <a href="<?php echo esc_url( home_url( '/land/' ) ); ?>" class="btn-outline" style="padding: 6px 16px; border-radius: 20px; font-size:12px;">مشاهده همه</a>
    </div>
    <?php echo do_shortcode( '[zaminyab_latest_listings count="8"]' ); ?>

    <!-- Trust / Educational Section -->
    <div class="trust-guide-section" style="background:#fff; border:1px solid var(--border-color); border-radius:12px; padding:32px; margin-top:60px;">
        <h2 class="section-title" style="margin-bottom: 16px; margin-top: 0;">چرا سامانه خرید و فروش زمین‌یاب؟</h2>
        <p class="text-justify" style="color: var(--text-muted); font-size:14px;">
            وب‌سایت زمین‌یاب با حذف واسطه‌ها و دلالان ملکی، بستری امن و آسان را برای خریداران و فروشندگان واقعی زمین در سراسر ایران ایجاد کرده است. چه به دنبال خرید زمین کشاورزی برای کشت، چه به دنبال زمین مسکونی با پروانه ساخت برای ساخت ویلا در شمال و یا زمین‌های تجاری-صنعتی در قطب‌های اقتصادی کشور باشید، ما راه را برای شما هموار کرده‌ایم. با ثبت آگهی در زمین‌یاب، ملک خود را مستقیماً به هزاران خریدار معرفی کنید.
        </p>
    </div>

</main>

<?php get_footer(); ?>
