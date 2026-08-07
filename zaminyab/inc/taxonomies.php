<?php
/**
 * ZaminYab Custom Taxonomies (Expanded with Rent/Mortgage, Residential/Commercial details and Default seeded Locations)
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Taxonomies for land_listing CPT.
 */
function zaminyab_register_taxonomies() {

    // 1. Land Type (نوع زمین)
    $labels_land_type = array(
        'name'                       => _x( 'نوع زمین', 'Taxonomy General Name', 'zaminyab' ),
        'singular_name'              => _x( 'نوع زمین', 'Taxonomy Singular Name', 'zaminyab' ),
        'menu_name'                  => __( 'انواع زمین', 'zaminyab' ),
        'all_items'                  => __( 'همه انواع زمین', 'zaminyab' ),
        'parent_item'                => __( 'نوع والد', 'zaminyab' ),
        'parent_item_colon'          => __( 'نوع والد:', 'zaminyab' ),
        'new_item_name'              => __( 'نام نوع زمین جدید', 'zaminyab' ),
        'add_new_item'               => __( 'افزودن نوع زمین جدید', 'zaminyab' ),
        'edit_item'                  => __( 'ویرایش نوع زمین', 'zaminyab' ),
        'update_item'                => __( 'بروزرسانی نوع زمین', 'zaminyab' ),
        'view_item'                  => __( 'مشاهده نوع زمین', 'zaminyab' ),
        'separate_items_with_commas' => __( 'جداسازی با کاما', 'zaminyab' ),
        'add_or_remove_items'        => __( 'افزودن یا حذف نوع زمین', 'zaminyab' ),
        'choose_from_most_used'      => __( 'انتخاب از پر استفاده‌ترین‌ها', 'zaminyab' ),
        'popular_items'              => __( 'انواع پرطرفدار', 'zaminyab' ),
        'search_items'               => __( 'جستجوی نوع زمین', 'zaminyab' ),
        'not_found'                  => __( 'پیدا نشد', 'zaminyab' ),
        'no_terms'                   => __( 'بدون نوع زمین', 'zaminyab' ),
        'items_list'                 => __( 'لیست انواع زمین', 'zaminyab' ),
        'items_list_navigation'      => __( 'ناوبری لیست انواع زمین', 'zaminyab' ),
    );
    $args_land_type = array(
        'labels'                     => $labels_land_type,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'land_type', array( 'land_listing' ), $args_land_type );

    // 2. Land Location (موقعیت مکانی - استان/شهر/منطقه)
    $labels_location = array(
        'name'                       => _x( 'موقعیت مکانی', 'Taxonomy General Name', 'zaminyab' ),
        'singular_name'              => _x( 'موقعیت مکانی', 'Taxonomy Singular Name', 'zaminyab' ),
        'menu_name'                  => __( 'موقعیت‌های مکانی', 'zaminyab' ),
        'all_items'                  => __( 'همه موقعیت‌ها (استان/شهر)', 'zaminyab' ),
        'parent_item'                => __( 'موقعیت والد', 'zaminyab' ),
        'parent_item_colon'          => __( 'موقعیت والد:', 'zaminyab' ),
        'new_item_name'              => __( 'نام موقعیت جدید', 'zaminyab' ),
        'add_new_item'               => __( 'افزودن موقعیت مکانی جدید', 'zaminyab' ),
        'edit_item'                  => __( 'ویرایش موقعیت', 'zaminyab' ),
        'update_item'                => __( 'بروزرسانی موقعیت', 'zaminyab' ),
        'view_item'                  => __( 'مشاهده موقعیت', 'zaminyab' ),
        'separate_items_with_commas' => __( 'جداسازی با کاما', 'zaminyab' ),
        'add_or_remove_items'        => __( 'افزودن یا حذف موقعیت', 'zaminyab' ),
        'choose_from_most_used'      => __( 'انتخاب از پر استفاده‌ترین‌ها', 'zaminyab' ),
        'popular_items'              => __( 'موقعیت‌های پر استفاده', 'zaminyab' ),
        'search_items'               => __( 'جستجوی موقعیت مکانی', 'zaminyab' ),
        'not_found'                  => __( 'پیدا نشد', 'zaminyab' ),
        'no_terms'                   => __( 'بدون موقعیت', 'zaminyab' ),
        'items_list'                 => __( 'لیست موقعیت‌ها', 'zaminyab' ),
        'items_list_navigation'      => __( 'ناوبری لیست موقعیت‌ها', 'zaminyab' ),
    );
    $args_location = array(
        'labels'                     => $labels_location,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'land_location', array( 'land_listing' ), $args_location );

    // 3. Land Status (وضعیت آگهی - فروشی/اجاره/رهن/فوری/تخفیف‌دار/ویژه)
    $labels_status = array(
        'name'                       => _x( 'وضعیت آگهی', 'Taxonomy General Name', 'zaminyab' ),
        'singular_name'              => _x( 'وضعیت آگهی', 'Taxonomy Singular Name', 'zaminyab' ),
        'menu_name'                  => __( 'وضعیت‌های آگهی', 'zaminyab' ),
        'all_items'                  => __( 'همه وضعیت‌ها', 'zaminyab' ),
        'parent_item'                => __( 'وضعیت والد', 'zaminyab' ),
        'parent_item_colon'          => __( 'وضعیت والد:', 'zaminyab' ),
        'new_item_name'              => __( 'نام وضعیت جدید', 'zaminyab' ),
        'add_new_item'               => __( 'افزودن وضعیت جدید', 'zaminyab' ),
        'edit_item'                  => __( 'ویرایش وضعیت', 'zaminyab' ),
        'update_item'                => __( 'بروزرسانی وضعیت', 'zaminyab' ),
        'view_item'                  => __( 'مشاهده وضعیت', 'zaminyab' ),
        'separate_items_with_commas' => __( 'جداسازی با کاما', 'zaminyab' ),
        'add_or_remove_items'        => __( 'افزودن یا حذف وضعیت', 'zaminyab' ),
        'choose_from_most_used'      => __( 'انتخاب از پر استفاده‌ترین‌ها', 'zaminyab' ),
        'popular_items'              => __( 'وضعیت‌های پر استفاده', 'zaminyab' ),
        'search_items'               => __( 'جستجوی وضعیت', 'zaminyab' ),
        'not_found'                  => __( 'پیدا نشد', 'zaminyab' ),
        'no_terms'                   => __( 'بدون وضعیت', 'zaminyab' ),
        'items_list'                 => __( 'لیست وضعیت‌های آگهی', 'zaminyab' ),
        'items_list_navigation'      => __( 'ناوبری لیست وضعیت‌های آگهی', 'zaminyab' ),
    );
    $args_status = array(
        'labels'                     => $labels_status,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'land_status', array( 'land_listing' ), $args_status );

    // 4. Land Document Type (نوع سند)
    $labels_doc_type = array(
        'name'                       => _x( 'نوع سند', 'Taxonomy General Name', 'zaminyab' ),
        'singular_name'              => _x( 'نوع سند', 'Taxonomy Singular Name', 'zaminyab' ),
        'menu_name'                  => __( 'انواع سند', 'zaminyab' ),
        'all_items'                  => __( 'همه انواع سند', 'zaminyab' ),
        'parent_item'                => __( 'نوع سند والد', 'zaminyab' ),
        'parent_item_colon'          => __( 'نوع سند والد:', 'zaminyab' ),
        'new_item_name'              => __( 'نام نوع سند جدید', 'zaminyab' ),
        'add_new_item'               => __( 'افزودن نوع سند جدید', 'zaminyab' ),
        'edit_item'                  => __( 'ویرایش نوع سند', 'zaminyab' ),
        'update_item'                => __( 'بروزرسانی نوع سند', 'zaminyab' ),
        'view_item'                  => __( 'مشاهده نوع سند', 'zaminyab' ),
        'separate_items_with_commas' => __( 'جداسازی با کاما', 'zaminyab' ),
        'add_or_remove_items'        => __( 'افزودن یا حذف نوع سند', 'zaminyab' ),
        'choose_from_most_used'      => __( 'انتخاب از پر استفاده‌ترین‌ها', 'zaminyab' ),
        'popular_items'              => __( 'انواع سند پر استفاده', 'zaminyab' ),
        'search_items'               => __( 'جستجوی نوع سند', 'zaminyab' ),
        'not_found'                  => __( 'پیدا نشد', 'zaminyab' ),
        'no_terms'                   => __( 'بدون نوع سند', 'zaminyab' ),
        'items_list'                 => __( 'لیست انواع سند', 'zaminyab' ),
        'items_list_navigation'      => __( 'ناوبری لیست انواع سند', 'zaminyab' ),
    );
    $args_doc_type = array(
        'labels'                     => $labels_doc_type,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'land_document_type', array( 'land_listing' ), $args_doc_type );

    // 5. Land Usage (کاربری زمین)
    $labels_usage = array(
        'name'                       => _x( 'کاربری زمین', 'Taxonomy General Name', 'zaminyab' ),
        'singular_name'              => _x( 'کاربری زمین', 'Taxonomy Singular Name', 'zaminyab' ),
        'menu_name'                  => __( 'کاربری‌های زمین', 'zaminyab' ),
        'all_items'                  => __( 'همه کاربری‌ها', 'zaminyab' ),
        'parent_item'                => __( 'کاربری والد', 'zaminyab' ),
        'parent_item_colon'          => __( 'کاربری والد:', 'zaminyab' ),
        'new_item_name'              => __( 'نام کاربری جدید', 'zaminyab' ),
        'add_new_item'               => __( 'افزودن کاربری جدید', 'zaminyab' ),
        'edit_item'                  => __( 'ویرایش کاربری', 'zaminyab' ),
        'update_item'                => __( 'بروزرسانی کاربری', 'zaminyab' ),
        'view_item'                  => __( 'مشاهده کاربری', 'zaminyab' ),
        'separate_items_with_commas' => __( 'جداسازی با کاما', 'zaminyab' ),
        'add_or_remove_items'        => __( 'افزودن یا حذف کاربری', 'zaminyab' ),
        'choose_from_most_used'      => __( 'انتخاب از پر استفاده‌ترین‌ها', 'zaminyab' ),
        'popular_items'              => __( 'کاربری‌های پر استفاده', 'zaminyab' ),
        'search_items'               => __( 'جستجوی کاربری', 'zaminyab' ),
        'not_found'                  => __( 'پیدا نشد', 'zaminyab' ),
        'no_terms'                   => __( 'بدون کاربری', 'zaminyab' ),
        'items_list'                 => __( 'لیست کاربری‌های زمین', 'zaminyab' ),
        'items_list_navigation'      => __( 'ناوبری لیست کاربری‌های زمین', 'zaminyab' ),
    );
    $args_usage = array(
        'labels'                     => $labels_usage,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'land_usage', array( 'land_listing' ), $args_usage );
}
add_action( 'init', 'zaminyab_register_taxonomies', 0 );

