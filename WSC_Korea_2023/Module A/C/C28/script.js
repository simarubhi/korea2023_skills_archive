window.addEventListener('DOMContentLoaded', () => {
	const pals = [
		'000',
		'088',
		'00d',
		'438',
		'800',
		'888',
		'8cf',
		'aa2',
		'b82',
		'c18',
		'fbb',
		'e00',
		'fd0',
		'feb',
		'ddd',
		'fff',
	];

	let activeColour = 0;

	const setActiveColour = index => {
		const colourElements = document.querySelectorAll('.colour');
		for (let i = 0; i < pals.length; i++) {
			colourElements[i].classList.remove('active');
		}

		colourElements[index].classList.add('active');
	};

	const grid = document.querySelector('.grid');

	const colours = document.querySelector('.colours');

	for (let i = 0; i < 16 * 16; i++) {
		const pixel = document.createElement('div');
		pixel.classList.add('pixel');
		pixel.addEventListener('click', () => {
			pixel.style.backgroundColor = '#' + pals[activeColour];
		});
		grid.appendChild(pixel);
	}

	for (let i = 0; i < pals.length; i++) {
		const colour = document.createElement('div');
		colour.classList.add('colour');
		colour.style.backgroundColor = '#' + pals[i];
		colour.addEventListener('click', () => {
			activeColour = i;
			setActiveColour(i);
		});
		colours.appendChild(colour);
	}

	setActiveColour(activeColour);
});
