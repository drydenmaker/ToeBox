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
	var defaultOption = 'toggle';	

	console.log('setup ' + dataKey);
	
	function Overlay(element, options) 
	{
	    this.$element      = $(element);
	    this.options       = $.extend({}, Overlay.DEFAULTS, options);
	    this.$trigger      = $('[data-toggle="overlay"][href="#' + element.id + '"],' +
                           '[data-toggle="overlay"][data-target="#' + element.id + '"]');
	    
	    this.transitioning = null;

	    if (this.options.parent) 
	    {
	      this.$parent = this.getParent();
	    } 
	    else 
	    {
	      this.addAriaAndCollapsedClass(this.$element, this.$trigger);
	    }

	    if (this.options.toggle) this.toggle();
	}
		
	Overlay.VERSION  = '0.0.1';

	Overlay.TRANSITION_DURATION = 350;

	Overlay.DEFAULTS = {
			toggle: true
	};
	/**
	 * handle showing Overlay
	 */
	Overlay.prototype.show = function () 
	{
		
		if (this.transitioning || this.$element.hasClass('in')) return;	    
	    console.log('showing');
	};
	/**
	 * handle hiding Overlay
	 */
	Overlay.prototype.hide = function () 
	{
		
		if (this.transitioning || !this.$element.hasClass('in')) return
	    console.log('hideing');

	};
	
	/**
	 * handle initial toggle
	 */
	Overlay.prototype.toggle = function () 
	{
	    this[this.$element.hasClass('in') ? 'hide' : 'show']();
	    
	    var activesData;
	    var actives = this.$parent && this.$parent.children('.panel').children('.in, .collapsing');

	    if (actives && actives.length) {
	      activesData = actives.data('bs.collapse');
	      if (activesData && activesData.transitioning) return;
	    }

	    var startEvent = $.Event('show.bs.collapse')
	    this.$element.trigger(startEvent);
	    if (startEvent.isDefaultPrevented()) return;

	    if (actives && actives.length) {
	      Plugin.call(actives, 'hide');
	      activesData || actives.data('bs.collapse', null);
	    }

	    var dimension = 'width'; //this.dimension()

	    this.$element
	      .removeClass('collapse')
	      .addClass('collapsing')[dimension](0)
	      .attr('aria-expanded', true);

	    this.$trigger
	      .removeClass('collapsed')
	      .attr('aria-expanded', true);

	    this.transitioning = 1;

	    var complete = function () {
	      this.$element
	        .removeClass('collapsing')
	        .addClass('collapse in')[dimension]('');
	      this.transitioning = 0;
	      this.$element
	        .trigger('shown.bs.collapse');
	    }

	    if (!$.support.transition) return complete.call(this);

	    var scrollSize = $.camelCase(['scroll', dimension].join('-'));

	    this.$element
	      .one('bsTransitionEnd', $.proxy(complete, this))
	      .emulateTransitionEnd(Collapse.TRANSITION_DURATION)[dimension](this.$element[0][scrollSize]);
	};
	
    /**
	 * ----------------------------------------------------------------------------------------------------------TOGGLE
	 */

	Overlay.prototype.getParent = function () 
	{
	    return $(this.options.parent)
	      .find('[data-toggle="overlay"][data-parent="' + this.options.parent + '"]')
	      .each($.proxy(function (i, element) {
	        var $element = $(element)
	        this.addAriaAndCollapsedClass(getTargetFromTrigger($element), $element)
	      }, this))
	      .end()
	  }

	Overlay.prototype.addAriaAndCollapsedClass = function ($element, $trigger) {
	    var isOpen = $element.hasClass('in');

	    $element.attr('aria-expanded', isOpen);
	    $trigger
	      .toggleClass('overlayd', !isOpen)
	      .attr('aria-expanded', isOpen);
	  }

	  function getTargetFromTrigger($trigger) 
	  {
	    var href
	    var target = $trigger.attr('data-target')
	      || (href = $trigger.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') // strip for ie7

	    return $(target)
	  }


	  // COLLAPSE PLUGIN DEFINITION
	  // ==========================

	  function Controller(option) 
	  {
	    return this.each(function () 
	    		{
			      var $this   = $(this);
			      var data    = $this.data('bs.overlay');
			      var options = $.extend({}, Overlay.DEFAULTS, $this.data(), typeof option == 'object' && option);
		
			      if (!data && options.toggle && /show|hide/.test(option)) options.toggle = false;
			      if (!data) $this.data('bs.overlay', (data = new Overlay(this, options)));
			      if (typeof option == 'string') data[option]();
			    });
	  }

	  var old = $.fn.overlay;

	  $.fn.overlay             = Controller;
	  $.fn.overlay.Constructor = Overlay;


	  // COLLAPSE NO CONFLICT
	  // ====================

	  $.fn.overlay.noConflict = function () 
	  {
	    $.fn.overlay = old;
	    return this;
	  }


	  // COLLAPSE DATA-API
	  // =================

	  $(document).on('click.bs.overlay.data-api', '[data-toggle="overlay"]', function (e) 
			  {
			    var $this   = $(this);
			    console.log('clicked');
			    if (!$this.attr('data-target')) e.preventDefault();
		
			    var $target = getTargetFromTrigger($this);
			    var data    = $target.data('bs.overlay');
			    var option  = data ? 'toggle' : $this.data();
		
			    Controller.call($target, option);
			  });

    
})(jQuery);