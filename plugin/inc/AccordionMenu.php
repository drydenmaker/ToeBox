<?php
namespace toebox\plugin\inc;
use toebox\plugin\inc\BasePlugin;
/**
 * this class is dependent on toebox\plugin\inc\BootstrapShortcodes
 * @author alton.crossley
 *
 */
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
        'tb-accordion' => 'ExpandAccordion',
        'tb-accordion-panel' => 'ExpandAccordionPanel',
    );

    protected $ShorCodeNamespace = '';


    public static $AccordionCount = 0;
    public static $AccordionName = 'none';
    
    function ExpandAccordion($attirbutes, $content = '&nbsp;')
    {
        static $defaults = array(
            'class' => 'panel-group',
            'id' => 'accordion'
        );
        
        $defaults['id'] .= '-'.++self::$AccordionCount;
        
        if (!empty($attirbutes['class'])) $attirbutes['class'] .= ' ' . $defaults['class'];
        
        $attirbutes = shortcode_atts($defaults, $attirbutes, 'tb_accordion');
        
        // NAME CONTENT
        $panelNameTemp = self::$AccordionName;
        self::$AccordionName = $attirbutes['id'];
        $content = do_shortcode($content);
        // -- reset
        self::$AccordionName = $panelNameTemp;
        self::$PanelCount = 0;
        
        $filteredAttributes = array_diff_key($attirbutes, array_flip(array(
            'title'
        )));
        
        return $this->removeAndRestorePBR(sprintf('<div role="tablist" aria-multiselectable="true" %1$s>%2$s</div>
                        ', $this->getNodeAttributes($filteredAttributes), $content));
        
        
    }
    
    public static $PanelCount = 0;
    public static $PanelName = 'none';
    
    function ExpandAccordionPanel($attirbutes, $content = '&nbsp;')
    {
        static $defaults = array(
            'title' => 'More...',
            'style' => 'default',
            'id' => 'panel',
            'expanded' => 'false',
            'center_text' => false,
            'caret' => false,
            'glyph' => '',
            'icon_position' => 'right'
        );
        
        
        if (self::$AccordionName == 'none') 
            return '<div class="alert alert-warning alert-dismissible" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <code>tb-accordion-panel</code> can only be used within a <code>tb-accordion</code> &nbsp; !
                    </div>';
        
        
        $attirbutes = shortcode_atts($defaults, $attirbutes, 'tb_accordion');
        
        $title = $attirbutes['title'];
        
        $attirbutes = array_map('strtolower', $attirbutes);
        $title_class = ($attirbutes['center_text']) ? 'text-center' : null ;
        if (!empty($attirbutes['class']) ) $class .=  ' '.$attirbutes['class'];
        
        $icon = ($attirbutes['caret']) ? '<span class="caret"></span>' : BootstrapShortcodes::$Instance->ExpandIcon($attirbutes);
        
        return sprintf('
                        <div class="panel panel-%7$s">
                            <div class="panel-heading" role="tab" id="%1$s-heading-%2$s">
                              <h4 class="panel-title %5$s">
                                <a data-toggle="collapse" data-parent="#%3$s" href="#%1$s-collapse-%2$s" aria-expanded="%4$s" aria-controls="%1$s-collapse-%2$s">
                                <span>&nbsp;'
                                .$title. '
                                &nbsp;</span>  %6$s
                            </a>
                          </h4>
                        </div>
                        <div id="%1$s-collapse-%2$s" class="panel-collapse collapse" role="tabpanel" aria-labelledby="%1$s-heading-%2$s">
                            <div class="panel-body">'
                                                .$this->preservePBR($this->removeInverseP(do_shortcode(trim($content)))).
                            '</div>
                        </div>
                      </div>',
                                $attirbutes['id'], ++self::$PanelCount, self::$AccordionName, $attirbutes['expanded'],
                            $title_class, $icon, $attirbutes['style'] );
    
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
