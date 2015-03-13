<?php
namespace toebox\inc\widget;

require_once TEMPLATEPATH . '/inc/Forms.php';

class BaseWidget extends \WP_Widget
{
    // WIDGET SETTINGS
    /**
     * Base ID
     *
     * @var string
     */
    public $BaseId = 'base_widget';

    /**
     * Friendly Widget Name
     *
     * @var string
     */
    public $Name = 'Base Widget';

    /**
     * Friendly Widget Name
     *
     * @var string
     */
    public $Description = 'DO NOT REGISTER';

    /**
     * unique template part
     *
     * @var string
     */
    public $TemplateName = 'base';

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        parent::__construct($this->BaseId, // Base ID
                __($this->Name, 'text_domain'), // Name
                array('description' => __($this->Description, 'text_domain')
        )); // Args
        
        add_action('sidebar_admin_setup', array(
            $this,
            'admin_setup'
        ));
    }

    function admin_setup()
    {
        wp_enqueue_media();
        wp_enqueue_script('toebox-admin-js', get_template_directory_uri() . '/js/some custom .js');
        wp_enqueue_style('toebox-admin-js', get_template_directory_uri() . '/css/some custom .css');
    }

    public $TemplatePrefix = '/tpl/widget_';

    /**
     * Outputs the content of the widget
     *
     * @param array $args            
     * @param array $instance            
     */
    public function widget($args, $instance)
    {
        $this->setDefaults($instance);
        
        foreach ($args as $var => $value) {
            $$var = $value;
        }
        foreach ($instance as $var => $value) {
            $$var = $value;
        }
        
        // outputs the content of the widget
        include TEMPLATEPATH . $this->TemplatePrefix . $this->TemplateName . '.php';
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance
     *            The widget options
     */
    public function form($instance)
    {
        $this->setDefaults($instance);
        
        $instance[widget] = $this;
        \toebox\inc\Forms::Display($this->TemplateName . '_widget_form', $instance);
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
        return $this->filterNewInstance($new_instance);
    }

    /**
     * strip tags on all values not in $ignore
     *
     * @param array $newInstance            
     * @param array $ignore            
     * @return multitype:Ambigous <string, unknown>
     */
    public function filterNewInstance(array $newInstance, array $ignore = array())
    {
        $filtered = array();
        foreach ($newInstance as $key => $value) {
            $filtered[$key] = (is_string($value) && ! in_array($key, $ignore)) ? strip_tags($value) : $value;
        }
        
        return $filtered;
    }

    /**
     * set defaults for this widget
     *
     * @param array $args            
     */
    public function setDefaults(&$args = array())
    {
        $this->defaultValue($args, 'logo_style', '');
        $this->defaultValue($args, 'background_style', 'no-repeat top center');
        
        $this->defaultValue($args, 'container_class', 'tb-header');
        $this->defaultValue($args, 'title_class', 'text-hide tb-title');
        $this->defaultValue($args, 'description_class', 'lead tb-description site-description');
    }

    /**
     * sets a value in an array if it is not already set
     *
     * @param array $array
     *            target array
     * @param string $key
     *            array key
     * @param unkown $default
     *            value to set
     */
    public function defaultValue(&$array, $key, $default)
    {
        if (array_key_exists($key, $array) && $array[$key])
            return $array;
        $array[$key] = $default;
        return $array;
    }
}
