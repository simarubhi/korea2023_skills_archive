const FRAME_COUNT = 25;
const WIDTH = 15000 / FRAME_COUNT;
const HEIGHT = 600;
let CANVAS_WIDTH = window.innerWidth;
let CANVAS_HEIGHT = window.innerHeight;
const STEP = 0.5;
const img = new Image();
img.src = './firework_sprites.png';

const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

canvas.width = CANVAS_WIDTH;
canvas.height = CANVAS_HEIGHT;

const colors = [
	'rgba(0, 132, 255, 0.575)',
	'rgba(197, 20, 144, 0.411)',
	'rgba(20, 197, 29, 0.411)',
	'rgba(179, 197, 20, 0.411)',
	'rgba(197, 120, 20, 0.411)',
	'rgba(197, 20, 117, 0.411)',
];

let fireWorks = [];

const getRandomInt = (min, max) => {
	return Math.floor(Math.random() * (max - min) + min);
};

class FireWork {
	constructor() {
		this.currentFrame = 0;
		this.color = colors[getRandomInt(0, colors.length)];
		this.size = 100;
		this.x = getRandomInt(this.size, CANVAS_WIDTH - this.size);
		this.y = getRandomInt(this.size, CANVAS_HEIGHT - this.size);
		this.done = false;
	}
	draw() {
		ctx.globalCompositeOperation = 'source-over';
		ctx.drawImage(
			img,
			Math.floor(this.currentFrame) * WIDTH,
			0,
			WIDTH,
			HEIGHT,
			this.x,
			this.y,
			this.size,
			this.size
		);
		ctx.globalCompositeOperation = 'source-atop';
		ctx.fillStyle = this.color;
		ctx.fillRect(this.x, this.y, this.size, this.size);
	}
	update() {
		this.currentFrame += 1;

		if (Math.floor(this.currentFrame) == FRAME_COUNT) {
			this.done = true;
		}
	}
}

img.addEventListener('load', () => {
	const animation = () => {
		ctx.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

		if (fireWorks.length < 20) {
			fireWorks.push(new FireWork());
		}

		for (let i = 0; i < fireWorks.length; i++) {
			fireWorks[i].draw();
			fireWorks[i].update();
			if (fireWorks[i].done) {
				fireWorks.splice(i, 1);
			}
		}

		setTimeout(animation, 50);

		// requestAnimationFrame(animation);
	};
	animation();
});

window.addEventListener('resize', () => {
	CANVAS_WIDTH = window.innerWidth;
	CANVAS_HEIGHT = window.innerHeight;
	canvas.width = CANVAS_WIDTH;
	canvas.height = CANVAS_HEIGHT;

	fireWorks = [];
});
