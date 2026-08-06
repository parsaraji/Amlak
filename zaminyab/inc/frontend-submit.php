<?php
/**
 * ZaminYab Frontend Submission System (Bypasses WP capability limits using wp_handle_upload)
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Handle frontend listing submission and editing.
 */
function zaminyab_handle_frontend_listing_submit() {
    if ( ! isset( $_POST['zaminyab_frontend_submit_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['zaminyab_frontend_submit_nonce'], 'zaminyab_submit_listing_action' ) ) {
        wp_die( 'خطای امنیتی رخ داده است. لطفاً مجدداً تلاش کنید.' );
    }

    $is_editing = ! empty( $_POST['edit_id'] );
    $edit_id    = $is_editing ? intval( $_POST['edit_id'] ) : 0;

    // Permissions check
    if ( $is_editing ) {
        if ( ! is_user_logged_in() ) {
            wp_die( 'جهت ویرایش آگهی ابتدا باید وارد حساب کاربری خود شوید.' );
        }
        $post_to_edit = get_post( $edit_id );
        if ( ! $post_to_edit || intval( $post_to_edit->post_author ) !== get_current_user_id() ) {
            wp_die( 'شما دسترسی لازم برای ویرایش این آگهی را ندارید.' );
        }
    } else {
        $guest_allowed = zaminyab_get_option( 'enable_guest_submission', '0' );
        if ( $guest_allowed !== '1' && ! is_user_logged_in() ) {
            wp_die( 'برای ثبت آگهی ابتدا باید وارد حساب کاربری خود شوید.' );
        }
    }

    // Capture standard post details
    $title       = isset( $_POST['title'] ) ? sanitize_text_field( $_POST['title'] ) : '';
    $description = isset( $_POST['description'] ) ? sanitize_textarea_field( $_POST['description'] ) : '';

    if ( empty( $title ) ) {
        wp_die( 'عنوان آگهی نمی‌تواند خالی باشد.' );
    }

    $default_status = zaminyab_get_option( 'default_listing_status', 'pending' );

    $post_data = array(
        'post_title'   => $title,
        'post_content' => $description,
        'post_type'    => 'land_listing',
    );

    if ( $is_editing ) {
        $post_data['ID'] = $edit_id;
        $post_id = wp_update_post( $post_data );
    } else {
        $post_data['post_status'] = $default_status;
        $post_data['post_author'] = is_user_logged_in() ? get_current_user_id() : 1;
        $post_id = wp_insert_post( $post_data );
    }

    if ( is_wp_error( $post_id ) || ! $post_id ) {
        wp_die( 'خطایی در ثبت اطلاعات در پایگاه‌داده رخ داد.' );
    }

    // Assign Taxonomies if set
    if ( isset( $_POST['land_type'] ) ) {
        wp_set_object_terms( $post_id, intval( $_POST['land_type'] ), 'land_type' );
    }
    if ( isset( $_POST['land_location'] ) ) {
        wp_set_object_terms( $post_id, intval( $_POST['land_location'] ), 'land_location' );
    }
    if ( isset( $_POST['land_status'] ) ) {
        wp_set_object_terms( $post_id, intval( $_POST['land_status'] ), 'land_status' );
    }
    if ( isset( $_POST['land_document'] ) ) {
        wp_set_object_terms( $post_id, intval( $_POST['land_document'] ), 'land_document_type' );
    }
    if ( isset( $_POST['land_usage'] ) ) {
        wp_set_object_terms( $post_id, intval( $_POST['land_usage'] ), 'land_usage' );
    }

    // Save Meta Data
    $meta_fields = array(
        'price_total'     => '_price_total',
        'price_meter'     => '_price_meter',
        'rent_monthly'       => '_rent_monthly',
        'rent_deposit'       => '_rent_deposit',
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
        'soil_type'          => '_soil_type',
        'water_rights'       => '_water_rights',
        'industrial_power'   => '_industrial_power',
        'commercial_permit'  => '_commercial_permit',
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

    // Core Robust File Upload (Bypasses WordPress capability check using wp_handle_upload)
    if ( ! empty( $_FILES['gallery_files'] ) ) {
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';

        $files = $_FILES['gallery_files'];
        $gallery_ids = array();

        if ( $is_editing ) {
            $existing_gallery = get_post_meta( $post_id, '_gallery_images', true );
            if ( ! empty( $existing_gallery ) ) {
                $gallery_ids = explode( ',', $existing_gallery );
            }
        }

        foreach ( $files['name'] as $key => $value ) {
            if ( $files['name'][ $key ] ) {
                // Re-arrange the array for wp_handle_upload compatibility
                $uploaded_file = array(
                    'name'     => $files['name'][ $key ],
                    'type'     => $files['type'][ $key ],
                    'tmp_name' => $files['tmp_name'][ $key ],
                    'error'    => $files['error'][ $key ],
                    'size'     => $files['size'][ $key ],
                );

                // Disable default ownership check to permit guests and low-privilege uploads
                $overrides = array( 'test_form' => false );
                $file_data = wp_handle_upload( $uploaded_file, $overrides );

                if ( ! isset( $file_data['error'] ) && isset( $file_data['file'] ) ) {
                    $file_path = $file_data['file'];
                    $file_url  = $file_data['url'];
                    $file_type = $file_data['type'];

                    // Prepare attachment object
                    $attachment = array(
                        'guid'           => $file_url,
                        'post_mime_type' => $file_type,
                        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_path ) ),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    );

                    // Insert attachment programmatically without capability restrictions
                    $attachment_id = wp_insert_attachment( $attachment, $file_path, $post_id );

                    if ( ! is_wp_error( $attachment_id ) && $attachment_id ) {
                        // Generate metadata and crop sizes (including zaminyab-square size!)
                        $attach_data = wp_generate_attachment_metadata( $attachment_id, $file_path );
                        wp_update_attachment_metadata( $attachment_id, $attach_data );

                        $gallery_ids[] = $attachment_id;

                        // Auto-assign first image as post featured image
                        if ( ! has_post_thumbnail( $post_id ) ) {
                            set_post_thumbnail( $post_id, $attachment_id );
                        }
                    }
                }
            }
        }

        if ( ! empty( $gallery_ids ) ) {
            update_post_meta( $post_id, '_gallery_images', implode( ',', $gallery_ids ) );
        }
    }

    // Redirect to success
    if ( $is_editing ) {
        wp_redirect( add_query_arg( 'edit_success', '1', get_permalink() ) );
    } else {
        wp_redirect( add_query_arg( 'submit_success', $post_id, get_permalink() ) );
    }
    exit;
}
add_action( 'template_redirect', 'zaminyab_handle_frontend_listing_submit' );
