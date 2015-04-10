<?php
namespace toebox\inc\Walker\NavMenu;

class Flat extends Bare
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
        return '<div class="%2$s panel panel-default %1$s"><ul class="nav nav-tabs nav-justified"> %3$s </ul></div>';
    }
    /**
     * format subtitle for display if enabled
     *
     * @param string $title
     * @return string
     */
    public function FormatSubTitle($title)
    {
        return  "<div class='subtitle'>&nbsp;{$title}&nbsp;</div>";
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
        static $topClass = "sub-menu-item";
        $class = ($depth) ? '' : $topClass;
        return "<ul class='$class' lvl>";
    }
}

