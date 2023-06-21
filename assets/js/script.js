jQuery(document).ready(function ($) {
    var dialog = document.getElementById('modal-dialog');
    var closeButton = document.getElementById('close-btn');
    // Show dialog
    dialog.showModal();
    // Close dialog
    closeButton.addEventListener('click', function () {
        dialog.close();
    });
    // Close dialog on ESC
    window.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && dialog.open) {
            dialog.close();
        }
    });
    // Reappear only after 30 days
    var now = new Date().getTime();
    var modalTimestamp = localStorage.getItem('modalTimestamp');
    if (modalTimestamp === null || (now - modalTimestamp) > (30 * 24 * 60 * 60 * 1000)) {
        localStorage.setItem('modalTimestamp', now);
        dialog.showModal();
    }
});
