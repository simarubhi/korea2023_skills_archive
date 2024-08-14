window.addEventListener('DOMContentLoaded', () => {
	const btn = document.querySelector('button');

	btn.addEventListener('click', e => {
		let x = e.clientX - btn.getBoundingClientRect().left;
		let y = e.clientY - btn.getBoundingClientRect().top;

		const circle = document.createElement('span');
		circle.classList.add('circle');

		circle.style.left = x + 'px';
		circle.style.top = y + 'px';

		btn.appendChild(circle);

		setTimeout(() => {
			circle.remove();
		}, 300);
	});
});
