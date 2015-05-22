<?php
namespace toebox\plugin\inc;
use toebox\plugin\inc\BasePlugin;

class BootstrapShortcodes extends BasePlugin
{
    /**
     * plugin constructor saves this latest instance to $Instance
     */
    function __construct()
    {
        self::$Instance = $this;
    }
    
    public function Initialize()
    {
        // do setup here
    }
    /**
     * (non-PHPdoc)
     * @see \toebox\plugin\inc\BasePlugin::AdminEditorInit()
     */
    public function AdminEditorInit()
    {    
        add_filter('mce_buttons', function($buttons)
        {
            array_push($buttons, 'separator', "tb_icon", 'separator', "tb_button", 'separator', "tb_nav",'separator', 
                            "tb_nav_link", 'separator', "tb_nav_dropdown", 'separator', "tb_show_xs", 'separator', "tb_hide_xs");
            return $buttons;
        });
    
        add_filter('mce_external_plugins', function($plugin_array)
        {
            $plugin_array['tb_icon'] = plugin_dir_url( __FILE__ ) . '../admin/js/toebox_icon_tmce.js';
            $plugin_array['tb_button'] = plugin_dir_url( __FILE__ ) . '../admin/js/toebox_button_tmce.js';
            $plugin_array['tb_nav'] = plugin_dir_url( __FILE__ ) . '../admin/js/toebox_nav_tmce.js';
            $plugin_array['tb_show_hide_xs'] = plugin_dir_url( __FILE__ ) . '../admin/js/toebox_show_hide_xs_tmce.js';
            return $plugin_array;
        });
    }
    /**
     * filter => toebox\plugin\inc\Hook array of filters
     *
     * @since 1.0.0
     * @access protected
     * @var array $Filters Filters registered with wordpress
     */
    protected $Filters = array(
        'the_title' => 'do_shortcode',
        'widget_text' => 'do_shortcode',
        'the_excerpt' => 'do_shortcode'
    );
    
    protected $Shortcodes = array(
        'tb-button' => 'ExpandButton',
        'tb-imgmedia-object' => 'ExpandImgmediaBlock',
        'tb-badge' => 'ExpandBadge',
        'tb-jumbotron' => 'ExpandJumbotron',
        'tb-thumbnail-content' => 'ExpandThumbnailContent',
        'tb-hr-link' => 'ExpandHrLink',
        'tb-icon' => 'ExpandIcon',
        'tb-hide-xs' => 'ExpandHideXSmall',
        'tb-show-xs' => 'ExpandShowXSmall',
        'tb-nav' => 'ExpandNav',
        'tb-nav-link' => 'ExpandNavLink',
        'tb-nav-dropdown' => 'ExpandNavDropdown',
    );

    protected $ShorCodeNamespace = '';
    
    function ExpandHideXSmall($attirbutes, $content = '&nbsp;')
    {
        return sprintf('<span  class="hidden-xs">%s</span>', do_shortcode(trim($content)));
    }
    function ExpandShowXSmall($attirbutes, $content = '&nbsp;')
    {
        $class = 'tb-hr-link clearfix';
        static $defaults = array(
            'display' => 'inline',
        );
        
        // combine and filter attributes
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_show_xs'));
        
        return sprintf('<span  class="visible-xs-inline">%2$s</span>', $attirbutes['display'], do_shortcode(trim($content)));
    }

    function ExpandBadge($attirbutes, $content = '&nbsp;')
    {
        return sprintf('<span class="badge">%s</span>', trim($content));
    }

    function ExpandJumbotron($attirbutes, $content = '&nbsp;')
    {
        return sprintf('<div  class="jumbotron">%s</div >', do_shortcode(trim($content)));
    }
    
    function ExpandHrLink($attirbutes, $content = '')
    {

        $content = 	do_shortcode($this->removeBreakParagraph(trim($content)));
                
        $class = 'tb-hr-link clearfix';
        static $defaults = array(
            'url' => '#',
            'class' => 'bg-primary',
        );
        
        // combine and filter attributes
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_hr_link'));
        
        $link = (array_key_exists('href', $attirbutes)) ? $attirbutes['href'] : $attirbutes['url'];
                
        $attirbutes['class'] = $class . ' ' . $attirbutes['class'];
        
        $filteredAttributes = array_diff_key($attirbutes, array_flip(array(
            'url',
            'href'
        )));
        
        return sprintf('<div %2$s> <a href="%1$s"> %3$s </a> </div>', $link, $this->getNodeAttributes($filteredAttributes), do_shortcode($content));
    }
    
