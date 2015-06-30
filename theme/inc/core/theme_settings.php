<?php
/**
 * ----------------------------------------------------------------------------
 * SETTINGS UI
 * ----------------------------------------------------------------------------
 */


add_action( 'admin_menu', function (  ) {

    add_theme_page( 'Advanced', 'Advanced', 'manage_options', 'toebox', 'toebox_theme_options_page' );
    add_editor_style('custom-editor-style.css');

});

function toebox_theme_options_page(  ) {


    if(isset($_GET['settings-updated']) && $_GET['settings-updated'])
    {
        if (class_exists('WPLessPlugin', false) && toebox\inc\ToeBox::$Settings[TOEBOX_USE_LESS])
        {
            WPLessPlugin::getInstance()->processStylesheets();
        }

        print '<div id="setting-error-settings_updated" class="updated settings-error">';
        print '<p><strong>updated theme settings</strong></p>';
        print '</div>';

    }
    
	?>
	<form action='options.php' method='post'>

		<h2>ToeBox Advanced Options</h2>
        <h4>You can use Appearance > <a href="./customize.php">Customize</a> to change most theme settings.</h4>
        <small>**Only change things here if you are sure of the effects. These are <strong>global</strong> settings.</small>
		<?php
		settings_fields( 'toeboxSettingsSection' );
		do_settings_sections( 'theme-options' );
		submit_button();
		?>

	</form>
	<?php

}

