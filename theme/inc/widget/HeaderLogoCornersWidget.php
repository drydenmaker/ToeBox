<?php
namespace toebox\inc\widget;

require_once get_template_directory().'/inc/widget/BaseWidget.php';

class HeaderLogoCornersWidget extends BaseWidget
{
    // WIDGET SETTINGS
    /**
     * Base ID
     * @var string
     */
    public $BaseId = 'toebox_header_corners_widget';
    /**
     * Friendly Widget Name
     * @var string
     */
    public $Name = 'Toebox Header Split';
    /**
     * Friendly Widget Name
     *
     * @var string
     */
    public $Description = 'A widget for displaying a typical wordpress blog name and description with logo and sub logo.
                             It floats the name/logo left and the description/sublogo right.';
    /**
     * unique template part
     * @var string
     */
    public $TemplateName = 'header_corners';
    
    /**
     * set defaults for this widget
     * @param array $args
     */
    public function setDefaults(&$args = array())
    {
        $this->defaultValue($args, 'logo', 'http://');
        $this->defaultValue($args, 'logo_style', '');
        $this->defaultValue($args, 'sub_logo', 'http://');
        $this->defaultValue($args, 'sub_logo_style', '');
        $this->defaultValue($args, 'background', 'http://');
        $this->defaultValue($args, 'container_class', 'tb-header tb-title-corners');
        $this->defaultValue($args, 'background_style', 'no-repeat top middle');
    
        $this->defaultValue($args, 'title_class', 'text-hide tb-title');
        $this->defaultValue($args, 'description_class', 'tb-description site-description pull-right text-right');
    }
}

