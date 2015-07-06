<?php
namespace toebox\inc\widget;
require_once get_template_directory().'/inc/widget/BaseWidget.php';
require_once get_template_directory().'/inc/Walker/NavMenu/Touch.php';

class TouchMenu extends BaseWidget
{
    // WIDGET SETTINGS 
    /**
     * Base ID
     * @var string
     */
    public $BaseId = 'toebox_touch_menu_widget';
    /**
     * Friendly Widget Name
     * @var string
     */
    public $Name = 'Touch Menu';
    /**
     * Friendly Widget Name
     *
     * @var string
     */
    public $Description = 'A widget for displaying a horizontal menu in a touch friendly way.';
    /**
     * unique template part
     * @var string
     */
    public $TemplateName = 'touch_menu';
    /**
     * set defaults for this widget
     * @param array $args
     */
    public function setDefaults(&$args = array())
    {
        
        $this->defaultValue($args, 'menu_id', 0);
        $this->defaultValue($args, 'hide_on_small', '');
        $this->defaultValue($args, 'show_only_on_small', '');
        $this->defaultValue($args, 'open_on_small', '');
        $this->defaultValue($args, 'sub_text', false);
        $this->defaultValue($args, 'drop_down_icon', 'chevron-down');

    }
    
}
