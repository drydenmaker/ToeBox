<?php
namespace toebox\plugin\inc;
use toebox\plugin\inc\BasePlugin;
/**
 * plugin class to handle common bootstrap shortcodes
 *  
 * @author alton.crossley
 *
 */
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
        add_filter('mce_buttons_2', function($buttons)
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
        'tb-no-pbr' => 'NoPBR',
        'img' => 'ExpandImg',
        'div' => 'ExpandDiv',
        'search' => 'ExpandSearch',
        'search_dropdown' => 'ExpandSeachDropDown'
    );
    
    public function ExpandSearch($attirbutes = array())
    {
        $homeUrl = esc_url(home_url('/'));
        $defaults = array(
            'class' => 'form-inline search-form',
            'style' => '',
            'action' => $homeUrl,
            'method' => 'get'
        );
        
        // combine and filter attributes
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_search'));
        
        return '<form role="search" '.$this->getNodeAttributes($attirbutes).'>
                    <div class="form-group btn-group" role="group">
                        <button type="submit" class="search-submit btn btn-primary pull-right"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                		<label class="screen-reader-text sr-only" for="s">'.__( 'Search for:', 'label', 'toebox-basic').'</label>
                		<input type="search" class="search-field form-control" placeholder="'.esc_attr_x( 'Search &hellip;', 'placeholder', 'flat-bootstrap' ).'" 
                		                value="'.esc_attr( get_search_query() ).'" name="s">
                    </div>
                </form>';
        return get_search_form(false);
    }
    
    public function ExpandImg($attirbutes)
    {

        $class = '';
        static $defaults = array(
            'url' => '#',
            'class' => 'tb-image',
            'src' => '',
            'style' => ''
        );
        
        // combine and filter attributes
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_hr_link'));
        
        $link = $attirbutes['url'];
                
        $attirbutes['class'] = $class . ' ' . $attirbutes['class'];
        
        $filteredAttributes = array_diff_key($attirbutes, array_flip(array(
            'url',
            'href'
        )));
        
        $img = sprintf('<img %s />', $this->getNodeAttributes($filteredAttributes));
        
        return ($link == '#' || empty($link)) ? $img :
            sprintf('<a href="%2$s">%1$s</a>', $img, $link);
        
    }
    
    public function ExpandDiv($attirbutes, $content = '')
    {
        $content = do_shortcode($content);
        
        static $defaults = array(
        );
        
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_div'));
        
        return sprintf('<div %1$s>%2$s</div>', $this->getNodeAttributes($attirbutes), $this->removeInverseP($content));
    
    }

    public function NoPBR($attirbutes, $content)
    {
        return $this->removeBreakParagraph(do_shortcode($content));
    }
    
    protected $ShorCodeNamespace = '';
    
    function ExpandHideXSmall($attirbutes, $content = '&nbsp;')
    {
        return sprintf('<span  class="hidden-xs">%s</span>', $this->removeInverseP(do_shortcode(trim($content))));
    }
    function ExpandShowXSmall($attirbutes, $content = '&nbsp;')
    {
        $class = 'tb-hr-link clearfix';
        static $defaults = array(
            'display' => 'inline',
        );
        
        // combine and filter attributes
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_show_xs'));
        
        return sprintf('<span  class="visible-xs-inline">%2$s</span>', $attirbutes['display'], $this->removeInverseP(do_shortcode(trim($content))));
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
    
    public function ExpandIcon($attirbutes)
    {
        static $defaults = array(
            'glyph' => 'asterisk',
            'position' => '', // left, right
            'icon_position' => '', // left, right
            'url' => '#',
            'href' => '#'
        );
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_icon'));
        $icon = $attirbutes['glyph'];
        
        // allow empty icon
        if (empty($icon)) return null;
        
        $return = sprintf('<span aria-hidden="true" class="glyphicon glyphicon-%s"></span>', trim(str_replace('"', '', $icon) ));
        
        if ($attirbutes['href'] != '#' && !empty($attirbutes['href'])) 
            $attirbutes['url'] = $attirbutes['href'];
        if ($attirbutes['url'] != '#' && !empty($attirbutes['url']))
            $return = sprintf('<a href="%2$s">%1$s</a>', $return, $attirbutes['url']);
        
        if (!empty($attirbutes['position']) || !empty($attirbutes['icon_position']))
        {
            $position = (empty($attirbutes['icon_position'])) ? $attirbutes['position'] : $attirbutes['icon_position'];
            switch ($position) {
                case 'right':
                    $return = "<span class='pull-right'>{$return}</span>";
                    break;
                default:
                    $return = "<span class='pull-left'>{$return}</span>";
                    break;
            }        
        }
        
        return $return;
    }
    

    public function ExpandNav($attirbutes, $content = '')
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
        
        $return = sprintf('<nav class="%1$s" %2$s>
                        <div class="container-fluid">
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    %3$s
                                </ul>
                            </div>
                        </div>
                        </nav>', $class, $attrs, do_shortcode($this->removeBreakParagraph($content)));

        return $return;
    }

    function ExpandNavLink($attirbutes, $content = '')
    {
        static $defaults = array(
            'collapse' => false,
            'active' => false,
            'url' => '',
            'href' => '',
            'title' => '',
            'class' => ''
        );
        $class = null;
        
        $attirbutes = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'tb_nav'));
        
        // SETUP CLASS
        if (!empty($attirbutes['active']) && $attirbutes['active'])  $class .=  'active';
        if (!empty($attirbutes['class']) ) $class .=  ' '.$attirbutes['class'];
        
        if (array_key_exists('url', $attirbutes) && ! empty($attirbutes['url'])) $attirbutes['href'] = $attirbutes['url'];       
        
        
        $filteredAttributes = array_diff_key($attirbutes, array_flip(array(
            'style',
            'active',
            'class',
            'invert',
            'url',
        )));
        
        $attrs = $this->getNodeAttributes($filteredAttributes);
        
        if (!empty($class)) $class = ' class="' . $class .'"';
        
        $return = sprintf('<li><a%1$s %2$s>%3$s</a></li>', $class, $attrs, do_shortcode($this->removeBreakParagraph($content)));
    
        return $return;
    }

    function ExpandNavDropDown($attirbutes, $content = '')
    {
        static $defaults = array(
            'title' => 'More...',
        );
                
        $attirbutes = shortcode_atts($defaults, $attirbutes, 'tb_nav_dropdown');
        
        $title = $attirbutes['title'];
        
        $attirbutes = array_map('strtolower', $attirbutes);
    
        $return = "\n".'<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.
                                    $title .' <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">'.
                     do_shortcode($this->removeBreakParagraph($content)).
                    "</ul></li>\n";
    
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
            'url' => 'none',
            'href' => 'none',
            'style' => 'default', // deafult, primary, success, info, warning, danger, link
            'size' => 3, // 1-4 (xsmall - large)
            'onclick' => '',
            'title' => '',
            'type' => 'button',
            'block' => false,
            'active' => false,
            'disabled' => '',
            'class' => '',
            'css_style' => ''
        );
        
        // combine and filter attributes
        $attirbutes = $yourArray = array_map('strtolower', shortcode_atts($defaults, $attirbutes, 'bootstrap_button'));
        
        // prefer href but allow url
        if ($attirbutes['href'] == 'none' && $attirbutes['url'] == 'none') 
        {
            $attirbutes['href'] = '#';
        }
        else if ($attirbutes['href'] == 'none')
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
        if (array_key_exists('class', $attirbutes)) {
            $class .= ' ' . $attirbutes['class'];
        }
        
        $attirbutes['style'] = (isset($attirbutes['css_style'])) ? $attirbutes['css_style'] : null;
        
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
