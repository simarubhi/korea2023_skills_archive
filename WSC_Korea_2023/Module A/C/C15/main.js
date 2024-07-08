const h1 = document.querySelector('h1');
const body = document.querySelector('body');
let light = true;

h1.addEventListener('click', () => {
	if (light) {
		light = false;
		h1.style.color = '#fff';
		h1.innerText = 'Dark Mode Test';
		body.style.backgroundColor = '#000';
	} else {
		light = true;
		h1.style.color = '#000';
		h1.innerText = 'Light Mode Test';
		body.style.backgroundColor = '#fff';
	}
});
