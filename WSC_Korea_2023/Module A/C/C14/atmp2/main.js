window.addEventListener('DOMContentLoaded', () => {
	const IMAGE_SHRINK = 2;

	const imageSelect = document.getElementById('picture-select');

	const imageElement = new Image();

	const images = [
		'image1.jpg',
		'image2.jpg',
		'image3.jpg',
		'image4.jpg',
		'image5.png',
	];

	images.forEach(image => {
		const option = document.createElement('option');
		option.value = image;
		option.innerText = image;
		imageSelect.appendChild(option);
	});

	const mouse = {
		x: null,
		y: null,
	};

	const colourDisplay = document.querySelector('.current-colour');
	const colourOutput = document.querySelector('.display-colour');

	const setColour = (r, g, b) => {
		colourDisplay.innerText = `Current colour: rgb(${r}, ${g}, ${b})`;
		colourOutput.style.backgroundColor = `rgb(${r}, ${g}, ${b})`;
	};

	const magnifyBtn = document.querySelector('.magnify');
	let mangify = false;

	magnifyBtn.addEventListener('click', () => {
		if (mangify) {
			mangify = false;
			magnifyBtn.innerText = 'Magnify';
		} else {
			mangify = true;
			magnifyBtn.innerText = 'Unmagnify';
		}
	});

	const canvas = document.getElementById('canvas');
	const ctx = canvas.getContext('2d', {
		willReadFrequently: true,
	});
	let canvasWidth = 500;
	let canvasHeight = 500;

	canvas.addEventListener('mousemove', event => {
		mouse.x = event.clientX - canvas.getBoundingClientRect().left;
		mouse.y = event.clientY - canvas.getBoundingClientRect().top;
	});

	canvas.addEventListener('mouseleave', () => {
		mouse.x = null;
		mouse.y = null;
	});

	const setSize = (width, height) => {
		canvasWidth = width;
		canvasHeight = height;
		canvas.width = width;
		canvas.height = height;
	};

	const changeImage = () => {
		imageElement.src = `../imgs/${imageSelect.value}`;

		imageElement.addEventListener('load', () => {
			setSize(
				imageElement.width / IMAGE_SHRINK,
				imageElement.height / IMAGE_SHRINK
			);
		});
	};
	changeImage();

	imageSelect.addEventListener('change', () => {
		changeImage();
	});

	imageElement.addEventListener('load', () => {
		const animate = () => {
			ctx.clearRect(0, 0, canvasWidth, canvasHeight);
			ctx.imageSmoothingEnabled = true;

			ctx.beginPath();

			ctx.drawImage(imageElement, 0, 0, canvasWidth, canvasHeight);

			if (mouse.x !== null && mouse.y !== null) {
				let imageData = ctx.getImageData(mouse.x, mouse.y, 1, 1).data;

				setColour(imageData[0], imageData[1], imageData[2]);
			} else {
				colourDisplay.innerText = `Current colour:`;
			}

			if (mangify && mouse.x !== null && mouse.y !== null) {
				ctx.imageSmoothingEnabled = false;
				const radius = 50;
				const zoom = 14;
				const magX = mouse.x + 60;
				const magY = mouse.y + 60;

				ctx.save();
				ctx.beginPath();
				ctx.arc(magX, magY, radius, 0, Math.PI * 2);
				ctx.clip();

				ctx.drawImage(
					imageElement,
					mouse.x * IMAGE_SHRINK - 7,
					mouse.y * IMAGE_SHRINK - 7,
					zoom,
					zoom,
					magX - radius,
					magY - radius,
					radius * 2,
					radius * 2
				);

				ctx.beginPath();
				ctx.strokeWidth = 0.1;
				ctx.strokeStyle = 'rgba(184, 184, 184, 0.4)';

				for (let i = 0; i < zoom + 1; i++) {
					ctx.moveTo(
						magX - radius + (i * radius * 2) / zoom,
						magY - radius
					);
					ctx.lineTo(
						magX - radius + (i * radius * 2) / zoom,
						magY + radius
					);
					ctx.stroke();

					ctx.moveTo(
						magX - radius,
						magY - radius + (i * radius * 2) / zoom
					);
					ctx.lineTo(
						magX + radius,
						magY - radius + (i * radius * 2) / zoom
					);
					ctx.stroke();
				}

				ctx.strokeWidth = 1;
				ctx.strokeStyle = 'red';
				ctx.strokeRect(
					magX,
					magY,
					zoom / IMAGE_SHRINK,
					zoom / IMAGE_SHRINK
				);

				ctx.restore();
			}

			requestAnimationFrame(animate);
		};

		animate();
	});
});
