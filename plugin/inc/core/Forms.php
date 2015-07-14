<?php
namespace toebox\plugin\inc\core;

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
    public static $FormTemplatePrefix = '/admin/tpl/';

    /**
     * output a form template
     * @param string $formName
     */
    public static function Display($formName, array $extras = array())
    {
        extract($extras);
        include self::GetPluginTemplateDir() . $formName . '.php';
    }
    
    public static function FormatSelect($options, $name, $value)
    {
        ob_start();
        include self::GetPluginTemplateDir() . '/control_selectbox.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public static function FormatCheckbox($checkedValue, $name, $value)
    {
        ob_start();
        include self::GetPluginTemplateDir() . '/control_checkbox.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public static function FormatColorPicker($name, $value)
    {
        $id = str_replace(']', '', str_replace('[', '', $name));
        
        ob_start();
        include self::GetPluginTemplateDir() . '/control_colorpicker.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public static function GetPluginTemplateDir()
    {
        return plugin_dir_path(__FILE__) . '../../' . self::$FormTemplatePrefix;
    }
    
    public static function FormatTextArea($name, $value)
    {
        ob_start();
        include self::GetPluginTemplateDir() . '/control_textarea.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public static function FormatTextbox($name, $value, $type = "text")
    {
        ob_start();
        include self::GetPluginTemplateDir() . '/control_textbox.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public static function FormatLabel($label, $for)
    {
        ob_start();
        include self::GetPluginTemplateDir() . '/control_label.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

?>