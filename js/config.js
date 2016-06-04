 $(document).ready(function($) {    
        
	if ($(window).width() > 600) {
			var sticky = new Waypoint.Sticky({
			element: $('.links')[0]
		});
	} else {
		console.log('Made nav smaller.');
	}
});
 