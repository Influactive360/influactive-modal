/**
 * @param {HTMLElement} dialog
 * @param {HTMLElement} closeButton
 */
function addEventListenersToDialog(dialog, closeButton) {

	closeButton.addEventListener('click', () => closeDialog(dialog));

	window.addEventListener('keydown', function(event) {
		if (event.key === 'Escape' && dialog.style.display !== 'none') {
			closeDialog(dialog);
		}
	});
}

/**
 * @param {HTMLElement} dialog
 */
function closeDialog(dialog) {
	dialog.close();
	document.body.classList.remove('modal-open');
}

/**
 * @param {HTMLElement} dialog
 */
function checkDateAndShowDialog(dialog) {
	if(!dialog || !dialog.showModal){
		// log error or throw an error
		return;
	}

	if(!localStorage){
		// log warning or notify user about reduced functionality due to absence of localStorage.
		return;
	}

	if(!document.body){
		// log error or throw an error
		return;
	}

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
