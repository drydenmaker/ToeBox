<?php
/**
 * Register Carousel Links
 */
// Register Custom Post Type
add_action( 'init', function() {

	$labels = array(
		'name'                => _x( 'Carousel Links', 'Post Type General Name', 'toebox-basic' ),
		'singular_name'       => _x( 'Carousel Link', 'Post Type Singular Name', 'toebox-basic' ),
		'menu_name'           => __( 'Carousel Links', 'toebox-basic' ),
		'parent_item_colon'   => __( 'Parent Item:', 'toebox-basic' ),
		'all_items'           => __( 'All Items', 'toebox-basic' ),
		'view_item'           => __( 'View Carousel Link', 'toebox-basic' ),
		'add_new_item'        => __( 'Add New Carousel Link', 'toebox-basic' ),
		'add_new'             => __( 'Add New', 'toebox-basic' ),
		'edit_item'           => __( 'Edit Carousel Link', 'toebox-basic' ),
		'update_item'         => __( 'Update Carousel Link', 'toebox-basic' ),
		'search_items'        => __( 'Search Carousel Links', 'toebox-basic' ),
		'not_found'           => __( 'Not found', 'toebox-basic' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'toebox-basic' ),
	);
	$args = array(
		'label'               => __( 'carousel_link_posts', 'toebox-basic' ),
		'description'         => __( 'Links that have a body of content used in a carousel.', 'toebox-basic' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'          => array( 'category', 'post_tag', 'link_category', 'post_format' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-images-alt2',
		'show_in_admin_bar'   => false,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'carousel_link_posts', $args );

});
