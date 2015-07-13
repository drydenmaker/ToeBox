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
 * ---------------------------------------------------------------------------- SETTINGS
 */
require_once get_template_directory() . '/inc/core/settings.php';
toebox\inc\Toebox::InitSettings();
/**
 * ---------------------------------------------------------------------------- INIT
 */
/**
 * init general
 */
add_action( 'init', function()
{
	add_post_type_support('page', array('excerpt', 'revisions', 'comments', 'custom-fields', 'page-attributes'));
	
	register_nav_menus(
    	array(
    	   'header-menu' => __( 'Header Menu', 'toebox-basic' )
    	));

	/**
	 * setup menu walkers
	 */
	require_once get_template_directory().'/inc/Walker/NavMenu/AbstractMenu.php';
	require_once get_template_directory().'/inc/Walker/NavMenu/Primary.php';
	require_once get_template_directory().'/inc/Walker/NavMenu/Hover.php';
	require_once get_template_directory().'/inc/Walker/NavMenu/Bare.php';
	require_once get_template_directory().'/inc/Walker/NavMenu/Flat.php';
	add_filter( 'wp_nav_menu_args', 'toebox\\inc\\Walker\\NavMenu\\Touch::MenuArguments');
    
	/*\
	 * Allow bootstrap html attributes
	\*/
	    allow_data_event_content('data-parent');
	    allow_data_event_content('data-toggle');	   
	    allow_data_event_content('aria-haspopup');
	    allow_data_event_content('aria-haspopup');
	    

});

/**
 * seo the title
 */
add_filter('wp_title', function($args){

    if (\toebox\inc\ToeBox::$Settings[TOEBOX_TITLE_SEO])
    {
        $args .= (strlen($args)) ? ' | ' : get_bloginfo( 'description') . ' | ';
        $blogName = get_bloginfo('name');
        return str_ireplace($blogName, '', $args) . $blogName;
    }
    return $args;
});


/**
 * Frontend styles and script
 */
add_action( 'wp_enqueue_scripts', function()
{
    $templateDir = get_template_directory_uri();

    if (class_exists('WPLessPlugin', false) && toebox\inc\ToeBox::$Settings[TOEBOX_USE_LESS])
    {
        wp_enqueue_style('bootstrap', $templateDir . '/less/bootstrap/customization/wp/bootstrap.less');
        wp_enqueue_style('bootstrap-theme', $templateDir . '/less/bootstrap/customization/wp/theme.less');

        if (WP_DEBUG) WPLessPlugin::getInstance()->processStylesheets();
    }
    else
    {
        wp_enqueue_style('bootstrap', $templateDir. '/css/bootstrap/bootstrap.min.css');
        wp_enqueue_style('bootstrap-theme', $templateDir. '/css/bootstrap/bootstrap-theme.min.css');
    }
    
    wp_enqueue_script('html5shiv_ielt9', $templateDir . '/js/vendor/html5shiv.min.js', array(), '3.7.2', false);
    wp_enqueue_script('modernizr_ielt9', $templateDir . '/js/vendor/respond.min.js', array(), '1.4.2', false);

    // external fonts
    // wp_enqueue_style('fontawesome-style', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
    wp_enqueue_style('tb-google-fonts', '//fonts.googleapis.com/css?family=' . \toebox\inc\ToeBox::$Settings[TOEBOX_GOOGLE_FONTS]);

    // them scripts
    wp_enqueue_script('bootstrap', $templateDir. '/js/bootstrap.min.js', array('jquery'), null, true);
    wp_enqueue_script('modernizr', $templateDir . '/js/vendor/modernizr.min.js', array('jquery'), null, true);
    wp_enqueue_script('toebox', $templateDir . '/js/toebox.js', array('jquery', 'bootstrap'), null, true);

});// toeboxBasicEnqueueScripts

// add ie conditional on tags with _ielt9 suffix
add_filter('script_loader_tag', function($tag, $handle){
    $needle = '_ielt9';
    if (($temp = strlen($handle) - strlen($needle)) >= 0 && strpos($handle, $needle, $temp) !== FALSE)
    {
        $tag = "<!--[if lt IE 9]>$tag<![endif]-->";
    }
    return $tag;
}, null, 2);



require_once get_template_directory() . '/inc/core/search.php';
require_once get_template_directory() . '/inc/core/post_status.php';
require_once get_template_directory() . '/inc/core/theme_customizer.php';
require_once get_template_directory() . '/inc/core/upload_mimes.php';
require_once get_template_directory() . '/inc/core/widgets.php';

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
    	'header-text'            => false,
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
                'default-image'          => '%1$s/images/background.png',
                'default-repeat'         => '%1$s/images/repeat_background.jpg',
                'default-position-x'     => 'center',
            )
        )
    );
    
    
    add_filter('show_admin_bar', function(){ return is_user_logged_in(); });


}); // toeboxBasicSetup

