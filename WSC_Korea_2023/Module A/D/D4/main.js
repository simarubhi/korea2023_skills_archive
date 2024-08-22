// window.addEventListener('DOMContentLoaded', async () => {
// 	const container = document.querySelector('.container');

// 	const jsonData = [];
// 	let start = 0;
// 	let currentPos = 0;

// 	const fetchData = async () => {
// 		const res = await fetch(`./index.php?start=${start}`);
// 		const data = await res.json();
// 		jsonData.push(...data);
// 		start += 10;
// 	};

// 	const populate = async () => {
// 		if (currentPos === start) {
// 			await fetchData();
// 		}
// 		for (let i = currentPos; i < currentPos + 5; i++) {
// 			const dataElement = document.createElement('div');
// 			dataElement.classList.add('data');
// 			dataElement.innerHTML = `${JSON.stringify(jsonData[i])}`;
// 			container.appendChild(dataElement);
// 		}
// 		currentPos += 5;
// 	};

// 	await fetchData();
// 	populate();
// });
window.addEventListener('DOMContentLoaded', async () => {
	const container = document.querySelector('.container');

	const jsonData = [];
	let start = 0;
	let currentPos = 0;
	let isLoading = false;

	const fetchData = async () => {
		if (isLoading) return;
		isLoading = true;

		const res = await fetch(`./index.php?start=${start}`);
		const data = await res.json();
		jsonData.push(...data);
		start += 10;

		isLoading = false;
	};

	const populate = async () => {
		if (currentPos >= jsonData.length) {
			await fetchData();
		}

		const endPos = Math.min(currentPos + 5, jsonData.length);
		for (let i = currentPos; i < endPos; i++) {
			const dataElement = document.createElement('div');
			dataElement.classList.add('data');
			dataElement.innerHTML = `${JSON.stringify(jsonData[i])}`;
			container.appendChild(dataElement);
		}
		currentPos += 5;
	};

	const handleScroll = async () => {
		const scrollBottom = 300 + window.scrollY + container.clientHeight;
		console.log(scrollBottom);
		console.log(window.scrollY);
		console.log(container.scrollHeight);
		if (scrollBottom >= container.scrollHeight && !isLoading) {
			await populate();
		}
	};

	window.addEventListener('scroll', handleScroll);

	await fetchData();
	populate();
});
