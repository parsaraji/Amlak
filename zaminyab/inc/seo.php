<?php
/**
 * ZaminYab Dynamic SEO Meta Tags & JSON-LD schema
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add Open Graph meta tags to document head.
 */
function zaminyab_add_seo_meta_tags() {
    if ( is_singular( 'land_listing' ) ) {
        global $post;
        $title = esc_attr( get_the_title( $post ) );
        $url = esc_url( get_permalink( $post ) );
        $desc = esc_attr( wp_strip_all_tags( get_the_excerpt( $post ) ) );
        $image = '';

        if ( has_post_thumbnail( $post->ID ) ) {
            $image = esc_url( get_the_post_thumbnail_url( $post->ID, 'large' ) );
        }

        echo "\n<!-- ZaminYab SEO Schema & OpenGraph -->\n";
        echo "<meta property=\"og:title\" content=\"{$title}\" />\n";
        echo "<meta property=\"og:type\" content=\"website\" />\n";
        echo "<meta property=\"og:url\" content=\"{$url}\" />\n";
        echo "<meta property=\"og:description\" content=\"{$desc}\" />\n";
        if ( ! empty( $image ) ) {
            echo "<meta property=\"og:image\" content=\"{$image}\" />\n";
        }

        // Real Estate Schema
        $price = get_post_meta( $post->ID, '_price_total', true );
        $area = get_post_meta( $post->ID, '_area_size', true );
        $approx_address = get_post_meta( $post->ID, '_approx_address', true );

        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'RealEstateListing',
            'name' => $title,
            'description' => $desc,
            'url' => $url,
            'datePosted' => get_the_date( 'c', $post ),
        );

        if ( ! empty( $price ) || ! empty( $area ) ) {
            $schema['amount'] = array(
                '@type' => 'QuantitativeValue',
                'value' => $area,
                'unitText' => 'SQM',
            );
        }

        echo "<script type=\"application/ld+json\">\n";
        echo json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
        echo "</script>\n";
    }
}
add_action( 'wp_head', 'zaminyab_add_seo_meta_tags' );
