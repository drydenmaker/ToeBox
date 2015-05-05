<?php
namespace toebox\inc\Walker\NavMenu;

class Primary extends \Walker_Nav_Menu
{
    /** -------------------------------------------------------  TO EXTEND */
    /**
     * switch weather or not to allow hover
     * @var bool
     */
    public $openOnHover = false;
    /**
     * supply the markup that wraps the menu
     * must contain %3$s for the menu itself
     *
     * @param array $args
     * @return mixed
     */
    function GetItemWrap($args)
    {
        $term_id = (array_key_exists('menu', $args) && $args['menu'] && property_exists($args['menu'], 'term_id')) ? $args['menu']->term_id : '';
    
        return str_replace('tb-navbar-collapse', 'tb-navbar-collapse-' . $term_id,
                        str_replace('<!-- Search -->', get_search_form(false),
                                        \toebox\inc\ToeBox::GetFileContents('/tpl/menu_wrap.php')));
    }
    /**
     * 
     * @param array $classes
     * @param object $item
     * @param \stdClass $args
     * @param int $depth
     * @return unknown
     */
    public function HandleElCssClasses($classes, $item, $args = array(), $depth = 0)
    {
        if (@$args->has_children) array_unshift($classes, $this->openOnHover ? 'dropdown-hover' : 'dropdown');
        return $classes;
    }
    /**
     * format subtitle for display if enabled
     * 
     * @param string $title
     * @return string
     */
    public function FormatSubTitle($title)
    {
        return  "<div class='subtitle'>{$title}</div>";
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
        return '<ul class="dropdown-menu" lvl>';
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
    /**
     * Format an elements body
     *
     * @param object $element
     * @param stgObject $args
     * @param array $attributes
     * @return string
     */
    public function FormatElement($element, $args, $attributes = array())
    {
        $subTitle = $this->GetSubTitle($attributes);
    
        // convert attributes to a string
        $attributes = $this->GetAttributeString($attributes);
    
        $item_output = $this->getArgument($args, 'before');
        $item_output .= '<a' . $attributes . '>';
    
        $item_output .= $this->getArgument($args, 'link_before') . apply_filters('the_title', $element->title, $element->ID) . $this->getArgument($args, 'link_after');
        $item_output .= $subTitle . '</a>';
        $item_output .= $this->getArgument($args, 'after');
    
        return $item_output;
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
     * format a subtitle when settings mandate
     *
     * @param array $attributes
     * @return string
     */
    private function GetSubTitle($attributes)
    {
        $subTitle = '';
        if (\toebox\inc\Toebox::$Settings[TOEBOX_MENU_SUBTITLES]) {
            if (array_key_exists('title', $attributes)) {
                $subTitle .= $this->FormatSubTitle($attributes['title']);
                $attributes['title'] = null;
            }
        }
        return $subTitle;
    }
    /**
     * close an element
     * 
     * @param object $element
     * @param int $depth
     * @param array $args
     * @return string
     */
    private function EndElement($element, $depth = 0, $args = array() )
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
        $class_names = $this->GetClass($item, $depth, $args);
        
        // create id
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        
        $atts = array();
        $atts['title'] = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = ! empty($item->target) ? $item->target : '';
        $atts['rel'] = ! empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = ! empty($item->url) ? $item->url : '';
        

        if (@$args->has_children)
        {
            if (!$this->openOnHover)
            {
                $atts['class'] = 'dropdown-toggle';
                $atts['data-toggle'] = 'dropdown';
                $atts['aria-expanded'] = 'false';
            }

        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $item_output = $this->FormatElement($item, $args, $atts);        

        $output .= $this->StartElement($id, $class_names) . apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

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
    
    public static function MenuArguments($args = array())
    {
        //print __FUNCTION__.'<pre>'.htmlspecialchars(print_r($args, true)).'</pre>';
        
        $args['container'] = 'nav';
        if (empty($args['walker'])) 
        {
            $args['container_class'] = 'tb-nav navbar navbar-inverse';
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
    private function GetClass($element, $depth, $args)
    {
        $classes = empty($element->classes) ? array() : (array) $element->classes;
        $classes[] = 'menu-item-' . $element->ID;
    
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



// add_filter('nav_menu_link_attributes', function($atts = array()){

//     $arr = get_defined_vars();
//     print 'link_attributes<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';


//     // alter links
//     return $atts;
// });

// add_filter('nav_menu_attr_title', function($atts = array()){

//     $arr = get_defined_vars();
//     print 'titl<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';


//     // alter links
//     return $atts;
// });

// add_filter('nav_menu_description', function($atts = array()){

//     $arr = get_defined_vars();
//     print 'description<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';


//     // alter links
//     return $atts;
// });

// add_filter('nav_menu_meta_box_object', function($atts = array()){

//     $arr = get_defined_vars();
//     print 'box_object<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';


//     // alter links
//     return $atts;
// });