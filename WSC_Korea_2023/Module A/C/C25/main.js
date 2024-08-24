document.addEventListener('DOMContentLoaded', () => {
	const canvas = document.getElementById('canvas');
	const ctx = canvas.getContext('2d');

	canvas.width = window.innerWidth;
	canvas.height = window.innerHeight;

	window.addEventListener('resize', () => {
		canvas.width = window.innerWidth;
		canvas.height = window.innerHeight;
	});

	const mouse = {
		x: null,
		y: null,
	};

	canvas.addEventListener('mousemove', e => {
		mouse.x = e.clientX - canvas.getBoundingClientRect().left;
		mouse.y = e.clientY - canvas.getBoundingClientRect().top;
	});

	let clicked = false;
	let circle = 1;
	const circleCord = {
		x: null,
		y: null,
	};

	canvas.addEventListener('click', () => {
		if (clicked) return;
		circleCord.x = mouse.x;
		circleCord.y = mouse.y;
		clicked = true;
	});

	const animate = () => {
		ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);

		if (clicked) {
			if (circle >= 80) {
				clicked = false;
				circle = 1;
				circleCord.x = null;
				circleCord.y = null;
			} else {
				ctx.beginPath();
				ctx.arc(circleCord.x, circleCord.y, circle, 0, 2 * Math.PI);
				ctx.fillStyle = `rgba(211, 208, 208, ${
					(600 - circle * 10) * 0.01
				})`;
				ctx.fill();
				circle += 1.5;
			}
		}

		if (mouse.x !== null && mouse.y !== null) {
			ctx.beginPath();

			ctx.moveTo(mouse.x, mouse.y);
			ctx.lineTo(mouse.x + 30, mouse.y);
			ctx.lineTo(mouse.x + 10, mouse.y + 13);
			ctx.lineTo(mouse.x, mouse.y + 30);
			ctx.fillStyle = 'black';
			ctx.fill();
		}

		requestAnimationFrame(animate);
	};

	animate();
});
