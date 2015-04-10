<?php
/**
 * ----------------------------------------------------------------------------
 * SETTINGS UI
 * ----------------------------------------------------------------------------
 */


$SettingsControls = array(
    
    /* ----- COLORS ----- */
    TOEBOX_CONTENT_BACKGROUND_COLOR => array(
                            'label' => __( 'Content background color.', 'toebox-basic' ),
                            'section' => 'colors',
                            'settings' => TOEBOX_CONTENT_BACKGROUND_COLOR,
    ),
    TOEBOX_USE_LESS =>  array(
                            'label' => __( 'Use Less CSS (requires WP-Less)', 'toebox-basic' ),
                            'section' => 'colors',
                            'type' => 'checkbox'
    ),
    /* ----- LAYOUT ----- */
    TOEBOX_PAGE_LAYOUT => array(
                            'label' => __( 'Page Layout', 'toebox-basic' ),
                            'section' => 'toebox_page_layout_section',
                            'type' => 'select',
                            'choices' => $pageLayoutOptions
    ),
    TOEBOX_FEATURED_STORY_LAYOUT => array(
                            'label' => __( 'Featured Story Layout', 'toebox-basic' ),
                            'section' => 'toebox_page_layout_section',
                            'type' => 'select',
                            'choices' => $pageLayoutOptions
    ),
    TOEBOX_HIDE_SMALL_SIDEBARS =>  array(
                            'label' => __( 'Hide Left Side Bar On Small Screens', 'toebox-basic' ),
                            'section' => 'toebox_page_layout_section',
                            'type' => 'checkbox'
    ),
    TOEBOX_USE_WIDGET_FOR_HEADER =>  array(
                            'label' => __( 'Use Header Widget (instead of default header)', 'toebox-basic' ),
                            'section' => 'title_tagline',
                            'type' => 'checkbox'
    ),
    TOEBOX_LIST_LAYOUT => array(
                            'label' => __( 'Post List Layout', 'toebox-basic' ),
                            'section' => 'toebox_content_layout_section',
                            'type' => 'select',
                            'choices' => array(
                                'list_text_only' => __( 'Text Only','toebox-basic' ),
                                'list_large_img' => __( 'Large Image Content','toebox-basic' ),
                                'list_short_img' => __( 'Short Image Content','toebox-basic' ),
                                'list_thumb_left' => __( 'Thumbnail Left','toebox-basic' ),
                                'list_thumb_right' => __( 'Thumbnail Right','toebox-basic' ),
                                'list_thumb_grid' => __( 'Thumbnail Grid','toebox-basic' )
                            )
    ),
    TOEBOX_STORY_LAYOUT =>  array(
                            'label' => __( 'Single Post Layout', 'toebox-basic' ),
                            'section' => 'toebox_content_layout_section',
                            'type' => 'select',
                            'choices' => array(
                                'single_full_img' => __( 'Full Image','toebox-basic' ),
                                'single_thumb_left' => __( 'Thumbnail Left','toebox-basic' ),
                                'single_thumb_right' => __( 'Thumbnail Right','toebox-basic' ),
                            )
                        ),
    /* ----- SYSTEM ----- */
    TOEBOX_SETUP =>  array(
                            'label' => '',
                            'section' => 'title_tagline',
                            'type' => 'hidden'
    ),

);

add_action( 'admin_init', function (  ) {

    register_setting( 'toeboxSettingsPage', 'toebox_settings' );

    add_settings_field(
        TOEBOX_PAGE_LAYOUT,
        __( 'Page Layout', 'toebox-basic' ),
        'toebox_select_page_layout_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        get_option(TOEBOX_PAGE_LAYOUT)
    );

    add_settings_field(
        TOEBOX_FEATURED_STORY_LAYOUT,
        __( 'Featured Story Layout', 'toebox-basic' ),
        'toebox_select_featured_story_layout_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        get_option(TOEBOX_FEATURED_STORY_LAYOUT)
    );


    add_settings_field(
        TOEBOX_CONTENT_BACKGROUND_COLOR,
        __( 'Content background color.', 'toebox-basic' ),
        'toebox_content_background_color_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        get_option(TOEBOX_CONTENT_BACKGROUND_COLOR)
    );


    add_settings_field(
        TOEBOX_LIST_LAYOUT,
        __( 'Post List Layout', 'toebox-basic' ),
        'toebox_list_layout_select_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        get_option(TOEBOX_LIST_LAYOUT)
    );

    add_settings_field(
        TOEBOX_STORY_LAYOUT,
        __( 'Single Post Layout', 'toebox-basic' ),
        'toebox_story_layout_select_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        get_option(TOEBOX_STORY_LAYOUT)
    );


    add_settings_field(
        TOEBOX_HIDE_SMALL_SIDEBARS,
        __( 'Hide Left Side Bar On Small Screens', 'toebox-basic' ),
        'toebox_hide_small_sidebars_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        get_option(TOEBOX_HIDE_SMALL_SIDEBARS)
    );


});

