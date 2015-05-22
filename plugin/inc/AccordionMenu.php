<?php
namespace toebox\plugin\inc;
use toebox\plugin\inc\BasePlugin;

class AccordionMenu extends BasePlugin
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
    
    protected $Shortcodes = array(
        'tb-accordion-menu' => 'ExpandMenu',
    );

    protected $ShorCodeNamespace = '';

    function ExpandMenu($attirbutes)
    {
        return 'Accordion Menu';
    }

    /**
     * latest instance of self
     * @var self
     */
    public static $Instance;
    /**
     * allow the rendering of a hr programatically
     * @param unknown $attirbutes
     * @param string $content
     * @return string
     */
    public static function Render($attirbutes)
    {
        if (self::$Instance && self::$Instance instanceof self)
            return self::$Instance->ExpandMenu($attirbutes, $content);
    }
}
