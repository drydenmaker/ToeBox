<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://gettoebox.com
 * @since             1.0.0
 * @package           toebox_plugin
 *
 * @wordpress-plugin
 * Plugin Name:       WP-ToeBox
 * Description:       To compliment a Bootstrap based theme, this plugin offers two new post types and shortcodes to go along with them.
 * Version:           0.0.1
 * Author:            Alton Crossley
 * Author URI:        http://gettoebox.com
 * License:           MIT
 * License URI:       http://opensource.org/licenses/MIT
 * Text Domain:       toebox-plugin
 * Domain Path:       /languages
 */
namespace toebox\plugin;
use toebox\plugin\inc\PluginController;
use \toebox\plugin\inc\Setting;

require_once  plugin_dir_path(__FILE__) . 'inc/PluginController.php';
require_once  plugin_dir_path(__FILE__) . 'inc/Setting.php';
require_once  plugin_dir_path(__FILE__) . 'inc/core/Forms.php';

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * class used to specify settings for this plugin
 * @author alton.crossley
 *
 */
class Actual extends \toebox\plugin\inc\PluginController
{
    const TOEBOX_PRIMARY_SETTINGS_TAB = 'toebox_primary';
    const TOEBOX_CAROUSEL_SETTINGS_TAB = 'toebox_carousel';
    const TOEBOX_FEATURED_SETTINGS_TAB = 'toebox_featured';
    
    public $PluginSlug = "toebox_plugin";
    public $PluginTitle = "Toebox Plugin";
    public $SettingsPageLink = "Tobox Plugin Settings";
        
    public function initPrimarySettings()
    {
        $this->addPrimarySetting(
                   Setting::Create('enable_featured', 'Enable Featured Stories', 'checkbox', 'false', 'checkbox'));
        $this->addPrimarySetting(
                   Setting::Create('enable_carousel', 'Enable Featured Stories', 'checkbox', 'false', 'checkbox'));
        $this->addPrimarySetting(
                   Setting::Create('enable_featured', 'Enable Featured Stories', 'checkbox', 'false', 'checkbox'));

    }
        
}

PluginController::RegisterPlugin('BootstrapShortcodes');
PluginController::RegisterPlugin('FeaturedStoryPostType');
PluginController::RegisterPlugin('CarouselPostType');
PluginController::RegisterPlugin('AccordionMenu');
PluginController::RegisterPlugin('TouchTextWidget');
PluginController::RegisterPlugin('TouchTextSlideWidget');
PluginController::Init('\toebox\plugin\Actual');

