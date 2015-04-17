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
     * unique-key => url array of scripts
     *
     * @since 1.0.0
     * @access protected
     * @var array $Scripts js urls to register with wordpress
     */
    protected $AdminScripts = array();
    /**
     * unique-key => url array of styles
     * 
     * @since 1.0.0
     * @access protected
     * @var array $Styles css urls to register with wordpress
     */
    protected $Styles = array();
    /**
     * unique-key => url array of styles
     *
     * @since 1.0.0
     * @access protected
     * @var array $Styles css urls to register with wordpress
     */
    protected $AdminStyles = array();
    /**
     * List of post types to register
     * uique-key => post type array
     * @see register_post_type for array format
     * @var array
     */
    protected $PostTypes = array();
    /**
     * required initialization function
     * @since 1.0.0
     * @access protected
     */
    abstract protected function Initialize();
    /**
     * execute misc functionaltiy after registering everything
     * @since 1.0.0
     * @access protected
     */
    protected function Prepare()
    {
        // to be overridden
    }
    /**
     * Register actions filters and shortcodes with wordpress
     * 
     * @since 1.0.0
     */
    public final function Register()
    {
        $this->Initialize();
        $this->RegisterWordpressFilters();
        $this->RegisterWordpressShortCodes();

        $this->AddAction('init', 'RegisterPostTypes');
        $this->AddAction('wp_enqueue_scripts', 'RegisterWordpressStylesAndScripts');
        $this->AddAction('admin_init', 'AdminInitialize');
        $this->RegisterWordpressActions();

        $this->Prepare();
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
     * Register styles and scripts with wordpress
     * 
     * @since 1.0.0
     * @access protected
     */
    public final function RegisterWordpressStylesAndScripts()
    {
        foreach ($this->Styles as $uid => $uri)
        {
            wp_enqueue_style($uid, $uri);
        }
        foreach ($this->Scripts as $uid => $uri)
        {
            wp_enqueue_script($uid, $uri);
        }
    }
    /**
     * Register styles and scripts with wordpress
     *
     * @since 1.0.0
     * @access protected
     */
    public final function RegisterWordpressAdminStylesAndScripts()
    {
        foreach ($this->AdminStyles as $uid => $uri)
        {
            wp_enqueue_style($uid, $uri);
        }
        foreach ($this->AdminScripts as $uid => $uri)
        {
            wp_enqueue_script($uid, $uri);
        }
    }
    /**
     * register post types with wordpress
     * 
     * @since 1.0.0
     */
    public final function RegisterPostTypes()
    {
        foreach($this->PostTypes as $uid => $params)
        {
            register_post_type($uid, $params);
        }
    }
    /**
     * admin initialize scripts styles and hooks
     * 
     * @since 1.0.0
     */
    public final function AdminInitialize()
    {
        add_action( 'admin_menu', array($this, 'RegisterWordpressAdminStylesAndScripts'));
        
        if (current_user_can('edit_posts') &&  current_user_can('edit_pages'))
        {
            $this->AdminEditorInit();
        }
    }
    /**
     * admin editor plugins
     * 
     * @since 1.0.0
     */
    public function AdminEditorInit() 
    { 
        // override and put your functionality here 
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
    /**
     * Process settings array and create settings screen
     */
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
    /**
     * 
     * 
     * @param array $field
     */
    public final function RenderField(array $field)
    {
        // todo handle rendering form
        // $engine = new toebox\plugins\inc\AdminForm();
        
        $validator = (array_key_exists('sanitize_callback', $field) && !empty($field['sanitize_callback'])) ? 
                $field['sanitize_callback'] : array($this, 'ValidateSettings');
        
        register_setting($field['section'], $field['id'], $validator);
        
    }
    /**
     * validate settings using settings definition
     * 
     * @param array $input
     * @return array
     */
    public final function ValidateSettings(array $input)
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
    /**
     * get 
     * @param string $templateName the plugin/theme relative path
     * @return string
     */
    protected final function getTemplateOutput($templatePath, $vars)
    {
        extract($vars);
         
        $templatePaths = array(
            PluginController::$TemplatePath . $templatePath,
            PluginController::$IncPath . $templatePath,
            PluginController::$PluginPath . $templatePath,
            PluginController::$PublicPath . $templatePath
        );
        
        // get a suggested template path
        $slug = trim(str_replace('.php', null, basename($templatePath)));
        $name = null;
        do_action( "get_template_part_{$slug}", $slug, $name );
        $name = (string) $name;
        if ( '' !== $name ) $templatePaths[] = "{$slug}-{$name}.php";
        // add a last ditch file
        $templatePaths[] = locate_template("{$slug}.php");
        
        ob_start();
        foreach($templatePaths as $fileName)
        {
            $cleanName = realpath($fileName);
            if ($cleanName)
            {
                include $cleanName;
                break;
            }
        }
        
        $output = ob_get_contents();
        ob_end_clean();
        
        return $output;
    }
    /**
     * return a string that can be output as the attributes of markup
     * 
     * @param string $nodeAttributes
     * @return string
     */
    protected function getNodeAttributes($nodeAttributes)
    {
        $returnString = '';
        foreach ($nodeAttributes as $attribute => $value) 
        {
            if (! empty($value)) 
            {
                $value = ('href' === $attribute) ? esc_url($value) : esc_attr($value);
                $returnString .= sprintf(' %1$s="%2$s"', $attribute, $value);
            }
        }
        return $returnString;
    }
    
    /**
     * filter a string and add lowerscores in place of spaces
     * 
     * @param string $stringToFilter
     * @return mixed
     */
    protected final function LowerScore($stringToFilter)
    {
        return preg_replace( "/[^a-z0-9_]/", "", 
                        str_replace('-', '_',
                        str_replace(' ', '_', str_tolower($stringToFilter))
                                        ));
    }
}

?>