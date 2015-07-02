/**
 * 
 */
var tb_button_button = null;
if (typeof window.tb_button_button_disable == 'undefined') window.tb_button_button_disable = false;
(function() {
    tinymce.PluginManager.add('tb_button',function(editor, url) {
    	editor.addButton('tb_button', {
            title : 'Add a Button',
            image : url+'/img/button_icon.png',
            onPostRender: function() { 
            		tb_button_button = this;
            		tb_button_button.disabled(tb_button_button_disable);
            	},
            onclick : function() {
            	
            	//editor.selection.setContent('[icon]');
            	
            	// Open window
                editor.windowManager.open({
                    title: 'Bootstrap Button (see http://getbootstrap.com/components/)',
                    body: [
                        {type: 'textbox', name: 'title', label: 'Title', value: ''},
                        {type: 'textbox', name: 'url', label: 'Url', value: 'http://'},
                        {type: 'listbox', name: 'style', label: 'Style', 'values': [
                                                                                    {text: 'default', value: 'default'}, 
                                                                                    {text: 'primary', value: 'primary'}, 
                                                                                    {text: 'success', value: 'success'}, 
                                                                                    {text: 'info', value: 'info'}, 
                                                                                    {text: 'warning', value: 'warning'}, 
                                                                                    {text: 'danger', value: 'danger'}, 
                                                                                    {text: 'link', value: 'link'},
                                                                                    {text: 'gray', value: 'gray'},
                                                                                    {text: 'silver', value: 'silver'},
                                                                                    {text: 'bordered', value: 'bordered'},
                                                                                    ]},
                        {type: 'listbox', name: 'size', label: 'Size', 'values': [
                                                                                    {text: 'Normal', value: '3'},
                                                                                    {text: 'Large', value: '4'}, 
                                                                                    {text: 'Small', value: '2'},   
                                                                                    {text: 'X Small', value: '1'}, 
                                                                                    ]},
                    ],
                    onsubmit: function(e) {
                    	shortcode = '[tb-button ';
                    	
                    	if (e.data.title != '') shortcode += 'title="' +  e.data.title + '" ';
                    	if (e.data.url != '' && e.data.url != 'http://') shortcode += 'url="' +  e.data.url + '" ';
                    	if (e.data.style != 'default') shortcode += 'style="' +  e.data.style + '" ';
                    	if (e.data.size != '3') shortcode += 'size="' +  e.data.size + '" ';    
                    	
                    	shortcode += ']'; 
                    	shortcode += editor.selection.getContent({format: 'raw'});
                    	shortcode += '[/tb-button]';
                    	
                        editor.selection.setContent(shortcode);
                    }
                });

            }
        });
    });
})();

