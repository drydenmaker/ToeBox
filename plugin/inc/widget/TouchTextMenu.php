<?php
namespace toebox\plugin\inc\widget;
require_once plugin_dir_path(__FILE__).'/BaseWidget.php';
require_once plugin_dir_path(__FILE__).'../Walker/NavMenu/TouchText.php';

class TouchTextMenu extends BaseWidget
{
    // WIDGET SETTINGS 
    /**
     * Base ID
     * @var string
     */
    public $BaseId = 'toebox_touch_text_menu_widget';
    /**
     * Friendly Widget Name
     * @var string
     */
    public $Name = 'Touch Menu with extra text fields.';
    /**
     * Friendly Widget Name
     *
     * @var string
     */
    public $Description = 'A responsive widget for displaying a horizontal menu in a touch friendly way. 
                    It has a place for arbitrary text that supports short codes.';
    /**
     * unique template part
     * @var string
     */
    public $TemplateName = 'touch_text_menu';

    /**
     * allow the persistance of html
     * @var array of string
     */
    public $PreserveHtml = array('extra_text', 'extra_header_text');
    /**
     * set defaults for this widget
     * @param array $args
     */
    public function setDefaults(&$args = array())
    {
        $this->defaultValue($args, 'menu_id', 0);
        $this->defaultValue($args, 'background', '');
        $this->defaultValue($args, 'hide_on_small', '');
        $this->defaultValue($args, 'show_only_on_small', '');
        $this->defaultValue($args, 'open_on_small', '');
        $this->defaultValue($args, 'drop_down_icon', 'chevron-down');
        $this->defaultValue($args, 'extra_header_text', '');
        $this->defaultValue($args, 'extra_header_text_strip_p', true);
        $this->defaultValue($args, 'extra_text', '');
        $this->defaultValue($args, 'extra_text_strip_p', true);
        $this->defaultValue($args, 'sub_text', false);
        $this->defaultValue($args, 'container_class', '');
        $this->defaultValue($args, 'anamate_width', true);       

    }
    
}
