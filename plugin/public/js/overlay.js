/* ========================================================================
 * ToeBox: overlay.js v3.3.4
 * http://gettoebox.com/javascript/#overlay
 * ========================================================================
 * Copyright 2011-2015 Simms Fishing Products, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

(function ($)
{
	var dataKey = 'tb.overlay';
	var defaultData = 'toggle';	

	console.log('setup ' + dataKey);
	
	function Overlay(element, options) 
	{
	    this.$element      = $(element)
	    this.options       = $.extend({}, Overlay.DEFAULTS, options)
	}
		
	Overlay.VERSION  = '0.0.1';

	Overlay.TRANSITION_DURATION = 350;

	Overlay.DEFAULTS = {
			toggle: true
	};
	/**
	 * handle showing Overlay
	 */
	Overlay.prototype.show = function () {
	    if (CurrentlyActive(this) || this.$element.hasClass('in')) return
	};
	/**
	 * handle hiding Overlay
	 */
	Overlay.prototype.hide = function () {
	    if (CurrentlyActive(this) || !this.$element.hasClass('in')) return
	};
	
	function CurrentlyActive(instance)
	{
		if (this.transitioning) return true;

	    var startEvent = $.Event('show.bs.collapse')
	    this.$element.trigger(startEvent)
	    if (startEvent.isDefaultPrevented()) return
	}

    function Controller(option)
    {
	    return this.each(function () 
	    		{
		          var $this   = $(this)
		          var data    = $this.data(dataKey)
		          var options = $.extend({}, Overlay.DEFAULTS, $this.data(), typeof option == 'object' && option)
		
		          // init toggle value as false or toggle to fals if true
		          if (!data && options.toggle && /show|hide/.test(option)) options.toggle = false
		          // init plugin instance if not attached
		          if (!data) $this.data(dataKey, (data = new Overlay(this, options)))
		          // if we can use 'option' as a key execute that function
		          if (typeof option == 'string') data[option]()
		        });
   }
    
    $.fn.overlay = Controller;
    
    function getTargetFromTrigger($trigger) 
    {
        var href
        var target = $trigger.attr('data-target')
          || (href = $trigger.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') // strip for ie7

        return $(target)
    }
    // namespaced click on 
    $(document).on('click.tb.oevrlay.data-api', '[data-toggle="overlay"]', function (e) 
	{
    	console.log('clicked');
    	
        var $this   = $(this)

        if (!$this.attr('data-target')) e.preventDefault();
        
        var $target = getTargetFromTrigger($this)
        var data    = $target.data(dataKey)
        var option  = data ? defaultData : $this.data();
        
        // execute actual plugin
        Controller.call($target, option);
        		
    });
    
    $('[data-toggle="overlay"]').click(function(){
    	console.log('other clicked');
    });
    
})(jQuery);

console.log('loaded');