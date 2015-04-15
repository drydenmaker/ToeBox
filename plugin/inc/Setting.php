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
     * text|url|email|select
     * @var unknown
     */
    public $Type;
    /**
     * callback for filtering values from the settings form
     * @var string|function
     */
    public $SanitizeCallback;
    /**
     * whitelist filter of values
     * @var array of mixed
     */
    public $Choices = array();

    function __construct()
    {
        
    }
}