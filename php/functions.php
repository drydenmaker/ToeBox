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

		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

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
					'default-color'          => '333',
                    'default-image'          => '%1$s/images/background.jpg',
                    'default-repeat'         => '%1$s/images/repeat_background.jpg',
                    'default-position-x'     => 'center',
				)
			)
		);
	} // toeboxBasicSetup
}
add_action('after_setup_theme', 'toeboxBasicSetup');


/**
 * Register Navigation Menus
*/
function toeboxInit() {


} // Hook into the 'init' action
add_action( 'init', 'toeboxInit' );




/**
 * Register widget areas
 */
add_action( 'widgets_init', function()
{
    // --------------  WIDGETS ---------------------------------------------
    //require_once 'inc/widget/TitleWidget.php';
    //register_widget( 'toebox\inc\widget\TitleWidget' );

	register_sidebar(array(
		'name'          => __('Right Sidebar', 'toebox-basic'),
		'description'   => __('Appears on all pages that have a right sidebar.', 'toebox-basic'),
		'id'            => 'toebox-right-sidebar',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));

	register_sidebar(array(
		'name'          => __('Left Sidebar', 'toebox-basic'),
		'description'   => __('Appears on all pages that have a left sidebar.', 'toebox-basic'),
		'id'            => 'toebox-left-sidebar',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	));

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

});


if (!function_exists('toeboxBasicEnqueueScriptsAndStyles')) {
	/**
	 * Enqueue scripts & styles
	 */
	function toeboxBasicEnqueueScriptsAndStyles()
	{
	    wp_enqueue_style('toebox-style', get_template_directory_uri() . '/css/toebox.min.css');
	    wp_enqueue_style('toebox-theme-style', get_template_directory_uri() . '/css/toebox-theme.min.css');
	    wp_enqueue_style('fontawesome-style', '//maxcdn.toeboxcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

		wp_enqueue_script('jquery');
		wp_enqueue_script('toebox-script', get_template_directory_uri() . '/js/toebox.js');

	}// toeboxBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'toeboxBasicEnqueueScriptsAndStyles');


/**
 * ----------------------------------------------------------------------------
 * SETTINGS UI
 * ----------------------------------------------------------------------------
 */
add_action( 'admin_menu', 'toebox_add_admin_menu' );
add_action( 'admin_init', 'toebox_settings_init' );


function toebox_add_admin_menu(  ) {

	add_menu_page( 'ToeBox', 'ToeBox', 'manage_options', 'toebox', 'toebox_options_page' );

}

define(TOEBOX_DEFAULT_PAGE_LAYOUT, 'toebox_1');
define(TOEBOX_DEFAULT_LIST_LAYOUT, 'toebox_2');
define(TOEBOX_DEFAULT_STORY_LAYOUT, 'toebox_3');



function toebox_settings_init(  ) {

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
    	__( 'Settings field description', 'text_domain' ),
    	'toebox_checkbox_field_3_render',
    	'pluginPage',
    	'toebox_pluginPage_section'
    );


}


function toebox_select_default_page_layout_render(  ) {

	$options = get_option( 'toebox_settings' );
	?>
	<select name='toebox_settings[<?php print TOEBOX_DEFAULT_PAGE_LAYOUT ?>]'>
		<option value='open' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'open' ); ?>>Open</option>
		<option value='no_column' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'no_column' ); ?>>Single Column</option>
		<option value='left_column' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'left_column' ); ?>>Left Column</option>
		<option value='three_column' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'three_column' ); ?>>Three Column</option>
		<option value='right_column' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'right_column' ); ?>>Right Column</option>
		<option value='two_right_column' <?php selected( $options[TOEBOX_DEFAULT_PAGE_LAYOUT], 'two_right_column' ); ?>>Two Right Columns</option>
	</select>

<?php

}


function toebox_select_field_1_render(  ) {

	$options = get_option( 'toebox_settings' );
	?>
	<select name='toebox_settings[<?php print TOEBOX_DEFAULT_LIST_LAYOUT ?>]'>
		<option value='list_text_only' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_text_only', true); ?>>Text Only</option>
		<option value='list_large_img' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_large_img', true); ?>>Large Image Content</option>
		<option value='list_short_img' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_short_img', true); ?>>Short Image Content</option>
		<option value='list_thumb_left' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_thumb_left', true); ?>>Thumbnail Left</option>
		<option value='list_thumb_right' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_thumb_right', true); ?>>Thumbnail Right</option>
		<option value='list_thumb_grid' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_thumb_grid', true); ?>>Thumbnail Grid</option>
		<option value='list_small_thumb_grid' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_small_thumb_grid', true); ?>>Small Thumbnail Grid</option>
		<option value='list_thumb_tiled' <?php selected( $options[TOEBOX_DEFAULT_LIST_LAYOUT], 'list_thumb_tiled', true); ?>>Tiled Thumbnails</option>
	</select>

<?php

}


function toebox_select_field_2_render(  ) {

	$options = get_option( 'toebox_settings' );
	?>
	<select name='toebox_settings[<?php print TOEBOX_DEFAULT_STORY_LAYOUT ?>]'>
		<option value='full_img' <?php selected( $options[TOEBOX_DEFAULT_STORY_LAYOUT],'full_img' ); ?>>Full Image</option>
		<option value='thumb_left' <?php selected( $options[TOEBOX_DEFAULT_STORY_LAYOUT], 'thumb_left' ); ?>>Thumbnail Left</option>
		<option value='thumb_right' <?php selected( $options[TOEBOX_DEFAULT_STORY_LAYOUT], 'thumb_right' ); ?>>Thumbnail Right</option>
	</select>

<?php

}


function toebox_checkbox_field_3_render(  ) {

    $options = get_option( 'toebox_settings' );
    ?>
	<input type='checkbox' name='toebox_settings[toebox_checkbox_field_3]' <?php checked( $options['toebox_checkbox_field_3'], 1 ); ?> value='1'>
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
 function toebox_search()
 {
    ?>
    <!-- < PASTE YOUR SEARCH FORM HERE > -->
    <?php
 }
 if ( function_exists('register_sidebar_widget') ) register_sidebar_widget(__('Search'), 'toebox_search');
