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
}

?>