/**
 * 
 */
var tb_nav_button = null;
if (typeof window.tb_nav_button_disable == 'undefined') window.tb_nav_button_disable = false;
if (typeof window.tb_nav_link_button_disable == 'undefined') window.tb_nav_link_button_disable = false;
if (typeof window.tb_nav_dropdown_button_disable == 'undefined') window.tb_nav_dropdown_button_disable = false;
(function() {
    tinymce.PluginManager.add('tb_nav',function(editor, url) {
    	editor.addButton('tb_nav', {
            title : 'Add a Navbar',
            image : url+'/img/nav_icon.png',
            onPostRender: function() { 
            		tb_nav_button = this;
            		tb_nav_button.disabled(tb_nav_link_button_disable);
            	},
            onclick : function() {
            	
            	//editor.selection.setContent('[icon]');
            	
            	// Open window
                editor.windowManager.open({
                    title: 'Bootstrap Nav (see http://getbootstrap.com)',
                    body: [
                           {type: 'checkbox', name: 'collapse ', label: 'Collapse ', checked: false},
                           {type: 'checkbox', name: 'invert ', label: 'Invert ', checked: false},
                           {type: 'listbox', name: 'style', label: 'Style', 'values': [
                                                                                       {text: 'Normal', value: ''},
                                                                                       {text: 'Pill', value: 'pill'},
                                                                                       {text: 'Tabs', value: 'tabs'}
                                                                                     ]},
                           {type: 'checkbox', name: 'justified ', label: 'Justified ', checked: false},
                    ],
                    onsubmit: function(e) {
                    	shortcode = '[tb-nav ';
                    	
                    	if (e.data.collapse == true) shortcode += 'collapse="true" ';
                    	if (e.data.invert == true) shortcode += 'invert="true" ';
                    	
                    	if (e.data.style != '') shortcode += 'style="' +  e.data.style + '" ';
                    	if (e.data.justified == true) shortcode += 'justified="true" ';

                    	
                    	shortcode += ']'; 
                    	shortcode += editor.selection.getContent({format: 'raw'});
                    	shortcode += '[/tb-nav]';
                    	
                        editor.selection.setContent(shortcode);
                    }
                });

            }
        });
    	
    	editor.addButton('tb_nav_link', {
            title : 'Add a Navbar Link',
            image : url+'/img/nav_link_icon.png',
            onPostRender: function() { 
            		tb_nav_link_button = this;
            		tb_nav_link_button.disabled(tb_nav_button_disable);
            	},
            onclick : function() {
            	
            	// Open window
                editor.windowManager.open({
                    title: 'Bootstrap Nav Link (see http://getbootstrap.com)',
                    body: [
							{type: 'textbox', name: 'title', label: 'Title', value: ''},
							{type: 'textbox', name: 'url', label: 'Url', value: 'http://'},
                           {type: 'checkbox', name: 'disabled ', label: 'Disabled ', checked: false},
                    ],
                    onsubmit: function(e) {
                    	shortcode = '[tb-nav-link ';
                    	
                    	if (e.data.title != '') shortcode += 'title="' +  e.data.title + '" ';
                    	if (e.data.url != 'http://') shortcode += 'url="' +  e.data.url + '" ';
                    	
                    	if (e.data.disabled == true) shortcode += 'disabled="true" ';
                    	
                    	shortcode += ']'; 
                    	shortcode += editor.selection.getContent({format: 'raw'});
                    	shortcode += '[/tb-nav-link]';
                    	
                        editor.selection.setContent(shortcode);
                    }
                });

            }
        });

   
    editor.addButton('tb_nav_dropdown', {
        title : 'Add a Navbar Dropdown',
        image : url+'/img/nav_dropdown_icon.png',
        onPostRender: function() { 
        		tb_nav_dropdown_button = this;
        		tb_nav_dropdown_button.disabled(tb_nav_dropdown_button_disable);
        	},
        onclick : function() {
        	
        	//if a url is specified it makes it a split button
        	
        	// Open window
            editor.windowManager.open({
                title: 'Bootstrap Nav Dropdown (see http://getbootstrap.com)',
                body: [
						{type: 'textbox', name: 'title', label: 'Title', value: ''},
						{type: 'textbox', name: 'url', label: 'Url', value: 'http://'},
                        {type: 'checkbox', name: 'disabled ', label: 'Disabled ', checked: false},
                ],
                onsubmit: function(e) {
                	shortcode = '[tb-nav-dropdown ';
                	
                	if (e.data.title != '') shortcode += 'title="' +  e.data.title + '" ';
                	if (e.data.url != 'http://' || e.data.url != '' || e.data.url != '#') shortcode += 'url="' +  e.data.url + '" ';
                	
                	if (e.data.disabled == true) shortcode += 'disabled="true" ';
                	
                	shortcode += ']'; 
                	shortcode += editor.selection.getContent({format: 'raw'});
                	shortcode += '[/tb-nav-dropdown]';
                	
                    editor.selection.setContent(shortcode);
                }
            });

        }
    });
    
    });
       
    
})();

