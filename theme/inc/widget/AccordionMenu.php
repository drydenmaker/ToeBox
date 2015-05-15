<?php
namespace toebox\inc\widget;

require_once get_template_directory().'/inc/widget/BaseWidget.php';
require_once get_template_directory().'/inc/Walker/NavMenu/Primary.php';
require_once get_template_directory().'/inc/Walker/NavMenu/Accordion.php';

class AccordionMenu extends BaseWidget
{
    // WIDGET SETTINGS 
    /**
     * Base ID
     * @var string
     */
    public $BaseId = 'toebox_accordion_menu_widget';
    /**
     * Friendly Widget Name
     * @var string
     */
    public $Name = 'Accordion Menu';
    /**
     * Friendly Widget Name
     *
     * @var string
     */
    public $Description = 'A widget for displaying a menu in an accordion';
    /**
     * unique template part
     * @var string
     */
    public $TemplateName = 'accordion_menu';
    /**
     * set defaults for this widget
     * @param array $args
     */
    public function setDefaults(&$args = array())
    {
        
        $this->defaultValue($args, 'menu_id', 0);

    }
    
}
