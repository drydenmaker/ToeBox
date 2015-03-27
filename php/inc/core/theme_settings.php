<?php
/**
 * ----------------------------------------------------------------------------
 * SETTINGS UI
 * ----------------------------------------------------------------------------
 */


$SettingsControls = array(
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
    TOEBOX_CONTENT_BACKGROUND_COLOR => array(
                            'label' => __( 'Content background color.', 'toebox-basic' ),
                            'section' => 'colors',
                            'settings' => TOEBOX_CONTENT_BACKGROUND_COLOR,
    ),
    TOEBOX_HIDE_SMALL_SIDEBARS=>  array(
                            'label' => __( 'Hide Left Side Bar On Small Screens', 'toebox-basic' ),
                            'section' => 'toebox_page_layout_section',
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
    TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE =>  array(
                            'label' => __( 'Enable Featured Stories', 'toebox-basic' ),
                            'section' => 'toebox_post_type_section',
                            'type' => 'checkbox'
                    ),
    TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE =>  array(
                            'label' => __( 'Enable Carousel Links', 'toebox-basic' ),
                            'section' => 'toebox_post_type_section',
                            'type' => 'checkbox'
                    ),
    
);

add_action( 'admin_init', function (  ) {

    register_setting( 'toeboxSettingsPage', 'toebox_settings' );

    // UNCOMMENT to display look and feel settings
//     add_settings_section(
//                         'toebox_pluginPage_section',
//                         __( 'ToeBox lets you mix and match many different layout options. Select your default page layout and default list size below:', 'toebox-basic' ),
//                         'toebox_settings_section_callback',
//                         'toeboxSettingsPage'
//                     );

    add_settings_field(
        TOEBOX_PAGE_LAYOUT,
        __( 'Page Layout', 'toebox-basic' ),
        'toebox_select_page_layout_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        toebox\inc\Toebox::$Settings[TOEBOX_PAGE_LAYOUT]
    );
    
    add_settings_field(
        TOEBOX_FEATURED_STORY_LAYOUT,
        __( 'Featured Story Layout', 'toebox-basic' ),
        'toebox_select_featured_story_layout_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        toebox\inc\Toebox::$Settings[TOEBOX_FEATURED_STORY_LAYOUT]
    );
    

    add_settings_field(
        TOEBOX_CONTENT_BACKGROUND_COLOR,
        __( 'Content background color.', 'toebox-basic' ),
        'toebox_content_background_color_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        toebox\inc\Toebox::$Settings[TOEBOX_CONTENT_BACKGROUND_COLOR]
    );
    

    add_settings_field(
        TOEBOX_LIST_LAYOUT,
        __( 'Post List Layout', 'toebox-basic' ),
        'toebox_list_layout_select_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        toebox\inc\Toebox::$Settings[TOEBOX_LIST_LAYOUT]
    );

    add_settings_field(
        TOEBOX_STORY_LAYOUT,
        __( 'Single Post Layout', 'toebox-basic' ),
        'toebox_story_layout_select_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        toebox\inc\Toebox::$Settings[TOEBOX_STORY_LAYOUT]
    );


    add_settings_field(
        TOEBOX_HIDE_SMALL_SIDEBARS,
        __( 'Hide Left Side Bar On Small Screens', 'toebox-basic' ),
        'toebox_hide_small_sidebars_render',
        'toeboxSettingsPage',
        'toebox_pluginPage_section',
        toebox\inc\Toebox::$Settings[TOEBOX_HIDE_SMALL_SIDEBARS]
    );
    /* POST TYPES */
    
    add_settings_section(
            'toebox_posttype_section',
            null,
            'toebox_posttype_section_callback',
            'toeboxSettingsPage'
        );
    
    add_settings_field(
        TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE,
        __( 'Enable Featured Stories', 'toebox-basic' ),
        'toebox_feature_stories_posttype_render',
        'toeboxSettingsPage',
        'toebox_posttype_section',
        get_option(TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE)
    );
    add_settings_field(
        TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE,
        __( 'Enable Carousel Links', 'toebox-basic' ),
        'toebox_carousel_posttype_render',
        'toeboxSettingsPage',
        'toebox_posttype_section',
        get_option(TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE)
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

    if( is_admin() ) {
         
        // Add the color picker css file
        wp_enqueue_style( 'wp-color-picker' );         
        // Include our custom jQuery file with WordPress Color Picker dependency
       // wp_enqueue_script( 'custom-script-handle', plugins_url( 'custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    }
});

add_action( 'admin_menu', function (  ) {

    add_menu_page( 'ToeBox', 'ToeBox', 'manage_options', 'toebox', 'toebox_options_page' );

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
        
//         $wp_customize->add_section(
//                         'toebox_post_type_section',
//                         array(
//                             'title' => __( 'Special Post Types', 'toebox-basic' ),
//                             'description' => __( 'These settings are specific to ToeBox.', 'toebox-basic' ),
//                             'priority' => 95,
//                         )
//         );
        
        
    
        /**
         * TOEBOX_PAGE_LAYOUT
         */
        $wp_customize->add_setting(
                        TOEBOX_PAGE_LAYOUT,
                        array(
                            'default' => toebox\inc\ToeBox::$Settings[TOEBOX_PAGE_LAYOUT],
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
         * TOEBOX_LIST_LAYOUT
         */
        $wp_customize->add_setting(
                        TOEBOX_LIST_LAYOUT,
                        array(
                            'default' => toebox\inc\ToeBox::$Settings[TOEBOX_LIST_LAYOUT],
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
                        )
        );
        
        $wp_customize->add_control(
                        TOEBOX_HIDE_SMALL_SIDEBARS,
                        $SettingsControls[TOEBOX_HIDE_SMALL_SIDEBARS]
        );
        
        /**
         * TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE
         */
//         $wp_customize->add_setting(
//                         TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE,
//                         array(
//                             'default' => toebox\inc\ToeBox::$Settings[TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE],
//                         )
//         );
        
//         $wp_customize->add_control(
//                         TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE,
//                         $SettingsControls[TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE]
//         );
        
        /**
         * TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE
         */
//         $wp_customize->add_setting(
//                         TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE,
//                         array(
//                             'default' => toebox\inc\ToeBox::$Settings[TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE],
//                         )
//         );
        
//         $wp_customize->add_control(
//                         TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE,
//                         $SettingsControls[TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE]
//         );
        
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
        <h4>(You can use Appearance > Customize to change theme settings too.)</h4>
		<?php
		settings_fields( 'toeboxSettingsPage' );
		do_settings_sections( 'toeboxSettingsPage' );
		submit_button();
		?>

	</form>
	<?php
	

}
