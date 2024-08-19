window.addEventListener('DOMContentLoaded', () => {
	const hightlight = new Highlight();
	const para = document.querySelector('p');
	const text = para.childNodes[0];
	const input = document.querySelector('input');
	const btn = document.querySelector('button');

	// btn.addEventListener('click', e => {
	// 	const value = input.value;

	// 	if (!value) return;

	// 	let index = para.innerText.indexOf(value);

	// 	while (index > -1) {
	// 		const range = new Range();
	// 		range.setStart(text, index);
	// 		range.setEnd(text, index + value.length);
	// 		hightlight.add(range);

	// 		console.log(range);
	// 		index = para.innerText.indexOf(value, index + 1);
	// 	}
	// });

	function getRandomColor() {
		const r = Math.floor(Math.random() * 256);
		const g = Math.floor(Math.random() * 256);
		const b = Math.floor(Math.random() * 256);
		return `rgb(${r}, ${g}, ${b})`;
	}

	btn.addEventListener('click', () => {
		const value = input.value;

		if (!value) return;

		let innerHTML = para.innerHTML;
		const colorMap = new Map(); // Map to store colors for keywords

		let index = innerHTML.indexOf(value);

		while (index > -1) {
			// Get the color for the current keyword or assign a new one
			let randomColor;
			if (colorMap.has(value)) {
				randomColor = colorMap.get(value);
			} else {
				randomColor = getRandomColor();
				colorMap.set(value, randomColor);
			}

			// Insert the <mark> tag with the random color around the matched text
			innerHTML =
				innerHTML.slice(0, index) +
				`<mark style="background-color: ${randomColor};">${innerHTML.slice(
					index,
					index + value.length
				)}</mark>` +
				innerHTML.slice(index + value.length);

			// Move the index forward to avoid infinite loop
			index = innerHTML.indexOf(
				value,
				index +
					value.length +
					`<mark style="background-color: ${randomColor};"></mark>`
						.length -
					value.length
			);
		}

		para.innerHTML = innerHTML;
	});
});
