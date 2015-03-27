<?php
namespace toebox\inc\widget;

require_once get_template_directory().'/inc/Forms.php';
require_once get_template_directory().'/inc/widget/BaseWidget.php';

class HeaderWidget extends BaseWidget
{
    // WIDGET SETTINGS 
    /**
     * Base ID
     * @var string
     */
    public $BaseId = 'toebox_header_widget';
    /**
     * Friendly Widget Name
     * @var string
     */
    public $Name = 'Toebox Header';
    /**
     * Friendly Widget Name
     *
     * @var string
     */
    public $Description = 'A widget for displaying a typical wordpress blog name and description.';
    /**
     * unique template part
     * @var string
     */
    public $TemplateName = 'header';
}
