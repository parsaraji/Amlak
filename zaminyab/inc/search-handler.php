<?php
/**
 * ZaminYab Search Handler & WP_Query builder
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Handle listing searches and return custom query.
 */
function zaminyab_get_search_query() {
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $posts_per_page = intval( zaminyab_get_option( 'listings_per_page', '12' ) );

    $args = array(
        'post_type'      => 'land_listing',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
        'meta_query'     => array( 'relation' => 'AND' ),
        'tax_query'      => array( 'relation' => 'AND' ),
    );

    // 1. Keyword search
    if ( ! empty( $_GET['s_keyword'] ) ) {
        $args['s'] = sanitize_text_field( $_GET['s_keyword'] );
    }

    // 2. Location (land_location)
    if ( ! empty( $_GET['s_location'] ) ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'land_location',
            'field'    => 'term_id',
            'terms'    => intval( $_GET['s_location'] ),
        );
    }

    // 3. Land Type (land_type)
    if ( ! empty( $_GET['s_type'] ) ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'land_type',
            'field'    => 'term_id',
            'terms'    => intval( $_GET['s_type'] ),
        );
    }

    // 4. Land Usage (land_usage)
    if ( ! empty( $_GET['s_usage'] ) ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'land_usage',
            'field'    => 'term_id',
            'terms'    => intval( $_GET['s_usage'] ),
        );
    }

    // 5. Document Type (land_document_type)
    if ( ! empty( $_GET['s_document'] ) ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'land_document_type',
            'field'    => 'term_id',
            'terms'    => intval( $_GET['s_document'] ),
        );
    }

    // 6. Status (land_status)
    if ( ! empty( $_GET['s_status'] ) ) {
        $args['tax_query'][] = array(
            'taxonomy' => 'land_status',
            'field'    => 'term_id',
            'terms'    => intval( $_GET['s_status'] ),
        );
    }

    // 7. Area Min/Max
    if ( ! empty( $_GET['area_min'] ) ) {
        $args['meta_query'][] = array(
            'key'     => '_area_size',
            'value'   => intval( $_GET['area_min'] ),
            'type'    => 'NUMERIC',
            'compare' => '>=',
        );
    }
    if ( ! empty( $_GET['area_max'] ) ) {
        $args['meta_query'][] = array(
            'key'     => '_area_size',
            'value'   => intval( $_GET['area_max'] ),
            'type'    => 'NUMERIC',
            'compare' => '<=',
        );
    }

    // 8. Price Min/Max
    if ( ! empty( $_GET['price_min'] ) ) {
        $args['meta_query'][] = array(
            'key'     => '_price_total',
            'value'   => floatval( $_GET['price_min'] ),
            'type'    => 'NUMERIC',
            'compare' => '>=',
        );
    }
    if ( ! empty( $_GET['price_max'] ) ) {
        $args['meta_query'][] = array(
            'key'     => '_price_total',
            'value'   => floatval( $_GET['price_max'] ),
            'type'    => 'NUMERIC',
            'compare' => '<=',
        );
    }

    // 9. Facilities (Water, Elec, Gas, Building Permit)
    if ( ! empty( $_GET['has_water'] ) ) {
        $args['meta_query'][] = array(
            'key'     => '_has_water',
            'value'   => '1',
            'compare' => '=',
        );
    }
    if ( ! empty( $_GET['has_electricity'] ) ) {
        $args['meta_query'][] = array(
            'key'     => '_has_electricity',
            'value'   => '1',
            'compare' => '=',
        );
    }
    if ( ! empty( $_GET['has_gas'] ) ) {
        $args['meta_query'][] = array(
            'key'     => '_has_gas',
            'value'   => '1',
            'compare' => '=',
        );
    }
    if ( ! empty( $_GET['has_building_permit'] ) ) {
        $args['meta_query'][] = array(
            'key'     => '_has_building_permit',
            'value'   => '1',
            'compare' => '=',
        );
    }

    // 10. Sorting
    $sort = isset( $_GET['sort'] ) ? sanitize_text_field( $_GET['sort'] ) : 'newest';
    switch ( $sort ) {
        case 'cheapest':
            $args['meta_key'] = '_price_total';
            $args['orderby']  = 'meta_value_num';
            $args['order']    = 'ASC';
            break;
        case 'expensive':
            $args['meta_key'] = '_price_total';
            $args['orderby']  = 'meta_value_num';
            $args['order']    = 'DESC';
            break;
        case 'largest':
            $args['meta_key'] = '_area_size';
            $args['orderby']  = 'meta_value_num';
            $args['order']    = 'DESC';
            break;
        case 'smallest':
            $args['meta_key'] = '_area_size';
            $args['orderby']  = 'meta_value_num';
            $args['order']    = 'ASC';
            break;
        case 'newest':
        default:
            $args['orderby'] = 'date';
            $args['order']   = 'DESC';
            break;
    }

    return new WP_Query( $args );
}
