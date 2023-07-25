function addEventListenersToDialog(dialog, closeButton) {
	function closeDialog() {
		dialog.close();
		document.body.classList.remove('modal-open');
	}

	closeButton.addEventListener('click', closeDialog);

	window.addEventListener('keydown', function(event) {
		if (event.key === 'Escape' && dialog.style.display !== 'none') {
			closeDialog();
		}
	});
}

function checkDateAndShowDialog(dialog) {
	const today = new Date().toDateString();
	const lastShownDate = localStorage.getItem('modalLastShownDate');

	if (lastShownDate === null || lastShownDate !== today) {
		localStorage.setItem('modalLastShownDate', today);
		dialog.showModal();
		document.body.classList.add('modal-open');
	}
}

function manageModalDialog() {
	const dialog = document.getElementById('modal-dialog');
	const closeButton = document.getElementById('close-btn');

	if (dialog && closeButton) {
		addEventListenersToDialog(dialog, closeButton);
		checkDateAndShowDialog(dialog);
	}
}

document.addEventListener('DOMContentLoaded', manageModalDialog);
