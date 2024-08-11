window.addEventListener('DOMContentLoaded', () => {
	const cards = document.querySelectorAll('.card');
	const groups = document.querySelectorAll('.group-sortable');
	let cardWidth = cards[0].offsetWidth;
	let isDragging = false;

	window.addEventListener('resize', () => {
		cardWidth = cards[0].offsetWidth;

		cards.forEach(card => {
			card.style.width = cardWidth + 'px';
		});
	});

	const startPos = {
		x: null,
		y: null,
	};

	const mouse = {
		x: null,
		y: null,
	};

	const updateMouse = event => {
		mouse.x = event.clientX;
		mouse.y = event.clientY;
	};

	window.addEventListener('drag', event => {
		updateMouse(event);

		if (isDragging) {
			const dragging = document.querySelector('.dragging');

			dragging.style.top = mouse.y - startPos.y + 'px';
			dragging.style.left = mouse.x - startPos.x + 'px';
		}
	});

	cards.forEach(card => {
		card.style.width = cardWidth + 'px';

		card.addEventListener('dragstart', event => {
			card.classList.add('tilt');
			const clone = card.cloneNode(true);
			clone.classList.add('dragging');
			clone.setAttribute('draggable', false);
			document.body.append(clone);

			const cardRect = card.getBoundingClientRect();
			startPos.x = mouse.x - cardRect.left;
			startPos.y = mouse.y - cardRect.top;

			isDragging = true;

			card.style.opacity = '0%';
		});

		card.addEventListener('dragend', () => {
			card.classList.remove('tilt');
			card.style.opacity = '100%';
			document.querySelector('.dragging').remove();
			isDragging = false;
		});
	});

	const insertAboveTask = (zone, mouseY) => {
		const zoneCards = zone.querySelectorAll('.card:not(.tilt)');

		let closestCard = null;
		let closestOffset = Number.NEGATIVE_INFINITY;

		zoneCards.forEach(task => {
			const { top } = task.getBoundingClientRect();

			const offset = mouseY - top;

			if (offset < 0 && offset > closestOffset) {
				closestOffset = offset;
				closestCard = task;
			}
		});

		return closestCard;
	};

	groups.forEach(zone => {
		zone.addEventListener('dragover', e => {
			e.preventDefault();

			const bottomCard = insertAboveTask(zone, e.clientY);
			const curCard = document.querySelector('.tilt');

			if (!bottomCard) {
				zone.appendChild(curCard);
			} else {
				zone.insertBefore(curCard, bottomCard);
			}
		});
	});
});
