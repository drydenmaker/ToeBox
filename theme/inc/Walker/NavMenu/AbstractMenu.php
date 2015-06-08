<?php
namespace toebox\inc\Walker\NavMenu;

abstract class AbstractMenu extends \Walker_Nav_Menu
{
    /** -------------------------------------------------------  TO EXTEND */
    
    public $WrapTemplate = 'accordion_wrap';

    public $elements = array();
    
    /**
     * Open a level element
     * 
     * @param int $depth
     * @param array $args
     * @return string
     */
    abstract function StartLevel($depth = 0, $args = array());
    
    /**
     * end a level element
     * 
     * @param number $depth
     * @param unknown $args
     * @return string
     */
    abstract function EndLevel($depth = 0, $args = array());
    
    abstract function StartLeafElement($item, $depth = 0, $args = array(), $id = 0);
    
    abstract function StartBranchElement($item, $depth = 0, $args = array(), $id = 0);    
    
    /**
     * close an element
     *
     * @param object $element
     * @param int $depth
     * @param array $args
     * @return string
     */
    abstract function EndElement($element, $args = array() , $depth = 0);
    /**
     * close an element that had branches
     *
     * @param object $element
     * @param int $depth
     * @param array $args
     * @return string
     */
    abstract function EndBranchElement($element, $args = array() , $depth = 0);
    
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
        $title = apply_filters('the_title', $element->title, $element->ID);
        
        if (isset($args->sub_text) && $args->sub_text) $title .= $this->GetSubTitle($element);
        
        return $this->FormatElementRaw($title, $args, $attributes);
    }
    
    /**
     * Format an elements body
     *
     * @param object $element
     * @param stgObject $args
     * @param array $attributes
     * @return string
     */
    public function FormatElementRaw($text, $args, $attributes = array())
    {
        // convert attributes to a string
        $attributes = $this->GetAttributeString($attributes);
    
        $item_output = $this->getArgument($args, 'before');
        $item_output .= '<a' . $attributes . '>';
    
        $item_output .= $this->getArgument($args, 'link_before') . do_shortcode($text) . $this->getArgument($args, 'link_after');
        $item_output .= '</a>';
        $item_output .= $this->getArgument($args, 'after');
    
        return $item_output;
    }
    
    /**
     * format a subtitle when settings mandate
     *
     * @param array $attributes
     * @return string
     */
    protected function GetSubTitle(\WP_Post $element)
    {
        $subTitle = '';
        
        if (isset($element->attr_title) && !empty($element->attr_title)) {
            $subTitle = $this->FormatSubTitle($element->attr_title);
        }
        
        return $subTitle;
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
    
    public $openOnHover = false;
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
    
    /** -------------------------------------------------------  INTERNALS */
    
    protected static $foeMenuId = 0;
    /**
     * supply the markup that wraps the menu
     * must contain %3$s for the menu itself
     *
     * @param array $args
     * @return mixed
     */
    function GetItemWrap($args)
    {
        
        $term_id = (array_key_exists('menu', $args) && $args['menu']) ? $args['menu'] : ++self::$foeMenuId;
    
        return str_replace('accordion_id', 'tb-accordian-' . $term_id,
                        \toebox\inc\ToeBox::GetFileContents('/tpl/'.$this->WrapTemplate.'.php'));
    }

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
     * list of sluggs to hide on small screens
     * @var unknown
     */
    public $HideOnSmall = array();
    /**
     * list of sluggs to only show on small screens
     * @var unknown
     */
    public $SowOnlyOnSmall = array();
    /**
     * list of sluggs to defalut to open on small screens
     * @var unknown
     */ 
    public $OpenOnSmall = array();
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
        
        $classes = $this->processSmallClasses($element, $classes, $args);
        
        print __FUNCTION__.'<pre>'.htmlspecialchars(print_r($classes, true)).'</pre>';
    
        $classes = $this->HandleElCssClasses($classes, $element, $args, $depth);
        return join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $element, $args, $depth));
    }
    

    protected function processSmallClasses($element, $classes, $args)
    {
       //print __FUNCTION__.'<pre>'.htmlspecialchars(print_r($args, true)).'</pre>';
        
        
        if (empty($this->SowOnlyOnSmall) && !empty($args->show_only_on_small))
            $this->SowOnlyOnSmall = array_map('trim',explode(',', strtolower($args->show_only_on_small)));
    
        if (empty($this->HideOnSmall) && !empty($args->hide_on_small))
            $this->HideOnSmall = array_map('trim',explode(',', strtolower($args->hide_on_small)));
    
        if (empty($this->OpenOnSmall) && !empty($args->open_on_small))
            $this->OpenOnSmall = array_map('trim',explode(',', strtolower($args->open_on_small)));
    
        // hide on md and lg
        $onlyOnSmall = array_diff($this->SowOnlyOnSmall, $this->HideOnSmall);
        if (in_array(strtolower($element->post_name), $onlyOnSmall)) $classes[] = 'visible-xs-block';
        // hide on small
        if (in_array(strtolower($element->post_name), $this->HideOnSmall)) $classes[] = 'hidden-xs';
        // open on small
        if (in_array(strtolower($element->post_name), $this->OpenOnSmall)) $classes[] = 'sm-open';
    
    
        return $classes;
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
    /**
     * meant to check if an array key is present and the stored value is equal
     * @param string $key key
     * @param array $array list
     * @param string $value value
     */
    protected function isArraValue($key, $array = array(), $value = true, $strict = false)
    {
        return (array_key_exists($key, $array) && ($array[$key] === $value || (!$strict && $array[$key] === $value)));
    }
}
