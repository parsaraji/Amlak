<?php
/**
 * ZaminYab Helper functions (Currency, Formatting, AJAX, Gregorian-to-Jalali Converter)
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
 * Convert Gregorian date to Jalali (Solar Hijri) date string.
 *
 * @param int $g_y Year
 * @param int $g_m Month
 * @param int $g_d Day
 * @return string Jalali date like "۱۴۰۲/۰۵/۱۵"
 */
function zaminyab_gregorian_to_jalali( $g_y, $g_m, $g_d ) {
    $g_days_in_month = array( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );
    $j_days_in_month = array( 31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29 );

    $gy = $g_y - 1600;
    $gm = $g_m - 1;
    $gd = $g_d - 1;

    $g_day_no = 365 * $gy + floor( ( $gy + 3 ) / 4 ) - floor( ( $gy + 99 ) / 100 ) + floor( ( $gy + 399 ) / 400 );

    for ( $i = 0; $i < $gm; ++$i ) {
        $g_day_no += $g_days_in_month[ $i ];
    }
    if ( $gm > 1 && ( ( $g_y % 4 == 0 && $g_y % 100 != 0 ) || ( $g_y % 400 == 0 ) ) ) {
        $g_day_no++;
    }
    $g_day_no += $gd;

    $j_day_no = $g_day_no - 79;

    $j_np = floor( $j_day_no / 12053 );
    $j_day_no %= 12053;

    $jy = 979 + 33 * $j_np + 4 * floor( $j_day_no / 1461 );
    $j_day_no %= 1461;

    if ( $j_day_no >= 366 ) {
        $jy += floor( ( $j_day_no - 1 ) / 365 );
        $j_day_no = ( $j_day_no - 1 ) % 365;
    }

    for ( $i = 0; $i < 11 && $j_day_no >= $j_days_in_month[ $i ]; ++$i ) {
        $j_day_no -= $j_days_in_month[ $i ];
    }
    $jm = $i + 1;
    $jd = $j_day_no + 1;

    // Formatting month & day with leading zeros
    $jm_str = ( $jm < 10 ) ? '۰' . $jm : $jm;
    $jd_str = ( $jd < 10 ) ? '۰' . $jd : $jd;

    $jy_str = zaminyab_to_persian_digits( $jy );
    $jm_str = zaminyab_to_persian_digits( $jm_str );
    $jd_str = zaminyab_to_persian_digits( $jd_str );

    return $jy_str . '/' . $jm_str . '/' . $jd_str;
}

/**
 * Returns the formatted Jalali date of a post.
 */
function zaminyab_get_jalali_date( $post_id = 0 ) {
    $post = get_post( $post_id );
    if ( ! $post ) {
        return '';
    }

    $time = strtotime( $post->post_date );
    $y = date( 'Y', $time );
    $m = date( 'n', $time );
    $d = date( 'j', $time );

    return zaminyab_gregorian_to_jalali( $y, $m, $d );
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
