(function() {
    tinymce.PluginManager.add('tb_carousel',function(editor, url) {
    	editor.addButton('tb_carousel', {
            title : 'Add a Carousel',
            image : url+'/img/carousel_icon.png',
            onclick : function() {
            	
            	//editor.selection.setContent('[carousel]');
            	
            	// Open window
                editor.windowManager.open({
                    title: 'Carousel For Category',
                    body: [
                        {type: 'textbox', name: 'category', label: 'WP Category', value: 'all'},
                        {type: 'listbox', name: 'style', label: 'Style', 'values': [
                                                                                      {text: 'Slide', value: 'slide'},
                                                                                      {text: 'Short', value: 'short'},
                                                                                      {text: 'Triple', value: 'triple'}
                                                                                    ]},
                        {type: 'textbox', name: 'interval', label: 'Interval', value: '5000'},
                        {type: 'textbox', name: 'pause', label: 'Pause', value: 'hover'},
                        {type: 'checkbox', name: 'wrap', label: 'Wrap', checked: true},
                        {type: 'checkbox', name: 'keyboard', label: 'Keyboard', checked: true},
                        {type: 'listbox', name: 'effect', label: 'Effect', 'values': [
                                                                                      {text: 'None', value: 'none'},
                                                                                      {text: 'Fade', value: 'fade'}
                                                                                    ]},
                    ],
                    onsubmit: function(e) {
                    	shortcode = '[carousel category="' + e.data.category + '" ' +
                    				'style="' + e.data.style + '" ' +
                    				'interval="' + e.data.interval + '" ' +
                    				'pause="' + e.data.pause + '" ' +
                    				'wrap="' + e.data.wrap + '" ' +
                    				'keyboard="' + e.data.keyboard + '" ' +
                    				'effect="' + e.data.effect + '" ' +
                    				']';
                    	
                        editor.selection.setContent(shortcode);
                    }
                });

            }
        });
    });
})();

