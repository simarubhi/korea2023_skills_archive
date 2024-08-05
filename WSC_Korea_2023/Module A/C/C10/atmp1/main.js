window.addEventListener('DOMContentLoaded', () => {
	const wrap = document.querySelector('.wrap');
	let warpWidth = wrap.getBoundingClientRect().width;
	const txt = document.querySelector('.txt');
	let txtWidth = txt.getBoundingClientRect().width;
	const originalContent = txt.innerText.split(' ');
	const startContent = originalContent.slice(0, originalContent.length / 2);
	const endContent = originalContent.slice(originalContent.length / 2);
	let startLimit = startContent.length - 1;
	let endLimit = 0;
	let takeStart = true;

	const getWrapWidth = () => {
		warpWidth = wrap.getBoundingClientRect().width;
	};

	const getTxtWidth = () => {
		txtWidth = Math.ceil(txt.getBoundingClientRect().width);
	};

	const resize = () => {
		getWrapWidth();
		getTxtWidth();
		console.log(startLimit, endLimit);
		if (txtWidth > warpWidth) {
			console.log('lhit');
			while (txtWidth > warpWidth) {
				txt.innerText = '';
				if (takeStart) {
					takeStart = false;
					startLimit--;
				} else {
					takeStart = true;
					endLimit++;
				}

				for (let i = 0; i < startLimit; i++) {
					if (i === 0) {
						txt.innerText += startContent[i];
					} else if (i == startLimit - 1) {
						txt.innerText += ' ' + startContent[i] + ' ';
					} else {
						txt.innerText += ' ' + startContent[i];
					}
				}

				txt.innerText += '...';

				for (let i = endLimit; i < endContent.length; i++) {
					txt.innerText += ' ' + endContent[i];
				}
				getWrapWidth();
				getTxtWidth();
			}
		} else {
			while (txtWidth < warpWidth) {
				console.log('rasdfdasfhit');
				if (startLimit === startContent.length - 1 && takeStart) break;
				if (endLimit === 0 && !takeStart) break;

				txt.innerText = '';
				console.log('rhit');
				if (!takeStart) {
					takeStart = true;
					endLimit--;
				} else {
					takeStart = false;
					startLimit++;
				}

				for (let i = 0; i < startLimit; i++) {
					if (i === 0) {
						txt.innerText += startContent[i];
					} else if (i == startLimit - 1) {
						txt.innerText += ' ' + startContent[i] + ' ';
					} else {
						txt.innerText += ' ' + startContent[i];
					}
				}

				txt.innerText += '...';

				for (let i = endLimit; i < endContent.length; i++) {
					txt.innerText += ' ' + endContent[i];
				}
				getWrapWidth();
				getTxtWidth();

				if (txtWidth > warpWidth) {
					console.log('adjsuted');
					txt.innerText = '';
					if (takeStart) {
						takeStart = false;
						startLimit--;
					} else {
						takeStart = true;
						endLimit++;
					}

					for (let i = 0; i < startLimit; i++) {
						if (i === 0) {
							txt.innerText += startContent[i];
						} else if (i == startLimit - 1) {
							txt.innerText += ' ' + startContent[i] + ' ';
						} else {
							txt.innerText += ' ' + startContent[i];
						}
					}

					txt.innerText += '...';

					for (let i = endLimit; i < endContent.length; i++) {
						txt.innerText += ' ' + endContent[i];
					}

					break;
				}
			}
		}
	};

	const observer = new ResizeObserver(resize);
	observer.observe(wrap);
});
