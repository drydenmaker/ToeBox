<?php
namespace toebox\inc\widget;

require_once get_template_directory().'/inc/widget/BaseWidget.php';
require_once get_template_directory().'/inc/Walker/NavMenu/Primary.php';
require_once get_template_directory().'/inc/Walker/NavMenu/Flat.php';

class FlatMenu extends BaseWidget
{
    // WIDGET SETTINGS 
    /**
     * Base ID
     * @var string
     */
    public $BaseId = 'toebox_flat_menu_widget';
    /**
     * Friendly Widget Name
     * @var string
     */
    public $Name = 'Custom Menu Flat';
    /**
     * Friendly Widget Name
     *
     * @var string
     */
    public $Description = 'A widget for displaying a menu in columns';
    /**
     * unique template part
     * @var string
     */
    public $TemplateName = 'flat_menu';
    /**
     * set defaults for this widget
     * @param array $args
     */
    public function setDefaults(&$args = array())
    {
        
        $this->defaultValue($args, 'menu_id', 0);

    }
    
}
