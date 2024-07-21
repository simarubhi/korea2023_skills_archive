window.addEventListener('DOMContentLoaded', () => {
	const canvas = document.getElementById('canvas');
	const ctx = canvas.getContext('2d');

	let mouse = {
		x: undefined,
		y: undefined,
	};

	let balls = [];

	const randomColor = () => {
		const colors = [
			'lightblue',
			'blue',
			'darkblue',
			'magenta',
			'cyan',
			'lightpink',
			'darkpurple',
		];

		return colors[Math.floor(Math.random() * colors.length)];
	};

	const randomPosition = () => {
		const max = 100;
		const min = -100;

		return Math.floor(Math.random() * (max - min)) + min;
	};

	class Ball {
		constructor() {
			this.x = mouse.x + randomPosition();
			this.y = mouse.y + randomPosition();
			this.size = 30;
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

			if (this.size <= 1) {
				this.size = 0;
			}
		}
	}

	const animation = () => {
		ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);

		if (mouse.x !== undefined && mouse.y !== undefined) {
			balls.push(new Ball());
		}

		for (let i = 0; i < balls.length; i++) {
			balls[i].update();
			balls[i].draw();

			if (balls[i].size === 0) {
				balls.splice(i, 1);
			}
		}

		requestAnimationFrame(animation);
	};

	const resize = () => {
		canvas.width = window.innerWidth;
		canvas.height = window.innerHeight;
	};

	const start = () => {
		resize();
		animation();
	};

	window.addEventListener('resize', () => {
		resize();
	});

	window.addEventListener('mouseout', () => {
		mouse.x = undefined;
		mouse.y = undefined;
	});

	window.addEventListener('mousemove', e => {
		mouse.x = e.x;
		mouse.y = e.y;
	});

	start();
});
