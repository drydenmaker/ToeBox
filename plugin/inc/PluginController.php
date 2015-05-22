<?php
namespace toebox\plugin\inc;
require_once  plugin_dir_path(__FILE__) . '/BasePlugin.php';
require_once  plugin_dir_path(__FILE__) . '/Hook.php';

class PluginController
{
    protected static $TagSpace = 'toebox_plugin';
    
    protected static $Version = '1.0.1';
    
    protected static $Plugins = array();
    
    public static $PluginInstancess = array();
    
    public static $TemplatePath;
    
    public static $IncPath;
    
    public static $PluginPath;
    
    public static $PublicPath;
    
    public static $AdminPath;
    
    public static $Instance;
    /**
     * primary method
    */
    public static function Init($pluginClass = 'self')
    {
        self::$TemplatePath = plugin_dir_path(get_template_directory());
        
        self::$IncPath = plugin_dir_path( __FILE__ );
        
        self::$PluginPath = plugin_dir_path(realpath(self::$IncPath . '/'));
        self::$PublicPath = self::$PluginPath . 'public/';
        self::$AdminPath = self::$PluginPath . 'admin/';
    
        $instance = new $pluginClass();
        if (!($instance instanceof PluginController)) throw new \Exception("$pluginClass does not extend PluginController");
        register_activation_hook( __FILE__, array($instance, 'Activate') );
        register_deactivation_hook( __FILE__, array($instance, 'Deactivate') );
        
        add_action('admin_menu', array($instance, 'RegisterSettingsPage'));
        
        $instance->LoadPlugins();
    }
    /**
     * add a class to the registry by name
     * class must in a file by the same name
     * class must be in the toebox\plugin\inc namespace
     * class must extend toebox\plugin\inc\BasePlugin
     *
     * @since 1.0.0
     * @param unknown $className
     */
    public static function RegisterPlugin($className)
    {
        self::$Plugins[] = $className;
    }
    /**
     * get an instance of a plugin
     * @param string $name
     * @return multitype:|boolean
     */
    public static function GetPluginInstance($name)
    {
        if (array_key_exists($name, self::$PluginInstancess))
        {
            return self::$PluginInstancess[$name];
        }
        return false;
    }
// ---------------------------------------------------------------------------- local vars and methods    

    public $PluginSlug = "toebox-plugin";
    public $PluginTitle = "Toebox Plugin";
    public $SettingsPageTitle = "Tobox Plugin Settings";
    public $SettingsDashIcon = "dashicons-admin-tools";
    public $SettingsCapability = 'manage_options';
    
    public function LoadPlugins()
    {
        foreach (self::$Plugins as $className)
        {
            require_once sprintf('%1$s/%2$s.php', plugin_dir_path(__FILE__), $className);
            $fullClassName = '\\toebox\\plugin\\inc\\' . $className;
            self::$PluginInstancess[$className] = new $fullClassName();
            $this->hookinPlugin(self::$PluginInstancess[$className]);
        }
    }
    
    /**
     * ensure object type when executing Register
     *
     * @since 1.0.0
     * @param toebox\plugin\inc\BasePlugin $plugin
     */
    protected function hookinPlugin(BasePlugin $plugin)
    {
        $plugin->Register();
    }
    
    public function Activate()
    {
        // Activation Code Goes Here
    }
    
    public function Deactivate()
    {
        // Deactivation Code Goes Here
    }
    /**
     * register the settings page with the wordpress admin bar
     */
    public function RegisterSettingsPage()
    {
        $this->initPrimarySettings();
        $this->initPluginSettings();
        
        add_menu_page($this->SettingsPageTitle,
            $this->PluginTitle,
            $this->SettingsCapability,
            $this->PluginSlug,
            array($this, 'RenderSettingsPage'));
    }
    /**
     * initialize primary settings
     */
    public function initPrimarySettings()
    {
        // OVERWRITE for your plugin    
    }
    public function initPluginSettings()
    {
        //TODO: cycle through plugins and get their settings
    }
    /**
     * capture the output of a lamda function
     *
     * @param callable $callback
     * @param array $parameters
     * @return string
     */
    public static function GetOutput(callable $callback, array $parameters = array())
    {
        ob_start();
    
        call_user_func_array($callback, $parameters);
    
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    //---------------------------------------------------------------------------- local settings
    /**
     * multi-level array
     * page
     *   section
     *     Setting
     * @var array
     */
    protected $settings = array('main' => array('primary' => array()));
    /**
     * display the actual settings page
     */
    public function RenderSettingsPage()
    {
        include self::$AdminPath . 'tpl/settings.php';
    }
    
    public function RenderSettingsSection($key)
    {
    
    }
    
    public function addPrimarySetting(Setting $setting)
    {
        $this->settings['main']['primary'][$setting->Id] = $setting;        
    }
    
    public function addSetting(Setting $setting, $page = 'main', $section = 'primary')
    {
        $this->GetSettingSection($section, $page);
        $this->settings[$page][$section][$setting->Id] = $setting;
    }
    
    public function GetSettingPage($key)
    {
        if (!array_key_exists($key, $this->settings))
        {
            $this->settings[$key] = array();
        }
        
        return $this->settings[$key];
    }
    
    public function GetSettingSection($section, $page = 'main')
    {
        $pageArray = $this->GetSettingPage($page);
        
        if (!array_key_exists($section, $pageArray))
        {
            $this->settings[$page][$section] = array();
        }
        
        return $pageArray[$section];
    }
    
}