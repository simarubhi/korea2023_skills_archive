const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
const resize = document.querySelector('.resize');

// Resize Canvas
const ro = new ResizeObserver(() => {
	canvas.width = resize.offsetWidth;
	canvas.height = resize.offsetHeight;
});
ro.observe(resize);

// Drawing

let mouse = {
	x: undefined,
	y: undefined,
};

let draw = false;
let beginX;
let beginY;
let selectedColour = 'black';

const colours = document.querySelectorAll('.colour-con div');
colours.forEach(colour => {
	colour.addEventListener('click', () => {
		selectedColour = colour.style.backgroundColor;
	});
});

const drawing = e => {
	if (!draw) return;

	ctx.lineWidth = 3;
	ctx.lineCap = 'round';
	ctx.strokeStyle = selectedColour;

	ctx.lineTo(mouse.x, mouse.y);
	ctx.stroke();
};

canvas.addEventListener('mousemove', e => {
	mouse.x = e.clientX - e.target.getBoundingClientRect().left;
	mouse.y = e.clientY - e.target.getBoundingClientRect().top;
	drawing();
});

canvas.addEventListener('mousedown', e => {
	draw = true;
	beginX = mouse.x;
	beginY = mouse.y;
});

canvas.addEventListener('mouseup', e => {
	draw = false;
	ctx.stroke();
	ctx.beginPath();
});

// Image save buttons
const jpgBtn = document.getElementById('jpg');
const pngBtn = document.getElementById('png');
const download = document.getElementById('download');

jpgBtn.addEventListener('click', () => {
	download.href = canvas.toDataURL('image/jpeg');
	download.click();
});

pngBtn.addEventListener('click', () => {
	download.href = canvas.toDataURL('image/png');
	download.click();
});
