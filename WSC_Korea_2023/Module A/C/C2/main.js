window.addEventListener('DOMContentLoaded', () => {
	const picture = document.querySelector('img');
	const container = document.querySelector('.img-container');

	const mouse = {
		x: undefined,
		y: undefined,
	};

	let size = 10;
	let spotLight;

	const updateMouse = e => {
		mouse.x = e.x;
		mouse.y = e.y;
	};

	const createSpotlight = () => {
		spotLight = document.createElement('div');
		spotLight.style.position = 'absolute';
		spotLight.style.opacity = '.6';
		spotLight.style.backgroundColor = 'white';
		spotLight.style.borderRadius = '300px';
		spotLight.style.filter = 'blur(3px)';
		spotLight.style.width = size + 'px';
		spotLight.style.height = size + 'px';
		spotLight.style.top = mouse.y + 'px';
		spotLight.style.left = mouse.x + 'px';
		picture.before(spotLight);
	};

	container.addEventListener('wheel', e => {
		size += e.deltaY * -0.1;
		if (size < 10) {
			size = 10;
		} else if (size > 300) {
			size = 300;
		}
		spotLight.style.width = size + 'px';
		spotLight.style.height = size + 'px';
	});

	container.addEventListener('mouseenter', e => {
		updateMouse(e);
		createSpotlight();
	});

	container.addEventListener('mouseleave', () => {
		console.log('leave');
		mouse.x = undefined;
		mouse.y = undefined;
		container.querySelectorAll('div').forEach(light => {
			light.remove();
		});
	});

	container.addEventListener('mousemove', e => {
		updateMouse(e);

		if (mouse.x == undefined || mouse.y == undefined) return;

		spotLight.style.top = mouse.y + 'px';
		spotLight.style.left = mouse.x + 'px';
		spotLight.style.transform = 'translate(-53%, -50%)';
	});
});
