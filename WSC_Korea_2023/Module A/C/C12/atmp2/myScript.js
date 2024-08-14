window.addEventListener('DOMContentLoaded', () => {
	const aLink = document.querySelectorAll('a')[0];
	const bLink = document.querySelectorAll('a')[1];
	const cLink = document.querySelectorAll('a')[2];

	const parser = new DOMParser();

	aLink.addEventListener('click', e => {
		e.preventDefault();
		document.title = 'A.html';
		history.pushState({ path: 'a.html' }, '', 'a.html');

		fetch(
			'http://127.0.0.1:5500/WSC_Korea_2023/Module%20A/C/C12/atmp2/a.html'
		)
			.then(response => response.text())
			.then(data => {
				const content = parser.parseFromString(data, 'text/html');
				const originalMain = document.querySelector('main');
				const main = content.querySelector('main');

				originalMain.innerHTML = main.innerHTML;
			});
	});

	bLink.addEventListener('click', e => {
		e.preventDefault();
		document.title = 'B.html';
		history.pushState({ path: 'b.html' }, '', 'b.html');

		fetch(
			'http://127.0.0.1:5500/WSC_Korea_2023/Module%20A/C/C12/atmp2/b.html'
		)
			.then(response => response.text())
			.then(data => {
				const content = parser.parseFromString(data, 'text/html');
				const originalMain = document.querySelector('main');
				const main = content.querySelector('main');

				originalMain.innerHTML = main.innerHTML;
			});
	});

	cLink.addEventListener('click', e => {
		e.preventDefault();
		document.title = 'C.html';
		history.pushState({ path: 'c.html' }, '', 'c.html');

		fetch(
			'http://127.0.0.1:5500/WSC_Korea_2023/Module%20A/C/C12/atmp2/c.html'
		)
			.then(response => response.text())
			.then(data => {
				const content = parser.parseFromString(data, 'text/html');
				const originalMain = document.querySelector('main');
				const main = content.querySelector('main');

				originalMain.innerHTML = main.innerHTML;
			});
	});
});
