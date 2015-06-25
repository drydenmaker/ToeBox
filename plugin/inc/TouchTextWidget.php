<?php
namespace toebox\plugin\inc;
use toebox\plugin\inc\BasePlugin;

class TouchTextWidget extends BasePlugin
{
    protected $Widgets = array(
        'TouchTextMenu'
    );
    
    function __construct()
    {
        self::$Instance = $this;
    }
    
    public function Initialize()
    {
        // do setup here
    }
    
    function ExpandMenu($attirbutes)
    {
        return 'TouchText Menu';
    }

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
}
