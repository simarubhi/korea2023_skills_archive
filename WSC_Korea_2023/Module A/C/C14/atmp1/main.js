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

	// This part chat gpt helped with
	const animate = () => {
		if (!isLoaded) return;
		ctx.clearRect(0, 0, canvasWidth, canvasHeight);
		ctx.drawImage(imageElement, 0, 0, canvasWidth, canvasHeight);

		// Get the color at the mouse position
		if (mouse.x !== null && mouse.y !== null) {
			const rect = canvas.getBoundingClientRect();
			const x = mouse.x - rect.left;
			const y = mouse.y - rect.top;

			if (x >= 0 && x < canvasWidth && y >= 0 && y < canvasHeight) {
				const pixel = ctx.getImageData(x, y, 1, 1).data;
				const color = `rgb(${pixel[0]}, ${pixel[1]}, ${pixel[2]})`;
				document.querySelector(
					'.color-output'
				).innerText = `Current colour: ${color}`;

				if (magnify) {
					// Draw magnifying glass
					const zoom = 10;
					const magnifierSize = 100;
					const magnifierRadius = magnifierSize / 2;
					const zoomedX = x - magnifierRadius / zoom;
					const zoomedY = y - magnifierRadius / zoom;

					ctx.strokeStyle = 'black';
					ctx.lineWidth = 1;
					ctx.beginPath();
					ctx.arc(
						x + 10 + magnifierRadius,
						y + 10 + magnifierRadius,
						magnifierRadius,
						0,
						Math.PI * 2
					);
					ctx.stroke();

					ctx.save();
					ctx.beginPath();
					ctx.arc(
						x + 10 + magnifierRadius,
						y + 10 + magnifierRadius,
						magnifierRadius,
						0,
						Math.PI * 2
					);
					ctx.clip();

					ctx.drawImage(
						canvas,
						zoomedX,
						zoomedY,
						magnifierSize / zoom,
						magnifierSize / zoom,
						x + 10,
						y + 10,
						magnifierSize,
						magnifierSize
					);

					// Draw grid lines
					ctx.strokeStyle = 'rgba(256, 256, 256, 0.5)';
					for (let i = 0; i < magnifierSize; i += zoom) {
						ctx.beginPath();
						ctx.moveTo(x + 10 + i, y + 10);
						ctx.lineTo(x + 10 + i, y + 10 + magnifierSize);
						ctx.moveTo(x + 10, y + 10 + i);
						ctx.lineTo(x + 10 + magnifierSize, y + 10 + i);
						ctx.stroke();
					}

					ctx.restore();
				}
			}
		}

		requestAnimationFrame(animate);
	};

	// const animate = () => {
	// 	if (!isLoaded) return;
	// 	ctx.clearRect(0, 0, canvasWidth, canvasHeight);

	// 	ctx.drawImage(imageElement, 0, 0, canvasWidth, canvasHeight);

	// 	if (magnify) {
	// 	}

	// 	requestAnimationFrame(animate);
	// };
});
