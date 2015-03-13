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
    $settings = get_option( 'toebox_settings' );
    
    toebox\inc\Toebox::$Settings = array_merge(toebox\inc\Toebox::$Settings, (is_array($settings)) ? $settings : array());
    
	add_post_type_support('page', array('excerpt', 'revisions', 'comments', 'custom-fields', 'page-attributes'));
});

/**
 * setup menu walker
 */
require_once TEMPLATEPATH.'/inc/NavMenuWalker.php';
add_filter( 'wp_nav_menu_args', 'toebox\\inc\\NavMenuWalker::MenuArguments');

add_filter('nav_menu_link_attributes', function($atts = array()){
    return $atts;
});


add_action( 'after_setup_theme', function()
{
	load_theme_textdomain('toebox-basic', get_template_directory() . '/languages');

	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

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
    require_once 'inc/widget/TitleCornersWidget.php';
    register_widget( 'toebox\inc\widget\TitleWidget' );
    register_widget( 'toebox\inc\widget\TitleCornersWidget' );


    // --------------  WIDGET AREAS -------------------------------------------

    register_sidebar(array(
        'name'          => __('Global Header', 'toebox-basic'),
        'description'   => __('Appears on all pages before all content.', 'toebox-basic'),
        'id'            => 'toebox-header',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ));

    register_sidebar(array(
        'name'          => __('Global Footer', 'toebox-basic'),
        'description'   => __('Appears on all pages after all content.', 'toebox-basic'),
        'id'            => 'toebox-footer',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ));


    register_sidebar(array(
        'name'          => __('Left Sidebar', 'toebox-basic'),
        'description'   => __('Appears on all pages that have a left sidebar.', 'toebox-basic'),
        'id'            => 'toebox_left_sidebar',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ));


	register_sidebar(array(
		'name'          => __('Right Sidebar', 'toebox-basic'),
		'description'   => __('Appears on all pages that have a right sidebar.', 'toebox-basic'),
		'id'            => 'toebox_right_sidebar',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));


    register_sidebar(array(
	    'name'          => __('Content Top', 'toebox-basic'),
	    'description'   => __('Appears on all pages before content between sidebars.', 'toebox-basic'),
	    'id'            => 'toebox_content_top',
	    'before_widget' => '',
	    'after_widget'  => '',
	    'before_title'  => '',
	    'after_title'   => '',
    ));

	register_sidebar(array(
		'name'          => __('Content Bottom', 'toebox-basic'),
		'description'   => __('Appears on all pages after content between sidebars.', 'toebox-basic'),
		'id'            => 'toebox_content_bottom',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));

});


add_action( 'wp_enqueue_scripts', function()
{
    wp_enqueue_style('toebox-style', get_template_directory_uri() . '/css/toebox.min.css');
    wp_enqueue_style('toebox-theme-style', get_template_directory_uri() . '/css/toebox-theme.min.css');
    wp_enqueue_style('fontawesome-style', '//maxcdn.toeboxcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

	wp_enqueue_script('jquery');
	wp_enqueue_script('toebox-script', get_template_directory_uri() . '/js/toebox.js');
	wp_enqueue_script('toebox-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js');

});// toeboxBasicEnqueueScripts



/**
 * ----------------------------------------------------------------------------
 * SETTINGS UI
 * ----------------------------------------------------------------------------
 */

add_action( 'admin_menu', function (  ) {

	add_menu_page( 'ToeBox', 'ToeBox', 'manage_options', 'toebox', 'toebox_options_page' );

});


add_action( 'admin_init', function (  ) {

	register_setting( 'pluginPage', 'toebox_settings' );

	add_settings_section(
		'toebox_pluginPage_section',
		__( 'ToeBox lets you mix and match many different layout options. Select your default page layout and default list size below:', 'text_domain' ),
		'toebox_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		TOEBOX_DEFAULT_PAGE_LAYOUT,
		__( 'Default Page Layout', 'text_domain' ),
		'toebox_select_default_page_layout_render',
		'pluginPage',
		'toebox_pluginPage_section'
	);

	add_settings_field(
		TOEBOX_DEFAULT_LIST_LAYOUT,
		__( 'Story List Layout', 'text_domain' ),
		'toebox_select_field_1_render',
		'pluginPage',
		'toebox_pluginPage_section'
	);

	add_settings_field(
		TOEBOX_DEFAULT_STORY_LAYOUT,
		__( 'Story Layout', 'text_domain' ),
		'toebox_select_field_2_render',
		'pluginPage',
		'toebox_pluginPage_section'
	);


	add_settings_field(
    	'toebox_checkbox_field_3',
    	__( 'Hide Left Side Bar On Small Screens', 'text_domain' ),
    	'toebox_checkbox_field_3_render',
    	'pluginPage',
    	'toebox_pluginPage_section'
    );


});


function toebox_select_default_page_layout_render(  ) {

	$options = toebox\inc\Toebox::$Settings;
	?>
	<select name='toebox_settings[<?php print TOEBOX_DEFAULT_PAGE_LAYOUT ?>]'>
		<option value='open' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'open' ); ?>>Open</option>
		<option value='no_column' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'no_column' ); ?>>Single Column</option>
		<option value='left_column' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'left_column' ); ?>>Left Column</option>
		<option value='three_column' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'three_column' ); ?>>Three Column</option>
		<option value='right_column' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'right_column' ); ?>>Right Column</option>
		<option value='two_right_column' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'two_right_column' ); ?>>Two Right Columns</option>
		<option value='two_right_column' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'two_left_column' ); ?>>Two Left Columns</option>
	</select>

