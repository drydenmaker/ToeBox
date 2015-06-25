/**
 * 
 */
var tb_show_xs_button = null;
if (typeof window.tb_show_xs_button_disable == 'undefined') window.tb_show_xs_button_disable = false;
(function() {
    tinymce.PluginManager.add('tb_show_xs',function(editor, url) {
    	editor.addButton('tb_show_xs', {
            title : 'Show Only on Small',
            image : url+'/img/show_xs_icon.png',
            onPostRender: function() { 
//            		tb_show_xs_button = this;
//            		tb_show_xs_button.disabled(tb_show_xs_button_disable);
            	},
            onclick : function() {
            	
            	//editor.selection.setContent('[icon]');
            	
            	// Open window
                editor.windowManager.open({
                    title: 'Bootstrap Icon (see http://getbootstrap.com/components/)',
                    body: [
                        {type: 'listbox', name: 'display', label: 'Display', 'values': [
																					{text: 'block', value: 'block'},
																					{text: 'inline', value: 'inline'},
																					{text: 'inline-block', value: 'inline-block'}
                                                                                    ]},
                    ],
                    onsubmit: function(e) {

                    	shortcode = '[tb-show-xs display="' + e.data.display + '" ]';                    	
                        
                    	shortcode += editor.selection.getContent({format: 'raw'});
                    	
                    	shortcode += '[/tb-show-xs]';
                    	
                        editor.selection.setContent(shortcode);
                        
                    }
                });

            }
        });
    	
    	editor.addButton('tb_hide_xs', {
            title : 'hide on Small',
            image : url+'/img/hide_xs_icon.png',
            onPostRender: function() { 
//            		tb_hide_xs_button = this;
//            		tb_hide_xs_button.disabled(tb_hide_xs_button_disable);
            	},
            onclick : function() {
            	

            	shortcode = '[tb-hide-xs]';                    	
                
            	shortcode += editor.selection.getContent({format: 'raw'});
            	
            	shortcode += '[/tb-hide-xs]';
            	
                editor.selection.setContent(shortcode);
                

            }
        });
    	
    	
    });
})();