    function ExpandIcon($attirbutes)
    {
        static $defaults = array(
            'glyph' => 'asterisk',
        );
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_icon'));
        $icon = $attirbutes['glyph'];
        
        $return = sprintf('<span aria-hidden="true" class="glyphicon glyphicon-%s"></span>', trim(str_replace('"', '', $icon) ));

        return $return;
    }
    

    function ExpandNav($attirbutes, $content = '')
    {
        static $defaults = array(
            'collapse' => false,
            'justified' => false,
            'invert' => 'false',
            'style' => '',
            'class' => ''
        );
        $class = "navbar navbar-";
        
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_nav'));
        
        // SETUP CLASS
        $class .= ($attirbutes['invert'] == 'false' ) ? 'default' : 'inverse';
        if (!empty($attirbutes['style']) ) $class .=  ' nav-'.$attirbutes['style'];
        if ($attirbutes['justified']) $class .=  ' nav-justified';
        if (!empty($attirbutes['class']) ) $class .=  ' '.$attirbutes['class'];
        
        
        $filteredAttributes = array_diff_key($attirbutes, array_flip(array(
            'style',
            'justified',
            'class',
            'invert',
        )));
        
        $attrs = $this->getNodeAttributes($filteredAttributes);
        
        $return = sprintf('<nav class="%1$s" %2$s>%3$s</nav>', $class, $attrs, do_shortcode($this->removeBreakParagraph($content)));
    
        print __FUNCTION__.'<pre>'.htmlspecialchars(print_r($attirbutes, true)).'</pre>';
        print __FUNCTION__.'<pre>'.htmlspecialchars(print_r($return, true)).'</pre>';
    
        return $return;
    }

    function ExpandNavLink($attirbutes, $content = '')
    {
        static $defaults = array(
            'collapse' => false,
            'justified' => false,
            'invert' => 'false',
            'style' => '',
            'class' => ''
        );
        $class = "navbar navbar-";
        
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_nav'));
        
        // SETUP CLASS
        $class .= ($attirbutes['invert'] == 'false' ) ? 'default' : 'inverse';
        if (!empty($attirbutes['style']) ) $class .=  ' nav-'.$attirbutes['style'];
        if ($attirbutes['justified']) $class .=  ' nav-justified';
        if (!empty($attirbutes['class']) ) $class .=  ' '.$attirbutes['class'];
        
        
        $filteredAttributes = array_diff_key($attirbutes, array_flip(array(
            'style',
            'justified',
            'class',
            'invert',
        )));
        
        $attrs = $this->getNodeAttributes($filteredAttributes);
        
        $return = sprintf('<nav class="%1$s" %2$s>%3$s</nav>', $class, $attrs, do_shortcode($this->removeBreakParagraph($content)));
    
        print __FUNCTION__.'<pre>'.htmlspecialchars(print_r($attirbutes, true)).'</pre>';
        print __FUNCTION__.'<pre>'.htmlspecialchars(print_r($return, true)).'</pre>';
    
        return $return;
    }

    function ExpandNavDropDown($attirbutes, $content = '')
    {
        static $defaults = array(
            'glyph' => 'asterisk',
        );
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_nav_dropdown'));
        $icon = $attirbutes['glyph'];
    
        $return = sprintf('<span aria-hidden="true" class="glyphicon glyphicon-%s"></span>', trim(str_replace('"', '', $icon) ));
    
        //print __FUNCTION__.'<pre>'.htmlspecialchars(print_r($icon, true)).'</pre>';
    
        return $return;
    }

