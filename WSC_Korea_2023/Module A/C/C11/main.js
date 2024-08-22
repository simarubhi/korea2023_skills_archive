window.addEventListener('DOMContentLoaded', () => {
	const cards = document.querySelectorAll(
		'.shadow.p-3.mb-5.bg-white.rounded'
	);

	let likes = [];
	let dislikes = [];

	for (let i = 0; i < cards.length; i++) {
		likes.push(false);
		dislikes.push(false);
	}

	const likeBtns = document.querySelectorAll('.like');
	const dislikeBtns = document.querySelectorAll('.dislike');

	likeBtns.forEach((btn, index) => {
		btn.addEventListener('click', () => {
			if (likes[index]) {
				likes[index] = false;
				btn.classList.remove('btn-dark');
				btn.classList.add('btn-light');
			} else {
				likes[index] = true;
				dislikes[index] = false;
				dislikeBtns[index].classList.remove('btn-dark');
				dislikeBtns[index].classList.add('btn-light');
				btn.classList.remove('btn-light');
				btn.classList.add('btn-dark');
			}
		});
	});

	dislikeBtns.forEach((btn, index) => {
		btn.addEventListener('click', () => {
			if (dislikes[index]) {
				dislikes[index] = false;
				btn.classList.remove('btn-dark');
				btn.classList.add('btn-light');
			} else {
				dislikes[index] = true;
				likes[index] = false;
				likeBtns[index].classList.remove('btn-dark');
				likeBtns[index].classList.add('btn-light');
				btn.classList.remove('btn-light');
				btn.classList.add('btn-dark');
			}
		});
	});

	const ratings = document.querySelector('.ratings');

	ratings.addEventListener('click', () => {
		likeCount = 0;
		dislikeCount = 0;
		for (let i = 0; i < likes.length; i++) {
			if (likes[i]) likeCount++;
			if (dislikes[i]) dislikeCount++;
		}

		alert(`Likes: ${likeCount}\nDislikes: ${dislikeCount}`);
	});
});
