$(document).ready(function() {
	$('.collapseHeader').collapser({
		target: 'next',
		targetOnly: 'div',
//		expandHtml: 'Expand Text',
//		collapseHtml: 'Collapse Text',
		expandClass: 'expArrow',
		collapseClass: 'collArrow'
	});
});
