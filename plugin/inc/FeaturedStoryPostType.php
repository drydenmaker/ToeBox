<?php
namespace toebox\plugin\inc;

class FeaturedStoryPostType extends BasePlugin
{
    const TOEBOX_ENABLE_FEATURED = 'enable_featured';
    const POST_TYPE = 'featured_story';
    
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
        
        $this->PostTypes[self::POST_TYPE] = array(
                    'label'               => self::POST_TYPE,
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
                    'register_meta_box_cb' => array($this, 'AddMetaboxes'),
        );
        
        $this->PostTypeTemplates[self::POST_TYPE] = 'featured_story/layout_page.php';
        
        $this->AddAction('save_post', 'SavePost');
        
    }
    
    /**
     * register a form field (metabox)
     *
     * @param WP_Post $post
     */
    public function AddMetaboxes($post)
    {
        add_meta_box( self::POST_TYPE.'_section_id', 'Featured Story CSS', array($this, 'RenderFeaturedCssMetaBox'), self::POST_TYPE, 'advanced', 'default', array('callback_args') );
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
        $nonce = self::POST_TYPE.'_css_nonce';
        $fieldId = self::POST_TYPE.'_css';
        
        if (!isset($_POST[$nonce]) ||
                        wp_verify_nonce($fieldId, 'myplugin_inner_custom_box' ))
                            return $post_id;
    
                        if (current_user_can('edit_posts') &&  current_user_can('edit_pages'))
                        {
                            update_post_meta( $post_id, $fieldId, sanitize_text_field($_POST[$fieldId]) );
                        }
    }

    /**
     * render form field on the edit page for the crousel content type
     *
     * @param WP_Post $post
     * @param unknown $self
     */
    public function RenderFeaturedCssMetaBox($post, $self)
    {
        $fieldId = self::POST_TYPE.'_css';
        
        // Add an nonce field so we can check for it later.
        wp_nonce_field($fieldId, self::POST_TYPE.'_css_nonce' );
    
        // Use get_post_meta to retrieve an existing value from the database.
        $value = get_post_meta( $post->ID, $fieldId, true );
        
        // Display the form, using the current value.
        echo "<label for='$fieldId'>";
        _e( 'extra css for featured story injected between &lt;style&gt; tags.', 'toebox-basic' );
        echo '</label> ';
        echo "<textarea id='$fieldId' name='$fieldId'".'style="width:100%" placeholder="styles or @import">';
        echo htmlentities2( $value );
        echo '</textarea>';
    
    }

}