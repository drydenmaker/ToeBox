<?php
namespace toebox\inc\Walker\NavMenu;

class Bare extends Primary
{
    /**
     * supply the markup that wraps the menu
     * must contain %3$s for the menu itself
     *
     * @param array $args
     * @return mixed
     */
    function GetItemWrap($args)
    {
        return '<div class="%2$s %1$s"><ul> %3$s </ul></div>';
    }
    /**
     * format subtitle for display if enabled
     *
     * @param string $title
     * @return string
     */
    public function FormatSubTitle($title)
    {
        return  "<div>{$title}</div>";
    }
    /**
     * Open a level element
     *
     * @param int $depth
     * @param array $args
     * @return string
     */
    public function StartLevel($depth = 0, $args = array())
    {
        return '<ul lvl>';
    }
    /**
     * opens an element
     *
     * @param string $id
     * @param string $class_names
     * @return string
     */
    private function StartElement($id, $class_names)
    {
        return sprintf('<li %1$s el>',
                        $id ? 'id="' . esc_attr($id) . '"' : '',
                        $class_names ? 'class="' . esc_attr($class_names) . '"' : '');
    }
}

