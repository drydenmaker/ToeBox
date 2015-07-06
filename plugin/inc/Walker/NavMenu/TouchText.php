<?php
namespace toebox\plugins\inc\Walker\NavMenu;
require_once plugin_dir_path(__FILE__).'/AbstractMenu.php';


class TouchText extends AbstractMenu
{
    /** -------------------------------------------------------  TO EXTEND */
    /**
     * switch weather or not to allow hover
     * @var bool
     */
    public $openOnHover = false;
    public $WrapTemplate = 'touch_text_menu_wrap';
    /**
     * supply the markup that wraps the menu
     * must contain %3$s for the menu itself
     *
     * @param array $args
     * @return mixed
     */
    function GetItemWrap($args)
    {
        $wrap = parent::GetItemWrap($args);
        return str_replace('tb-navbar-collapse', 'tb-navbar-touchtext-' . self::$foeMenuId,
                        str_replace('<!-- NAVTEXT -->', '<!-- NAVTEXT CC -->', $wrap));
    }
    
    /**
     * Open a level element
     * 
     * @param int $depth
     * @param array $args
     * @return string
     */
    public function StartLevel($depth = 0, $args = array())
    {
        return '<ul class="dropdown-menu'.(($depth) ? ' sub-dropdown': '').'" lvl>';
    }
    /**
     * end a level element
     * 
     * @param number $depth
     * @param unknown $args
     * @return string
     */
    public function EndLevel($depth = 0, $args = array())
    {
        return "</li>\n";
    }
    /**
     * opens an element
     *
     * @param string $id
     * @param string $class_names
     * @return string
     */
    private function StartElement($id, $class_names)
    {
        return sprintf('<li %1$s %2$s>',
                        $id ? 'id="' . esc_attr($id) . '"' : '',
                        $class_names ? 'class="' . esc_attr($class_names) . '"' : '');
    }
    
