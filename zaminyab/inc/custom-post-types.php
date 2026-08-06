<?php
/**
 * ZaminYab Custom Post Types
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register land_listing Custom Post Type.
 */
function zaminyab_register_land_listing_cpt() {

    $labels = array(
        'name'                  => _x( 'آگهی‌های زمین', 'Post Type General Name', 'zaminyab' ),
        'singular_name'         => _x( 'آگهی زمین', 'Post Type Singular Name', 'zaminyab' ),
        'menu_name'             => __( 'آگهی‌های زمین', 'zaminyab' ),
        'name_admin_bar'        => __( 'آگهی زمین', 'zaminyab' ),
        'archives'              => __( 'آرشیو آگهی‌ها', 'zaminyab' ),
        'attributes'            => __( 'ویژگی‌های آگهی', 'zaminyab' ),
        'parent_item_colon'     => __( 'آگهی والد:', 'zaminyab' ),
        'all_items'             => __( 'همه آگهی‌ها', 'zaminyab' ),
        'add_new_item'          => __( 'افزودن آگهی زمین جدید', 'zaminyab' ),
        'add_new'               => __( 'افزودن جدید', 'zaminyab' ),
        'new_item'              => __( 'آگهی جدید', 'zaminyab' ),
        'edit_item'             => __( 'ویرایش آگهی', 'zaminyab' ),
        'update_item'           => __( 'بروزرسانی آگهی', 'zaminyab' ),
        'view_item'             => __( 'مشاهده آگهی', 'zaminyab' ),
        'view_items'            => __( 'مشاهده آگهی‌ها', 'zaminyab' ),
        'search_items'          => __( 'جستجوی آگهی', 'zaminyab' ),
        'not_found'             => __( 'آگهی پیدا نشد', 'zaminyab' ),
        'not_found_in_trash'    => __( 'آگهی در زباله‌دان پیدا نشد', 'zaminyab' ),
        'featured_image'        => __( 'تصویر شاخص آگهی', 'zaminyab' ),
        'set_featured_image'    => __( 'تنظیم تصویر شاخص', 'zaminyab' ),
        'remove_featured_image' => __( 'حذف تصویر شاخص', 'zaminyab' ),
        'use_featured_image'    => __( 'استفاده به عنوان تصویر شاخص', 'zaminyab' ),
        'insert_into_item'      => __( 'درج در آگهی', 'zaminyab' ),
        'uploaded_to_this_item' => __( 'آپلود شده در این آگهی', 'zaminyab' ),
        'items_list'            => __( 'لیست آگهی‌ها', 'zaminyab' ),
        'items_list_navigation' => __( 'ناوبری لیست آگهی‌ها', 'zaminyab' ),
        'filter_items_list'     => __( 'فیلتر لیست آگهی‌ها', 'zaminyab' ),
    );

    $args = array(
        'label'                 => __( 'آگهی زمین', 'zaminyab' ),
        'description'           => __( 'لیست آگهی‌های فروش و معاوضه زمین', 'zaminyab' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt', 'custom-fields' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-location-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'land',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type( 'land_listing', $args );
}
add_action( 'init', 'zaminyab_register_land_listing_cpt', 0 );
