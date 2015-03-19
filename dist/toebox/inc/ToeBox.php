<?php
namespace toebox\inc;


define(TOEBOX_DEFAULT_PAGE_LAYOUT, 'toebox_page_laout');
define(TOEBOX_DEFAULT_LIST_LAYOUT, 'toebox_list_laout');
define(TOEBOX_DEFAULT_STORY_LAYOUT, 'toebox_story_laout');
define(TOEBOX_HIDE_SMALL_SIDEBARS, 'toebox_hide_small_sidebars');
define(TOEBOX_FEATURED_IMG_CLASS, 'toebox_featured_img_class');


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
        TOEBOX_DEFAULT_PAGE_LAYOUT => 'right_column',
        TOEBOX_DEFAULT_LIST_LAYOUT => 'list_large_img',
        TOEBOX_DEFAULT_STORY_LAYOUT => 'full_img',
        TOEBOX_HIDE_SMALL_SIDEBARS => '1',
        TOEBOX_FEATURED_IMG_CLASS => 'img-rounded'
    );
    
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
    /**
     * Load page layout which contains content loop
     * @param array $settings
     */
    public static function Layout($toeboxSlug = 'content')
    {
        $settings = self::$Settings;
        $hideSideBarsOnSmallScreens = $settings[TOEBOX_HIDE_SMALL_SIDEBARS];
        $ifHideOnSmallCss = ($hideSideBarsOnSmallScreens) ? 'hidden-xs hidden-sm' : '' ;
        require TEMPLATEPATH.self::$LaoutPrefix . $settings[TOEBOX_DEFAULT_PAGE_LAYOUT] . '.php';
    }
    /**
     * location and prefix of layout pages
     * @var string
     */
    public static $LaoutContentPrefix = '/tpl/layout_content_';
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

        
        if (is_single())
        {
            $body = $post_content;
        }
        else 
        {
            $body = (trim($post_excerpt)) ? $post_excerpt : $post_content;
        }
        
        $body = apply_filters('the_content', $body);

        $template = (is_single()) ? $settings[TOEBOX_DEFAULT_STORY_LAYOUT] : $settings[TOEBOX_DEFAULT_LIST_LAYOUT];
        $templatePath = TEMPLATEPATH.self::$LaoutContentPrefix . $template . '.php';
        
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
                get_template_part($slug, $post->post_mime_type);
            } // end while
        } // end if
        else
        {
            print '<p>No content found</p>';
        }
    }
    /**
     * relative file path of template files
     * @var string
     */
    public static $TemplatePrefix = '/tpl/';
    /**
     * Featured Image Standard Format
     * 
     * @param string $post_id
     * @param string $size
     * @param string $attr
     */
    public static function HandleFeaturedImage($post_id = null, $size = 'post-thumbnail', $attr = '', $template = 'content_featured_image.php') {
        if ( post_password_required() || is_attachment() || !has_post_thumbnail() ) {
            return;
        }

        if ( in_the_loop() )
            update_post_thumbnail_cache();

        $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;

        $attachment_id = get_post_thumbnail_id( $post_id );
        $image = wp_get_attachment_image_src($attachment_id, $size, $icon);

        if ( $image === false ) return;

        list($src, $width, $height) = $image;

        $size_class = $size;
        if ( is_array( $size_class ) ) {
            $size_class = join( 'x', $size_class );
        }

        $attachment = get_post($attachment_id);

        $sizeClass = "attachment-$size_class";

        $attr = wp_parse_args($attr, $default_attr);
        $attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment, $size );
        $attr = array_map( 'esc_attr', $attr );
        $alt = trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ));

        $title = get_the_title();
        
        $class = self::$Settings[TOEBOX_FEATURED_IMG_CLASS];

        require TEMPLATEPATH.self::$TemplatePrefix . $template;

    }
    /**
     * Featured Image with alternate template 
     * 
     * @param string $template
     */
    public static function HandleFeaturedImageTemplated($template = 'content_featured_image_overlay.php')
    {
        self::HandleFeaturedImage(null, 'post-thumbnail', '', $template);
    }
}

?>