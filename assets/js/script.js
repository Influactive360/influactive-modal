jQuery(document).ready(function ($) {
    var dialog = document.getElementById('modal-dialog');
    var closeButton = document.getElementById('close-btn');
    // Close dialog
    closeButton.addEventListener('click', function () {
        dialog.close();
        document.body.classList.remove('modal-open');
    });
    // Close dialog on ESC
    window.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && dialog.open) {
            dialog.close();
            document.body.classList.remove('modal-open');
        }
    });
    // Reappear only the next day
    var now = new Date();
    var today = now.toDateString(); // convert the date to a string
    var lastShownDate = localStorage.getItem('modalLastShownDate');
    if (lastShownDate === null || lastShownDate !== today) {
        localStorage.setItem('modalLastShownDate', today);
        dialog.showModal();
        document.body.classList.add('modal-open');
    }
});
