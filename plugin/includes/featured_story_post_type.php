<?php
if (toebox\inc\Toebox::$Settings[TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE])
{
    /**
     * Register widget areas
     */
    add_action( 'widgets_init', function()
    {
        // --------------  WIDGET AREAS -------------------------------------------
    
        register_sidebar(array(
        'name'          => __('Featured  Header', 'toebox-basic'),
        'description'   => __('Appears on all pages before all content.', 'toebox-basic'),
        'id'            => 'featured_header',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!--',
        'after_title'   => '-->',
        ));
    
        register_sidebar(array(
        'name'          => __('Featured  Footer', 'toebox-basic'),
        'description'   => __('Appears on all pages after all content.', 'toebox-basic'),
        'id'            => 'featured_footer',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<!--',
        'after_title'   => '-->',
        ));
    
    
        register_sidebar(array(
        'name'          => __('Featured Left Sidebar', 'toebox-basic'),
        'description'   => __('Appears on all pages that have a left sidebar.', 'toebox-basic'),
        'id'            => 'featured_left_sidebar',
        'before_widget' => '<div class="tb_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
        ));
    
    
        register_sidebar(array(
        'name'          => __('Right Sidebar', 'toebox-basic'),
        'description'   => __('Appears on all pages that have a right sidebar.', 'toebox-basic'),
        'id'            => 'featured_right_sidebar',
        'before_widget' => '<div class="tb_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
        ));
    
    
        register_sidebar(array(
        'name'          => __('Featured Content Top', 'toebox-basic'),
        'description'   => __('Appears on all pages before content between sidebars.', 'toebox-basic'),
        'id'            => 'featured_content_top',
        'before_widget' => '<div class="tb_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
        ));
    
        register_sidebar(array(
        'name'          => __('Featured Content Bottom', 'toebox-basic'),
        'description'   => __('Appears on all pages after content between sidebars.', 'toebox-basic'),
        'id'            => 'featured_content_bottom',
        'before_widget' => '<div class="tb_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
        ));
    
    });
    
    // Register Custom Post Type
    add_action( 'init', function () {
    
        $labels = array(
            'name'                => _x( 'Featured Stories', 'Post Type General Name', 'toebox-basic' ),
            'singular_name'       => _x( 'Featured Story', 'Post Type Singular Name', 'toebox-basic' ),
            'menu_name'           => __( 'Featured Stories', 'toebox-basic' ),
            'parent_item_colon'   => __( 'Parent Story:', 'toebox-basic' ),
            'all_items'           => __( 'All Stories', 'toebox-basic' ),
            'view_item'           => __( 'View Featured Story', 'toebox-basic' ),
            'add_new_item'        => __( 'Add New Featured Stories', 'toebox-basic' ),
            'add_new'             => __( 'Add New', 'toebox-basic' ),
            'edit_item'           => __( 'Edit Story', 'toebox-basic' ),
            'update_item'         => __( 'Update Story', 'toebox-basic' ),
            'search_items'        => __( 'Search Featured Stories', 'toebox-basic' ),
            'not_found'           => __( 'Not found', 'toebox-basic' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'toebox-basic' ),
        );
        $args = array(
            'label'               => __( 'featured_story', 'toebox-basic' ),
            'description'         => __( 'Featured Story Content', 'toebox-basic' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions'),
            'taxonomies'          => array( 'category', 'post_tag' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-heart',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'query_var'           => 'featured_story',
            'capability_type'     => 'post',
        );
        register_post_type( 'featured_story', $args );
    
    });
}