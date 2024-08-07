window.addEventListener('DOMContentLoaded', () => {
	const open = document.getElementById('open');
	const modal = document.querySelector('.modal');
	const close = document.getElementById('close');
	const overlay = document.querySelector('.overlay');
	let isOpen = false;

	open.addEventListener('click', () => {
		if (isOpen) return;
		isOpen = true;

		modal.style.display = 'block';
		overlay.style.display = 'block';
	});

	close.addEventListener('click', () => {
		if (!isOpen) return;
		isOpen = false;

		modal.style.display = 'none';
		overlay.style.display = 'none';
	});

	overlay.addEventListener('click', () => {
		if (!isOpen) return;
		isOpen = false;

		modal.style.display = 'none';
		overlay.style.display = 'none';
	});
});
