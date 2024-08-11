const imageSelector = document.getElementById('imageSelector');
const imageCanvas = document.getElementById('imageCanvas');
const ctx = imageCanvas.getContext('2d');
const magnifyingGlass = document.getElementById('magnifyingGlass');
const magnifyingCtx = magnifyingGlass.getContext('2d');
const colorInfo = document.getElementById('colorInfo');

// Images available in ./imgs folder
const images = ['image1.jpg', 'image2.jpg', 'image3.jpg']; // Replace with your actual images

// Populate the image selector
images.forEach(image => {
	const option = document.createElement('option');
	option.value = `../imgs/${image}`;
	option.textContent = image;
	imageSelector.appendChild(option);
});

// Handle image selection
imageSelector.addEventListener('change', function () {
	const imgSrc = this.value;
	if (imgSrc) {
		const img = new Image();
		img.onload = function () {
			imageCanvas.width = img.width;
			imageCanvas.height = img.height;
			ctx.drawImage(img, 0, 0);
		};
		img.src = imgSrc;
	}
});

imageCanvas.addEventListener('mousemove', handleMouseMove, false);

function handleMouseMove(event) {
	const rect = imageCanvas.getBoundingClientRect();
	const x = event.clientX - rect.left;
	const y = event.clientY - rect.top;

	// Get color at mouse position
	const imageData = ctx.getImageData(x, y, 1, 1).data;
	const color = `rgb(${imageData[0]}, ${imageData[1]}, ${imageData[2]})`;
	colorInfo.textContent = `Color: ${color}`;

	// Display magnifying glass
	magnifyingGlass.style.left = `${x + 10}px`;
	magnifyingGlass.style.top = `${y + 10}px`;
	magnifyingGlass.style.display = 'block';

	// Draw magnified image
	const magnification = 10;
	magnifyingCtx.clearRect(
		0,
		0,
		magnifyingGlass.width,
		magnifyingGlass.height
	);
	magnifyingCtx.drawImage(
		imageCanvas,
		x - 7,
		y - 7,
		14,
		14,
		0,
		0,
		magnifyingGlass.width,
		magnifyingGlass.height
	);

	// Draw grid lines on magnifying glass
	drawGridLines(magnifyingCtx);
}

function drawGridLines(ctx) {
	ctx.strokeStyle = 'rgba(0, 0, 0, 0.5)';
	for (let i = 0; i <= 100; i += 10) {
		ctx.beginPath();
		ctx.moveTo(i, 0);
		ctx.lineTo(i, 100);
		ctx.moveTo(0, i);
		ctx.lineTo(100, i);
		ctx.stroke();
	}
}
