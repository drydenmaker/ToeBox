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
    );

    protected $ShorCodeNamespace = '';

    function ExpandBadge($attirbutes, $content = '&nbsp;')
    {
        return sprintf('<span class="badge">%s</span>', $content);
    }

    function ExpandJumbotron($attirbutes, $content = '&nbsp;')
    {
        return sprintf('<div  class="jumbotron">%s</div >', $content);
    }
    
    function ExpandHrLink($attirbutes, $content = '')
    {
        $class = 'tb-hr-link clearfix';
        static $defaults = array(
            'url' => '#',
            'class' => 'bg-primary',
        );
        
        // combine and filter attributes
        $attirbutes = shortcode_atts($defaults, $attirbutes, 'tb_hr_link');
        
        $link = (array_key_exists('href', $attirbutes)) ? $attirbutes['href'] : $attirbutes['url'];
                
        $attirbutes['class'] = $class . ' ' . $attirbutes['class'];
        
        $filteredAttributes = array_diff_key($attirbutes, array_flip(array(
            'url',
            'href'
        )));
    
        return sprintf('<div %2$s> <a href="%1$s"> %3$s </a> </div>', $link, $this->getNodeAttributes($filteredAttributes), $content);
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
        $class = 'btn';
        static $defaults = array(
            'url' => '#',
            'style' => 'primary', // deafult, primary, success, info, warning, danger, link
            'size' => 3, // 1-4 (xsmall - large)
            'onclick' => 'void(0)',
            'title' => '',
            'type' => 'button',
            'block' => false,
            'active' => false,
            'disabled' => '',
            'class' => ''
        );
        
        // combine and filter attributes
        $attirbutes = shortcode_atts($defaults, $attirbutes, 'bootstrap_button');
        
        // prefer href but allow url
        if (! array_key_exists('href', $attirbutes)) {
            $attirbutes['href'] = $attirbutes['url'];
        }
        
        // setup classes
        $class .= ' btn-' . $attirbutes['style'];
        switch ($defaults['size']) {
            case 1:
                $class .= ' btn-xs';
                break;
            case 2:
                $class .= ' btn-sm';
                break;
            case 3:
                $class .= ' btn-lg';
                break;
        }
        
        if (array_key_exists('block', $attirbutes) && $attirbutes['block']) {
            $class .= ' btn-block';
        }
        if (array_key_exists('active', $attirbutes) && $attirbutes['active']) {
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
        $attirbutes = shortcode_atts($defaults, $attirbutes, 'bootstrap_media_object');
        
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
