window.addEventListener('DOMContentLoaded', () => {
	const btns = document.querySelectorAll('.digicode-button:not(.status)');
	const status = document.querySelector('.status');

	const AudioContext = window.AudioContext || window.webkitAudioContext;

	const audioContext = new AudioContext();

	const beepElement = document.getElementById('beep');
	const beep = audioContext.createMediaElementSource(beepElement);
	beep.connect(audioContext.destination);

	const successElement = document.getElementById('success');
	const success = audioContext.createMediaElementSource(successElement);
	success.connect(audioContext.destination);

	let currentNumbers = null;
	let isPass = false;
	const expected = '6789';

	btns.forEach(btn => {
		btn.addEventListener('click', () => {
			if (isPass) return;
			audioContext.resume();
			if (currentNumbers == null) {
				currentNumbers = btn.innerText;
			} else if (currentNumbers.length < 4) {
				currentNumbers += btn.innerText;
			} else {
				let temp = currentNumbers.split('');
				temp.shift();
				temp.push(btn.innerText);
				currentNumbers = temp.join('');
			}

			if (currentNumbers == expected) {
				successElement.play();
				status.classList.add('on');
				isPass = true;
			} else {
				beepElement.play();
			}
		});
	});
});
