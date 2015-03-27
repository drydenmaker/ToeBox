<?php
namespace toebox\inc\widget;

require_once get_template_directory().'/inc/widget/BaseWidget.php';

class HeaderLogoWidget extends BaseWidget
{
    // WIDGET SETTINGS 
    /**
     * Base ID
     * @var string
     */
    public $BaseId = 'toebox_header_logo_widget';
    /**
     * Friendly Widget Name
     * @var string
     */
    public $Name = 'Toebox Header with Logo';
    /**
     * Friendly Widget Name
     *
     * @var string
     */
    public $Description = 'A widget for displaying a typical wordpress blog name and description with a logo.';
    /**
     * unique template part
     * @var string
     */
    public $TemplateName = 'header_logo';
    /**
     * set defaults for this widget
     * @param array $args
     */
    public function setDefaults(&$args = array())
    {
        
        $this->defaultValue($args, 'logo', '');
        $this->defaultValue($args, 'logo_style', '');
        $this->defaultValue($args, 'background', '');
        $this->defaultValue($args, 'background_style', 'no-repeat top center');
        
        $this->defaultValue($args, 'container_class', 'tb-header');
        $this->defaultValue($args, 'title_class', 'text-hide tb-title');
        $this->defaultValue($args, 'description_class', 'lead tb-description site-description');
    }
    
}