<?php

}


function toebox_select_field_1_render(  ) {

	$options = toebox\inc\Toebox::$Settings;
	?>
	<select name='toebox_settings[<?php print TOEBOX_DEFAULT_LIST_LAYOUT ?>]'>
		<option value='list_text_only' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_text_only', true); ?>>Text Only</option>
		<option value='list_large_img' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_large_img', true); ?>>Large Image Content</option>
		<option value='list_short_img' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_short_img', true); ?>>Short Image Content</option>
		<option value='list_thumb_left' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_thumb_left', true); ?>>Thumbnail Left</option>
		<option value='list_thumb_right' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_thumb_right', true); ?>>Thumbnail Right</option>
		<option value='list_thumb_grid' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_thumb_grid', true); ?>>Thumbnail Grid</option>
	</select>

<?php

}


function toebox_select_field_2_render(  ) {
    $options = toebox\inc\Toebox::$Settings;
	?>
	<select name='toebox_settings[<?php print TOEBOX_DEFAULT_STORY_LAYOUT ?>]'>
		<option value='full_img' <?php selected( $options[TOEBOX_DEFAULT_STORY_LAYOUT],'full_img' ); ?>>Full Image</option>
		<option value='thumb_left' <?php selected( $options[TOEBOX_DEFAULT_STORY_LAYOUT], 'thumb_left' ); ?>>Thumbnail Left</option>
		<option value='thumb_right' <?php selected( $options[TOEBOX_DEFAULT_STORY_LAYOUT], 'thumb_right' ); ?>>Thumbnail Right</option>
	</select>

<?php

}


function toebox_checkbox_field_3_render(  ) {

    $options = toebox\inc\Toebox::$Settings;
    ?>
	<input type='checkbox' name='toebox_settings[<?php print TOEBOX_HIDE_SMALL_SIDEBARS ?>]' <?php checked( $options[TOEBOX_HIDE_SMALL_SIDEBARS], 1 ); ?> value='1'>
	<?php

}


function toebox_settings_section_callback(  ) {

	echo __( 'Select your default page layout and default list layout below.', 'text_domain' );

}


function toebox_options_page(  ) {

	?>
	<form action='options.php' method='post'>

		<h2>ToeBox</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}

/**
 * ----------------------------------------------------------------------------
 * SEARCH
 * ----------------------------------------------------------------------------
 */
 register_sidebar_widget(__('Search'), function()
 {
    ?>
    <!-- < PASTE YOUR SEARCH FORM HERE > -->
    <?php
 });
 
/**
 * ----------------------------------------------------------------------------
 * EXTRA MIME TYPES
 * ----------------------------------------------------------------------------
 */
add_filter('upload_mimes', function ( $existing_mimes=array() ) {

	$existing_mimes['svg'] = 'image/svg+xml';
	$existing_mimes['svgz'] = 'image/svg+xml';
	return $existing_mimes;

});

