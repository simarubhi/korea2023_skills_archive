window.addEventListener('DOMContentLoaded', () => {
	const input = document.getElementById('searchInput');
	const button = document.getElementById('searchButton');
	const textElement = document.getElementById('text');

	// Helper function to generate a random color
	function getRandomColor() {
		return '#' + Math.floor(Math.random() * 16777215).toString(16);
	}

	// Helper function to escape special characters for regex
	function escapeRegExp(string) {
		return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
	}

	button.addEventListener('click', () => {
		const keyword = input.value;
		if (keyword === '') return; // Don't do anything if the input is empty

		// Get the original HTML of the paragraph
		let originalHTML = textElement.innerHTML;

		// Escape special characters in the keyword for regex
		const escapedKeyword = escapeRegExp(keyword);
		const regex = new RegExp(`(${escapedKeyword})`, 'g');

		// Replace matched keywords with highlighted version
		let match;
		let index = 0;
		let newHTML = '';

		while ((match = regex.exec(originalHTML)) !== null) {
			// Get the part of the HTML before the match
			newHTML += originalHTML.substring(index, match.index);

			// Generate a random color for this match
			const randomColor = getRandomColor();
			// Add the highlighted match
			newHTML += `<span class="highlight" style="background-color: ${randomColor};">${match[0]}</span>`;

			// Update the index to be after the current match
			index = regex.lastIndex;
		}

		// Append the remaining part of the original HTML after the last match
		newHTML += originalHTML.substring(index);

		// Set the new HTML with highlights
		textElement.innerHTML = newHTML;
	});
});
