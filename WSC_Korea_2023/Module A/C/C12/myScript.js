// const btnA = document.querySelector('a[href="a.html"]');
// const btnB = document.querySelector('a[href="b.html"]');
// const btnC = document.querySelector('a[href="c.html"]');

// const base = location.origin + location.pathname.slice(0, -6);

// btnA.addEventListener('click', event => {
// 	event.preventDefault();
// 	window.location.assign(`${base}a.html`);
// });

// CHAT GPT CODE

document.querySelectorAll('header a').forEach(link => {
	link.addEventListener('click', function (event) {
		event.preventDefault(); // Prevent the default anchor behavior

		const url = this.getAttribute('href'); // Get the target URL from the link
		loadPage(url); // Load the content of the new page without refresh
	});
});

// Function to load page content dynamically
function loadPage(url) {
	// Fetch the content of the target HTML file
	fetch(url)
		.then(response => response.text())
		.then(data => {
			// Parse the fetched HTML to extract the main content
			const parser = new DOMParser();
			const doc = parser.parseFromString(data, 'text/html');
			console.log(doc);
			const newContent = doc.querySelector('main').innerHTML;
			const newTitle = doc.querySelector('title').innerText;

			// Update the document title and main content
			document.title = newTitle;
			document.querySelector('main').innerHTML = newContent;

			// Change the URL without reloading the page
			window.history.pushState({ path: url }, '', url);
		})
		.catch(error => console.error('Error loading page:', error));
}

// Handle browser back/forward buttons
window.addEventListener('popstate', function (event) {
	if (event.state && event.state.path) {
		loadPage(event.state.path);
	}
});
