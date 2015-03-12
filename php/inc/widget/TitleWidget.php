<?php
namespace toebox\inc\widget;

require_once TEMPLATEPATH.'/inc/Forms.php';
require_once TEMPLATEPATH.'/inc/widget/BaseWidget.php';

class TitleWidget extends BaseWidget
{
    // WIDGET SETTINGS 
    /**
     * Base ID
     * @var string
     */
    public $BaseId = 'toebox_title_widget';
    /**
     * Friendly Widget Name
     * @var string
     */
    public $Name = 'Toebox Title';
    /**
     * Friendly Widget Name
     *
     * @var string
     */
    public $Description = 'A widget for displaying a typical wordpress blog title';
    /**
     * unique template part
     * @var string
     */
    public $TemplateName = 'title';

    
    function admin_setup(){
    
        wp_enqueue_media();
        wp_enqueue_script('tpw-admin-js', get_template_directory_uri() . '/js/toebox_admin.js');
        wp_enqueue_style('tpw-admin-js', get_template_directory_uri() . '/css/toebox_admin.css');
    
    }


    /**
     * set defaults for this widget
     * @param array $args
     */
    public function setDefaults(&$args = array())
    {
        $this->defaultValue($args, 'logo_style', '');
        $this->defaultValue($args, 'background_style', 'no-repeat top center');
        
        $this->defaultValue($args, 'container_class', 'tb-header');
        $this->defaultValue($args, 'title_class', 'text-hide tb-title');
        $this->defaultValue($args, 'description_class', 'lead tb-description site-description');
    }
    /**
     * sets a value in an array if it is not already set
     * @param array $array target array
     * @param string $key array key
     * @param unkown $default value to set
     */
    public function defaultValue(&$array, $key, $default)
    {
        if (array_key_exists($key, $array) && $array[$key]) return $array;
        $array[$key] = $default;
        return $array;
    }
    
}
