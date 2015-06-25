<?php
namespace toebox\plugin\inc;

use toebox\plugin\inc\PluginController;
class CarouselPostType extends BasePlugin
{
    const ENABLE = 'enable_carousel';
    const POST_TYPE = 'carousel_link_post';
    /**
     * plugin constructor saves this latest instance to $Instance
     */
    function __construct()
    {
        self::$Instance = $this;
    }
    
    /* (non-PHPdoc)
     * @see \toebox\plugin\inc\BasePlugin::Initialize()
     */
    protected function Initialize()
    {
        // TODO: check settings to see if this should be enabled
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
                
        $this->PostTypes[self::POST_TYPE] = array(
                    'label'               => self::POST_TYPE,
                    'description'         => __( 'Links that have a body of content used in a carousel.', 'toebox-basic' ),
                    'labels'              => $labels,
                    'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'revisions', 'excerpt', 'sticky'),
                    'taxonomies'          => array( 'category', 'post_tag', 'link_category', 'post_format'),
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
                    'register_meta_box_cb' => array($this, 'AddMetaboxes'),
        );
        
        $this->AddShortCode('carousel', 'ExpandCarousel');
        $this->AddAction('save_post', 'SavePost');

    }
    /**
     * (non-PHPdoc)
     * @see \toebox\plugin\inc\BasePlugin::AdminEditorInit()
     */
    public function AdminEditorInit()
    {        
        // TODO: check settings to see if this should be enabled
        if (array_key_exists('post_type', $_GET) && $_GET['post_type'] == self::POST_TYPE ) return;

        add_filter('mce_buttons', function($buttons)
        {
            array_push($buttons,'separator', "tb_carousel");
            return $buttons;
        });
        
        add_filter('mce_external_plugins', function($plugin_array)
        {
            $plugin_array['tb_carousel'] = plugin_dir_url( __FILE__ ) . '../admin/js/toebox_carousel_tmce.js';
            return $plugin_array;
        });
    }
    /**
     * register a form field (metabox)
     * 
     * @param WP_Post $post
     */
    public function AddMetaboxes($post)
    {
        add_meta_box( self::POST_TYPE.'_section_id', 'Carousel Link URL', array($this, 'RenderUrlMetaBox'), self::POST_TYPE, 'advanced', 'default', array('callback_args') );        
    }
    /**
     * save general posts hook
     * @param unknown $post_id
     * @return \toebox\plugin\inc\unknown
     */
    public function SavePost($post_id)
    {
        return $this->SaveMetaBox($post_id);
    }
    /**
     * save custom metabox data
     * @param unknown $post_id
     * @return unknown
     */
    public function SaveMetaBox($post_id)
    {
        if (!isset($_POST[self::POST_TYPE.'_url_nonce']) || 
                        wp_verify_nonce(self::POST_TYPE.'_url', 'myplugin_inner_custom_box' ))
            return $post_id;
        
        if (current_user_can('edit_posts') &&  current_user_can('edit_pages'))
        {
            $postField = self::POST_TYPE.'_url';
            $Url = sanitize_url($_POST[$postField]);
            update_post_meta( $post_id, $postField, $Url );
        }
    }
    /**
     * render form field on the edit page for the crousel content type
     * 
     * @param WP_Post $post
     * @param unknown $self
     */
    public function RenderUrlMetaBox($post, $self)
    {
        // Add an nonce field so we can check for it later.
        wp_nonce_field(self::POST_TYPE.'_url', self::POST_TYPE.'_url_nonce' );
        
        $fieldId = self::POST_TYPE.'_url';
        // Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, $fieldId, true );

		// Display the form, using the current value.
		echo "<label for='$fieldId'>";
		_e( 'link for carousel panel', 'toebox-basic' );
		echo '</label> ';
		echo "<input type='text' id='$fieldId' name='$fieldId'";
        echo ' value="' . esc_attr( $value ) . '" style="width:100%" placeholder="http://"/>';
        echo '<script> window.tb_carousel_button_disable = true; </script>';
        
    }
    
    /**
     *  renders a carousel based on the attributes
     *
     * @param array $attirbutes
     * @param string $content
     */
    public function ExpandCarousel($attirbutes, $content = '')
    {
        static $defaults = array(
            'style' => 'slide', // slide, short, triple
            'category' => 'all',
            'interval' => 5000,
            'pause' => 'hover',
            'wrap' => true,
            'keyboard' => true,
            'effect' => 'none',
            'post_count' => 3,
            'class' => 'hidden-xs' // tb-carousel-fixedheight, hidden-xs 
        );
    
        static $carouselCount = 0;
        $carouselCount++;
    
        // combine and filter attributes
        $attirbutes = shortcode_atts($defaults, $attirbutes, 'carousel_links');
    
        $queryArguments = array(
            'post_type' => self::POST_TYPE,
            'post_status' => 'publish',
            'posts_per_page' => $attirbutes['post_count'],
            'tax_query' => false,
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
    
        $carouselQuery = new \WP_Query($queryArguments);
        
        if (!$carouselQuery->have_posts()) return '<!-- no posts carousel posts -->';
    
        $attirbutes = array_diff_key($attirbutes, array_flip(array('category', 'style')));
                
        $templatePath = get_template_directory() . "/tpl/carousel/$templateName.php";
        if (!file_exists($templatePath)) // check to see if the theme supports the plugin
        {
            $templatePath = PluginController::$PublicPath . "/tpl/carousel/$templateName.php";
        }
        
        $vars = array_merge($queryArguments, $attirbutes);
        $vars['carouselQuery'] = $carouselQuery;
        $vars['post_count'] = $carouselQuery->post_count;
        $vars['carousel_count'] = $carouselCount;
        
        $output = $this->getTemplateOutput("tpl/carousel/$templateName.php", $vars);
           
        return $output;
    
    }
    /**
     * latest instance of self
     * @var self
     */
    public static $Instance;
    /**
     * allow the rendering of a carousel programatically
     * @param unknown $attirbutes
     * @param string $content
     * @return string
     */
    public static function Render($attirbutes, $content = '')
    {
        if (self::$Instance && self::$Instance instanceof self)
            return self::$Instance->ExpandCarousel($attirbutes, $content);
    }

    
}