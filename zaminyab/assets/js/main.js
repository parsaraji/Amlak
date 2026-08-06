/**
 * ZaminYab main theme javascript behaviors
 */

function toggleMobileSidebar() {
    var sidebar = document.getElementById('mobileSidebar');
    var overlay = document.getElementById('mobileOverlay');
    if (sidebar && overlay) {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('open');
        var expanded = sidebar.classList.contains('open');
        document.querySelector('.mobile-hamburger').setAttribute('aria-expanded', expanded);
    }
}

function toggleMobileFilters() {
    var sidebar = document.getElementById('mobileFilters');
    var overlay = document.getElementById('mobileFiltersOverlay');
    if (sidebar && overlay) {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('open');
    }
}

/**
 * Handle AJAX favorite toggle interaction
 */
function toggleFavorite(postId, element) {
    if (typeof jQuery === 'undefined' || typeof zaminyab_ajax_obj === 'undefined') {
        return;
    }

    var $ = jQuery;
    var $btn = $(element);

    $.ajax({
        url: zaminyab_ajax_obj.ajax_url,
        type: 'POST',
        data: {
            action: 'zaminyab_toggle_favorite',
            post_id: postId,
            nonce: zaminyab_ajax_obj.nonce
        },
        beforeSend: function() {
            $btn.css('opacity', '0.5');
        },
        success: function(response) {
            $btn.css('opacity', '1');
            if (response.success) {
                if (response.data.status === 'added') {
                    // Switch to filled heart
                    $btn.html('<svg class="zaminyab-icon" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>');
                } else if (response.data.status === 'removed' || response.data.status === 'guest_handled') {
                    // Switch to outline heart
                    $btn.html('<svg class="zaminyab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>');
                }
                alert(response.data.message);
            } else {
                alert(response.data);
            }
        },
        error: function() {
            $btn.css('opacity', '1');
            alert('خطایی در برقراری ارتباط رخ داده است.');
        }
    });
}
