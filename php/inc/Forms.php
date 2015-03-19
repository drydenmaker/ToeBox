<?php
namespace toebox\inc;

/**
 * toebox forms encapsulation
 * @author drydenmaker
 *
 */
class Forms
{
    /**
     * the path from theme root and file prefix
     * @var string
     */
    public static $FormTemplatePrefix = '/forms/';

    /**
     * output a form template
     * @param string $formName
     */
    public static function Display($formName, array $extras = array())
    {
        foreach ($extras as $var => $value)
        {
            $$var = $value;
        }
        include TEMPLATEPATH.self::$FormTemplatePrefix . $formName . '.php';
    }
    
    public static function FormatSelect($options, $name, $value)
    {
        ob_start();
        include TEMPLATEPATH.self::$FormTemplatePrefix . '/control_selectbox.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public static function FormatCheckbox($checkedValue, $name, $value)
    {
        ob_start();
        include TEMPLATEPATH.self::$FormTemplatePrefix . '/control_checkbox.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public static function FormatColorPicker($name, $value)
    {
        $id = str_replace(']', '', str_replace('[', '', $name));
        
        ob_start();
        include TEMPLATEPATH.self::$FormTemplatePrefix . '/control_colorpicker.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

?>