function selectFor($key, $value)
{
    global $SettingsControls;

    $ctrlName = sprintf('toebox_settings[%s]', $key);
    return toebox\inc\Forms::FormatSelect($SettingsControls[$key]['choices'], $ctrlName, $value);
}
function checkboxFor($key, $value, $checkedValue = 1)
{
    global $SettingsControls;

    $ctrlName = sprintf('toebox_settings[%s]', $key);
    return toebox\inc\Forms::FormatCheckbox($checkedValue, $ctrlName, $value);
}
function colorPickerFor($key, $value)
{
    global $SettingsControls;

    $ctrlName = sprintf('toebox_settings[%s]', $key);
    return toebox\inc\Forms::FormatColorPicker($ctrlName, $value);
}

function toebox_select_page_layout_render($value)
{
    print selectFor(TOEBOX_PAGE_LAYOUT, $value);
}
function toebox_select_featured_story_layout_render($value)
{
    print selectFor(TOEBOX_FEATURED_STORY_LAYOUT, $value);
}
function toebox_list_layout_select_render($value)
{
    print selectFor(TOEBOX_LIST_LAYOUT, $value);
}
function toebox_story_layout_select_render($value)
{
    print selectFor(TOEBOX_STORY_LAYOUT, $value);
}

function toebox_hide_small_sidebars_render($value)
{
   print checkboxFor(TOEBOX_HIDE_SMALL_SIDEBARS, $value);
}
/* POST TYPE */
function toebox_feature_stories_posttype_render($value)
{
    print checkboxFor(TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE, $value);
}
function toebox_carousel_posttype_render($value)
{
    print checkboxFor(TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE, $value);
}

function toebox_content_background_color_render($value)
{
    print colorPickerFor(TOEBOX_CONTENT_BACKGROUND_COLOR, $value);
}

add_action( 'admin_enqueue_scripts', function ( $hook )
{

    if( is_admin() ) wp_enqueue_style( 'wp-color-picker' );

});

add_action( 'admin_menu', function (  ) {
    // This is unnecessary
    // add_theme_page( 'ToeBox Settings', 'ToeBox Settings', 'manage_options', 'toebox', 'toebox_options_page' );
    add_editor_style('custom-editor-style.css');

});

