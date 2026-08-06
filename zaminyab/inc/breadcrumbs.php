<?php
/**
 * ZaminYab Persian Breadcrumbs
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Display RTL Persian breadcrumbs for land listings.
 */
function zaminyab_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }

    echo '<div class="breadcrumbs container" aria-label="breadcrumb">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'خانه', 'zaminyab' ) . '</a>';
    echo ' &gt; ';

    if ( is_singular( 'land_listing' ) ) {
        $post_type = get_post_type_object( 'land_listing' );
        if ( $post_type ) {
            echo '<a href="' . esc_url( get_post_type_archive_link( 'land_listing' ) ) . '">آگهی‌های فروش زمین</a>';
            echo ' &gt; ';
        }

        // Output land_type if available
        $terms = get_the_terms( get_the_ID(), 'land_type' );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $term = array_shift( $terms );
            echo '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
            echo ' &gt; ';
        }

        echo '<span class="current">' . esc_html( get_the_title() ) . '</span>';
    } elseif ( is_post_type_archive( 'land_listing' ) ) {
        echo '<span class="current">آرشیو فروش زمین</span>';
    } elseif ( is_tax() ) {
        $term = get_queried_object();
        echo '<span class="current">' . esc_html( $term->name ) . '</span>';
    } elseif ( is_search() ) {
        echo '<span class="current">نتایج جستجو</span>';
    } elseif ( is_page() ) {
        echo '<span class="current">' . esc_html( get_the_title() ) . '</span>';
    }

    echo '</div>';
}
