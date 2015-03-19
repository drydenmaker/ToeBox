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

define('TOEBOX_404_MESSAGE', 'toebox_404_message');
define('TOEBOX_ENABLE_404_SEARCH', 'toebox_404_search');

define('TOEBOX_TEMPLATE_SINGLE', 'single_');
define('TOEBOX_TEMPLATE_LIST', 'list_');




$pageLayoutOptions = array(
    'open' => __( 'Open','toebox-basic' ),
    'no_column' => __( 'Single Column','toebox-basic' ),
    'left_column' => __( 'Left Column','toebox-basic' ),
    'three_column' => __( 'Three Column','toebox-basic' ),
    'right_column' => __( 'Right Column','toebox-basic' ),
    'two_right_column' => __( 'Two Right Columns','toebox-basic' ),
    'two_left_column' => __( 'Two Left Columns','toebox-basic' ),
    'featured_story' => __( 'Featured Story','toebox-basic' ),
    'featured_story_left_sidebar' => __( 'Featured Story Left Sidebar','toebox-basic' ),
);

/**
 *
 * @author alton.crossley
 *
 */
class ToeBox
{
    /**
     * settings registry
     * @var Array
     */
    public static $Settings = array(
        'ver' => '0.0.1',
        TOEBOX_MORE_TEXT => 'More...',
        TOEBOX_PAGE_LAYOUT => 'right_column',
        TOEBOX_FEATURED_STORY_LAYOUT => 'featured_story',
        TOEBOX_LIST_LAYOUT => 'list_large_img',
        TOEBOX_STORY_LAYOUT => 'single_full_img',
        TOEBOX_HIDE_SMALL_SIDEBARS => '1',
        TOEBOX_FEATURED_IMG_CLASS => 'img-rounded',
        TOEBOX_CONTENT_BACKGROUND_COLOR => '#222',
        TOEBOX_404_MESSAGE => '<p>Sorry, no content was found.</p>',
        TOEBOX_ENABLE_404_SEARCH => true
    );
    
    public static function InitSettings(array $otherSettings = array())
    {
        self::$Settings = array_merge(self::$Settings, get_theme_mods(), $otherSettings);
    }
    
