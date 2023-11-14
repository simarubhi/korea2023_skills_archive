(function () {
	// Canvas Paint -------------------------------
	const canvas = document.getElementById('myC');
	const ctx = canvas.getContext('2d');
	const colours = document.querySelectorAll('.sq');

	let img;

	let paint = false;
	let initalX;
	let initalY;

	let col = canvas.getBoundingClientRect().left;
	let cot = canvas.getBoundingClientRect().top;

	canvas.addEventListener('mousedown', e => {
		paint = true;
		initalX = e.clientX;
		initalY = e.clientY;
	});

	canvas.addEventListener('mousemove', e => {
		if (!paint) return;
		ctx.lineWidth = 5;
		ctx.lineCap = 'round';

		ctx.lineTo(e.clientX - col, e.clientY - cot);
		ctx.stroke();
	});

	canvas.addEventListener('mouseup', () => {
		paint = false;
		ctx.stroke();
		ctx.beginPath();
	});

	colours.forEach(colour => {
		colour.addEventListener('click', () => {
			ctx.strokeStyle = colour.dataset.col;
		});
	});

	// Canvas Drag ----------------------------
	const bl = document.querySelector('.bl');

	let length = 300;
	let clicked = false;
	let initalPos;

	bl.addEventListener('mousedown', e => {
		clicked = true;
		initalPos = e.clientX;
	});

	document.addEventListener('mousemove', e => {
		if (!clicked) return;
		length += e.clientX - initalPos;

		img = ctx.getImageData(0, 0, length, length);

		canvas.width = length;
		canvas.height = length;

		initalPos = e.clientX;
		col = canvas.getBoundingClientRect().left;
		cot = canvas.getBoundingClientRect().top;

		ctx.putImageData(img, 0, 0);
	});

	document.addEventListener('mouseup', () => {
		clicked = false;
	});

	// Export --------------------------------
	const jpgBtn = document.getElementById('jpg-btn');
	const pngBtn = document.getElementById('png-btn');

	jpgBtn.addEventListener('click', () => {
		let data = canvas.toDataURL('image/jpg');
		let link = document.createElement('a');
		link.href = data;
		link.download = 'canvas.jpg';
		document.body.appendChild(link);
		link.click();
		document.body.removeChild(link);
	});

	pngBtn.addEventListener('click', () => {
		let data = canvas.toDataURL('image/png');
		let link = document.createElement('a');
		link.href = data;
		link.download = 'canvas.png';
		document.body.appendChild(link);
		link.click();
		document.body.removeChild(link);
	});
})();
