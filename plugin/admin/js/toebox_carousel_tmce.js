var tb_carousel_button = null;
if (typeof window.tb_carousel_button_disable == 'undefined') window.tb_carousel_button_disable = false;
(function() {
    tinymce.PluginManager.add('tb_carousel',function(editor, url) {
    	editor.addButton('tb_carousel', {
            title : 'Add a Carousel',
            image : url+'/img/carousel_icon.png',
            onPostRender: function() { 
            		tb_carousel_button = this;
            		tb_carousel_button.disabled(tb_carousel_button_disable);
            	},
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
                    	shortcode = '[carousel  ';
                    	
                    	if (e.data.category != '') shortcode += 'category="' +  e.data.category + '" ';    
                    	if (e.data.style != '') shortcode += 'style="' +  e.data.style + '" ';
                    	if (e.data.interval != '5000') shortcode += 'interval="' +  e.data.interval + '" ';
                    	if (e.data.pause != 'hover') shortcode += 'pause="' +  e.data.pause + '" ';
                    	if (e.data.wrap != true) shortcode += 'wrap="' +  e.data.wrap + '" ';
                    	if (e.data.keyboard != true) shortcode += 'keyboard="' +  e.data.keyboard + '" ';
                    	if (e.data.effect != '') shortcode += 'effect="' +  e.data.effect + '" ';
                    	
                    	shortcode += ']'; 
                    	
                        editor.selection.setContent(shortcode);
                    }
                });

            }
        });
    });
})();

