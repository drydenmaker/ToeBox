<?php
namespace toebox\plugin\inc;
use toebox\plugin\inc\core\StringTransform;
require_once  plugin_dir_path(__FILE__) . '/BasePlugin.php';
require_once  plugin_dir_path(__FILE__) . '/Hook.php';
require_once  plugin_dir_path(__FILE__) . '/Setting.php';
require_once  plugin_dir_path(__FILE__) . '/core/Forms.php';

class PluginController
{
    protected static $Version = '1.0.1';
    
    protected static $Plugins = array();
    
    public static $PluginInstancess = array();
    
    public static $TemplatePath;
    
    public static $IncPath;
    
    public static $PluginPath;
    
    public static $PublicPath;
    
    public static $AdminPath;
    
    public static $PluginBaseUrl;
    public static $PluginPublicUrl;
    public static $PluginAdminUrl;
    
    public static $Instance;
    
    public $PluginSlug;
    public $PluginTitle;
    
    
    
    /**
     * primary method
    */
    public static function Init($pluginClass = 'self')
    {
        self::$TemplatePath = plugin_dir_path(get_template_directory());
        
        self::$IncPath = plugin_dir_path( __FILE__ );
        
        self::$PluginPath = plugin_dir_path(realpath(self::$IncPath . '/'));
        self::$PublicPath = StringTransform::normalizeSlashes(self::$PluginPath . 'public/');
        self::$AdminPath = StringTransform::normalizeSlashes(self::$PluginPath . 'admin/');
        
        self::$PluginBaseUrl = plugin_dir_url( __FILE__ );
        self::$PluginPublicUrl = plugin_dir_url( self::$PublicPath.'.' );
        self::$PluginAdminUrl = plugin_dir_url( self::$AdminPath.'.' );
    
        $instance = new $pluginClass();
        if (!($instance instanceof PluginController)) throw new \Exception("$pluginClass does not extend PluginController");
        register_activation_hook( __FILE__, array($instance, 'Activate') );
        register_deactivation_hook( __FILE__, array($instance, 'Deactivate') );
        
        add_action('admin_menu', array($instance, 'RegisterSettingsPage'));
        add_action('admin_init', array($instance, 'ProcessSettings' ));
        
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

    public $SettingsPageTitle = "Settings";
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
        
        // only register the page if there are settings to show
        if (count($this->settings['main']['primary'] > 1) ||
                        count($this->settings['main']) > 1 ||
                        count($this->settings) > 1)
        {
            add_options_page($this->SettingsPageTitle,
                $this->SettingsPageTitle,
                $this->SettingsCapability,
                $this->PluginSlug,
                array($this, 'RenderSettingsPage'));
        }
    }
    /**
     * initialize primary settings
     */
    public function initPrimarySettings()
    {
        // OVERLOAD THIS
    }
    /**
     * initialize primary settings
     */
    public function ProcessSettings()
    {
        $this->ProcessSettingsArray($this->settings);
    }
    
    public function ProcessSettingsArray($settings)
    {
        foreach ($settings as $tabKey => $sections)
        {
        
            if ($tabKey != 'title' && is_array($sections))
                foreach ($sections as $sectionKey => $settings)
                {
                    $this->registerSettingsTabSection($tabKey, $sectionKey, $settings);
        
                    if ($sectionKey != 'title' && is_array($settings))
                        foreach($settings as $setting => $settingObj)
                        {
                            if ($setting != 'title')
                                $this->registerSettingField($setting, $settingObj, $sectionKey);
                        }
                }
        }
    }

    protected function registerSettingsTabSection($tabKey, $sectionKey, $values)
    {
        $title = (array_key_exists('title', $values)) ? $values['title'] : $sectionKey;
        
        add_settings_section($sectionKey, __( $title, 'toebox-basic' ), function() use($title){
            echo "<hr><h3>$title</h3>";
        }, $this->PluginSlug);
        
    }
   
    protected function registerSettingField($setting, \toebox\plugin\inc\Setting $settingObj, $sectionKey)
    {
        register_setting($sectionKey, $settingObj->Id);
        add_settings_field(
                        $settingObj->Id,
                        __( $settingObj->Label, 'toebox-basic' ),
                        
                        $settingObj->RenderCallBack,
                        
                        $this->PluginSlug,
                        $sectionKey,                        
                        
                        array($settingObj, get_option($settingObj->Id))
        );
        
    }
    
    public function initPluginSettings()
    {
        foreach(self::$PluginInstancess as $plugin)
        {
            $this->settings = array_merge($this->settings, $plugin->Settings);
        }
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
    protected $settings = array('main' => array('primary' => array('title' => 'Primary Settings')));
    /**
     * display the actual settings page
     */
    public function RenderSettingsPage()
    {
        if(isset($_GET['settings-updated']) && $_GET['settings-updated'])
        {
        
            // do stuff on save
        
        }
        
        include self::$AdminPath . 'tpl/settings.php';
    }
    
    public function RenderSettingsSection($key)
    {
    
    }
    
    public function addPrimarySetting(Setting $setting)
    {  
        $this->addSetting($setting);
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
    
    /**
     * includes a theme php file
     * @param string $fileName
     */
    public static function GetFileContents($fileName, $args = array())
    {
        ob_start();
    
        require self::$PluginPath . '/' . self::GetThemeRelativeFileName($fileName);
    
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    /**
     * reduces a absolute file name to a path relative to the theme root
     * @param string $fileName
     * @return string
     */
    public static function GetThemeRelativeFileName($fileName)
    {
        return str_replace(
                        str_replace('\\', '/', self::$PluginPath), null,
                        str_replace('\\', '/', $fileName));
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