<?php
namespace toebox\plugin\inc;

abstract class BasePlugin
{
    protected $Tag = 'base';
    /**
     * filter => toebox\plugin\inc\Hook array of filters
     *
     * @since 1.0.0
     * @access protected
     * @var array $Filters Filters registered with wordpress
     */
    protected $Filters = array();
    /**
     * action => toebox\plugin\inc\Hook array of hooks 
     * 
     * @since 1.0.0
     * @access protected
     * @var array $Action Actions (hooks) registered with wordpress
     */
    protected $Action = array();
    /**
     * shortcode -> method array of shortcodes
     * 
     * @since 1.0.0
     * @access protected
     * @var array $Shortcode Filters registered with wordpress
     */
    protected $Shortcodes = array();
    /**
     * unique-key => url array of scripts
     * 
     * @since 1.0.0
     * @access protected
     * @var array $Scripts js urls to register with wordpress
     */
    protected $Scripts = array();
    /**
     * unique-key => url array of styles
     * 
     * @since 1.0.0
     * @access protected
     * @var array $Styles css urls to register with wordpress
     */
    protected $Styles = array();
    /**
     * required initialization function
     * @since 1.0.0
     * @access protected
     */
    abstract protected function Initialize();
    /**
     * execute misc functionaltiy
     * @since 1.0.0
     * @access protected
     */
    protected function Prepare()
    {
        // to be overridden
    }
    /**
     * Add a filter hook by name
     * 
     * @since 1.0.0
     * @access public
     * @param string $tag
     * @param string $callback
     * @param int $priority
     * @param int $argumemntCount
     */
    public final function AddFilter($tag, $callback, $priority = 10, $argumemntCount = 1)
    {
        $this->Filters[$tag] = new Hook($tag, $callback, $priority, $argumemntCount);
    }
    /**
     * Add action hook by name
     * 
     * @since 1.0.0
     * @access public
     * @param string $tag
     * @param string $callback
     * @param int $priority
     * @param int $argumemntCount
     */
    public final function AddAction($tag, $callback, $priority = 10, $argumemntCount = 1)
    {
        $this->Action[$tag] = new Hook($tag, $callback, $priority, $argumemntCount);
    }
    /**
     * add shortcode callback
     * 
     * @since 1.0.0
     * @param string $shortcode
     * @param string $function
     */
    public final function AddShortCode($shortcode, $method)
    {
        $this->Shortcodes[$shortcode] = $method;
    }
    /**
     * Register actions filters and shortcodes with wordpress
     */
    public final function Register()
    {
        $this->Initialize();
        $this->RegisterWordpressFilters();
        $this->RegisterWordpressActions();
        $this->RegisterWordpressShortCodes();
        $this->RegisterWordpressStyles();
        $this->RegisterWordpressScripts();
        $this->Prepare();
    }
    
    /**
     * Register filters with wordpress
     * 
     * @since 1.0.0
     * @access protected
     */
    protected final function RegisterWordpressFilters()
    {
        foreach ($this->Filters as $filter => $method)
        {
            if ($method instanceof \toebox\plugin\inc\Hook)
            {
                $this->hookFilter($method);
            }
            else
            {
                add_filter($filter, $method);
            }
        }
    }
    /**
     * register function as a filter from a Hook
     * 
     * @since 1.0.0
     * @param \toebox\plugin\inc\Hook $hook
     */
    protected final function hookFilter(\toebox\plugin\inc\Hook $hook)
    {
        $methodRefrence = (method_exists($this, $hook->Method)) ?
            array($this, $hook->Method) : $hook->Method;
        
        add_filter($hook->Tag, $methodRefrence, $hook->Priority, $hook->ArgumentCount);
    }
    /**
     * Register actions with wordpress
     * 
     * @since 1.0.0
     * @access protected
     */
    protected final function RegisterWordpressActions()
    {
        foreach ($this->Action as $action => $method)
        {
            $methodRefrence = (method_exists($this, $method->Method)) ?
                                array($this, $method->Method) : $method->Method;
            
            add_action($action,  $methodRefrence, $method->Priority, $method->ArgumentCount);
        }
    }
    
