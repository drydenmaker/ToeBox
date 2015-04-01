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

//print __FUNCTION__.'<pre>'.htmlspecialchars(print_r(\toebox\inc\Toebox::$Settings, true)).'</pre>';


/**
 * init general
 */
add_action( 'init', function()
{
	add_post_type_support('page', array('excerpt', 'revisions', 'comments', 'custom-fields', 'page-attributes'));
	
	/**
	 * setup menu walker
	 */
	require_once get_template_directory().'/inc/Walker/NavMenu/Primary.php';
	add_filter( 'wp_nav_menu_args', 'toebox\\inc\\Walker\\NavMenu\\Primary::MenuArguments');
	
	add_filter('wp_title', function($args){
	    
	    if (\toebox\inc\ToeBox::$Settings[TOEBOX_TITLE_SEO])
	    {
	        $args .= (strlen($args)) ? ' | ' : get_bloginfo( 'description') . ' | ';
	        $blogName = get_bloginfo('name');
	        return str_ireplace($blogName, '', $args) . $blogName;
	    }
	    return $args;
	});
});

/**
 * Frontend styles and script
 */
add_action( 'wp_enqueue_scripts', function()
{
    $templateDir = get_template_directory_uri();
    
    wp_enqueue_style('fontawesome-style', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
    
    wp_enqueue_style('toebox', $templateDir
                    . (class_exists('WPLessPlugin', false) ? '/less/style.less' : '/css/bootstrap-Toebox.min.css'));
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array(), false, true);
    wp_enqueue_script('modernizr', $templateDir . '/js/vendor/modernizr.min.js');

});// toeboxBasicEnqueueScripts

/**
 * make embed responsive
 */
add_filter( 'embed_oembed_html', function ( $html, $data, $url )
{
    return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}, 10, 3 );

/**
 * alter paging links
 */
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

require_once get_template_directory() . '/inc/core/search.php';
require_once get_template_directory() . '/inc/core/post_status.php';
require_once get_template_directory() . '/inc/core/theme_settings.php';
require_once get_template_directory() . '/inc/core/upload_mimes.php';
require_once get_template_directory() . '/inc/core/widgets.php';

require_once get_template_directory() . '/inc/core/plugins.php';

add_action( 'after_setup_theme', function()
{
    load_theme_textdomain('toebox-basic', get_template_directory() . '/languages');
    
    add_theme_support( "title-tag" );
    add_theme_support( "custom-header", array(
    	'default-image'          => '',
    	'width'                  => 0,
    	'height'                 => 0,
    	'flex-height'            => false,
    	'flex-width'             => false,
    	'uploads'                => true,
    	'random-default'         => false,
    	'header-text'            => true,
    	'default-text-color'     => '',
    	'wp-head-callback'       => '',
    	'admin-head-callback'    => '',
    	'admin-preview-callback' => '',
    ));
    /*
     * TOOD add custom header via widget 
     * <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
     */
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