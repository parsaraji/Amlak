<?php
/**
 * Custom Pagination for land directory searches
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$query = isset( $args['query'] ) ? $args['query'] : $GLOBALS['wp_query'];

$big = 999999999; // need an unlikely integer

$links = paginate_links( array(
    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format'    => '?paged=%#%',
    'current'   => max( 1, get_query_var( 'paged' ) ),
    'total'     => $query->max_num_pages,
    'prev_text' => zaminyab_get_svg_icon( 'arrow-right' ) . ' قبلی',
    'next_text' => 'بعدی ' . zaminyab_get_svg_icon( 'arrow-left' ),
    'type'      => 'array',
) );

if ( is_array( $links ) ) {
    echo '<nav class="zaminyab-pagination" aria-label="ناوبری صفحات" style="display:flex; justify-content:center; gap:8px; margin-top:40px;">';
    foreach ( $links as $link ) {
        // Beautify classes
        if ( strpos( $link, 'current' ) !== false ) {
            echo '<span class="page-link active" style="padding:8px 16px; background:var(--primary-color); color:#fff; border-radius:6px; font-weight:bold;">' . zaminyab_to_persian_digits(strip_tags($link)) . '</span>';
        } else {
            echo str_replace( 'page-numbers', 'page-link', $link );
        }
    }
    echo '</nav>';
}
