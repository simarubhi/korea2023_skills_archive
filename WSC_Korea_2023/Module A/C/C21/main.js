const body = document.querySelector('body');
body.style.width = '100vw';
body.style.height = '100vh';
body.style.overflow = 'hidden';
const size = 50;

const generate = () => {
	body.replaceChildren();
	xMin = size;
	xMax = body.offsetWidth - size;
	yMin = size;
	yMax = body.offsetHeight - size;

	const createBubble = (x, y, colour) => {
		let bubble = document.createElement('div');

		bubble.style.width = size + 'px';
		bubble.style.height = size + 'px';
		bubble.style.borderRadius = '100%';
		bubble.style.backgroundColor = colour;
		bubble.style.position = 'absolute';
		bubble.style.left = x + 'px';
		bubble.style.top = y + 'px';

		body.append(bubble);
	};

	const genRanColour = () => {
		let r = Math.floor(Math.random() * 101);
		let g = Math.floor(Math.random() * 101);
		let b = Math.floor(Math.random() * 101);

		return `rgb(${r}, ${g}, ${b})`;
	};

	for (let i = 0; i < 10; i++) {
		let xpos = Math.random() * (xMax - xMin) + xMin;
		let ypos = Math.random() * (yMax - yMin) + yMin;
		let ranColour = genRanColour();

		createBubble(xpos, ypos, ranColour);
	}
};

window.addEventListener('load', generate);
window.addEventListener('resize', generate);
