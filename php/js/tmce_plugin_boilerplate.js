(function() {
    tinymce.create('tinymce.plugins.quote', {
        init : function(editor, url) {
        	editor.addButton('quote', {
                title : 'Add a Quote',
                image : url+'/carousel_icon.png',
                onclick : function() {
                	editor.selection.setContent('[quote]' + editor.selection.getContent() + '[/quote]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('quote', tinymce.plugins.quote);
})();