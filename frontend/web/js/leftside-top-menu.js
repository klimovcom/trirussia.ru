$(document).ready(function(){
	$("#leftside-menu").scotchPanel({
		containerSelector: 'body', // As a jQuery Selector
		direction: 'left', // Make it toggle in from the left
		duration: 300, // Speed in ms how fast you want it to be
		transition: 'ease', // CSS3 transition type: linear, ease, ease-in, ease-out, ease-in-out, cubic-bezier(P1x,P1y,P2x,P2y)
		clickSelector: '.menu-trigger', // Enables toggling when clicking elements of this class
		distanceX: '20%', // Size fo the toggle
		enableEscapeKey: true, // Clicking Esc will close the panel
		beforePanelOpen: function() {
			$(".sidebar").remove();
		},
		afterPanelClose: function() {
			$(".new-sidebar").show();
		}
	});	
});
