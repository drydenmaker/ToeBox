<?php
namespace toebox\inc\widget;

class TitleWidget extends \WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        parent::__construct(
			'toebox_title_widget', // Base ID
			__( 'Toebox Title', 'text_domain' ), // Name
			array( 'description' => __( 'A Widget for Displaying The Blog Title', 'text_domain' ), ) // Args
		);
    }

    public static $TemplatePrefix = '/tpl/widget_';

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        // outputs the content of the widget
        include TEMPLATEPATH.self::$TemplatePrefix . 'title.php';
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance
     *            The widget options
     */
    public function form($instance)
    {
        toebox\inc\Form::Display('title_widget', $instance);
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance
     *            The new options
     * @param array $old_instance
     *            The previous options
     */
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved
    }
}

?>