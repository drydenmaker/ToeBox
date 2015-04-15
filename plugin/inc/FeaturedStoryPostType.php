<?php
namespace toebox\plugin\inc;

class FeaturedStoryPostType extends BasePlugin
{
    const TOEBOX_ENABLE_FEATURED = 'enable_featured';
    
    /* (non-PHPdoc)
     * @see \toebox\plugin\inc\BasePlugin::Initialize()
     */
    protected function Initialize()
    {
        // TODO: check settings to see if this should be enabled
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
        
        $this->PostTypes['featured_story'] = array(
                    'label'               => 'featured_story',
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
        
    }


}