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
    
    //                      id                      title       callback    page
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




