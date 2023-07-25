document.addEventListener('DOMContentLoaded', function() {
	const dialog = document.getElementById('modal-dialog');
	const closeButton = document.getElementById('close-btn');

	if (dialog && closeButton) {

		// Close dialog
		closeButton.addEventListener('click', function() {
			closeDialog();
		});

		// Close dialog on ESC
		window.addEventListener('keydown', function(event) {
			if (event.key === 'Escape' && dialog && dialog.open) {
				closeDialog();
			}
		});
	}

	// Reappear only the next day
	const now = new Date();
	const today = now.toDateString(); // convert the date to a string
	const lastShownDate = localStorage.getItem('modalLastShownDate');

	if (lastShownDate === null || lastShownDate !== today) {
		localStorage.setItem('modalLastShownDate', today);
		dialog.showModal();
		document.body.classList.add('modal-open');
	}

	function closeDialog() {
		dialog.close();
		document.body.classList.remove('modal-open');
	}
})
