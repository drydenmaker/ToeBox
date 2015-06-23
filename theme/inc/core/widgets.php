<?php

/**
 * Register widget areas
 */
add_action( 'widgets_init', function()
{
    // add shortcode support
    add_filter( 'widget_text', 'shortcode_unautop' );
    add_filter( 'widget_text', 'do_shortcode' );
    
    // --------------  WIDGETS ---------------------------------------------
    require_once get_template_directory().'/inc/widget/HeaderLogoCornersWidget.php';

    require_once get_template_directory().'/inc/widget/BareMenu.php';
    require_once get_template_directory().'/inc/widget/FlatMenu.php';
    require_once get_template_directory().'/inc/widget/HeaderLogoWidget.php';
    require_once get_template_directory().'/inc/widget/HeaderWidget.php';
    require_once get_template_directory().'/inc/widget/SearchRowWidget.php';
    require_once get_template_directory().'/inc/widget/AccordionMenu.php';
    require_once get_template_directory().'/inc/widget/TouchMenu.php';

    register_widget( 'toebox\inc\widget\HeaderLogoWidget' );
    register_widget( 'toebox\inc\widget\HeaderLogoCornersWidget' );
    register_widget( 'toebox\inc\widget\HeaderWidget' );
    register_widget( 'toebox\inc\widget\AccordionMenu' );
    register_widget( 'toebox\inc\widget\TouchMenu' );

    // --------------  WIDGET AREAS -------------------------------------------


    register_sidebar(array(
        'name'          => __('Right Sidebar', 'toebox-basic'),
        'description'   => __('Appears on all pages that have a right sidebar.', 'toebox-basic'),
        'id'            => 'toebox_right_sidebar',
        'before_widget' => '<div id="%1$s" class="tb_widget %2$s clearfix">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Left Sidebar', 'toebox-basic'),
        'description'   => __('Appears on all pages that have a left sidebar.', 'toebox-basic'),
        'id'            => 'toebox_left_sidebar',
        'before_widget' => '<div id="%1$s" class="tb_widget %2$s clearfix">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Global Header', 'toebox-basic'),
        'description'   => __('Appears on all pages before all content.', 'toebox-basic'),
        'id'            => 'toebox-header',
        'before_widget' => '<div id="%1$s" class="tb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!--',
        'after_title'   => '-->',
    ));

    register_sidebar(array(
        'name'          => __('Global Footer', 'toebox-basic'),
        'description'   => __('Appears on all pages after all content.', 'toebox-basic'),
        'id'            => 'toebox-footer',
        'before_widget' => '<div id="%1$s" class="tb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!--',
        'after_title'   => '-->',
    ));
    
    register_sidebar(array(
        'name'          => __('Container Header', 'toebox-basic'),
        'description'   => __('Appears on all pages before all content within the container.', 'toebox-basic'),
        'id'            => 'toebox-container-header',
        'before_widget' => '<div id="%1$s" class="row tb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!--',
        'after_title'   => '-->',
    ));
    
    register_sidebar(array(
        'name'          => __('Container Footer', 'toebox-basic'),
        'description'   => __('Appears on all pages after all content within the container.', 'toebox-basic'),
        'id'            => 'toebox-container-footer',
        'before_widget' => '<div id="%1$s" class="row tb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<!--',
        'after_title'   => '-->',
    ));

    register_sidebar(array(
        'name'          => __('Content Top', 'toebox-basic'),
        'description'   => __('Appears before post/page content between sidebars.', 'toebox-basic'),
        'id'            => 'toebox_content_top',
        'before_widget' => '<div id="%1$s" class="tb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Content Bottom', 'toebox-basic'),
        'description'   => __('Appears after post/page content between sidebars.', 'toebox-basic'),
        'id'            => 'toebox_content_bottom',
        'before_widget' => '<div id="%1$s" class="tb_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));

});
