const highlight = new Highlight();

//Here is your CODE!
const render = e => {
	const selction = document.getSelection();
	const startNode = selction.anchorNode;
	const startOff = selction.anchorOffset;
	const endNode = selction.focusNode;
	const endOff = selction.focusOffset;

	const highlightRange = new Range();
	highlightRange.setStart(startNode, startOff);
	highlightRange.setEnd(endNode, endOff);

	highlight.add(highlightRange);
	CSS.highlights.set('custom-highlight', highlight);
};

window.addEventListener('DOMContentLoaded', () => {
	const btn = document.querySelector('.render-btn');
	btn.setAttribute('onclick', 'render(event)');

	const head = document.getElementsByTagName('head')[0];
	const style = document.createElement('style');
	head.appendChild(style);

	// style.type = 'text/css';
	style.appendChild(
		document.createTextNode(
			'::highlight(custom-highlight) {background: yellow;color: red;}'
		)
	);
});

/* ::highlight(custom-highlight) {
				background: yellow;
				color: red;
			} */
