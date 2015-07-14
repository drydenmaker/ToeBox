<?php
namespace toebox\plugin\inc;
use toebox\plugin\inc\BasePlugin;

class ToeBoxAdvanced extends BasePlugin
{
    const THEME_NAME = 'ToeBox';
    /**
     * latest instance of self
     * @var self
     */
    public static $Instance;
    /**
     * allow the rendering
     * @param unknown $attirbutes
     * @param string $content
     * @return string
     */
    public static function Render($attirbutes)
    {
        // TODO: render??
    }

    function __construct()
    {
        self::$Instance = $this;
    }
    
    public function Initialize()
    {
        if (get_current_theme() == self::THEME_NAME)
        {
            $this->AddSetting(Setting::Create('toebox_more_text', '"Read More" Text', 'text', 'More...', array($this, 'RenderInput'),
                            'This is placed at the end of exerpts and when using the \'more\' tags on posts.'),
                            'Advanced', 'Text');
            
            $this->AddSetting(Setting::Create('tb-list-header', 'Title Format: List', 'textarea', '<h3><a href="{link}">{title}</a></h3>', array($this, 'RenderTextArea'),
                            'This is the format of the title when listing posts.
                            Use the following place holders <strong>{title}</strong> post title, <strong>{link}</strong> perma link, <strong>{class}</strong> extra css classes'),
                            'Advanced', 'Text');
            $this->AddSetting(Setting::Create('tb-single-header', 'Title Format: Single', 'textarea', '<h3><a href="{link}">{title}</a></h3>', array($this, 'RenderTextArea'),
                            'This is the format of the title when showing only one post.
                            Use the following place holders <strong>{title}</strong> post title, <strong>{link}</strong> perma link, <strong>{class}</strong> extra css classes'),
                            'Advanced', 'Text');
            
            $this->AddSetting(Setting::Create('extra_header', 'Header Text', 'textarea', '<!-- NO TEXT IN HEADER -->', array($this, 'RenderTextArea'),
                            'This is placed between the header tags before the body of every page. Place meta, script or css link tags here.'),
                            'Advanced', 'Text');
            $this->AddSetting(Setting::Create('extra_footer', 'Footer Text', 'textarea', '<!-- NO TEXT IN HEADER -->', array($this, 'RenderTextArea'),
                            'This is placed at the very end of the body of every page.'),
                            'Advanced', 'Text');
            
            $this->AddSetting(Setting::Create('border-radius-base', 'Default Button Radius', 'textarea', '0px', array($this, 'RenderInput'),
                            'any value other than 0 must includ px (ex 4px)'),
                            'Theme', 'Corner Radius');
            $this->AddSetting(Setting::Create('border-radius-large', 'Large Button Radius', 'textarea', '0px', array($this, 'RenderInput'),
                            'any value other than 0 must includ px (ex 6px)'),
                            'Theme', 'Corner Radius');
            $this->AddSetting(Setting::Create('border-radius-small', 'Small Button Radius', 'textarea', '0px', array($this, 'RenderInput'),
                            'any value other than 0 must includ px (ex 3px)'),
                            'Theme', 'Corner Radius');
            
            $this->AddSetting(Setting::Create('border-radius-button-base', 'Default Button Radius', 'textarea', '5px', array($this, 'RenderInput'),
                            'any value other than 0 must includ px (ex 4px)'),
                            'Theme', 'Corner Button Radius');
            $this->AddSetting(Setting::Create('border-radius-button-large', 'Large Button Radius', 'textarea', '5px', array($this, 'RenderInput'),
                            'any value other than 0 must includ px (ex 6px)'),
                            'Theme', 'Corner Button Radius');
            $this->AddSetting(Setting::Create('border-radius-button-small', 'Small Button Radius', 'textarea', '5px', array($this, 'RenderInput'),
                            'any value other than 0 must includ px (ex 3px)'),
                            'Theme', 'Corner Button Radius');
        }
    }
}