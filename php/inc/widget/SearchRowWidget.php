<?php
namespace toebox\inc\widget;

require_once get_template_directory().'/inc/Forms.php';
require_once get_template_directory().'/inc/widget/BaseWidget.php';

class SearchRowWidget extends BaseWidget
{
    // WIDGET SETTINGS 
    /**
     * Base ID
     * @var string
     */
    public $BaseId = 'toebox_search_row_widget';
    /**
     * Friendly Widget Name
     * @var string
     */
    public $Name = 'Toebox Search Row';
    /**
     * Friendly Widget Name
     *
     * @var string
     */
    public $Description = 'A widget for displaying the search box without content wrapping around it.';
    /**
     * unique template part
     * @var string
     */
    public $TemplateName = 'search_row';
}
