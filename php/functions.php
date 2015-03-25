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

toebox\inc\Toebox::InitSettings();

/**
 * init general
 */
add_action( 'init', function()
{
	add_post_type_support('page', array('excerpt', 'revisions', 'comments', 'custom-fields', 'page-attributes'));
	
	/**
	 * setup menu walker
	 */
	require_once TEMPLATEPATH.'/inc/Walker/NavMenu/Primary.php';
	add_filter( 'wp_nav_menu_args', 'toebox\\inc\\Walker\\NavMenu\\Primary::MenuArguments');
});

add_filter( 'embed_oembed_html', function ( $html, $data, $url )
{
    return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}, 10, 3 );

/**
 * Frontend styles and script
 */
add_action( 'wp_enqueue_scripts', function()
{
    wp_enqueue_style('fontawesome-style', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
    wp_enqueue_style('tb_css', get_template_directory_uri() . '/less/style.less');
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('toebox-script', get_template_directory_uri() . '/js/toebox.js', array(), false, true);
    wp_enqueue_script('toebox-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), false, true);

});// toeboxBasicEnqueueScripts

add_action( 'after_setup_theme', function()
{
	load_theme_textdomain('toebox-basic', get_template_directory() . '/languages');

	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support('post-formats', array('image', 'video', 'link', 'gallery', 'featured-story', 'carousel_link'));

	// add support custom background
	add_theme_support(
		'custom-background',
		apply_filters(
			'toebox_basic_custom_background_args',
			array(
				'default-color'          => '333',
                'default-image'          => '%1$s/images/background.jpg',
                'default-repeat'         => '%1$s/images/repeat_background.jpg',
                'default-position-x'     => 'center',
			)
		)
	);
	
	
}); // toeboxBasicSetup

add_filter('wp_link_pages_link', function($link){

    if (strstr($link, 'href') === false)
    {
        $link = "<a href='#'>{$link}</a>" ;
    }
    
    return $link;
});

add_filter('wp_link_pages', function($atts){

    $atts = str_replace("<li><a href='#'", "<li class='active'><a href='#'", $atts);

    return $atts;
});

require_once 'inc/core/less.php'; 
require_once 'inc/core/search.php';
require_once 'inc/core/post_status.php';
require_once 'inc/core/theme_settings.php';
require_once 'inc/core/upload_mimes.php';
require_once 'inc/core/featured_story_post_type.php';
require_once 'inc/core/carousel_post_type.php';
require_once 'inc/core/widgets.php';
require_once 'inc/core/bootstrap_shortcodes.php';