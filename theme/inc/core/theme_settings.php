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
                            'type' => 'checkbox',
                            'settings' => TOEBOX_USE_LESS
    ),
    
    TOEBOX_LESS_COLOR_PRIMARY => array(
        'label' => __( 'Bootstrap primary color.', 'toebox-basic' ),
        'section' => 'colors',
        'settings' => TOEBOX_LESS_COLOR_PRIMARY,
    ),
    TOEBOX_LESS_COLOR_SUCCESS => array(
        'label' => __( 'Bootstrap success color.', 'toebox-basic' ),
        'section' => 'colors',
        'settings' => TOEBOX_LESS_COLOR_SUCCESS,
    ),
    TOEBOX_LESS_COLOR_INFO => array(
        'label' => __( 'Bootstrap info color.', 'toebox-basic' ),
        'section' => 'colors',
        'settings' => TOEBOX_LESS_COLOR_INFO,
    ),
    TOEBOX_LESS_COLOR_WARNING => array(
        'label' => __( 'Bootstrap warning color.', 'toebox-basic' ),
        'section' => 'colors',
        'settings' => TOEBOX_LESS_COLOR_WARNING,
    ),
    TOEBOX_LESS_COLOR_DANGER => array(
        'label' => __( 'Bootstrap danger color.', 'toebox-basic' ),
        'section' => 'colors',
        'settings' => TOEBOX_LESS_COLOR_DANGER,
    ),
    
    /* ----- FONTS ----- */
    TOEBOX_GOOGLE_FONTS =>  array(
        'label' => __( 'Google Fonts (pipe delimited)', 'toebox-basic' ),
        'section' => 'toebox_font_section',
        'type' => 'text',
        'settings' => TOEBOX_GOOGLE_FONTS
    ),
    
    TOEBOX_LESS_FONT_SIZE_BASE =>  array(
        'label' => __( 'Base Font Size', 'toebox-basic' ),
        'section' => 'toebox_font_section',
        'type' => 'text',
        'settings' => TOEBOX_LESS_FONT_SIZE_BASE
    ),
    TOEBOX_LESS_FONT_FAMILY_MONOSPACE =>  array(
        'label' => __( 'Monospace Font Family', 'toebox-basic' ),
        'section' => 'toebox_font_section',
        'type' => 'text',
        'settings' => TOEBOX_LESS_FONT_FAMILY_MONOSPACE
    ),
    TOEBOX_LESS_FONT_FAMILY_SERIF =>  array(
        'label' => __( 'Serif Font Family', 'toebox-basic' ),
        'section' => 'toebox_font_section',
        'type' => 'text',
        'settings' => TOEBOX_LESS_FONT_FAMILY_SERIF
    ),
    TOEBOX_LESS_FONT_FAMILY_SANS_SERIF =>  array(
        'label' => __( 'Sans-Serif Font Family', 'toebox-basic' ),
        'section' => 'toebox_font_section',
        'type' => 'text',
        'settings' => TOEBOX_LESS_FONT_FAMILY_SANS_SERIF
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
                            'label' => __( 'Site Title', 'toebox-basic' ),
                            'section' => 'title_tagline',
                            'type' => 'radio',
                            'choices' => array(
                                0 => 'On',
                                1 => 'Off (you can use a widget)'
                            )
    ),
    TOEBOX_USE_WIDGET_FOR_NAV_MENU =>  array(
                            'label' => __( 'Site Menu', 'toebox-basic' ),
                            'section' => 'title_tagline',
                            'type' => 'radio',
                            'choices' => array(
                                0 => 'On',
                                1 => 'Off (you use a widget)'
                            )
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

add_action( 'customize_preview_init', function()
{
	wp_enqueue_script( 
		  'toebox-themecustomizer',			//Give the script an ID
		  get_template_directory_uri().'/js/theme-customizer.js',//Point to file
		  array( 'jquery','customize-preview' ),	//Define dependencies
		  null,						//Define a version (optional) 
		  true						//Put script in footer?
	);
} );

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
                            'description' => __( 'Page Layout for ToeBox.', 'toebox-basic' ),
                            'priority' => 90,
                        )
        );

        
        
        $wp_customize->add_section(
                        'toebox_content_layout_section',
                        array(
                            'title' => __( 'Content Layout', 'toebox-basic' ),
                            'description' => __( 'Content Layout for ToeBox.', 'toebox-basic' ),
                            'priority' => 92,
                        )
        );
        
        $wp_customize->add_section(
                        'toebox_font_section',
                        array(
                            'title' => __( 'Fonts', 'toebox-basic' ),
                            'description' => __( 'Fonts used in ToeBox.', 'toebox-basic' ),
                            'priority' => 93,
                        )
        );

        /**
         * TOEBOX_USE_WIDGET_FOR_HEADER
         */
        $wp_customize->add_setting(
            TOEBOX_USE_WIDGET_FOR_HEADER,
            array(
                'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_USE_WIDGET_FOR_HEADER],
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            TOEBOX_USE_WIDGET_FOR_HEADER,
            $SettingsControls[TOEBOX_USE_WIDGET_FOR_HEADER]
        );
        
        /**
         * TOEBOX_USE_WIDGET_FOR_NAV_MENU
         */
        $wp_customize->add_setting(
                        TOEBOX_USE_WIDGET_FOR_NAV_MENU,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_USE_WIDGET_FOR_NAV_MENU],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );
        
        $wp_customize->add_control(
                        TOEBOX_USE_WIDGET_FOR_NAV_MENU,
                        $SettingsControls[TOEBOX_USE_WIDGET_FOR_NAV_MENU]
        );
        
        /**
         * TOEBOX_SETUP
         */
        $wp_customize->add_setting(
                TOEBOX_SETUP,
                array(
                    'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_SETUP],
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
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_PAGE_LAYOUT],
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
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_FEATURED_STORY_LAYOUT],
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
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_CONTENT_BACKGROUND_COLOR],
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
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_USE_LESS],
                            'sanitize_callback' => 'sanitize_text_field',
                            'transport' => 'postMessage'
                        )
        );
        
        $wp_customize->add_control(
                        TOEBOX_USE_LESS,
                        $SettingsControls[TOEBOX_USE_LESS]
        );
        /* -------------------------- LESS --------------------------- */
        /**
         * TOEBOX_LESS
         */
        // primary
        $wp_customize->add_setting(
                        TOEBOX_LESS_COLOR_PRIMARY,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_LESS_COLOR_PRIMARY],
                            'sanitize_callback' => 'sanitize_hex_color',
                            'transport'    => 'postMessage'
                        )
        );
        
        $wp_customize->add_control(
                        new WP_Customize_Color_Control(
                                        $wp_customize,
                                        TOEBOX_LESS_COLOR_PRIMARY,
                                        $SettingsControls[TOEBOX_LESS_COLOR_PRIMARY]
                        )
        );
        // success
        $wp_customize->add_setting(
                        TOEBOX_LESS_COLOR_SUCCESS,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_LESS_COLOR_SUCCESS],
                            'sanitize_callback' => 'sanitize_hex_color',
                            'transport'    => 'postMessage'
                        )
        );
        
        $wp_customize->add_control(
                        new WP_Customize_Color_Control(
                                        $wp_customize,
                                        TOEBOX_LESS_COLOR_SUCCESS,
                                        $SettingsControls[TOEBOX_LESS_COLOR_SUCCESS]
                        )
        );
        // info
        $wp_customize->add_setting(
                        TOEBOX_LESS_COLOR_INFO,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_LESS_COLOR_INFO],
                            'sanitize_callback' => 'sanitize_hex_color',
                            'transport'    => 'postMessage'
                        )
        );
        
        $wp_customize->add_control(
                        new WP_Customize_Color_Control(
                                        $wp_customize,
                                        TOEBOX_LESS_COLOR_INFO,
                                        $SettingsControls[TOEBOX_LESS_COLOR_INFO]
                        )
        );
        // warning
        $wp_customize->add_setting(
                        TOEBOX_LESS_COLOR_WARNING,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_LESS_COLOR_WARNING],
                            'sanitize_callback' => 'sanitize_hex_color',
                            'transport'    => 'postMessage'
                        )
        );
        
        $wp_customize->add_control(
                        new WP_Customize_Color_Control(
                                        $wp_customize,
                                        TOEBOX_LESS_COLOR_WARNING,
                                        $SettingsControls[TOEBOX_LESS_COLOR_WARNING]
                        )
        );
        // danger
        $wp_customize->add_setting(
                        TOEBOX_LESS_COLOR_DANGER,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_LESS_COLOR_DANGER],
                            'sanitize_callback' => 'sanitize_hex_color',
                            'transport'    => 'postMessage'
                        )
        );
        
        $wp_customize->add_control(
                        new WP_Customize_Color_Control(
                                        $wp_customize,
                                        TOEBOX_LESS_COLOR_DANGER,
                                        $SettingsControls[TOEBOX_LESS_COLOR_DANGER]
                        )
        );
        
        /**
         * TOEBOX_FONTS
         */
        
        $wp_customize->add_setting(
                        TOEBOX_GOOGLE_FONTS,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_GOOGLE_FONTS],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );
        $wp_customize->add_control(
                        TOEBOX_GOOGLE_FONTS,
                        $SettingsControls[TOEBOX_GOOGLE_FONTS]
        );
        
        
        
        $wp_customize->add_setting(
                        TOEBOX_LESS_FONT_SIZE_BASE,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_LESS_FONT_SIZE_BASE],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );
        $wp_customize->add_control(
                        TOEBOX_LESS_FONT_SIZE_BASE,
                        $SettingsControls[TOEBOX_LESS_FONT_SIZE_BASE]
        );
        
        
        $wp_customize->add_setting(
                        TOEBOX_LESS_FONT_FAMILY_MONOSPACE,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_LESS_FONT_FAMILY_MONOSPACE],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );
        $wp_customize->add_control(
                        TOEBOX_LESS_FONT_FAMILY_MONOSPACE,
                        $SettingsControls[TOEBOX_LESS_FONT_FAMILY_MONOSPACE]
        );
        
        
        $wp_customize->add_setting(
                        TOEBOX_LESS_FONT_FAMILY_SERIF,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_LESS_FONT_FAMILY_SERIF],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );
        $wp_customize->add_control(
                        TOEBOX_LESS_FONT_FAMILY_SERIF,
                        $SettingsControls[TOEBOX_LESS_FONT_FAMILY_SERIF]
        );
        
        
        $wp_customize->add_setting(
                        TOEBOX_LESS_FONT_FAMILY_SANS_SERIF,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_LESS_FONT_FAMILY_SANS_SERIF],
                            'sanitize_callback' => 'sanitize_text_field'
                        )
        );
        $wp_customize->add_control(
                        TOEBOX_LESS_FONT_FAMILY_SANS_SERIF,
                        $SettingsControls[TOEBOX_LESS_FONT_FAMILY_SANS_SERIF]
        );
        
        
        /**
         * TOEBOX_LIST_LAYOUT
         */
        $wp_customize->add_setting(
                        TOEBOX_LIST_LAYOUT,
                        array(
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_LIST_LAYOUT],
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
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_STORY_LAYOUT],
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
                            'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_HIDE_SMALL_SIDEBARS],
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
