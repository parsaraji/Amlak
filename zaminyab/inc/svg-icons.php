<?php
/**
 * ZaminYab Custom SVG Icons Function
 *
 * @package ZaminYab
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Returns inline SVG icon.
 *
 * @param string $name  Icon name.
 * @param string $class Additional CSS classes.
 * @return string Inline SVG markups.
 */
function zaminyab_get_svg_icon( $name, $class = '' ) {
    $class_attr = $class ? ' ' . esc_attr( $class ) : '';
    $svg = '';

    switch ( $name ) {
        case 'home':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>';
            break;

        case 'search':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="11" cy="11" r="8"/>
                <path d="m21 21-4.3-4.3"/>
            </svg>';
            break;

        case 'map':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/>
                <line x1="9" x2="9" y1="3" y2="18"/>
                <line x1="15" x2="15" y1="6" y2="21"/>
            </svg>';
            break;

        case 'location':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                <circle cx="12" cy="10" r="3"/>
            </svg>';
            break;

        case 'phone':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>';
            break;

        case 'whatsapp':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
            </svg>';
            break;

        case 'user':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>';
            break;

        case 'plus':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="12" x2="12" y1="5" y2="19"/>
                <line x1="5" x2="19" y1="12" y2="12"/>
            </svg>';
            break;

        case 'heart':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
            </svg>';
            break;

        case 'heart-filled':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
            </svg>';
            break;

        case 'share':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="18" cy="5" r="3"/>
                <circle cx="6" cy="12" r="3"/>
                <circle cx="18" cy="19" r="3"/>
                <line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/>
                <line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/>
            </svg>';
            break;

        case 'filter':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
            </svg>';
            break;

        case 'close':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="18" x2="6" y1="6" y2="18"/>
                <line x1="6" x2="18" y1="6" y2="18"/>
            </svg>';
            break;

        case 'menu':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="4" x2="20" y1="12" y2="12"/>
                <line x1="4" x2="20" y1="6" y2="6"/>
                <line x1="4" x2="20" y1="18" y2="18"/>
            </svg>';
            break;

        case 'arrow-left':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" x2="5" y1="12" y2="12"/>
                <polyline points="12 19 5 12 12 5"/>
            </svg>';
            break;

        case 'arrow-right':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="5" x2="19" y1="12" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
            </svg>';
            break;

        case 'land':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M2 20h20"/>
                <path d="M5 17c1-2 3-3 7-3s6 1 7 3"/>
                <path d="M12 4v10"/>
                <path d="m9 7 3-3 3 3"/>
            </svg>';
            break;

        case 'farm':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M3 20h18"/>
                <path d="M5 20v-8a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8"/>
                <path d="M9 10V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5"/>
            </svg>';
            break;

        case 'industry':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M2 20h20"/>
                <path d="M3 20V10l4 3V10l4 3V10l4 3V7l5 3v10"/>
            </svg>';
            break;

        case 'document':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" x2="8" y1="13" y2="13"/>
                <line x1="16" x2="8" y1="17" y2="17"/>
                <polyline points="10 9 9 9 8 9"/>
            </svg>';
            break;

        case 'price':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect width="20" height="12" x="2" y="6" rx="2"/>
                <circle cx="12" cy="12" r="2"/>
                <path d="M6 12h.01M18 12h.01"/>
            </svg>';
            break;

        case 'area':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect width="18" height="18" x="3" y="3" rx="2"/>
                <path d="M9 3v18M15 3v18M3 9h18M3 15h18"/>
            </svg>';
            break;

        case 'road':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect width="16" height="20" x="4" y="2" rx="2"/>
                <line x1="12" x2="12" y1="6" y2="8"/>
                <line x1="12" x2="12" y1="12" y2="14"/>
                <line x1="12" x2="12" y1="18" y2="20"/>
            </svg>';
            break;

        case 'water':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 22a7 7 0 0 0 7-7c0-4.3-7-11-7-11S5 10.7 5 15a7 7 0 0 0 7 7z"/>
            </svg>';
            break;

        case 'electricity':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
            </svg>';
            break;

        case 'gas':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 2c0 4.3 4 5.7 4 8.5a4 4 0 0 1-8 0c0-2.8 4-4.2 4-8.5z"/>
                <path d="M12 15v5M10 20h4"/>
            </svg>';
            break;

        case 'building-permit':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="16 16 20 12 16 8"/>
                <line x1="12" x2="20" y1="12" y2="12"/>
                <rect width="8" height="12" x="4" y="6" rx="1"/>
            </svg>';
            break;

        case 'warning':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                <line x1="12" x2="12" y1="9" y2="13"/>
                <line x1="12" x2="12.01" y1="17" y2="17"/>
            </svg>';
            break;

        case 'check':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="20 6 9 17 4 12"/>
            </svg>';
            break;

        case 'upload':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                <polyline points="17 8 12 3 7 8"/>
                <line x1="12" x2="12" y1="3" y2="15"/>
            </svg>';
            break;

        case 'camera':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                <circle cx="12" cy="13" r="4"/>
            </svg>';
            break;

        case 'dashboard':
            $svg = '<svg class="zaminyab-icon' . $class_attr . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect width="7" height="9" x="3" y="3" rx="1"/>
                <rect width="7" height="5" x="14" y="3" rx="1"/>
                <rect width="7" height="9" x="14" y="12" rx="1"/>
                <rect width="7" height="5" x="3" y="16" rx="1"/>
            </svg>';
            break;
    }

    return $svg;
}
