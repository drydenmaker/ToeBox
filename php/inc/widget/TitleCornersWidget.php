<?php
namespace toebox\inc\widget;

require_once TEMPLATEPATH.'/inc/widget/TitleWidget.php';

class TitleCornersWidget extends TitleWidget
{
    // WIDGET SETTINGS
    /**
     * Base ID
     * @var string
     */
    public $BaseId = 'toebox_title_corners_widget';
    /**
     * Friendly Widget Name
     * @var string
     */
    public $Name = 'Toebox Title in Corners';
    /**
     * unique template part
     * @var string
     */
    public $TemplateName = 'title_corners';
    
    /**
     * set defaults for this widget
     * @param array $args
     */
    public function setDefaults(&$args = array())
    {
        $this->defaultValue($args, 'container_class', 'tb-header tb-title-corners');
        $this->defaultValue($args, 'background_style', 'no-repeat top middle');
    
        $this->defaultValue($args, 'title_class', 'text-hide tb-title');
        $this->defaultValue($args, 'description_class', 'tb-description site-description pull-right text-right');
    }
    

    function admin_setup(){
    
        wp_enqueue_media();
        wp_enqueue_script('tpw-admin-js', get_template_directory_uri() . '/js/toebox_admin.js');
        wp_enqueue_style('tpw-admin-js', get_template_directory_uri() . '/css/toebox_admin.css');
    
    }
}