if (class_exists('WPLessPlugin', false) && toebox\inc\ToeBox::$Settings[TOEBOX_USE_LESS])
{
    /**
     * if wp-less is installed make it use less.php for bootstrap compatibility
     */
    add_filter('wp_less_compiler', function($args){
        return 'less.php';
    }, 0);

    $lessConfig = WPLessPlugin::getInstance()->getConfiguration();

    $less = WPLessPlugin::getInstance();
    $less->dispatch();

    // COLORS
    $less->addVariable('body-bg', '#'.get_theme_mod( 'background_color', '333' ));
    
    $less->addVariable('tb-main-bg-color', toebox\inc\Toebox::$Settings[TOEBOX_CONTENT_BACKGROUND_COLOR]);
    
    $less->addVariable('brand-primary', \toebox\inc\ToeBox::$Settings[TOEBOX_LESS_COLOR_PRIMARY]); //EC7225
    $less->addVariable('brand-success', \toebox\inc\ToeBox::$Settings[TOEBOX_LESS_COLOR_SUCCESS]); //18987B
    $less->addVariable('brand-info', \toebox\inc\ToeBox::$Settings[TOEBOX_LESS_COLOR_INFO]); //24569B
    $less->addVariable('brand-warning', \toebox\inc\ToeBox::$Settings[TOEBOX_LESS_COLOR_WARNING]); //ECA125
    $less->addVariable('brand-danger', \toebox\inc\ToeBox::$Settings[TOEBOX_LESS_COLOR_DANGER]); //EF5870
    
    // FONTS
    $less->addVariable('font-size-base', \toebox\inc\ToeBox::$Settings[TOEBOX_LESS_FONT_SIZE_BASE]); 
    $less->addVariable('font-family-monospace', \toebox\inc\ToeBox::$Settings[TOEBOX_LESS_FONT_FAMILY_MONOSPACE]); 
    $less->addVariable('font-family-serif', \toebox\inc\ToeBox::$Settings[TOEBOX_LESS_FONT_FAMILY_SERIF]); 
    $less->addVariable('font-family-sans-serif', \toebox\inc\ToeBox::$Settings[TOEBOX_LESS_FONT_FAMILY_SANS_SERIF]);

    // CORNERS
    $less->addVariable(TOEBOX_BORDER_RADIUS_BASE, \toebox\inc\ToeBox::$Settings[TOEBOX_BORDER_RADIUS_BASE]);
    $less->addVariable(TOEBOX_BORDER_RADIUS_LARGE, \toebox\inc\ToeBox::$Settings[TOEBOX_BORDER_RADIUS_LARGE]);
    $less->addVariable(TOEBOX_BORDER_RADIUS_SMALL, \toebox\inc\ToeBox::$Settings[TOEBOX_BORDER_RADIUS_SMALL]);
    
    $less->addVariable(TOEBOX_BORDER_RADIUS_BUTTON_BASE, \toebox\inc\ToeBox::$Settings[TOEBOX_BORDER_RADIUS_BUTTON_BASE]);
    $less->addVariable(TOEBOX_BORDER_RADIUS_BUTTON_LARGE, \toebox\inc\ToeBox::$Settings[TOEBOX_BORDER_RADIUS_BUTTON_LARGE]);
    $less->addVariable(TOEBOX_BORDER_RADIUS_BUTTON_SMALL, \toebox\inc\ToeBox::$Settings[TOEBOX_BORDER_RADIUS_BUTTON_SMALL]);
    
}
/**
 * ---------------------------------------------------------------------------- INTERNAL
 */
/**
 * make embed responsive
 */
add_filter( 'embed_oembed_html', function ( $html, $data, $url )
{
    return (stripos($html, 'youtube.com') === false) ? $html :
    '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';

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
/**
 * ---------------------------------------------------------------------------- ALLOW BOOTSTRAP ATTRIBUTES
 */
/**
 * Add to extended_valid_elements for TinyMCE
 *
 * @param $init assoc. array of TinyMCE options
 * @return $init the changed assoc. array
 */
add_filter('tiny_mce_before_init', function( $init ) {
    // Command separated string of extended elements
    $ext = 'pre[id|name|class|style|role|data-toggle|data-parent|data-*]'; //

    // Add to extended_valid_elements if it alreay exists
    if ( isset( $init['extended_valid_elements'] ) ) {
        $init['extended_valid_elements'] .= ',' . $ext;
    } else {
        $init['extended_valid_elements'] = $ext;
    }

    // Super important: return $init!
    return $init;
});

function allow_data_event_content($tag)
{
    global $allowedposttags, $allowedtags;
    
    $allowedposttags["a"][$tag] = true;
    $allowedtags["a"][$tag] = true;
}