    /**
     * expands to a bootstrap button
     * 
     * @since 1.0.0
     * @param unknown $attirbutes            
     * @param string $content            
     * @return string
     */
    function ExpandButton($attirbutes, $content = 'Button')
    {
        //print __FUNCTION__.' Before<pre>'.htmlspecialchars(print_r($attirbutes, true)).'</pre>';
        
        $content = do_shortcode(trim($content));
        
        $class = 'btn';
        static $defaults = array(
            'url' => '#',
            'href' => '#',
            'style' => 'primary', // deafult, primary, success, info, warning, danger, link
            'size' => 3, // 1-4 (xsmall - large)
            'onclick' => '',
            'title' => '',
            'type' => 'button',
            'block' => false,
            'active' => false,
            'disabled' => '',
            'class' => ''
        );
        
        // combine and filter attributes
        $attirbutes = $yourArray = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'bootstrap_button'));
        
        // prefer href but allow url
        if (! array_key_exists('href', $attirbutes)) 
        {
            $attirbutes['href'] = $attirbutes['url'];
        }
        
        // setup classes
        $class .= ' btn-' . $attirbutes['style'];
        switch ($attirbutes['size']) {
            case 1:
            case '1':
                $class .= ' btn-xs';
                break;
            case 2:
            case '2':
                $class .= ' btn-sm';
                break;
            case 4:
            case '4':
                $class .= ' btn-lg';
                break;
            default:
                break;
        }
        
        if (array_key_exists('block', $attirbutes) && $attirbutes['block'] == 'true') {
            $class .= ' btn-block';
        }
        if (array_key_exists('active', $attirbutes) && $attirbutes['active'] == 'true') {
            $class .= ' active';
        }
        
        // append classes
        if (! array_key_exists('class', $attirbutes)) {
            $class .= ' ' . $attirbutes['class'];
        }
        
        $filteredAttributes = array_diff_key($attirbutes, array_flip(array(
            'url',
            'size',
            'block',
            'active',
            'class'
        )));
        
        $tag = "<a class='$class'";
        $tag .= $this->getNodeAttributes($filteredAttributes);
        $tag .= ">$content</a>";
        
        return $tag;
    }
    

    /**
     * expands to a media block
     * 
     * @since 1.0.0
     * @param unknown $attirbutes            
     * @param string $content            
     * @return string <example>
     *         [imgmedia-object src='/img/my.jpg' url=# heading="OOO" img_title="an image" align="middle"] ... [/imgmedia-object]
     *         </example>
     */
    function ExpandImgmediaBlock($attirbutes, $content = '&nbsp;')
    {
        static $defaults = array(
            'url' => '#',
            'src' => '',
            'style' => 'left', // deafult, primary, success, info, warning, danger, link
            'size' => 2, // 1-4 (xsmall - large)
            'img_title' => '',
            'heading' => '',
            'alignment' => 'top'
        );
        
        // combine and filter attributes
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'bootstrap_media_object'));
        
        // prefer href but allow url
        if (! array_key_exists('href', $attirbutes)) {
            $attirbutes['href'] = $attirbutes['url'];
        }
        
        $imgClass = '';
        switch ($defaults['size']) {
            case 1:
                $imgClass = 'img-xs';
                break;
            case 3:
                $imgClass = 'img-md';
                break;
            case 4:
                $imgClass = 'img-lg';
                break;
            default:
                $imgClass = 'img-sm';
        }
        
        $mediaAlignment = '';
        switch ($defaults['alignment']) {
            case 'center':
            case 'middle':
                $mediaAlignment = 'media-middle';
                break;
            case 'bottom':
                $mediaAlignment = 'media-bottom';
                break;
        }
        
        extract(array_diff_key($attirbutes, array_flip(array(
            'size',
            'url',
            'alignment'
        ))));
        
        if ($style === 'right') {
            return "
            <div class='media'>
              <div class='media-body'>
                    <h4 class='media-heading'>$heading</h4>
                    $content
              </div>
              <div class='media-right $mediaAlignment'>
                <a href='$href'>
                    <img class='media-object {$imgClass}' src='$src' alt='$img_title'>
                </a>
              </div>
            </div>
            ";
        }
        
        return "
        <div class='media'>
            <div class='media-left $mediaAlignment'>
                <a href='$href'>
                    <img class='media-object {$imgClass}' src='$src' alt='$img_title'>
                </a>
            </div>
            <div class='media-body'>
                <h4 class='media-heading'>$heading</h4>
                $content
            </div>
        </div>
        ";
    }

    function ExpandThumbnailContent($attirbutes, $content = '&nbsp;')
    {
        static $defaults = array(
            'url' => '#',
            'src' => '',
            'img_title' => '',
            'heading' => ''
        );
        // combine and filter attributes
        $attirbutes = shortcode_atts($defaults, $attirbutes, 'bootstrap_media_object');
        
        // prefer href but allow url
        if (! array_key_exists('href', $attirbutes)) {
            $attirbutes['href'] = $attirbutes['url'];
        }
        
        extract(array_diff_key($attirbutes, array_flip(array(
            'size',
            'url',
            'alignment'
        ))));
        
        return sprintf("<div class='thumbnail'>
                            <img src='$src' alt='$heading'>
                            <div class='caption'>
                                <h3>$heading</h3>
                                $content
                            </div>
                        </div>", $content);
    }
    

    function removeBreakParagraph($subject)
    {
        return str_ireplace('<br />', null, str_ireplace('<p>', null, str_ireplace('</p>', null, $subject)));
    }
    
    
    /**
     * latest instance of self
     * @var self
     */
    public static $Instance;
    /**
     * allow the rendering of a carousel programatically
     * @param unknown $attirbutes
     * @param string $content
     * @return string
     */
    public static function RenderHrLink($attirbutes, $content = '')
    {
        if (self::$Instance && self::$Instance instanceof self)
            return self::$Instance->ExpandHrLink($attirbutes, $content);
    }
}
