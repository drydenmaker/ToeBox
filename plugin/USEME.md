== Plugin ==

=== Navigation Menu Widget ===
/inc/PluginMenu.php : primary plugin class
/inc/widget/PluginMenu.php : widget class
/inc/Walker/NavMenu/Plugin.php : menu walker class (registered by widget class and used in public template)
/admin/tpl/plugin_widget_form.php : form shown to configure widget
/public/tpl/widget/plugin_menu.php : template used to display widget (calls menu walker)

=== add a field to a widget ===
modify the widget form in /admin/tpl/<widgetname>_widget_form.php
add default values in /inc/widget/<widgetname>.php
pass values to walker in /public/tpl/widget/<widgetname>.php
optionally allow html by adding to $PreserveHtml in the walker in  /inc/Walker/NavMenu/<widgetname>.php
optionally use the values in the walker in /inc/Walker/NavMenu/<widgetname>.php
optionally use the variables in  /public/tpl/widget/<widgetname>_wrap.php via $args['<valuename>'] array