    public function StartLeafElement($item, $depth = 0, $args = array(), $id = 0)
    {
    
        $class_names = $this->GetClass($item, $depth, $args);
    
        // create id
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        if (isset($args->sub_text) && $args->sub_text) $title .= $this->GetSubTitle($item);
    
        $atts = array();
//         $atts['title'] = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['title'] = $title;
        $atts['target'] = ! empty($item->target) ? $item->target : '';
        $atts['rel'] = ! empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = ! empty($item->url) ? $item->url : '';
    
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
    
        $item_output = $this->FormatElement($item, $args, $atts);
    
        return $this->StartElement($id, $class_names) . apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    public static $ChevronTop = '<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>';
    
    public function StartBranchElement($item, $depth = 0, $args = array(), $id = 0)
    {
        
        
        $class_names = $this->GetClass($item, $depth, $args);
    
        // create id
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
    
        $atts = array();
        $atts['title'] = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = ! empty($item->target) ? $item->target : '';
        $atts['rel'] = ! empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = ! empty($item->url) ? $item->url : '$item->href';
        
        $toggle = 'dropdown dropdown-toggle';
        $baseclass = '';
        
        if ($depth)
        {
            $toggle = 'dropdown tb-dropdown-toggle';
        }
               
        
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);  
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        
        // TODO: account for second level menu
        // and side chevron on click
        // make sure click event flows down
        // test collapsed secondary menu

        // decide if the link should be split
        if ($atts['href'] != '#')
        {
            $title .= '<a href="#" class="'. $toggle .'" '.
                        'data-toggle="dropdown" aria-expanded="false">'.
                        $this->GetDropDownIcon($args->drop_down_icon).
                        '</a>';
            
            if (isset($args->sub_text) && $args->sub_text) $title .= $this->GetSubTitle($item);
            
            $item_output = $this->FormatElementRaw($title, $args, $atts);
            
        }
        else 
        {
            $title .= ' &nbsp; ' . $this->GetDropDownIcon($args->drop_down_icon);
            
            if (isset($args->sub_text) && $args->sub_text) $title .= $this->GetSubTitle($item);
            
            $atts['data-toggle'] = "dropdown" ;
            $atts['aria-expanded'] = "false";
            $atts['class'] = $toggle;
                
            $item_output = $this->FormatElementRaw(
                                    $title, 
                                    $args, 
                                    $atts);
        }
    
        return $this->StartElement($id, $class_names) . apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    
    public function getArgument($args, $argname)
    {
        if (is_array($args) && array_key_exists($argname, $args))
        {
            return $args[$argname];
        }
        else if (is_object($args))
        {
            return $args->$argname;
        }
        return null;
    }
    
    /**
     * close an element
     * 
     * @param object $element
     * @param int $depth
     * @param array $args
     * @return string
     */
    public function EndElement($element, $depth = 0, $args = array() )
    {
        return "</li>";
    }
    
    /**
     * close an element
     *
     * @param object $element
     * @param int $depth
     * @param array $args
     * @return string
     */
    public function EndBranchElement($element, $depth = 0, $args = array() )
    {
        return "</li>";
    }
    
    
    
    /** -------------------------------------------------------  INTERNALS */

    var $db_fields = array(
        'parent' => 'menu_item_parent',
        'id' => 'db_id'
    );
    
    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth. It is possible to set the
     * max depth to include all depths, see walk() method.
     *
     * This method shouldn't be called directly, use the walk() method instead.
     *
     * @since 2.5.0
     *
     * @param object $element
     *            Data object
     * @param array $children_elements
     *            List of elements to continue traversing.
     * @param int $max_depth
     *            Max depth to traverse.
     * @param int $depth
     *            Depth of current element.
     * @param array $args
     * @param string $output
     *            Passed by reference. Used to append additional content.
     * @return null Null on failure with no changes to parameters.
     */
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
        $id_field = $this->db_fields['id'];

        if (is_array($args) && array_key_exists(0, $args) && is_object($args[0])){
            $args[0]->has_children = ! empty($children_elements[$element->$id_field]);
        }

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
    
    /**
     *
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output
     *            Passed by reference. Used to append additional content.
     * @param object $item
     *            Menu item data object.
     * @param int $depth
     *            Depth of menu item. Used for padding.
     * @param int $current_page
     *            Menu item ID.
     * @param object $args
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {

        if ($args->has_children)
        {
            $this->elements[] = 'item-branch-' . $item->ID;
            $output .= $this->StartBranchElement($item, $depth, $args, $id);
        }
        else
        {
            $this->elements[] = 'item-leaf-' . $item->ID;
            $output .= $this->StartLeafElement($item, $depth, $args, $id);
        }
    }
    
    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a manu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     *
     */
    public static function Fallback( $args )
    {
        if ( current_user_can( 'manage_options' ) )
    	{
            
            $item = new \stdClass();
            $item->title = __( 'Add a menu', 'toebox-basic' );
            $item->ID = 0;
            $item->url = admin_url( 'nav-menus.php' );
            $item->menu_item_parent = 0;
            
            $elements = array($item);
            $walker = new self();
            
            $id_field = $walker->db_fields['id'];
            $item->$id_field = 'ID';

            
            $walkerArgs = array( $elements, 1, $args );
            $menu = call_user_func_array( array($walker, 'walk'), $walkerArgs );
            
            print sprintf($walker->GetItemWrap($args), null, null, $menu);
                
        }
        else
        {
            echo '<!-- no menu -->';
        }
    }
    /**
     * Ends the element output, if needed.
     *
     * @see Walker::end_el()
     *
     * @since 0.0.1
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Page data object. Not used.
     * @param int    $depth  Depth of page. Not Used.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= $this->EndElement( $item, $depth, $args);
    }
    
    /**
     *
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output
     *            Passed by reference. Used to append additional content.
     * @param int $depth
     *            Depth of page. Used for padding.
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= $this->StartLevel($depth, $args);
    }
    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker::end_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "</ul>\n";
    }
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

    
    /**
     * extract class string from element
     * 
     * @param item
     * @param depth
     * @param args
     */
    protected function GetClass($element, $depth, $args)
    {
        $classes = empty($element->classes) ? array() : (array) $element->classes;
        $classes[] = 'menu-item-' . $element->ID;
        $classes[] = 'menu-level-' . $depth;
        $classes[] = 'menu-' . $element->post_name;
        
        if ($element->has_children) $classes[] = 'dropdopwn';
        
        $classes = $this->processSmallClasses($element, $classes, $args);
            
        $classes = $this->HandleElCssClasses($classes, $element, $args, $depth);
        return join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $element, $args, $depth));
    }
        
    /**
     * convert associative array to attribute string
     * 
     * @param array $attributes name => value list of attributes
     * @return string
     */
    private function GetAttributeString($attributes)
    {
        $attributesString = '';
        foreach ($attributes as $attr => $value) {
            if (! empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributesString .= ' ' . $attr . '="' . $value . '"';
            }
        }
    
        return $attributesString;
    }
}