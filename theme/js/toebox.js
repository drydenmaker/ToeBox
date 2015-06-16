/*!
 * ToeBox v0.1 (http://gettoebox.com)
 * Copyright 2011-2015 drydenmaker
 * Licensed under MIT (https://github.com/drydenmaker/toebox/blob/master/LICENSE)
 */
(function($) {
	/**
	  * NAME: Bootstrap 3 Triple Nested Sub-Menus
	  * This script will active Triple level multi drop-down menus in Bootstrap 3.*
	  * inital block script posted: http://www.bootply.com/fOjRunEiTZ
	  * NOTE: requires [data-toggle=dropdown] on toggles
	  */
	$('.tb-nav .tb-dropdown-toggle').on('click', function(event) {
		
	    // Avoid following the href location when clicking
	    event.preventDefault(); 
	    // Avoid having the menu to close when clicking
	    event.stopPropagation(); 

	    // add .open to parent for sub-menu item
	    $(this).parent().siblings().removeClass('open');
	    $(this).parent().toggleClass('open');
	    
	});
})(jQuery);
