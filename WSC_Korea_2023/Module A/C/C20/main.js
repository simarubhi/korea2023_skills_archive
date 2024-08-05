const wordRank = words => {
	const scores = [];
	scores.length = words.length;
	words = words.map(word => word.replace(/[^a-zA-Z]/g, ''));

	words.forEach((word, index) => {
		let chars = word.split('');
		let score = 0;

		chars.forEach(char => {
			score += char.toLowerCase().charCodeAt(0) - 96;
		});

		scores[index] = parseInt(score);
	});

	let maxScore = Math.max(...scores);
	return words[scores.findIndex(score => score === maxScore)];
};

let words = ['hello', 'sldkfj23', 'zxvcx', 'sdlSfjDs'];

console.log(wordRank(words));
