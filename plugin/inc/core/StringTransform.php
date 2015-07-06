<?php
namespace toebox\plugin\inc\core;


class StringTransform
{

    /**
     * filter a string and add lowerscores in place of spaces
     *
     * @param string $stringToFilter
     * @return mixed
     */
    static function LowerScore($stringToFilter)
    {
        return preg_replace( "/[^a-z0-9_]/", "",
                        str_replace('-', '_',
                                        str_replace(' ', '_', strtolower($stringToFilter))
                        ));
    }
    /**
     * protect p and br from remove function
     * @param string $subject
     * @return string
     */
    static function preservePBR($subject)
    {
        return str_ireplace('<br />', '[br]', str_ireplace('<p>', '[p]', str_ireplace('</p>', '[/p]', $subject)));
    }
    /**
     * restore p and br from preserv function
     * @param string $subject
     * @return string
     */
    static function restorePBR($subject)
    {
        return str_ireplace('[br]','<br />', str_ireplace( '[p]','<p>', str_ireplace( '[/p]','</p>', $subject)));
    }
    /***
     * strip extra p and br tags
     *
     * @param string $subject
     * @return string
     */
    static function removeBreakParagraph($subject)
    {
        return str_ireplace('<br />', null, str_ireplace('<p>', null, str_ireplace('</p>', null, $subject)));
    }
    /**
     * removes the wp closing p at the begining of a string and
     * removes the opening p at the end of a string
     *
     * @param string $subject
     * @return string
     */
    static function removeInverseP($haystack)
    {
        static $start = '</p>';
        static $end = '<p>';
        // start
        if(substr(strtolower($haystack),0, strlen($start))===$start) $haystack = substr($haystack, strlen($start));
    
        // end
        if(substr(strtolower($haystack), -strlen($end))===$end) $haystack = substr($haystack, 0, (strlen($haystack)-strlen($end)));
    
        return $haystack;
    }
    /**
     * combines remove and restore p and br functions
     * @param string $subject
     * @return string
     */
    static function removeAndRestorePBR($subject)
    {
        return self::removeInverseP(self::restorePBR(self::removeBreakParagraph($subject)));
    }
    /**
     * changes slash direction to leaning forward
     * @param string $path path to normalize slashes in
     * @return string
     */
     static function normalizeSlashes($path)
     {
         return str_replace('\\', '/', $path);
     }
    
}