add_action( 'admin_init', function (  ) {
    
    
    add_settings_section("toeboxSettingsSection", "Global Text", null, "theme-options");
    
    // TOEBOX_MORE_TEXT
    register_setting("toeboxSettingsSection", TOEBOX_MORE_TEXT);
    add_settings_field(
        TOEBOX_MORE_TEXT,
        __( '"Read More" Text', 'toebox-basic' ),
        function($value){

            DisplayTextbox(TOEBOX_MORE_TEXT);
            print "<div><small>This is placed at the end of exerpts and when using the 'more' tags on posts.</small></div>";

        },
        'theme-options',
        'toeboxSettingsSection',
        get_option(TOEBOX_MORE_TEXT)
    );
    


    // TOEBOX_LIST_HEADER
    register_setting("toeboxSettingsSection", TOEBOX_LIST_HEADER);
    add_settings_field(
                    TOEBOX_LIST_HEADER,
                    __( 'Title Format: LIST', 'toebox-basic' ),
                    function($value){
    
                        DisplayTextArea(TOEBOX_LIST_HEADER);
                        print "<div><small>This is the format of the title when listing posts.</small></div>";
                        print "<div><small>Use the following place holders <b>{title}</b> post title, <b>{link}</b> perma link, <b>{class}</b> extra css classes </small></div>";
    
                    },
                    'theme-options',
                    'toeboxSettingsSection',
                    get_option(TOEBOX_LIST_HEADER)
    );
    


    // TOEBOX_SINGLE_HEADER
    register_setting("toeboxSettingsSection", TOEBOX_SINGLE_HEADER);
    add_settings_field(
                    TOEBOX_SINGLE_HEADER,
                    __( 'Title Format: SINGLE', 'toebox-basic' ),
                    function($value){
    
                        DisplayTextArea(TOEBOX_SINGLE_HEADER);
                        print "<div><small>This is the format of the title when showing only one.</small></div>";
                        print "<div><small>Use the following place holders <b>{title}</b> post title, <b>{link}</b> perma link, <b>{class}</b> extra css classes </small></div>";
    
                    },
                    'theme-options',
                    'toeboxSettingsSection',
                    get_option(TOEBOX_SINGLE_HEADER)
    );
    
    // TOEBOX_EXTRA_HEADER
    register_setting("toeboxSettingsSection", TOEBOX_EXTRA_HEADER);
    add_settings_field(
        TOEBOX_EXTRA_HEADER,
        __( 'Header Text', 'toebox-basic' ),
        function($value){ 

            DisplayTextArea(TOEBOX_EXTRA_HEADER);
            print "<div><small>This is placed between the header tags before the body of every page.  Place meta, script or css link tags here.</small></div>";
            print "<div><small><b>NOTE:</b> If you need something displayed it is recomended that you use Widgets.</small></div>";
        
        },
        'theme-options',
        'toeboxSettingsSection',
        get_option(TOEBOX_EXTRA_HEADER)
    );
    
    // TOEBOX_EXTRA_FOOTER
    register_setting("toeboxSettingsSection", TOEBOX_EXTRA_FOOTER);
    add_settings_field(
        TOEBOX_EXTRA_FOOTER,
        __( 'Footer Text', 'toebox-basic' ),
        function($value){

            DisplayTextArea(TOEBOX_EXTRA_FOOTER);
            print "<div><small>This is placed at the very end of the body of every page.</small></div>";
            print "<div><small><b>NOTE:</b> If you need something displayed it is recomended that you use Widgets.</small></div>";

        },
        'theme-options',
        'toeboxSettingsSection',
        get_option(TOEBOX_EXTRA_FOOTER)
    );
    
    add_settings_section("toeboxCornerLayousSection", "Corner Radius", null, "theme-options");
    
    // TOEBOX_BORDER_RADIUS_BASE
    register_setting("toeboxSettingsSection", TOEBOX_BORDER_RADIUS_BASE);
    add_settings_field(
                    TOEBOX_BORDER_RADIUS_BASE,
                    __( 'Base Radius', 'toebox-basic' ),
                    function($value){
    
                        DisplayTextbox(TOEBOX_BORDER_RADIUS_BASE);
                        print "<div><small>any value other than 0 must includ px (ex 4px)</small></div>";
    
                    },
                    'theme-options',
                    'toeboxCornerLayousSection',
                    get_option(TOEBOX_BORDER_RADIUS_BASE)
    );
    // TOEBOX_BORDER_RADIUS_LARGE
    register_setting("toeboxSettingsSection", TOEBOX_BORDER_RADIUS_LARGE);
    add_settings_field(
                    TOEBOX_BORDER_RADIUS_LARGE,
                    __( 'Large Radius', 'toebox-basic' ),
                    function($value){
    
                        DisplayTextbox(TOEBOX_BORDER_RADIUS_LARGE);
                        print "<div><small>any value other than 0 must includ px (ex 6px)</small></div>";
    
                    },
                    'theme-options',
                    'toeboxCornerLayousSection',
                    get_option(TOEBOX_BORDER_RADIUS_LARGE)
    );
    // TOEBOX_BORDER_RADIUS_SMALL
    register_setting("toeboxSettingsSection", TOEBOX_BORDER_RADIUS_SMALL);
    add_settings_field(
                    TOEBOX_BORDER_RADIUS_SMALL,
                    __( 'Small Radius', 'toebox-basic' ),
                    function($value){
    
                        DisplayTextbox(TOEBOX_BORDER_RADIUS_SMALL);
                        print "<div><small>any value other than 0 must includ px (ex 3px)</small></div>";
    
                    },
                    'theme-options',
                    'toeboxCornerLayousSection',
                    get_option(TOEBOX_BORDER_RADIUS_SMALL)
    );
    

    add_settings_section("toeboxButtonCornerLayousSection", "Button Corner Radius", null, "theme-options");
    // TOEBOX_BORDER_RADIUS_BUTTON_BASE
    register_setting("toeboxSettingsSection", TOEBOX_BORDER_RADIUS_BUTTON_BASE);
    add_settings_field(
                    TOEBOX_BORDER_RADIUS_BUTTON_BASE,
                    __( 'Default <b>Button</b> Radius', 'toebox-basic' ),
                    function($value){
    
                        DisplayTextbox(TOEBOX_BORDER_RADIUS_BUTTON_BASE);
                        print "<div><small>any value other than 0 must includ px (ex 3px)</small></div>";
    
                    },
                    'theme-options',
                    'toeboxButtonCornerLayousSection',
                    get_option(TOEBOX_BORDER_RADIUS_BUTTON_BASE)
    );
    // TOEBOX_BORDER_RADIUS_BUTTON_LARGE
    register_setting("toeboxSettingsSection", TOEBOX_BORDER_RADIUS_BUTTON_LARGE);
    add_settings_field(
                    TOEBOX_BORDER_RADIUS_BUTTON_LARGE,
                    __( 'Large <b>Button</b> Radius', 'toebox-basic' ),
                    function($value){
    
                        DisplayTextbox(TOEBOX_BORDER_RADIUS_BUTTON_LARGE);
                        print "<div><small>any value other than 0 must includ px (ex 3px)</small></div>";
    
                    },
                    'theme-options',
                    'toeboxButtonCornerLayousSection',
                    get_option(TOEBOX_BORDER_RADIUS_BUTTON_LARGE)
    );
    // TOEBOX_BORDER_RADIUS_BUTTON_SMALL
    register_setting("toeboxSettingsSection", TOEBOX_BORDER_RADIUS_BUTTON_SMALL);
    add_settings_field(
                    TOEBOX_BORDER_RADIUS_BUTTON_SMALL,
                    __( 'Small <b>Button</b> Radius', 'toebox-basic' ),
                    function($value){
    
                        DisplayTextbox(TOEBOX_BORDER_RADIUS_BUTTON_SMALL);
                        print "<div><small>any value other than 0 must includ px (ex 3px)</small></div>";
    
                    },
                    'theme-options',
                    'toeboxButtonCornerLayousSection',
                    get_option(TOEBOX_BORDER_RADIUS_BUTTON_SMALL)
    );
    

});

function DisplaySelect($key, $options)
{
    print toebox\inc\Forms::FormatSelect($options, $key, toebox\inc\Toebox::$Settings[$key]);
}

function DisplayTextArea($key)
{
    print toebox\inc\Forms::FormatTextArea($key, toebox\inc\Toebox::$Settings[$key]);
}

