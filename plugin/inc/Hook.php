<?php
namespace toebox\plugin\inc;

/**
 * Class to describe a wordpress callback hook like filters and actions.
 * 
 * @author alton.crossley
 *        
 */
class Hook
{
    /**
     * The name of the filter to hook the callback to.
     * 
     * @since 1.0.0
     * @access public
     * @var string
     */
    public $Tag;
    /**
     * Method to be executed
     * 
     * @since 1.0.0
     * @access public
     * @var string
     */
    public $Method;
    /**
     * Priority to be executed (1-10)
     * 
     * @since 1.0.0
     * @access public
     * @var int
     */
    public $Priority;
    /**
     * Number of arguments expected by the Hook Method
     * 
     * @since 1.0.0
     * @access public
     * @var int
     */
    public $ArgumentCount;
    /**
     * constructor with assignment
     * 
     * @param string $tag
     * @param string $method
     * @param string $priority
     * @param string $argumentCount
     */
    public function __construct($tag = '', $method = '', $priority = '', $argumentCount = '')
    {
        $this->Tag = $tag;
        $this->Method = $method;
        $this->Priority = $priority;
        $this->ArgumentCount = $argumentCount;
    }
}

?>