    /**
     * Register filters with wordpress
     * 
     * @since 1.0.0
     * @access protected
     */
    protected final function RegisterWordpressShortCodes()
    {
        foreach ($this->Shortcodes as $filter => $method)
        {
            $methodRefrence = (method_exists($this, $method)) ?
                                    array($this, $method) : $method;
            
            add_shortcode($filter, $methodRefrence);
        }
        
    }
    /**
     * Register styles with wordpress
     * 
     * @since 1.0.0
     * @access protected
     */
    protected final function RegisterWordpressStyles()
    {
        foreach ($this->Styles as $uid => $uri)
        {
            wp_enqueue_style($uid, $uri);
        }
    }
    /**
     * Register scripts with wordpress
     * 
     * @since 1.0.0
     * @access protected
     */
    protected final function RegisterWordpressScripts()
    {
        foreach ($this->Scripts as $uid => $uri)
        {
            wp_enqueue_script($uid, $uri);
        }
    }
    protected $defaultSetting = array(
        'title' => '',
        'label' => '',
        'type' => 'text',
        'sanitize_callback' => 'sanitize_text_field',
        'choices' => array(),
    );
    /**
     * Page Title => 
     *   Section Title => 
     *       id => {title, description, placeholder default, type, sanitize_callback}
     *       
     * settings 
     * 
     * @var array
     */
    public $Settings = array();
    public final function ProcessSettingsScreen()
    {
        foreach ($this->Settings as $page => $settingsSection)
        {
            $pageSlug = $this->LowerScore($page);
            add_theme_page($page, $page, 'edit_theme_options', $pageSlug);
            
            foreach ($settingsSection as $sectionTitle => $options)
            {
                $sectionSlug = $this->LowerScore($sectionTitle);
                add_settings_section($sectionSlug, $sectionTitle, function(){ print "<h4>$sectionTitle</h4>"; }, $pageSlug);
                
                foreach ($options as $id => $field)
                {
                    $id = $this->LowerScore($id);
                    $filteredField = array_merge($this->defaultSetting, $field, array('id' => $id, 'section' => $sectionSlug));
                    
                    add_settings_field($id, $filteredField['title'], array($this, 'RenderField'), $pageSlug, $sectionSlug, $filteredField);
                }
            }
        }
    }
    public final function RenderField(array $field)
    {
        // todo handle rendering form
        // $engine = new toebox\plugins\inc\AdminForm();
        
        $validator = (array_key_exists('sanitize_callback', $field) && !empty($field['sanitize_callback'])) ? 
                $field['sanitize_callback'] : array($this, 'ValidateSettings');
        
        register_setting($field['section'], $field['id'], $validator);
        
    }
    public final function ValidateSettings($input)
    {
        $errors = array();
        foreach ( $input AS $key => $value ) 
        {
            $settingName = (isset($this->settings[$key]['title'])) ?
                            $this->settings[$key]['title'] : $this->settings[$key]['id'];
            
            if ( $value == '' ) 
            {
                unset( $input[$key] );
            } 
            elseif ( isset( $this->settings[$key]['validator'] ) ) 
            {
                switch ( $this->settings[$key]['validator'] ) 
                {
                    case 'numeric':
                        if ( is_numeric( $value ) ) 
                        {
                            $input[$key] = intval( $value );
                        } 
                        else 
                        {
                            $errors[] = $key . ' must be a numeric value.';
                            unset( $input[$key] );
                        }
                        break;
                }
            } 
            else 
            {
                $input[$key] = strip_tags( $value );
            }
        }
        if ( count( $errors ) > 0 ) 
        {
            add_settings_error(
            $settingName,
            $this->tag,
            implode( '<br />', $errors ),
            'error');
        }
        
        return $input;
    }
    protected final function LowerScore($stringToFilter)
    {
        return preg_replace( "/[^a-z0-9_]/", "", 
                        str_replace('-', '_',
                        str_replace(' ', '_', str_tolower($stringToFilter))
                                        ));
    }
}

?>