<?php
namespace toebox\plugin\inc;
require_once  dirname(__FILE__) . '/core/StringTransform.php';

/**
 * class to be extended to create plugins of all sorts
 * @author alton.crossley
 *
 */
abstract class BasePlugin
{
    protected $Tag = 'base';
    /**
     * unique-key => class name array of widget classes
     * use the simple name ex: MyWidget instead of toebox\plugin\inc\widget\MyWidget
     * since the include path and namespace will be prepended
     * because of this widget classes need to be stored in inc/widget directory
     * and they must be defined in the toebox\plugin\inc\widget namespace
     * 
     * @since 1.0.0
     * @access protected
     * @var unknown
     */
    protected $Widgets = array();
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
     * List of post type templates     * 
     * post-type-key -> path to public template
     * note: post-type-key corrisponds to key in PostTypes
     * @var array
     */
    protected $PostTypeTemplates = array();
    /**
     * required initialization function
     * executed before any registering happens
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
        $this->AddAction('widgets_init', 'RegisterWidgets');
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
            else if (method_exists($this, $method))
            {
                add_filter($filter, array($this, $method));
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
     * @access public
     */
    public final function RegisterWordpressStylesAndScripts()
    {
        foreach ($this->Styles as $uid => $uri)
        {
            wp_enqueue_style($uid, $uri);
        }
        foreach ($this->Scripts as $uid => $uri)
        {
            
            if (strpos($uri, '//') === false) 
                $uri = PluginController::$PluginPublicUrl . 'js/' . $uri;
            
            wp_enqueue_script($uid, $uri);
        }
    }
    /**
     * Register styles and scripts with wordpress
     *
     * @since 1.0.0
     * @access public
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
     * Register wordpress widgets
     * 
     * @since 1.0.0
     * @access public
     */
    public final function RegisterWidgets()
    {
        static $namespace = 'toebox\\plugin\\inc\\widget\\';
        static $path = 'widget/';
        foreach ($this->Widgets as $className)
        {
            $namespacedClassName = $namespace.$className;
            
            if (!class_exists($namespacedClassName))
            {
                $classPath = PluginController::$IncPath.$path.$className.'.php';
                
                if (file_exists($classPath))
                {
                    include_once $classPath;
                }
                
            }
            //print __FUNCTION__.'<pre>registering '.htmlspecialchars(print_r($namespacedClassName, true)).'</pre>';
            register_widget($namespacedClassName);
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
        
        if (count($this->PostTypes)) add_filter("single_template", array($this, 'MapSingleTemplates'));        
    }
    /**
     * callback used as a hook to remap a template to a single post type
     * 
     * @param unknown $singleTemplate
     * @return string
     */
    public final function MapSingleTemplates($singleTemplate)
    {
        global $post;
        if (array_key_exists($post->post_type, $this->PostTypeTemplates))
        {
            $singleTemplate = PluginController::$PublicPath . 'tpl/' . $this->PostTypeTemplates[$post->post_type];
        }
        return $singleTemplate;
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
     * @param string $subject
     * @return mixed
     */
    protected final function LowerScore($subject)
    {
        return \toebox\plugin\inc\core\StringTransform::LowerScore($subject);
    }
    /**
     * protect p and br from remove function
     * @param string $subject
     * @return string
     */
    protected function preservePBR($subject)
    {
        return \toebox\plugin\inc\core\StringTransform::preservePBR($subject);
    }
    /**
     * restore p and br from preserv function
     * @param string $subject
     * @return string
     */
    protected function restorePBR($subject)
    {
        return \toebox\plugin\inc\core\StringTransform::restorePBR($subject);
    }
    /***
     * strip extra p and br tags
     *
     * @param string $subject
     * @return string
     */
    function removeBreakParagraph($subject)
    {
        return \toebox\plugin\inc\core\StringTransform::removeBreakParagraph($subject);
    }
    /**
     * removes the wp closing p at the begining of a string and
     * removes the opening p at the end of a string
     *
     * @param string $subject
     * @return string
     */
    protected function removeInverseP($subject)
    {
        return \toebox\plugin\inc\core\StringTransform::removeInverseP($subject);
    }
    /**
     * combines remove and restore p and br functions
     * @param string $subject
     * @return string
     */
    protected function removeAndRestorePBR($subject)
    {
        return \toebox\plugin\inc\core\StringTransform::removeAndRestorePBR($subject);
    }
    
    // ------------------------------------------------------------------------ SETTINGS

    /**
     * multi-level array
     *
     * page
     *   section
     *     Setting
     *
     * @var array
     */
    public $Settings = array();
    
    public function AddSetting(Setting $setting, $page = 'main', $section = 'primary')
    {
        $this->GetSettingSection($section, $page);
        $this->Settings[$page][$section][$setting->Id] = $setting;
    }
    
    public function GetSettingPage($key)
    {
        if (!array_key_exists($key, $this->Settings))
        {
            $this->Settings[$key] = array();
        }
    
        return $this->Settings[$key];
    }
    
    public function GetSettingSection($section, $page = 'main')
    {
        $pageArray = $this->GetSettingPage($page);
    
        if (!array_key_exists($section, $pageArray))
        {
            $this->Settings[$page][$section] = array();
        }
    
        return $this->Settings[$page][$section];
    }
    
    //---------------------------------------------------------------------------- FORM RENDER FUNCTIONS
    
    public function RenderCheckbox($args)
    {
        $setting = $args[0];
        $currentValue = $args[1];
    
        print \toebox\plugin\inc\core\Forms::FormatCheckbox(true, $setting->Id, $currentValue);
//         print \toebox\plugin\inc\core\Forms::FormatLabel($setting->Label, $setting->Id);
        print $setting->Description;
    
    }
    
    public function RenderInput($args)
    {
        $setting = $args[0];
        $currentValue = $args[1];
        
//         print \toebox\plugin\inc\core\Forms::FormatLabel($setting->Label, $setting->Id);
        print \toebox\plugin\inc\core\Forms::FormatTextbox($setting->Id, $currentValue);
        print $setting->Description;
    }
    
    public function RenderTextArea($args)
    {
        $setting = $args[0];
        $currentValue = $args[1];
        
//         print \toebox\plugin\inc\core\Forms::FormatLabel($setting->Label, $setting->Id);
        print \toebox\plugin\inc\core\Forms::FormatTextArea($setting->Id, $currentValue);
        print $setting->Description;
    }
        
}

?>