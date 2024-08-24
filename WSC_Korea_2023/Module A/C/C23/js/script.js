window.addEventListener('DOMContentLoaded', () => {
	const left = document.querySelector('.circle.circle-left');
	const right = document.querySelector('.circle.circle-right');
	const bar = document.querySelector('.bar');

	const minPrice = document.querySelector('.cost.cost-left span');
	const maxPrice = document.querySelector('.cost.cost-right span');

	const slider = document.getElementById('slider');

	const stepValue = 50;
	const step = slider.offsetWidth / 20; // 40px

	// Reset styles
	bar.style.width = 0;
	bar.style.left = 0;

	let leftValue = 400;
	let rightValue = 600;

	const setWidth = () => {
		bar.style.width = ((rightValue - leftValue) / stepValue) * step + 'px';
	};

	const setLeft = () => {
		bar.style.left = (leftValue / stepValue) * step + 'px';
		setWidth();
	};

	let leftClick = false;
	let rightClick = false;

	left.addEventListener('mousedown', () => {
		leftClick = true;
	});

	right.addEventListener('mousedown', () => {
		rightClick = true;
	});

	left.addEventListener('mouseup', () => {
		leftClick = false;
	});

	right.addEventListener('mouseup', () => {
		rightClick = false;
	});

	slider.addEventListener('mouseleave', () => {
		leftClick = false;
		rightClick = false;
	});

	slider.addEventListener('mouseup', () => {
		leftClick = false;
		rightClick = false;
	});

	const setDisplay = () => {
		minPrice.innerHTML = leftValue;
		maxPrice.innerHTML = rightValue;
	};

	const setLeftValue = mouseX => {
		if (mouseX <= 0) return;
		if (Math.floor(mouseX / step) * stepValue >= rightValue) return;
		leftValue = Math.floor(mouseX / step) * stepValue;
		setLeft();
		setDisplay();
	};

	const setRightValue = mouseX => {
		if (Math.floor(mouseX / step) * stepValue <= leftValue) return;
		if (mouseX >= slider.offsetWidth - 3 && mouseX <= slider.offsetWidth) {
			rightValue = Math.floor(slider.offsetWidth / step) * stepValue;
			setWidth();
			setDisplay();
		} else {
			if (mouseX > slider.offsetWidth) return;
			rightValue = Math.floor(mouseX / step) * stepValue;
			setWidth();
			setDisplay();
		}
	};

	slider.addEventListener('mousemove', e => {
		let mouseX = e.clientX - slider.offsetLeft;

		if (leftClick) {
			setLeftValue(mouseX);
		} else if (rightClick) {
			setRightValue(mouseX);
		}
	});

	setWidth();
	setLeft();
});
