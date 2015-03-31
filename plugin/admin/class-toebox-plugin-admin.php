<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://gettobox.com
 * @since      1.0.0
 *
 * @package    Toebox_Plugin
 * @subpackage Toebox_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Toebox_Plugin
 * @subpackage Toebox_Plugin/admin
 * @author     Alton Crossley <ac@gettobox.com>
 */
class Toebox_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The snake cased version of plugin ID for making hook tags.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $snake_cased_plugin_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->snake_cased_plugin_name = $this->sanitize_snake_cased( $plugin_name );

	}

	/**
	 * Sanitize a string key.
	 *
	 * Lowercase alphanumeric characters and underscores are allowed.
	 * Uppercase characters will be converted to lowercase.
	 * Dashes characters will be converted to underscores.
	 *
	 * @access   private
	 * @param  string 	$key 	String key
	 * @return string 	     	Sanitized snake cased key
	 */
	private function sanitize_snake_cased( $key ) {

		return str_replace( '-', '_', sanitize_key( $key ) );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'postbox' );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/toebox-plugin-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '_carousel_mce', plugin_dir_url( __FILE__ ) . 'js/toebox_carousel_tmce.js', array( 'jquery' ), $this->version, false );
		

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
	
	    add_menu_page(
	    __( 'Plugin Name', $this->plugin_name ),
	    __( 'Plugin Name', $this->plugin_name ),
	    'manage_options',
	    $this->plugin_name,
	    array( $this, 'display_plugin_admin_page' )
	    );
	
	    $tabs = Plugin_Name_Settings_Definition::get_tabs();
	
	    foreach ( $tabs as $tab_slug => $tab_title ) {
	
	        add_submenu_page(
	        $this->plugin_name,
	        $tab_title,
	        $tab_title,
	        'manage_options',
	        $this->plugin_name . '&tab=' . $tab_slug,
	        array( $this, 'display_plugin_admin_page' )
	        );
	    }
	
	    remove_submenu_page( $this->plugin_name, $this->plugin_name );
	}
	
	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 * @return   array 			Action links
	 */
	public function add_action_links( $links ) {
	
	    return array_merge(
	                    array(
	                        'settings' => '<a href="' . admin_url( 'admin.php?page=' . $this->plugin_name ) . '">' . __( 'Settings', $this->plugin_name ) . '</a>'
	                    ),
	                    $links
	    );
	
	}
	
	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
	
	    $tabs = Plugin_Name_Settings_Definition::get_tabs();
	
	    $default_tab = Plugin_Name_Settings_Definition::get_default_tab_slug();
	
	    $active_tab = isset( $_GET[ 'tab' ] ) && array_key_exists( $_GET['tab'], $tabs ) ? $_GET[ 'tab' ] : $default_tab;
	
	    include_once( 'partials/' . $this->plugin_name . '-admin-display.php' );
	
	}
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Toebox_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Toebox_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/toebox-plugin-admin.css', array(), $this->version, 'all' );

	}

	
}
