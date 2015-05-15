<?php
namespace toebox\inc\Walker\NavMenu;

class Accordion extends \Walker_Nav_Menu
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
        static $foeMenuId = 0;
        $term_id = (array_key_exists('menu', $args) && $args['menu']) ? $args['menu'] : ++$foeMenuId;
    
        return str_replace('accordion_id', 'tb-accordian-' . $term_id,
                                    \toebox\inc\ToeBox::GetFileContents('/tpl/accordion_wrap.php'));
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
        return $this->getPadding($depth)."\n<!-- START LEVEL --><div>";
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
        return $this->getPadding($depth)."</div><!-- END LEVEL -->\n";
    }
    
    public $elements = array();
    
    public function StartLeafElement($item, $depth = 0, $args = array(), $id = 0)
    {
        $class_names = $this->GetClass($item, $depth, $args);
        $class_names .= ' panel panel-default tb-accordion-leaf';
        
        $atts = array();
        $atts['title'] = ! empty($item->title) ? $item->title : '';
        $atts['attr_title'] = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = ! empty($item->target) ? $item->target : '';
        $atts['rel'] = ! empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = ! empty($item->url) ? $item->url : '';
        
    
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
    
        $item_output = $this->FormatElementLink($item, $args, $atts);
        
        $item_output = $this->getPadding($depth).
                    sprintf('<div %1$s el>%2$s',
                                    $class_names ? 'class="' . esc_attr($class_names) . '"' : '',
                                    $item_output);
    
        return apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    
    }
    
    public function StartBranchElement($item, $depth = 0, $args = array(), $id = 0)
    {        
        $class_names = $this->GetClass($item, $depth, $args);
        $class_names .= ' tb-accordion-branch';

        $id = end($this->elements);        
        
        $atts = array();
        $atts['attr_title'] = empty($item->attr_title) ? $item->title : $item->attr_title;
        $atts['title'] = ! empty($item->title) ? $item->title : '';
        $atts['target'] = ! empty($item->target) ? $item->target : '';
        $atts['rel'] = ! empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = ! empty($item->url) ? $item->url : '';
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $open = $this->getPadding($depth).
                    sprintf("<div %1\$s %2\$s el>",
                        $id ? 'id="' . esc_attr($id) . '"' : '',
                        $class_names ? 'class="' . esc_attr($class_names) . '"' : '');
        
        $panel = '<div class="panel panel-default">';
        
        $panel .= "<div class='panel-heading' role='tab' id='heading_{$id}e'>
                      <a data-toggle='collapse' data-parent='#accordion' href='#$id' aria-expanded='false' aria-controls='$id'>
                        <h4 class='panel-title'>
                          {$atts['attr_title']}
                        </h4>
                      </a>
                   </div>";
        
        $panel .= "
                <div id='$id' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingOne'>
                      <div class='panel-body'>
                	  ";
        
        if (!empty($item->url) && $item->url !== '#')
        {
            // add the link element
            $panel .= $this->StartLeafElement($item, $depth, $args, $id);
            $panel .= $this->EndElement($item, $args, $depth);
        }
        
        return apply_filters('walker_nav_menu_start_el', $panel, $item, $depth, $args);
//         return "{$open}BRANCH " . $depth . ' | '. count($this->elements) . ' | ' . $atts['title'];
    }
    
    
    /**
     * close an element
     *
     * @param object $element
     * @param int $depth
     * @param array $args
     * @return string
     */
    private function EndElement($element, $args = array() , $depth = 0)
    {
        return $this->getPadding($depth)."</div><!-- end element -->\n";
    }
    /**
     * close an element that had branches
     *
     * @param object $element
     * @param int $depth
     * @param array $args
     * @return string
     */
    private function EndBranchElement($element, $args = array() , $depth = 0)
    {
        $padding = $this->getPadding($depth);
        return $padding."</div>
                </div>
              </div><!-- end element -->\n";
    }
    /**
     * Format an elements body
     *
     * @param object $element
     * @param stgObject $args
     * @param array $attributes
     * @return string
     */
    public function FormatElementLink($element, $args, $attributes = array())
    {
        // convert attributes to a string
        $attributes = $this->GetAttributeString($attributes);
    
    
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
    
        $item_output .= $args->link_before . apply_filters('the_title', $element->title, $element->ID) . $args->link_after;
        
        $item_output .= '</a>';
        $item_output .= $args->after;
    
        return $item_output;
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
    
    
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
    
        $item_output .= $args->link_before . apply_filters('the_title', $element->title, $element->ID) . $args->link_after;
        $item_output .= $subTitle . '</a>';
        $item_output .= $args->after;
    
        return $item_output;
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
    public function end_el( &$output, $item, $depth = 0, $args = array() ) 
    {
        $elementId = array_pop($this->elements);
        if (strpos($elementId, '-branch-'))
        {
            $output .= $this->EndBranchElement($item, $args, $depth);
            return;
        }
        $output .= $this->EndElement($item, $args, $depth);
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
    public function end_lvl( &$output, $depth = 0, $args = array() ) 
    {
        $output .= $this->EndLevel($depth, $args);
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
        $args['fallback_cb'] = 'toebox\\inc\\Walker\\NavMenu\\Accordion::fallback';
        
        return apply_filters('nav_menu_walker_arguments', $args);
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
    public static function Fallback( $args ) {
        if ( current_user_can( 'manage_options' ) ) {
    
            extract( $args );
    
            $fb_output = null;
    
            if ( $container ) {
                $fb_output = '<' . $container;
    
                if ( $container_id )
                    echo ' id="' . $container_id . '"';
    
                if ( $container_class )
                    echo ' class="' . $container_class . '"';
    
                echo '>';
            }
    
            echo '<ul';
    
            if ( $menu_id )
                echo ' id="' . $menu_id . '"';
    
            if ( $menu_class )
                echo ' class="' . $menu_class . '"';
    
            echo '>';
            echo '<li><a href="' . admin_url( 'nav-menus.php' ) . '">' . __( 'Add a menu', 'toebox-basic' ) . '</a></li>';
            echo '</ul>';
    
            if ( $container )
                echo '</' . $container . '>';
    
            echo $fb_output;
        }
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
        static $attributeFilter = array(
            'attr_title'
        );
        $attributesString = '';
        
        foreach ($attributes as $attr => $value) {
            if (!empty($value) && !in_array($attr, $attributeFilter)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributesString .= ' ' . $attr . '="' . $value . '"';
            }
        }
    
        return $attributesString;
    }
    
    protected function getPadding($depth)
    {
        return "\n".str_repeat('  ', $depth);
    }
}