function DisplayTextbox($key)
{
    print toebox\inc\Forms::FormatTextbox($key, toebox\inc\Toebox::$Settings[$key]);
}

//     register_setting( 'toeboxSettingsPage', 'toebox_settings' );

//     add_settings_field(
//         TOEBOX_PAGE_LAYOUT,
//         __( 'Page Layout', 'toebox-basic' ),
//         'toebox_select_page_layout_render',
//         'toeboxSettingsPage',
//         'toebox_pluginPage_section',
//         get_option(TOEBOX_PAGE_LAYOUT)
//     );

//     add_settings_field(
//         TOEBOX_FEATURED_STORY_LAYOUT,
//         __( 'Featured Story Layout', 'toebox-basic' ),
//         'toebox_select_featured_story_layout_render',
//         'toeboxSettingsPage',
//         'toebox_pluginPage_section',
//         get_option(TOEBOX_FEATURED_STORY_LAYOUT)
//     );


//     add_settings_field(
//         TOEBOX_CONTENT_BACKGROUND_COLOR,
//         __( 'Content background color.', 'toebox-basic' ),
//         'toebox_content_background_color_render',
//         'toeboxSettingsPage',
//         'toebox_pluginPage_section',
//         get_option(TOEBOX_CONTENT_BACKGROUND_COLOR)
//     );


//     add_settings_field(
//         TOEBOX_LIST_LAYOUT,
//         __( 'Post List Layout', 'toebox-basic' ),
//         'toebox_list_layout_select_render',
//         'toeboxSettingsPage',
//         'toebox_pluginPage_section',
//         get_option(TOEBOX_LIST_LAYOUT)
//     );

//     add_settings_field(
//         TOEBOX_STORY_LAYOUT,
//         __( 'Single Post Layout', 'toebox-basic' ),
//         'toebox_story_layout_select_render',
//         'toeboxSettingsPage',
//         'toebox_pluginPage_section',
//         get_option(TOEBOX_STORY_LAYOUT)
//     );


//     add_settings_field(
//         TOEBOX_HIDE_SMALL_SIDEBARS,
//         __( 'Hide Left Side Bar On Small Screens', 'toebox-basic' ),
//         'toebox_hide_small_sidebars_render',
//         'toeboxSettingsPage',
//         'toebox_pluginPage_section',
//         get_option(TOEBOX_HIDE_SMALL_SIDEBARS)
//     );


// });

// function selectFor($key, $value)
// {
//     global $SettingsControls;

//     $ctrlName = sprintf('toebox_settings[%s]', $key);
//     return toebox\inc\Forms::FormatSelect($SettingsControls[$key]['choices'], $ctrlName, $value);
// }
// function checkboxFor($key, $value, $checkedValue = 1)
// {
//     global $SettingsControls;

//     $ctrlName = sprintf('toebox_settings[%s]', $key);
//     return toebox\inc\Forms::FormatCheckbox($checkedValue, $ctrlName, $value);
// }
// function colorPickerFor($key, $value)
// {
//     global $SettingsControls;

//     $ctrlName = sprintf('toebox_settings[%s]', $key);
//     return toebox\inc\Forms::FormatColorPicker($ctrlName, $value);
// }

// function toebox_select_page_layout_render($value)
// {
//     print selectFor(TOEBOX_PAGE_LAYOUT, $value);
// }
// function toebox_select_featured_story_layout_render($value)
// {
//     print selectFor(TOEBOX_FEATURED_STORY_LAYOUT, $value);
// }
// function toebox_list_layout_select_render($value)
// {
//     print selectFor(TOEBOX_LIST_LAYOUT, $value);
// }
// function toebox_story_layout_select_render($value)
// {
//     print selectFor(TOEBOX_STORY_LAYOUT, $value);
// }

// function toebox_hide_small_sidebars_render($value)
// {
//    print checkboxFor(TOEBOX_HIDE_SMALL_SIDEBARS, $value);
// }
// /* POST TYPE */
// function toebox_feature_stories_posttype_render($value)
// {
//     print checkboxFor(TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE, $value);
// }
// function toebox_carousel_posttype_render($value)
// {
//     print checkboxFor(TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE, $value);
// }

// function toebox_content_background_color_render($value)
// {
//     print colorPickerFor(TOEBOX_CONTENT_BACKGROUND_COLOR, $value);
// }

// add_action( 'admin_enqueue_scripts', function ( $hook )
// {

//     if( is_admin() ) wp_enqueue_style( 'wp-color-picker' );

// });

// function tb_setup_field($value)
// {
//     CustomizerSettingsSave();
//     return sanitize_text_field($value);
// }

// function toebox_settings_section_callback(  ) {

// 	echo __( 'Select your default page layout and default list layout below.', 'toebox-basic' );

// }

// function toebox_posttype_section_callback(  ) {

//     echo __( 'Enable ToeBox special post types below.', 'toebox-basic' );

// }





