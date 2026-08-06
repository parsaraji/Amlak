<?php
/**
 * ZaminYab Header Template
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site" style="width: 100%; min-height: 100vh; display: flex; flex-direction: column;">
    <a class="skip-link screen-reader-text" href="#primary" style="display:none;"><?php esc_html_e( 'پرش به محتوا', 'zaminyab' ); ?></a>

    <!-- Full-Width Sticky Header -->
    <header class="site-header" style="width: 100%;">
        <div class="container header-container" style="width: 100%; max-width: var(--container-width); margin: 0 auto; padding: 0 16px;">
            <!-- Hamburger menu for mobile -->
            <button class="mobile-hamburger" aria-label="منوی ناوبری" aria-expanded="false" onclick="toggleMobileSidebar()">
                <?php echo zaminyab_get_svg_icon( 'menu' ); ?>
            </button>

            <!-- Brand Logo -->
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo">
                    <?php
                    $logo = zaminyab_get_option( 'logo_url' );
                    if ( ! empty( $logo ) ) : ?>
                        <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height: 32px; width: auto; object-fit: contain;">
                    <?php else : ?>
                        <?php echo zaminyab_get_svg_icon( 'land' ); ?>
                        <span><?php bloginfo( 'name' ); ?></span>
                    <?php endif; ?>
                </a>
            </div>

            <!-- Desktop Menu -->
            <nav class="desktop-nav">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => '__return_false',
                ) );
                ?>
            </nav>

            <!-- Actions buttons -->
            <div class="header-actions">
                <?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( home_url( '/dashboard/' ) ); ?>" class="btn-outline">
                        <?php echo zaminyab_get_svg_icon( 'user' ); ?> پنل کاربری
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url( wp_login_url() ); ?>" class="btn-muted">
                        <?php echo zaminyab_get_svg_icon( 'user' ); ?> ورود / ثبت نام
                    </a>
                <?php endif; ?>

                <a href="<?php echo esc_url( home_url( '/submit-listing/' ) ); ?>" class="btn-primary">
                    <?php echo zaminyab_get_svg_icon( 'plus' ); ?> ثبت آگهی
                </a>
            </div>
        </div>
    </header>

    <!-- Mobile Sidebar Drawer -->
    <div class="mobile-sidebar" id="mobileSidebar">
        <div class="mobile-sidebar-header">
            <strong><?php bloginfo( 'name' ); ?></strong>
            <button class="mobile-sidebar-close" onclick="toggleMobileSidebar()">
                <?php echo zaminyab_get_svg_icon( 'close' ); ?>
            </button>
        </div>
        <div class="mobile-sidebar-body">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary-menu',
                'menu_class'     => 'mobile-nav-menu',
                'container'      => false,
            ) );
            ?>
        </div>
    </div>
    <div class="mobile-sidebar-overlay" id="mobileOverlay" onclick="toggleMobileSidebar()"></div>