    /**
     * output dynamic sidebar contnet
     * @param unknown $sidebarName
     */
    public static function HandleDynamicSidebar($sidebarName)
    {
        if ( is_active_sidebar( $sidebarName ) )
        {
            sprintf('<div id="%1$s" class="container" role="complementary">%2$s</div><!-- #%1$s -->', $sidebarName, dynamic_sidebar( $sidebarName ));
        }
    }
    /**
     * location and prefix of layout pages
     * @var string
     */
    public static $LaoutPrefix = '/tpl/layout_page_';
    public static $CustomLayoutTemplates = array(
        'featured_story'
    );
    /**
     * Load page layout which contains content loop
     * @param array $settings
     */
    public static function Layout($toeboxSlug = 'content')
    {
        global $wp_the_query;

        $postType = $wp_the_query->query_vars['post_type'];
        
        
        $settings = self::$Settings;
        $hideSideBarsOnSmallScreens = $settings[TOEBOX_HIDE_SMALL_SIDEBARS];
        $ifHideOnSmallCss = ($hideSideBarsOnSmallScreens) ? 'hidden-xs hidden-sm' : '' ;
        
        if (($postType) && in_array($postType, self::$CustomLayoutTemplates))
        {
            require TEMPLATEPATH.self::$LaoutPrefix . $settings[TOEBOX_FEATURED_STORY_LAYOUT] . '.php';
        }
        else 
        {
            require TEMPLATEPATH.self::$LaoutPrefix . $settings[TOEBOX_PAGE_LAYOUT] . '.php';
        }
    }
    /**
     * location and prefix of layout pages
     * @var string
     */
    public static $LaoutContentPrefix = '/tpl/content/';
    /**
     * Use template to handle content layout
     * This method uses the settings for the theme to format a post. It uses
     * array variable expansion to make individual attributes of $post available
     * to the template directly in the form $<propertyname>
     *
     * A special variable is made available called $body that is the excerpt if
     * within a single post and if it is set. Otherwise it is the content of
     * the post.
     *
     * @param \WP_Post $post
     * @param array $settings
     */
    public static function LayoutContent(\WP_Post $post, array $settings)
    {
        foreach ($post as $var => $value)
        {
            $$var = $value;
        }
        foreach ($settings as $var => $value)
        {
            $$var = $value;
        }
        
        // set template
        if (is_single() || is_sticky())
        {
            $templateType = TOEBOX_TEMPLATE_SINGLE;
        }
        else 
        {
            $templateType = TOEBOX_TEMPLATE_LIST;
        }
        
        // process body content
        $body = get_the_content(__(self::$Settings[TOEBOX_MORE_TEXT],'toebox-basic' ));
        $body = apply_filters('the_content', $body);
        $body = str_replace( ']]>', ']]&gt;', $body );
        
        // add pagination
//         $body .= wp_link_pages( array(
// 				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'toebox-basic' ) . '</span>',
// 				'after'       => '</div>',
// 				'link_before' => '<span>',
// 				'link_after'  => '</span>',
// 				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'toebox-basic' ) . ' </span>%',
// 				'separator'   => '<span class="screen-reader-text">, </span>',
//                 'echo'        => false,
// 			) );
        
        if (in_array($post_type, self::$CustomLayoutTemplates))
        {
            $extension = (is_single()) ? 'single' : 'list';
            $templatePath = sprintf('%s%s_%s.php', TEMPLATEPATH.self::$LaoutContentPrefix, $post_type, $extension);
        }
        else
        {
            $template = (is_single()) ? $settings[TOEBOX_STORY_LAYOUT] : $settings[TOEBOX_LIST_LAYOUT];
            $templatePath = sprintf('%s%s.php', TEMPLATEPATH.self::$LaoutContentPrefix, $template);
        }
        
        require $templatePath;
    }
    /**
     * Handle the wordpress loop
     * @param unknown $posts
     * @param string $slug
     */
    public static function HandleLoop($posts, $slug = 'content')
    {
        if ( have_posts() )
        {
            while ( have_posts() )
            {
                the_post();
                global $post;
                
                get_template_part($slug, $post->post_mime_type);
            } // end while
        } // end if
        else
        {
            print self::$Settings[TOEBOX_404_MESSAGE];
        }
    }
    /**
     * relative file path of template files
     * @var string
     */
    public static $TemplatePrefix = '/tpl/content/';
    /**
     * Featured Image Standard Format
     * 
     * @param string $post_id
     * @param string $size
     * @param string $attr
     */
    public static function HandleFeaturedImage($post_id = null, $size = 'post-thumbnail', $attr = array(), $template = 'featured_image') {
        if ( post_password_required() || is_attachment() || !has_post_thumbnail() ) {
            return;
        }

        if ( in_the_loop() )
            update_post_thumbnail_cache();

        $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

        $attachment_id = get_post_thumbnail_id( $post_id );
        $image = wp_get_attachment_image_src($attachment_id, $size);

        if ( $image === false ) return;

        list($src, $width, $height) = $image;

        $size_class = $size;
        if ( is_array( $size_class ) ) {
            $size_class = join( 'x', $size_class );
        }

        $attachment = get_post($attachment_id);

        $sizeClass = "attachment-$size_class";
        // TODO: make some default attributes for the image
        //$attr = wp_parse_args($attr, $default_attr);
        $attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment, $size );
        $attr = array_map( 'esc_attr', $attr );
        $alt = trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ));

        $title = get_the_title();
        
        $class = self::$Settings[TOEBOX_FEATURED_IMG_CLASS];

        require TEMPLATEPATH.self::$TemplatePrefix . $template . '.php';

    }
    /**
     * Featured Image with alternate template 
     * 
     * @param string $template
     */
    public static function HandleFeaturedImageTemplated($template = 'featured_image_overlay', $post_id = null, $size = 'post-thumbnail', $attr = array())
    {
        self::HandleFeaturedImage($post_id, $size, $attr, $template);
    }
}

?>