window.addEventListener('DOMContentLoaded', () => {
	const canvas = document.getElementById('canvas');
	const ctx = canvas.getContext('2d');

	let xSize, ySize;
	let balls = [];

	let mouse = {
		x: undefined,
		y: undefined,
	};

	const randomInt = (min, max) => {
		return Math.floor(Math.random() * (max - min) + min);
	};

	const randomColor = () => {
		const colors = [
			'cyan',
			'blue',
			'darkblue',
			'lightblue',
			'lightpink',
			'purple',
			'lightpurple',
		];

		return colors[randomInt(0, colors.length)];
	};

	class Ball {
		constructor() {
			this.x = mouse.x + randomInt(-100, 100);
			this.y = mouse.y + randomInt(-100, 100);
			this.size = 30 + randomInt(-10, 10);
			this.color = randomColor();
		}
		draw() {
			ctx.fillStyle = this.color;
			ctx.beginPath();
			ctx.arc(this.x, this.y, this.size, 0, 2 * Math.PI);
			ctx.closePath();
			ctx.fill();
		}
		update() {
			this.size -= 1;

			if (this.size < 1) {
				this.size = 0;
			}
		}
	}

	const animation = () => {
		ctx.clearRect(0, 0, xSize, ySize);

		if (mouse.x !== undefined && mouse.y !== undefined) {
			balls.push(new Ball());
		}

		for (let i = 0; i < balls.length; i++) {
			balls[i].update();

			if (balls[i].size == 0) {
				balls.splice(i, 1);
			} else {
				balls[i].draw();
			}
		}

		requestAnimationFrame(animation);
	};

	const resize = () => {
		console.log('hit');
		xSize = canvas.width = window.innerWidth;
		ySize = canvas.height = window.innerHeight;
	};

	const init = () => {
		resize();
		animation();
	};

	const getMouse = e => {
		mouse.x = e.x;
		mouse.y = e.y;
	};

	window.addEventListener('resize', init);
	window.addEventListener('mousemove', getMouse);

	window.addEventListener('mouseout', () => {
		mouse.x = undefined;
		mouse.y = undefined;
	});

	init();
});
