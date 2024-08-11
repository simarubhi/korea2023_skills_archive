window.addEventListener('DOMContentLoaded', () => {
	const canvas = document.getElementById('canvas');
	const ctx = canvas.getContext('2d');
	let canvasHeight = 540;
	let canvasWidth = 1000;
	canvas.width = canvasWidth;
	canvas.height = canvasHeight;

	let imageElement = null;
	let isLoaded = false;
	let magnify = false;

	const magnifyBtn = document.getElementById('magnify-btn');
	magnifyBtn.addEventListener('click', () => {
		if (magnify) {
			magnifyBtn.innerText = 'Magnify';
			magnify = false;
		} else {
			magnifyBtn.innerText = 'Unmagnify';
			magnify = true;
		}
	});

	const mouse = {
		x: null,
		y: null,
	};

	window.addEventListener('mousemove', event => {
		mouse.x = event.clientX;
		mouse.y = event.clientY;
	});

	const imgSelect = document.getElementById('imgselect');

	const images = [
		'image1.jpg',
		'image2.jpg',
		'image3.jpg',
		'image4.jpg',
		'image5.png',
	];

	const loadImage = src => {
		imageElement = new Image();
		imageElement.src = src;

		imageElement.onload = () => {
			isLoaded = true;
			animate();
		};
	};

	images.forEach((image, index) => {
		const option = document.createElement('option');
		option.innerText = image;
		option.setAttribute('value', `../imgs/${image}`);
		imgSelect.appendChild(option);

		if (index === 0) {
			loadImage(`../imgs/${image}`);
		}
	});

	imgSelect.addEventListener('change', e => {
		loadImage(e.target.value);
	});

	const animate = () => {
		if (!isLoaded) return;
		ctx.clearRect(0, 0, canvasWidth, canvasHeight);

		ctx.drawImage(imageElement, 0, 0, canvasWidth, canvasHeight);

		if (magnify) {
		}

		requestAnimationFrame(animate);
	};
});
