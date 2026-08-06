<?php
/**
 * ZaminYab Helper functions (Currency, Formatting, AJAX)
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Convert English digits to Persian.
 */
function zaminyab_to_persian_digits( $number ) {
    $en = array("0","1","2","3","4","5","6","7","8","9");
    $fa = array("۰","۱","۲","۳","۴","۵","۶","۷","۸","۹");
    return str_replace( $en, $fa, $number );
}

/**
 * Format currency to Persian Tomans.
 */
function zaminyab_format_price( $price ) {
    if ( empty( $price ) || ! is_numeric( $price ) ) {
        return 'توافقی';
    }

    $formatted = number_format( $price );
    return zaminyab_to_persian_digits( $formatted ) . ' تومان';
}

/**
 * Format area to Persian digits + m2.
 */
function zaminyab_format_area( $area ) {
    if ( empty( $area ) || ! is_numeric( $area ) ) {
        return 'ثبت نشده';
    }

    return zaminyab_to_persian_digits( number_format( $area ) ) . ' متر مربع';
}

/**
 * Favorite Listing Toggle AJAX handler.
 */
function zaminyab_toggle_favorite_ajax() {
    check_ajax_referer( 'zaminyab_ajax_nonce', 'nonce' );

    $post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
    if ( ! $post_id ) {
        wp_send_json_error( 'شناسه آگهی معتبر نیست.' );
    }

    // Guest vs logged-in
    if ( is_user_logged_in() ) {
        $user_id = get_current_user_id();
        $favorites = get_user_meta( $user_id, '_zaminyab_favorites', true );
        if ( ! is_array( $favorites ) ) {
            $favorites = array();
        }

        if ( in_array( $post_id, $favorites, true ) ) {
            $favorites = array_diff( $favorites, array( $post_id ) );
            $status = 'removed';
            $msg = 'از علاقه‌مندی‌ها حذف شد.';
        } else {
            $favorites[] = $post_id;
            $status = 'added';
            $msg = 'به علاقه‌مندی‌ها اضافه شد.';
        }

        update_user_meta( $user_id, '_zaminyab_favorites', $favorites );
        wp_send_json_success( array( 'status' => $status, 'message' => $msg ) );
    } else {
        // Fallback or instructions to use localStorage in front-end JS
        wp_send_json_success( array( 'status' => 'guest_handled', 'message' => 'مهمان: در مرورگر شما ذخیره شد.' ) );
    }
}
add_action( 'wp_ajax_zaminyab_toggle_favorite', 'zaminyab_toggle_favorite_ajax' );
add_action( 'wp_ajax_nopriv_zaminyab_toggle_favorite', 'zaminyab_toggle_favorite_ajax' );

/**
 * Check if post is favorited by user.
 */
function zaminyab_is_post_favorited( $post_id ) {
    if ( ! is_user_logged_in() ) {
        return false;
    }

    $user_id = get_current_user_id();
    $favorites = get_user_meta( $user_id, '_zaminyab_favorites', true );
    if ( is_array( $favorites ) && in_array( $post_id, $favorites, true ) ) {
        return true;
    }
    return false;
}
