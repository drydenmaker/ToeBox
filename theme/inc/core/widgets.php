<?php

/**
 * Register widget areas
 */
add_action( 'widgets_init', function()
{
    // --------------  WIDGETS ---------------------------------------------
    require_once get_template_directory().'/inc/widget/HeaderLogoCornersWidget.php';

    require_once get_template_directory().'/inc/widget/BareMenu.php';
    require_once get_template_directory().'/inc/widget/FlatMenu.php';
    require_once get_template_directory().'/inc/widget/HeaderLogoWidget.php';
    require_once get_template_directory().'/inc/widget/HeaderWidget.php';
    require_once get_template_directory().'/inc/widget/SearchRowWidget.php';

    register_widget( 'toebox\inc\widget\BareMenu' );
    register_widget( 'toebox\inc\widget\FlatMenu' );
    register_widget( 'toebox\inc\widget\HeaderLogoWidget' );
    register_widget( 'toebox\inc\widget\HeaderLogoCornersWidget' );
    register_widget( 'toebox\inc\widget\HeaderWidget' );
    register_widget( 'toebox\inc\widget\SearchRowWidget' );

    // --------------  WIDGET AREAS -------------------------------------------


    register_sidebar(array(
    'name'          => __('Right Sidebar', 'toebox-basic'),
    'description'   => __('Appears on all pages that have a right sidebar.', 'toebox-basic'),
    'id'            => 'toebox_right_sidebar',
    'before_widget' => '<div class="tb_widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
    ));

    register_sidebar(array(
    'name'          => __('Left Sidebar', 'toebox-basic'),
    'description'   => __('Appears on all pages that have a left sidebar.', 'toebox-basic'),
    'id'            => 'toebox_left_sidebar',
    'before_widget' => '<div class="tb_widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
    ));

    register_sidebar(array(
    'name'          => __('Global Header', 'toebox-basic'),
    'description'   => __('Appears on all pages before all content.', 'toebox-basic'),
    'id'            => 'toebox-header',
    'before_widget' => '<div class="tb_widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<!--',
    'after_title'   => '-->',
    ));

    register_sidebar(array(
    'name'          => __('Global Footer', 'toebox-basic'),
    'description'   => __('Appears on all pages after all content.', 'toebox-basic'),
    'id'            => 'toebox-footer',
    'before_widget' => '<div class="tb_widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<!--',
    'after_title'   => '-->',
    ));

    register_sidebar(array(
    'name'          => __('Content Top', 'toebox-basic'),
    'description'   => __('Appears on all pages before content between sidebars.', 'toebox-basic'),
    'id'            => 'toebox_content_top',
    'before_widget' => '<div class="tb_widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
    ));

    register_sidebar(array(
    'name'          => __('Content Bottom', 'toebox-basic'),
    'description'   => __('Appears on all pages after content between sidebars.', 'toebox-basic'),
    'id'            => 'toebox_content_bottom',
    'before_widget' => '<div class="tb_widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
    ));

});
