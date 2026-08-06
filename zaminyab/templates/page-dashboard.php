<?php
/**
 * Template Name: الگوی داشبورد کاربری
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Ensure user is logged in
if ( ! is_user_logged_in() ) {
    wp_redirect( wp_login_url() );
    exit;
}

$user_id = get_current_user_id();

// Handle Frontend Secure Deletion
if ( isset( $_GET['action'] ) && $_GET['action'] === 'delete' && isset( $_GET['id'] ) ) {
    $delete_id = intval( $_GET['id'] );

    // Verify security nonce
    if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'delete_listing_' . $delete_id ) ) {
        $post_to_delete = get_post( $delete_id );

        // Ownership verification
        if ( $post_to_delete && intval( $post_to_delete->post_author ) === $user_id ) {
            wp_trash_post( $delete_id );
            wp_redirect( add_query_arg( 'deleted', '1', remove_query_arg( array( 'action', 'id', '_wpnonce' ) ) ) );
            exit;
        }
    }
}

get_header(); ?>

<!-- Breadcrumbs -->
<?php zaminyab_breadcrumbs(); ?>

<main id="primary" class="site-main container">
    <div style="margin: 40px 0;">
        <h1 style="font-size:24px; font-weight:bold; margin-bottom:24px;">داشبورد آگهی‌های من</h1>

        <!-- Feedback messages -->
        <?php if ( isset($_GET['deleted']) && $_GET['deleted'] === '1' ) : ?>
            <div class="zaminyab-warning-box" style="background-color:#f0fdf4; border-right:4px solid #16a34a; color:#15803d; margin-bottom:24px;">
                آگهی زمین مورد نظر با موفقیت حذف گردید و به زباله‌دان انتقال یافت.
            </div>
        <?php endif; ?>

        <?php get_template_part( 'template-parts/dashboard-content' ); ?>
    </div>
</main>

<?php get_footer(); ?>
