<?php
namespace toebox\inc\Walker\NavMenu;

class Hover extends Primary
{
    /**
     * switch weather or not to allow hover
     * @var bool
     */
    public $openOnHover = true;
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
     * handle setup of menu configuration
     *
     * @param unknown $args
     * @return mixed
     */
    public static function MenuArguments($args = array())
    {
        $defaults = array(
            'container'       => 'div',
            'container_class' => 'accordion_container_class',
            'container_id'    => '',
            'menu_class'      => 'accordion_menu',
            'menu_id'         => '',
            'echo'            => true,
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'depth'           => 0,
        );
    
        $args = array_merge($defaults, $args);
    
        // two parameters cannot be overwritten
        $walker = new self();
        $args['items_wrap'] = $walker->GetItemWrap($args);
        $args['walker'] = $walker;
        $args['fallback_cb'] = 'toebox\\inc\\Walker\\NavMenu\\Primary::Fallback';
    
        return apply_filters('nav_menu_walker_arguments', $args);
    }
}