add_action( 'customize_register', function(WP_Customize_Manager $wp_customize )
{

    global $SettingsControls;

        $wp_customize->add_section(
                        'toebox_page_layout_section',
                        array(
                            'title' => __( 'Page Layout', 'toebox-basic' ),
                            'description' => __( 'These settings are specific to ToeBox.', 'toebox-basic' ),
                            'priority' => 90,
                        )
        );

        $wp_customize->add_section(
                        'toebox_content_layout_section',
                        array(
                            'title' => __( 'Content Layout', 'toebox-basic' ),
                            'description' => __( 'These settings are specific to ToeBox.', 'toebox-basic' ),
                            'priority' => 91,
                        )
        );
        
        $wp_customize->add_section(
                        'toebox_content_layout_section',
                        array(
                            'title' => __( 'Content Layout', 'toebox-basic' ),
                            'description' => __( 'These settings are specific to ToeBox.', 'toebox-basic' ),
                            'priority' => 89,
                        )
        );

        /**
         * TOEBOX_PAGE_LAYOUT
         */
        $wp_customize->add_setting(
            TOEBOX_USE_WIDGET_FOR_HEADER,
            array(
                'default' => toebox\inc\ToeBox::$Settings[TOEBOX_USE_WIDGET_FOR_HEADER],
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            TOEBOX_USE_WIDGET_FOR_HEADER,
            $SettingsControls[TOEBOX_USE_WIDGET_FOR_HEADER]
        );
        
        /**
         * TOEBOX_SETUP
         */
        $wp_customize->add_setting(
                TOEBOX_SETUP,
                array(
                    'default' => toebox\inc\ToeBox::$Settings[TOEBOX_SETUP],
                    'sanitize_callback' => 'sanitize_text_field'
                )
        );
        
        $wp_customize->add_control(
                TOEBOX_SETUP,
                $SettingsControls[TOEBOX_SETUP]
        );

        /**
         * TOEBOX_PAGE_LAYOUT
         */
        $wp_customize->add_setting(
                        TOEBOX_PAGE_LAYOUT,
                        array(
                            'default' => toebox\inc\ToeBox::$Settings[TOEBOX_PAGE_LAYOUT],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );

        $wp_customize->add_control(
                        TOEBOX_PAGE_LAYOUT,
                        $SettingsControls[TOEBOX_PAGE_LAYOUT]
        );

        /**
         * TOEBOX_CUSTOM_PAGE_LAYOUT
         */
        $wp_customize->add_setting(
                        TOEBOX_FEATURED_STORY_LAYOUT,
                        array(
                            'default' => toebox\inc\ToeBox::$Settings[TOEBOX_FEATURED_STORY_LAYOUT],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );

        $wp_customize->add_control(
                        TOEBOX_FEATURED_STORY_LAYOUT,
                        $SettingsControls[TOEBOX_FEATURED_STORY_LAYOUT]
        );
        /**
         * TOEBOX_CONTENT_BACKGROUND_COLOR
         */
        $wp_customize->add_setting(
                        TOEBOX_CONTENT_BACKGROUND_COLOR,
                        array(
                            'default' => toebox\inc\ToeBox::$Settings[TOEBOX_CONTENT_BACKGROUND_COLOR],
                            'sanitize_callback' => 'sanitize_hex_color'
                        )
        );

        $wp_customize->add_control(
                        new WP_Customize_Color_Control(
                                        $wp_customize,
                                        TOEBOX_CONTENT_BACKGROUND_COLOR,
                                        $SettingsControls[TOEBOX_CONTENT_BACKGROUND_COLOR]
                        )
        );
        /**
         * TOEBOX_USE_LESS
         */
        $wp_customize->add_setting(
                        TOEBOX_USE_LESS,
                        array(
                            'default' => toebox\inc\ToeBox::$Settings[TOEBOX_USE_LESS],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );
        
        $wp_customize->add_control(
                        TOEBOX_USE_LESS,
                        $SettingsControls[TOEBOX_USE_LESS]
        );
        
        /**
         * TOEBOX_LIST_LAYOUT
         */
        $wp_customize->add_setting(
                        TOEBOX_LIST_LAYOUT,
                        array(
                            'default' => toebox\inc\ToeBox::$Settings[TOEBOX_LIST_LAYOUT],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );

        $wp_customize->add_control(
                        TOEBOX_LIST_LAYOUT,
                        $SettingsControls[TOEBOX_LIST_LAYOUT]
        );

        /**
         * TOEBOX_STORY_LAYOUT
         */
        $wp_customize->add_setting(
                        TOEBOX_STORY_LAYOUT,
                        array(
                            'default' => toebox\inc\ToeBox::$Settings[TOEBOX_STORY_LAYOUT],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );

        $wp_customize->add_control(
                        TOEBOX_STORY_LAYOUT,
                        $SettingsControls[TOEBOX_STORY_LAYOUT]
        );

        /**
         * TOEBOX_HIDE_SMALL_SIDEBARS
         */
        $wp_customize->add_setting(
                        TOEBOX_HIDE_SMALL_SIDEBARS,
                        array(
                            'default' => toebox\inc\ToeBox::$Settings[TOEBOX_HIDE_SMALL_SIDEBARS],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );

        $wp_customize->add_control(
                        TOEBOX_HIDE_SMALL_SIDEBARS,
                        $SettingsControls[TOEBOX_HIDE_SMALL_SIDEBARS]
        );


});



function toebox_settings_section_callback(  ) {

	echo __( 'Select your default page layout and default list layout below.', 'toebox-basic' );

}

function toebox_posttype_section_callback(  ) {

    echo __( 'Enable ToeBox special post types below.', 'toebox-basic' );

}


function toebox_options_page(  ) {


    if(isset($_GET['settings-updated']) && $_GET['settings-updated'])
    {
        $settings = get_option( 'toebox_settings' );
        foreach($settings as $key => $value)
        {
            set_theme_mod($key, $value);
        }
        print '<div id="setting-error-settings_updated" class="updated settings-error">';
        print '<p><strong>updated theme settings</strong></p>';
        print '</div>';

    }

	?>
	<form action='options.php' method='post'>

		<h2>ToeBox Layout</h2>
        <h4>Use Appearance > <a href="./customize.php">Customize</a> to change theme settings.</h4>
		<?php
		settings_fields( 'toeboxSettingsPage' );
		do_settings_sections( 'toeboxSettingsPage' );
		submit_button();
		?>

	</form>
	<?php


}
