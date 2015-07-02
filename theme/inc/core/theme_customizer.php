<?php

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



add_action( 'customize_register', function(WP_Customize_Manager $wp_customize )
{

    global $CustomizerSettingsControls;

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
                    $CustomizerSettingsControls[TOEBOX_USE_WIDGET_FOR_HEADER]
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
                    $CustomizerSettingsControls[TOEBOX_USE_WIDGET_FOR_NAV_MENU]
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
                    $CustomizerSettingsControls[TOEBOX_PAGE_LAYOUT]
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
                                    $CustomizerSettingsControls[TOEBOX_CONTENT_BACKGROUND_COLOR]
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
                    $CustomizerSettingsControls[TOEBOX_USE_LESS]
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
                                    $CustomizerSettingsControls[TOEBOX_LESS_COLOR_PRIMARY]
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
                                    $CustomizerSettingsControls[TOEBOX_LESS_COLOR_SUCCESS]
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
                                    $CustomizerSettingsControls[TOEBOX_LESS_COLOR_INFO]
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
                                    $CustomizerSettingsControls[TOEBOX_LESS_COLOR_WARNING]
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
                                    $CustomizerSettingsControls[TOEBOX_LESS_COLOR_DANGER]
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
                    $CustomizerSettingsControls[TOEBOX_GOOGLE_FONTS]
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
                    $CustomizerSettingsControls[TOEBOX_LESS_FONT_SIZE_BASE]
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
                    $CustomizerSettingsControls[TOEBOX_LESS_FONT_FAMILY_MONOSPACE]
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
                    $CustomizerSettingsControls[TOEBOX_LESS_FONT_FAMILY_SERIF]
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
                    $CustomizerSettingsControls[TOEBOX_LESS_FONT_FAMILY_SANS_SERIF]
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
                    $CustomizerSettingsControls[TOEBOX_LIST_LAYOUT]
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
                    $CustomizerSettingsControls[TOEBOX_STORY_LAYOUT]
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
                    $CustomizerSettingsControls[TOEBOX_HIDE_SMALL_SIDEBARS]
    );

    /**
     * TOEBOX_SETUP
    */
    $wp_customize->add_setting(
                    TOEBOX_SETUP,
                    array(
                        'default' => toebox\inc\ToeBox::$SettingsDefaults[TOEBOX_SETUP],
                        'sanitize_callback' => 'tb_setup_field'
                    )
    );

    $wp_customize->add_control(
                    TOEBOX_SETUP,
                    $CustomizerSettingsControls[TOEBOX_SETUP]
    );


});

function CustomizerSettingsSave()
{
    if (toebox\inc\ToeBox::$Settings[TOEBOX_USE_LESS] && class_exists('WPLessPlugin', false))
    {
        WPLessPlugin::getInstance()->processStylesheets();
    }
}