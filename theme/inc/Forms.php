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
    public static $FormTemplatePrefix = '/tpl/admin-forms/';

    /**
     * output a form template
     * @param string $formName
     */
    public static function Display($formName, array $extras = array())
    {
        extract($extras);
        include get_template_directory().self::$FormTemplatePrefix . $formName . '.php';
    }
    
    public static function FormatSelect($options, $name, $value)
    {
        ob_start();
        include get_template_directory().self::$FormTemplatePrefix . '/control_selectbox.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public static function FormatCheckbox($checkedValue, $name, $value)
    {
        ob_start();
        include get_template_directory().self::$FormTemplatePrefix . '/control_checkbox.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public static function FormatColorPicker($name, $value)
    {
        $id = str_replace(']', '', str_replace('[', '', $name));
        
        ob_start();
        include get_template_directory().self::$FormTemplatePrefix . '/control_colorpicker.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public static function FormatTextArea($name, $value)
    {
        ob_start();
        include get_template_directory().self::$FormTemplatePrefix . '/control_textarea.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public static function FormatTextbox($name, $value, $type = "text")
    {
        ob_start();
        include get_template_directory().self::$FormTemplatePrefix . '/control_textbox.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

?>