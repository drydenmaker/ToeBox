<?php
if (toebox\inc\Toebox::$Settings[TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE])
{
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
    		'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
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
    	add_shortcode('carousel', 'carousel_function');
    	
    	/**
    	 * Add UI Buttons
    	 */
    // 	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
    // 	{
    	    add_filter('mce_external_plugins', 'tb_carousel_add_tmce_plugin');
    	    add_filter('mce_buttons', 'tb_carousel_register_tmce_button');
    // 	}
    
    });
    
    function tb_carousel_register_tmce_button($buttons)
    {
        array_push($buttons,'separator', "tb_carousel");
        
        return $buttons;
    }
    
    function tb_carousel_add_tmce_plugin($plugin_array)
    {
        $plugin_array['tb_carousel'] = get_bloginfo('template_url').'/js/toebox_carousel_tmce.js';
        return $plugin_array;
    }
    
    $validStyles = array('slide', 'short', 'triple');
    
    function carousel_function($attirbutes, $content = '') 
    {
        static $defaults = array(
            'style' => 'slide', // slide, short, triple
            'category' => 'all',
            'interval' => 5000,
            'pause' => 'hover',
            'wrap' => true,
            'keyboard' => true,
            'effect' => 'none',
            'post_count' => 3
        );
        static $carouselCount = 0;
        $carouselCount++;
    
        // combine and filter attributes
        $attirbutes = shortcode_atts($defaults, $attirbutes, 'carousel_links');
        
        $queryArguments = array(
            'post_type' => 'carousel_link_posts', 
            'post_status' => 'publish', 
            'posts_per_page' => $attirbutes['post_count'],
            'order' => 'ASC',
	        'orderby' => 'menu_order',
         );
        if (!empty($attirbutes['category']) && $attirbutes['category'] != 'all') 
        {
            $queryArguments['category_name'] = $attirbutes['category'];
        }
        
        switch ($attirbutes['style']) {
            case 'triple':
                $templateName = 'triple';
                break;
            case 'short':
                $templateName = 'short';
                break;
            default:
                $templateName = 'slide';
                break;
        }
        
        $carouselQuery = new WP_Query($queryArguments);
        
        if (!$carouselQuery->have_posts()) return '<!-- no posts carousel posts -->';
        
        $attirbutes = array_diff_key($attirbutes, array_flip(array('category', 'style')));
        extract($attirbutes);
        
        ob_start();
        include TEMPLATEPATH . "/tpl/carousel/$templateName.php";
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    
    }
}