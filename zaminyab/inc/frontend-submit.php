<?php
/**
 * ZaminYab Frontend Submission System
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Handle frontend listing submission form submission.
 */
function zaminyab_handle_frontend_listing_submit() {
    if ( ! isset( $_POST['zaminyab_frontend_submit_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['zaminyab_frontend_submit_nonce'], 'zaminyab_submit_listing_action' ) ) {
        wp_die( 'خطای امنیتی رخ داده است. لطفاً مجدداً تلاش کنید.' );
    }

    // Guest submission restriction
    $guest_allowed = zaminyab_get_option( 'enable_guest_submission', '0' );
    if ( $guest_allowed !== '1' && ! is_user_logged_in() ) {
        wp_die( 'برای ثبت آگهی ابتدا باید وارد حساب کاربری خود شوید.' );
    }

    // Capture standard post details
    $title       = isset( $_POST['title'] ) ? sanitize_text_field( $_POST['title'] ) : '';
    $description = isset( $_POST['description'] ) ? sanitize_textarea_field( $_POST['description'] ) : '';

    if ( empty( $title ) ) {
        return new WP_Error( 'empty_title', 'عنوان آگهی نمی‌تواند خالی باشد.' );
    }

    // Create post object
    $default_status = zaminyab_get_option( 'default_listing_status', 'pending' );
    $post_data = array(
        'post_title'   => $title,
        'post_content' => $description,
        'post_status'  => $default_status,
        'post_type'    => 'land_listing',
        'post_author'  => is_user_logged_in() ? get_current_user_id() : 1,
    );

    // Insert post
    $post_id = wp_insert_post( $post_data );

    if ( is_wp_error( $post_id ) ) {
        return $post_id;
    }

    // Assign Taxonomies if set
    if ( ! empty( $_POST['land_type'] ) ) {
        wp_set_object_terms( $post_id, intval( $_POST['land_type'] ), 'land_type' );
    }
    if ( ! empty( $_POST['land_location'] ) ) {
        wp_set_object_terms( $post_id, intval( $_POST['land_location'] ), 'land_location' );
    }
    if ( ! empty( $_POST['land_status'] ) ) {
        wp_set_object_terms( $post_id, intval( $_POST['land_status'] ), 'land_status' );
    }
    if ( ! empty( $_POST['land_document'] ) ) {
        wp_set_object_terms( $post_id, intval( $_POST['land_document'] ), 'land_document_type' );
    }
    if ( ! empty( $_POST['land_usage'] ) ) {
        wp_set_object_terms( $post_id, intval( $_POST['land_usage'] ), 'land_usage' );
    }

    // Save Meta Data
    $meta_fields = array(
        'price_total'     => '_price_total',
        'price_meter'     => '_price_meter',
        'area_size'       => '_area_size',
        'seller_name'     => '_seller_name',
        'seller_phone'    => '_seller_phone',
        'seller_whatsapp' => '_seller_whatsapp',
        'seller_bale'     => '_seller_bale',
        'seller_rubika'   => '_seller_rubika',
        'seller_eitaa'     => '_seller_eitaa',
        'land_width'      => '_land_width',
        'land_length'     => '_land_length',
        'land_passage'    => '_land_passage',
        'approx_address'  => '_approx_address',
        'latitude'        => '_latitude',
        'longitude'       => '_longitude',
        'map_zoom'        => '_map_zoom',
        'video_url'       => '_video_url',
    );

    foreach ( $meta_fields as $post_key => $meta_key ) {
        if ( isset( $_POST[ $post_key ] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $post_key ] ) );
        }
    }

    // Checkboxes
    $checkboxes = array(
        'allow_direct_call'   => '_allow_direct_call',
        'click_to_reveal'     => '_click_to_reveal',
        'has_water'           => '_has_water',
        'has_electricity'     => '_has_electricity',
        'has_gas'             => '_has_gas',
        'has_phone'           => '_has_phone',
        'has_wall'            => '_has_wall',
        'has_building_permit' => '_has_building_permit',
        'inside_plan'         => '_inside_plan',
        'can_subdivide'       => '_can_subdivide',
        'approx_mode'         => '_approx_mode',
    );

    foreach ( $checkboxes as $post_key => $meta_key ) {
        $val = isset( $_POST[ $post_key ] ) ? '1' : '0';
        update_post_meta( $post_id, $meta_key, $val );
    }

    // Media Handling (Files uploads)
    if ( ! empty( $_FILES['gallery_files'] ) ) {
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';

        $files = $_FILES['gallery_files'];
        $gallery_ids = array();

        foreach ( $files['name'] as $key => $value ) {
            if ( $files['name'][ $key ] ) {
                $file = array(
                    'name'     => $files['name'][ $key ],
                    'type'     => $files['type'][ $key ],
                    'tmp_name' => $files['tmp_name'][ $key ],
                    'error'    => $files['error'][ $key ],
                    'size'     => $files['size'][ $key ],
                );

                $_FILES = array( 'upload_file' => $file );
                $attachment_id = media_handle_upload( 'upload_file', $post_id );

                if ( ! is_wp_error( $attachment_id ) ) {
                    $gallery_ids[] = $attachment_id;
                    // Set first image as featured thumbnail
                    if ( count( $gallery_ids ) === 1 ) {
                        set_post_thumbnail( $post_id, $attachment_id );
                    }
                }
            }
        }

        if ( ! empty( $gallery_ids ) ) {
            update_post_meta( $post_id, '_gallery_images', implode( ',', $gallery_ids ) );
        }
    }

    // Redirect to success or home
    wp_redirect( add_query_arg( 'submit_success', $post_id, get_permalink() ) );
    exit;
}
add_action( 'template_redirect', 'zaminyab_handle_frontend_listing_submit' );