/**
 * Add default terms for taxonomies on theme activation.
 */
function zaminyab_add_default_taxonomy_terms() {
    $default_terms = array(
        'land_type' => array(
            'زمین مسکونی',
            'زمین کشاورزی',
            'زمین صنعتی',
            'زمین تجاری',
            'باغ و باغچه',
            'زمین ویلایی',
            'زمین روستایی',
            'زمین ساحلی',
            'زمین شهرکی',
            'زمین سرمایه‌گذاری'
        ),
        'land_status' => array(
            'فروش',
            'اجاره',
            'رهن و اجاره',
            'فروشی',
            'معاوضه',
            'فوری',
            'دارای تخفیف',
            'ویژه'
        ),
        'land_document_type' => array(
            'سند تک برگ',
            'سند شش دانگ',
            'قولنامه‌ای',
            'مشاع',
            'اوقافی',
            'در حال تفکیک',
            'فاقد سند'
        ),
        'land_usage' => array(
            'مسکونی',
            'کشاورزی',
            'صنعتی',
            'تجاری',
            'باغی',
            'سرمایه‌گذاری'
        )
    );

    foreach ( $default_terms as $tax => $terms ) {
        foreach ( $terms as $term ) {
            if ( ! term_exists( $term, $tax ) ) {
                wp_insert_term( $term, $tax );
            }
        }
    }

    // Seed hierarchical locations (Provinces & Cities)
    $locations_seeding = array(
        'تهران' => array( 'دماوند', 'لواسان', 'رودهن', 'بومهن' ),
        'مازندران' => array( 'کلاردشت', 'رامسر', 'چالوس', 'نوشهر' ),
        'گیلان' => array( 'لاهیجان', 'رشت', 'بندرانزلی' ),
        'اصفهان' => array( 'کاشان', 'شاهین‌شهر' ),
        'فارس' => array( 'شیراز', 'مرودشت' )
    );

    foreach ( $locations_seeding as $province => $cities ) {
        $parent_term = term_exists( $province, 'land_location' );
        if ( ! $parent_term ) {
            $parent_term = wp_insert_term( $province, 'land_location' );
        }

        $parent_id = is_array( $parent_term ) ? $parent_term['term_id'] : intval( $parent_term );

        if ( $parent_id ) {
            foreach ( $cities as $city ) {
                if ( ! term_exists( $city, 'land_location' ) ) {
                    wp_insert_term( $city, 'land_location', array( 'parent' => $parent_id ) );
                }
            }
        }
    }
}
add_action( 'after_switch_theme', 'zaminyab_add_default_taxonomy_terms' );
add_action( 'init', 'zaminyab_add_default_taxonomy_terms', 99 );
