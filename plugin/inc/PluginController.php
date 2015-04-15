<?php
namespace toebox\plugin\inc;

class PluginController
{
    protected static $TagSpace = 'toebox_plgin';
    
    protected static $Version = '1.0.1';
    
    protected static $Plugins = array();
    
    public static $TemplatePath;
    
    public static $IncPath;
    
    public static $PluginPath;
    
    public static $PublicPath;
    
    public static $AdminPath;
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
        register_activation_hook( __FILE__, array($instance, 'Activate') );
        register_deactivation_hook( __FILE__, array($instance, 'Deactivate') );
    
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
    
    public function LoadPlugins()
    {
        foreach (self::$Plugins as $className)
        {
            require_once sprintf('%1$s\%2$s.php', plugin_dir_path(__FILE__), $className);
            $fullClassName = '\\toebox\\plugin\\inc\\' . $className;
            $instance = new $fullClassName();
            $this->hookinPlugin($instance);
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
}