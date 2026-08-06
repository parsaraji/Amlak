/**
 * Maps rendering & interactions using Leaflet / OpenStreetMap or Neshan
 */
jQuery(document).ready(function($) {
    var $mapEl = $('#zaminyab-leaflet-map');
    if (!$mapEl.length || typeof L === 'undefined') {
        return;
    }

    var lat = parseFloat($mapEl.data('lat')) || 35.6892;
    var lng = parseFloat($mapEl.data('lng')) || 51.3890;
    var zoom = parseInt($mapEl.data('zoom')) || 12;
    var approx = parseInt($mapEl.data('approx')) || 0;

    // Initialize Leaflet Map
    var map = L.map('zaminyab-leaflet-map').setView([lat, lng], zoom);

    // Standard OSM tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // Add marker
    var marker;
    if (approx === 1) {
        // Approximate location is drawn as a circle instead of direct marker
        L.circle([lat, lng], {
            color: '#0d9488',
            fillColor: '#ccfbf1',
            fillOpacity: 0.5,
            radius: 800
        }).addTo(map);
    } else {
        // Red pin SVG icon
        var customIcon = L.divIcon({
            html: '<svg style="width:32px;height:32px;color:#ef4444;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>',
            className: 'custom-map-marker',
            iconSize: [32, 32],
            iconAnchor: [16, 32]
        });

        marker = L.marker([lat, lng], { icon: customIcon, draggable: true }).addTo(map);

        // Update hidden coordinates inputs on drag end (helpful for submission page)
        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            $('#latitude').val(position.lat.toFixed(6));
            $('#longitude').val(position.lng.toFixed(6));
        });
    }

    // Move marker on map click (in submission screen)
    if (approx !== 1 && $('#submitListingForm').length) {
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            $('#latitude').val(e.latlng.lat.toFixed(6));
            $('#longitude').val(e.latlng.lng.toFixed(6));
        });
    }
});
