<?php
/**
 * toebox ToeBox theme
 * 
 * @package ToeBox
 */
require_once 'inc/ToeBox.php';

/**
 * Required WordPress variable.
 */
if (!isset($content_width)) {
	$content_width = 1170;
}


if (!function_exists('toeboxBasicSetup')) {
	/**
	 * Setup theme and register support wp features.
	 */
	function toeboxBasicSetup() 
	{
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * 
		 * copy from underscores theme
		 */
		load_theme_textdomain('toebox-basic', get_template_directory() . '/languages');

		// add theme support post and comment automatic feed links
		add_theme_support('automatic-feed-links');

		// enable support for post thumbnail or feature image on posts and pages
		add_theme_support('post-thumbnails');

		// add support menu
		register_nav_menus(array(
			'primary' => __('Primary Menu', 'toebox-basic'),
		));

		// add post formats support
		add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

		// add support custom background
		add_theme_support(
			'custom-background', 
			apply_filters(
				'toebox_basic_custom_background_args', 
				array(
					'default-color' => 'ffffff', 
					'default-image' => ''
				)
			)
		);
	}// toeboxBasicSetup
}
add_action('after_setup_theme', 'toeboxBasicSetup');


if (!function_exists('toeboxBasicWidgetsInit')) {
	/**
	 * Register widget areas
	 */
	function toeboxBasicWidgetsInit() 
	{
	    register_sidebar(array(
    	    'name'          => __('Content Top', 'toebox-basic'),
    	    'description'   => __('Appears on all pages before content between sidebars.', 'toebox-basic'),
    	    'id'            => 'toebox-content-top',
    	    'before_widget' => '',
    	    'after_widget'  => '',
    	    'before_title'  => '',
    	    'after_title'   => '',
	    ));

		register_sidebar(array(
			'name'          => __('Content Bottom', 'toebox-basic'),
			'description'   => __('Appears on all pages after content between sidebars.', 'toebox-basic'),
			'id'            => 'toebox-content-bottom',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		));
		
		register_sidebar(array(
    		'name'          => __('Left Sidebar Top', 'toebox-basic'),
    		'description'   => __('Appears on all pages that have a left sidebar at the top of the left sidebar.', 'toebox-basic'),
    		'id'            => 'toebox-left-sidebar-top',
    		'before_widget' => '',
    		'after_widget'  => '',
    		'before_title'  => '',
    		'after_title'   => '',
		));
		
		register_sidebar(array(
    		'name'          => __('Left Sidebar Bottom', 'toebox-basic'),
    		'id'            => 'toebox-left-sidebar-bottom',
    		'description'   => __('Appears on all pages that have a left sidebar at the bottom of the left sidebar.', 'toebox-basic'),
    		'before_widget' => '',
    		'after_widget'  => '',
    		'before_title'  => '',
    		'after_title'   => '',
		));
		
		register_sidebar(array(
    		'name'          => __('Right Sidebar Top', 'toebox-basic'),
    		'description'   => __('Appears on all pages that have a right sidebar at the top of the right sidebar.', 'toebox-basic'),
    		'id'            => 'toebox-right-header-top',
    		'before_widget' => '',
    		'after_widget'  => '',
    		'before_title'  => '',
    		'after_title'   => '',
		));
		
		register_sidebar(array(
    		'name'          => __('Right Sidebar Bottom', 'toebox-basic'),
    		'description'   => __('Appears on all pages that have a right sidebar at the bottom of the right sidebar.', 'toebox-basic'),
    		'id'            => 'toebox-right-header-bottom',
    		'before_widget' => '',
    		'after_widget'  => '',
    		'before_title'  => '',
    		'after_title'   => '',
		));
		
		register_sidebar(array(
    		'name'          => __('Header', 'toebox-basic'),
    		'description'   => __('Appears on all pages before all content.', 'toebox-basic'),
    		'id'            => 'toebox-header',
    		'before_widget' => '',
    		'after_widget'  => '',
    		'before_title'  => '',
    		'after_title'   => '',
		));
		
		register_sidebar(array(
    		'name'          => __('Footer', 'toebox-basic'),
    		'description'   => __('Appears on all pages after all content.', 'toebox-basic'),
    		'id'            => 'toebox-footer',
    		'before_widget' => '',
    		'after_widget'  => '',
    		'before_title'  => '',
    		'after_title'   => '',
		));

	}// toeboxBasicWidgetsInit
}
add_action('widgets_init', 'toeboxBasicWidgetsInit');


if (!function_exists('toeboxBasicEnqueueScripts')) {
	/**
	 * Enqueue scripts & styles
	 */
	function toeboxBasicEnqueueScripts() 
	{
		wp_enqueue_style('toebox-style', get_template_directory_uri() . '/css/toebox.min.css');
		wp_enqueue_style('toebox-theme-style', get_template_directory_uri() . '/css/toebox-theme.min.css');
		wp_enqueue_style('fontawesome-style', '//maxcdn.toeboxcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

		wp_enqueue_script('jquery');
		wp_enqueue_script('toebox-script', get_template_directory_uri() . '/js/toebox.js');
		
	}// toeboxBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'toeboxBasicEnqueueScripts');
