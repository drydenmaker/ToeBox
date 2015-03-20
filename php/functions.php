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


/**
 * init general
 */
add_action( 'init', function()
{
    toebox\inc\Toebox::InitSettings();
	add_post_type_support('page', array('excerpt', 'revisions', 'comments', 'custom-fields', 'page-attributes'));
	
	$WPLessPlugin = WPLessPlugin::getInstance();
	if (WP_DEBUG) $WPLessPlugin->processStylesheets();
	$WPLessPlugin->dispatch();
	
	/**
	 * setup menu walker
	 */
	require_once TEMPLATEPATH.'/inc/Walker/NavMenu/Primary.php';
	add_filter( 'wp_nav_menu_args', 'toebox\\inc\\Walker\\NavMenu\\Primary::MenuArguments');
});

add_filter( 'embed_oembed_html', function ( $html, $data, $url )
{

//     $arr = get_defined_vars();
//     print 'embed_oembed_html<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';
    
    
//     if ( FALSE !== strpos( $url, 'deviantart.com' ) ) {
//         return $html . '<br/>Author: ' . $data->author_name;
//     }
    return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}, 10, 3 );

add_filter( 'oembed_dataparse', function ( $html, $data, $url )
{

//     $arr = get_defined_vars();
//     print 'oembed_dataparse<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';


    //     if ( FALSE !== strpos( $url, 'deviantart.com' ) ) {
    //         return $html . '<br/>Author: ' . $data->author_name;
    //     }
    return $html;
}, 10, 3 );

// add_filter('nav_menu_link_attributes', function($atts = array()){

//     $arr = get_defined_vars();
//     print 'link_attributes<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';
    
    
//     // alter links
//     return $atts;
// });

// add_filter('nav_menu_attr_title', function($atts = array()){

//     $arr = get_defined_vars();
//     print 'titl<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';


//     // alter links
//     return $atts;
// });

// add_filter('nav_menu_description', function($atts = array()){

//     $arr = get_defined_vars();
//     print 'description<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';


//     // alter links
//     return $atts;
// });

// add_filter('nav_menu_meta_box_object', function($atts = array()){

//     $arr = get_defined_vars();
//     print 'box_object<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';


//     // alter links
//     return $atts;
// });

    


add_action( 'after_setup_theme', function()
{
	load_theme_textdomain('toebox-basic', get_template_directory() . '/languages');

	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support('post-formats', array('image', 'video', 'link', 'featured-story'));

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



/**
 * Register widget areas
 */
add_action( 'widgets_init', function()
{
    // --------------  WIDGETS ---------------------------------------------
    require_once 'inc/widget/HeaderLogoCornersWidget.php';
    require_once 'inc/widget/HeaderLogoWidget.php';    
    require_once 'inc/widget/HeaderWidget.php';
    require_once 'inc/widget/SearchRowWidget.php';
    
    register_widget( 'toebox\inc\widget\HeaderLogoWidget' );
    register_widget( 'toebox\inc\widget\HeaderLogoCornersWidget' );
    register_widget( 'toebox\inc\widget\HeaderWidget' );
    register_widget( 'toebox\inc\widget\SearchRowWidget' );

    // --------------  WIDGET AREAS -------------------------------------------

    register_sidebar(array(
        'name'          => __('Global Header', 'toebox-basic'),
        'description'   => __('Appears on all pages before all content.', 'toebox-basic'),
        'id'            => 'toebox-header',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!--',
        'after_title'   => '-->',
    ));

    register_sidebar(array(
        'name'          => __('Global Footer', 'toebox-basic'),
        'description'   => __('Appears on all pages after all content.', 'toebox-basic'),
        'id'            => 'toebox-footer',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!--',
        'after_title'   => '-->',
    ));


    register_sidebar(array(
        'name'          => __('Left Sidebar', 'toebox-basic'),
        'description'   => __('Appears on all pages that have a left sidebar.', 'toebox-basic'),
        'id'            => 'toebox_left_sidebar',
        'before_widget' => '<div class="tb_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));


	register_sidebar(array(
		'name'          => __('Right Sidebar', 'toebox-basic'),
		'description'   => __('Appears on all pages that have a right sidebar.', 'toebox-basic'),
		'id'            => 'toebox_right_sidebar',
        'before_widget' => '<div class="tb_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
	));


    register_sidebar(array(
	    'name'          => __('Content Top', 'toebox-basic'),
	    'description'   => __('Appears on all pages before content between sidebars.', 'toebox-basic'),
	    'id'            => 'toebox_content_top',
        'before_widget' => '<div class="tb_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

	register_sidebar(array(
		'name'          => __('Content Bottom', 'toebox-basic'),
		'description'   => __('Appears on all pages after content between sidebars.', 'toebox-basic'),
		'id'            => 'toebox_content_bottom',
        'before_widget' => '<div class="tb_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
	));

});


add_action( 'wp_enqueue_scripts', function()
{
//     wp_enqueue_style('toebox-style', get_template_directory_uri() . '/css/toebox.min.css');
//     wp_enqueue_style('toebox-theme-style', get_template_directory_uri() . '/css/toebox-theme.min.css');
    wp_enqueue_style('tb_css', get_template_directory_uri() . '/less/style.less');
    wp_enqueue_style('fontawesome-style', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

	wp_enqueue_script('jquery');
	wp_enqueue_script('toebox-script', get_template_directory_uri() . '/js/toebox.js', array(), false, true);
	wp_enqueue_script('toebox-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), false, true);
	
	

});// toeboxBasicEnqueueScripts


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



require_once 'inc/core/search.php'; 
require_once 'inc/core/post_status.php';
require_once 'inc/core/theme_settings.php';
require_once 'inc/core/upload_mimes.php';
require_once 'inc/core/featured_story_post_type.php';


require_once 'vendor/autoload.php';
require_once 'vendor/oncletom/wp-less/bootstrap-for-theme.php';
