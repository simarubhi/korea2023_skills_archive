window.addEventListener('load', () => {
	const overlay = document.querySelector('.overlay');

	overlay.addEventListener('click', () => {
		alert('Use the keyboard to start');
	});

	const keys = document.querySelectorAll('.k');

	let piano = Synth.createInstrument('piano');

	const playPiano = note => {
		piano.play(note, 4, 2);
	};

	const addAni = index => {
		keys[index].classList.add('active');
	};

	const removeAni = index => {
		keys[index].classList.remove('active');
	};

	let pressed;

	window.addEventListener('keydown', e => {
		if (pressed == true) return;
		pressed = true;

		let keyPressed = e.key;
		if (keyPressed == 'A') {
			addAni(0);
			playPiano('C');
		} else if (keyPressed == 'S') {
			addAni(1);
			playPiano('D');
		} else if (keyPressed == 'D') {
			addAni(2);
			playPiano('E');
		} else if (keyPressed == 'F') {
			addAni(3);
			playPiano('F');
		} else if (keyPressed == 'J') {
			addAni(4);
			playPiano('G');
		} else if (keyPressed == 'K') {
			addAni(5);
			playPiano('A');
		} else if (keyPressed == 'L') {
			addAni(6);
			playPiano('B');
		} else {
			pressed = false;
		}
	});

	window.addEventListener('keyup', e => {
		if (pressed == false) return;
		pressed = false;

		let keyPressed = e.key;
		if (keyPressed == 'A') {
			removeAni(0);
		} else if (keyPressed == 'S') {
			removeAni(1);
			playPiano('D');
		} else if (keyPressed == 'D') {
			removeAni(2);
		} else if (keyPressed == 'F') {
			removeAni(3);
		} else if (keyPressed == 'J') {
			removeAni(4);
		} else if (keyPressed == 'K') {
			removeAni(5);
		} else if (keyPressed == 'L') {
			removeAni(6);
		}
	});
});
