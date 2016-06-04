jQuery(document).ready(function($) {
					
	var social_slider = $('.social-slider').unslider({ 
		autoplay: true, 
		delay: 3000,
		nav: false,
		arrows: false,
		keys: {
			prev: 37,
			next: 39,
			stop: 27 // Esc key
		}
	});
	
	
	var work = $('.work').unslider({ 
		autoplay: true, 
		delay: 5000,
		arrows: {
		prev: '<a class="prev">&#139;</a>',
		next: '<a class="next">&#155;</a>',
		},
		keys: {
			prev: 37,
			mnext: 39,
			stop: 27 // Esc key
		}
	}); // Both
	
	var mobile_work = $('.mobile_work').unslider({ 
		autoplay: true, 
		delay: 5000,
		arrows: {
		prev: '<a class="prev">&#139;</a>',
		next: '<a class="next">&#155;</a>',
		},
		keys: {
			prev: 37,
			next: 39,
			stop: 27 // Esc key
		}
	}); // For Mobile Designs
	
	var mobile_work_only = $('.mobile_work_only').unslider({ 
		autoplay: true, 
		delay: 5000,
		arrows: {
		prev: '<a class="prev">&#139;</a>',
		next: '<a class="next">&#155;</a>',
		},
		keys: {
			prev: 37,
			next: 39,
			stop: 27 // Esc key
		}
	}); // For Mobile Only
});