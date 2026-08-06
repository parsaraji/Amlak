<?php
/**
 * ZaminYab Map Utilities
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Render standard Persian map block on single page or archive.
 */
function zaminyab_render_map( $post_id = 0 ) {
    $enabled = zaminyab_get_option( 'enable_maps', '1' );
    if ( $enabled !== '1' ) {
        return;
    }

    $lat = '';
    $lng = '';
    $zoom = '12';
    $approx = '0';

    if ( $post_id ) {
        $lat = get_post_meta( $post_id, '_latitude', true );
        $lng = get_post_meta( $post_id, '_longitude', true );
        $zoom = get_post_meta( $post_id, '_map_zoom', true );
        $approx = get_post_meta( $post_id, '_approx_mode', true );
    }

    if ( empty( $lat ) || empty( $lng ) ) {
        $lat = zaminyab_get_option( 'default_latitude', '35.6892' );
        $lng = zaminyab_get_option( 'default_longitude', '51.3890' );
    }

    ?>
    <div class="zaminyab-map-wrapper">
        <div id="zaminyab-leaflet-map" class="map-container"
             data-lat="<?php echo esc_attr( $lat ); ?>"
             data-lng="<?php echo esc_attr( $lng ); ?>"
             data-zoom="<?php echo esc_attr( $zoom ? $zoom : '12' ); ?>"
             data-approx="<?php echo esc_attr( $approx ); ?>">
        </div>
        <p class="description text-justify" style="font-size:12px; color: var(--text-muted); margin-top: 8px;">
            <?php if ( $approx === '1' ) : ?>
                * توجه: جهت حفظ حریم خصوصی، موقعیت نشان داده شده روی نقشه به صورت تقریبی می‌باشد.
            <?php else : ?>
                موقعیت دقیق زمین روی نقشه در بالا نمایش داده شده است.
            <?php endif; ?>
        </p>
    </div>
    <?php
}
