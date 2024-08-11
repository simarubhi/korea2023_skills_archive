// main.js

document.addEventListener('DOMContentLoaded', function () {
	const colorInput = document.getElementById('color-input');
	const resultControl = document.getElementById('result-control');

	const colorTypeSpan = resultControl.querySelector('.color-type');
	const hexColorValueSpan = resultControl.querySelector('.hex-color-value');
	const rgbColorValueSpan = resultControl.querySelector('.rgb-color-value');

	const successResult = resultControl.querySelector('.success-result');
	const errorResult = resultControl.querySelector('.error-result');

	colorInput.addEventListener('input', function () {
		const inputValue = colorInput.value.trim();

		if (isHex(inputValue)) {
			const rgbValue = hexToRgb(inputValue);
			colorTypeSpan.textContent = 'HEX';
			hexColorValueSpan.textContent = inputValue;
			rgbColorValueSpan.textContent = `rgb(${rgbValue.r},${rgbValue.g},${rgbValue.b})`;
			displayResult(true);
		} else if (isRgb(inputValue)) {
			const hexValue = rgbToHex(inputValue);
			colorTypeSpan.textContent = 'RGB';
			hexColorValueSpan.textContent = hexValue;
			rgbColorValueSpan.textContent = inputValue;
			displayResult(true);
		} else {
			displayResult(false);
		}
	});

	function isHex(value) {
		return /^#([0-9A-Fa-f]{3}){2}$/.test(value);
	}

	function hexToRgb(hex) {
		let bigint = parseInt(hex.slice(1), 16);
		let r = (bigint >> 16) & 255;
		let g = (bigint >> 8) & 255;
		let b = bigint & 255;
		return { r, g, b };
	}

	function isRgb(value) {
		return /^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/.test(value);
	}

	function rgbToHex(rgb) {
		let result = rgb
			.match(/\d+/g)
			.map(num => parseInt(num).toString(16).padStart(2, '0'))
			.join('');
		return `#${result}`;
	}

	function displayResult(isSuccess) {
		if (isSuccess) {
			successResult.style.display = 'block';
			errorResult.style.display = 'none';
		} else {
			successResult.style.display = 'none';
			errorResult.style.display = 'block';
		}
	}
});
