<?php
namespace toebox\inc;

define('TOEBOX_MORE_TEXT', 'toebox_more_text');

define('TOEBOX_PAGE_LAYOUT', 'toebox_page_laout');
define('TOEBOX_FEATURED_STORY_LAYOUT', 'toebox_custom_page_laout');
define('TOEBOX_LIST_LAYOUT', 'toebox_list_laout');
define('TOEBOX_STORY_LAYOUT', 'toebox_story_laout');
define('TOEBOX_HIDE_SMALL_SIDEBARS', 'toebox_hide_small_sidebars');
define('TOEBOX_FEATURED_IMG_CLASS', 'toebox_featured_img_class');
define('TOEBOX_CONTENT_BACKGROUND_COLOR', 'toebox_background_collor');

define('TOEBOX_USE_WIDGET_FOR_HEADER', 'toebox_header_widget');
define('TOEBOX_USE_WIDGET_FOR_NAV_MENU', 'toebox_nav_widget');

define('TOEBOX_404_MESSAGE', 'toebox_404_message');
define('TOEBOX_ENABLE_404_SEARCH', 'toebox_404_search');
define('TOEBOX_ENABLE_LIST_PAGING', 'toebox_list_paging');

define('TOEBOX_MENU_SUBTITLES', 'toebox_menu_subtitles');

define('TOEBOX_TITLE_SEO', 'toebox_title_seo');

define('TOEBOX_TEMPLATE_SINGLE', 'single');
define('TOEBOX_TEMPLATE_LIST', 'list');

define('TOEBOX_LINK_PAGES_ARGS', 'toebox_link_pages_args');

define('TOEBOX_SETUP', 'toebox_setup');
define('TOEBOX_USE_LESS', 'toebox_use_less');

define('TOEBOX_LESS_COLOR_PRIMARY', 'toebox_less_primary');
define('TOEBOX_LESS_COLOR_SUCCESS', 'toebox_less_success');
define('TOEBOX_LESS_COLOR_INFO', 'toebox_less_info');
define('TOEBOX_LESS_COLOR_WARNING', 'toebox_less_warning');
define('TOEBOX_LESS_COLOR_DANGER', 'toebox_less_danger');

define('TOEBOX_LESS_FONT_SIZE_BASE', 'font_size_base');
define('TOEBOX_LESS_FONT_FAMILY_MONOSPACE', 'font_family_monospace');
define('TOEBOX_LESS_FONT_FAMILY_SERIF', 'font_family_serif');
define('TOEBOX_LESS_FONT_FAMILY_SANS_SERIF', 'font_family_sans_serif');

define('TOEBOX_GOOGLE_FONTS', 'google_fonts');

define('TOEBOX_EXTRA_HEADER', 'extra_header');
define('TOEBOX_EXTRA_FOOTER', 'extra_footer');

define('TOEBOX_BORDER_RADIUS_BASE', 'border-radius-base');
define('TOEBOX_BORDER_RADIUS_LARGE', 'border-radius-large');
define('TOEBOX_BORDER_RADIUS_SMALL', 'border-radius-small');
define('TOEBOX_BORDER_RADIUS_BUTTON_BASE', 'border-radius-button-base');
define('TOEBOX_BORDER_RADIUS_BUTTON_LARGE', 'border-radius-button-large');
define('TOEBOX_BORDER_RADIUS_BUTTON_SMALL', 'border-radius-button-small');

define('TOEBOX_LIST_HEADER', 'tb-list-header');
define('TOEBOX_SINGLE_HEADER', 'tb-single-header');

