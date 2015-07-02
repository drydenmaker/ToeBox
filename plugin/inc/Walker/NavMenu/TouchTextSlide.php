<?php
namespace toebox\plugins\inc\Walker\NavMenu;
require_once plugin_dir_path(__FILE__).'/TouchText.php';


class TouchTextSlide extends TouchText
{

    public $WrapTemplate = 'touch_text_slide_menu_wrap';
    /**
     * handle setup and output of a wp nav menu
     *
     * @param array $args
     * @return mixed
     */
    public static function HandleMenu($args = array())
    {
        return wp_nav_menu(self::MenuArguments($args));
    }
    /**
     * 
     * @param unknown $args
     */
    public static function MenuArguments($args = array())
    {
        $args['container'] = 'nav';
        if (empty($args['walker']))
        {
            $args['container_class'] = 'tb-nav navbar navbar-default ' .
                            ((array_key_exists('container_class', $args)) ? $args['container_class']:'') ;
    
            $args['menu_class'] = 'nav navbar-nav';
            $args['fallback_cb'] = 'toebox\\inc\\Walker\\NavMenu\\Primary::Fallback';
            $args['walker'] = new self();
        }
    
        $args['items_wrap'] = $args['walker']->GetItemWrap($args);
    
        return apply_filters('nav_menu_walker_arguments', $args);
    }

}