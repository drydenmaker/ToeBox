<?php
namespace toebox\plugin\inc;
/**
 * class for specifying settings
 * @author alton.crossley
 *
 */
class Setting
{
    /**
     * plugin unique key for the setting
     * @var string
     */
    public $Id;
    /**
     * default value for setting
     * @var mixed
     */
    public $DefaultValue;
    /**
     * lable displayed in settings form
     * @var string
     */
    public $Label;
    /**
     * type of control to use in a settings form
     * text|url|email|select|checkbox|radio
     * @var string
     */
    public $Type;
    /**
     * callback for rendering input fields from the settings form
     * @var string|function
     */
    public $RenderCallBack;
    /**
     * whitelist filter of values
     * @var array of mixed
     */
    public $Choices = array();
    /**
     * description of setting value
     * @var string
     */
    public $Description;

    function __construct()
    {
        
    }
    /**
     * factory
     * 
     * @param unknown $id
     * @param string $label
     * @param string $type
     * @param mixed $default
     * @param string|function $renderCallback
     */
    public static function Create($id, $label, $type, $default, $renderCallback, $description = null)
    {
        $instance = new self();
        $instance->Id = $id;
        $instance->Label = $label;
        $instance->Type = $type;
        $instance->DefaultValue = $default;
        $instance->RenderCallBack = $renderCallback;
        
        $instance->Description = $description;
        
        return $instance;
    }
}