ToeBox::$SettingsDefaults = array(
    'ver' => '0.0.1',
    TOEBOX_SETUP => false,
    TOEBOX_USE_LESS => false,
    TOEBOX_MORE_TEXT => 'More...',
    TOEBOX_PAGE_LAYOUT => 'right_column',
    TOEBOX_FEATURED_STORY_LAYOUT => 'featured_story',
    TOEBOX_LIST_LAYOUT => 'list_large_img',
    TOEBOX_STORY_LAYOUT => 'single_full_img',
    TOEBOX_HIDE_SMALL_SIDEBARS => '1',
    TOEBOX_FEATURED_IMG_CLASS => 'img-rounded',
    TOEBOX_CONTENT_BACKGROUND_COLOR => '#222',
    TOEBOX_404_MESSAGE => '<p>Sorry, no content was found.</p>',
    TOEBOX_ENABLE_404_SEARCH => true,
    TOEBOX_ENABLE_LIST_PAGING => true,
    TOEBOX_USE_WIDGET_FOR_HEADER => false,
    TOEBOX_USE_WIDGET_FOR_NAV_MENU => false,
    TOEBOX_USE_LESS => false,

    TOEBOX_LESS_COLOR_PRIMARY => '#EC7225',
    TOEBOX_LESS_COLOR_SUCCESS => '#18987B',
    TOEBOX_LESS_COLOR_INFO => '#24569B',
    TOEBOX_LESS_COLOR_WARNING => '#ECA125',
    TOEBOX_LESS_COLOR_DANGER => '#EF5870',


    TOEBOX_LESS_FONT_SIZE_BASE => '14px',
    TOEBOX_LESS_FONT_FAMILY_MONOSPACE => 'Inconsolata, Menlo, Monaco, Consolas, "Courier New", monospace',
    TOEBOX_LESS_FONT_FAMILY_SERIF => 'Playfair, Georgia, "Times New Roman", Times, serif',
    TOEBOX_LESS_FONT_FAMILY_SANS_SERIF => 'Arimo, "Helvetica Neue", Helvetica, Arial, sans-serif',

    TOEBOX_GOOGLE_FONTS => 'Arimo|Playfair|Inconsolata',

    TOEBOX_MENU_SUBTITLES => true,

    TOEBOX_TITLE_SEO => true,

    TOEBOX_LINK_PAGES_ARGS => array(
        'before'      => '<nav><ul class="page-links pagination"><li>',
        'after'       => '</li></ul></nav>',
        'link_before' => '',
        'link_after'  => '',
        'pagelink'    => '%',
        'separator'   => '</li><li>',
    ),
    
    TOEBOX_EXTRA_HEADER => "<!-- NO EXTRA HEADER -->",
    TOEBOX_EXTRA_FOOTER => "<!-- NO EXTRA FOOTER -->",
    
    TOEBOX_BORDER_RADIUS_BASE => "0",
    TOEBOX_BORDER_RADIUS_LARGE => "0",
    TOEBOX_BORDER_RADIUS_SMALL => "0",
    
    TOEBOX_BORDER_RADIUS_BUTTON_BASE => "4px",
    TOEBOX_BORDER_RADIUS_BUTTON_LARGE => "5px",
    TOEBOX_BORDER_RADIUS_BUTTON_SMALL => "3px",
    
    TOEBOX_LIST_HEADER => '<header class="entry-header {class}">
        <h3><a href="{link}">{title}</a></h3>
    </header>',
    TOEBOX_SINGLE_HEADER => '<header class="entry-header {class}">
        <h3><a href="{link}">{title}</a></h3>
    </header>',
    

);

$pageLayoutOptions = array(
    'open' => __( 'Open','toebox-basic' ),
    'no_column' => __( 'Single Column','toebox-basic' ),
    'left_column' => __( 'Left Column','toebox-basic' ),
    'three_column' => __( 'Three Column','toebox-basic' ),
    'right_column' => __( 'Right Column','toebox-basic' ),
    'two_right_column' => __( 'Two Right Columns','toebox-basic' ),
    'two_left_column' => __( 'Two Left Columns','toebox-basic' )
);

ToeBox::$OptionsToInclude = array(
    TOEBOX_MORE_TEXT,
    TOEBOX_LIST_HEADER,
    TOEBOX_SINGLE_HEADER,
    TOEBOX_EXTRA_HEADER,
    TOEBOX_EXTRA_FOOTER,
    TOEBOX_BORDER_RADIUS_BASE,
    TOEBOX_BORDER_RADIUS_LARGE,
    TOEBOX_BORDER_RADIUS_SMALL,
    TOEBOX_BORDER_RADIUS_BUTTON_BASE,
    TOEBOX_BORDER_RADIUS_BUTTON_LARGE,
    TOEBOX_BORDER_RADIUS_BUTTON_SMALL
);

$CustomizerSettingsControls = array(

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