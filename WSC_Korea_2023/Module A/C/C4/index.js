//Here is your CODE!

const highlight = new Highlight();
var render = e => {
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
