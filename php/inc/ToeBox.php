<?php
namespace toebox\inc;

/**
 *
 * @author alton.crossley
 *
 */
class ToeBox
{
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
    public static function Layout(array $settings, $toeboxSlug = 'content')
    {
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
        //$arr = get_defined_vars();
        //print '<pre>'.print_r($arr, true).'</pre>';

        foreach ($post as $var => $value)
        {
            $$var = $value;
        }
        foreach ($settings as $var => $value)
        {
            $$var = $value;
        }

        $body = (is_single()) ?
                $post_content :
                (@trim($post_excerpt)) ? $post_excerpt : $post_content;

        $body = apply_filters('the_content', $body);

        $template = (is_single()) ? $settings[TOEBOX_DEFAULT_STORY_LAYOUT] : $settings[TOEBOX_DEFAULT_LIST_LAYOUT];
        require TEMPLATEPATH.self::$LaoutContentPrefix . $template . '.php';
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

    public static function HandleFeaturedImage($post_id = null, $size = 'post-thumbnail', $attr = '') {
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

            //$hwstring = image_hwstring($width, $height);

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

        require TEMPLATEPATH.self::$TemplatePrefix . 'content_featured_image.php';

    }
}

?>