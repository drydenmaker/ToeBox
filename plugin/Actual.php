<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://gettobox.com
 * @since             1.0.0
 * @package           toebox_plugin
 *
 * @wordpress-plugin
 * Plugin Name:       WP-ToeBox
 * Description:       To compliment a Bootstrap based theme, this plugin offers two new post types and shortcodes to go along with them.
 * Version:           1.0.1
 * Author:            Alton Crossley
 * Author URI:        http://gettobox.com
 * License:           MIT
 * License URI:       http://opensource.org/licenses/MIT
 * Text Domain:       toebox-plugin
 * Domain Path:       /languages
 */
namespace toebox\plugin;
use toebox\plugin\inc\PluginController;
require_once  plugin_dir_path(__FILE__) . 'inc/PluginController.php';
require_once  plugin_dir_path(__FILE__) . 'inc/BasePlugin.php';
require_once  plugin_dir_path(__FILE__) . 'inc/Hook.php';

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Actual extends \toebox\plugin\inc\PluginController
{
    const TOEBOX_PRIMARY_SETTINGS_TAB = 'primary';
    const TOEBOX_CAROUSEL_SETTINGS_TAB = 'carousel';
    const TOEBOX_FEATURED_SETTINGS_TAB = 'featured';
        
}

PluginController::RegisterPlugin('BootstrapShortcodes');
PluginController::RegisterPlugin('FeaturedStoryPostType');
PluginController::RegisterPlugin('CarouselPostType');
PluginController::Init('\toebox\plugin\Actual');


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-toebox-plugin-activator.php
 */
// function activate_plugin_name() {
// 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-toebox-plugin-activator.php';
// 	Toebox_Plugin_Activator::activate();
// }

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-toebox-plugin-deactivator.php
 */
// function deactivate_plugin_name() {
// 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-toebox-plugin-deactivator.php';
// 	Toebox_Plugin_Deactivator::deactivate();
// }

// register_activation_hook( __FILE__, 'activate_plugin_name' );
// register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
// require plugin_dir_path( __FILE__ ) . 'includes/class-toebox-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
// function run_plugin() {

// 	$plugin = new Toebox_Plugin();
// 	$plugin->run();

// }
// run_plugin();
