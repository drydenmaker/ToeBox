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
define('TOEBOX_ENABLE_LIST_PAGING', 'toebox_list_paging');


define('TOEBOX_MENU_SUBTITLES', 'toebox_menu_subtitles');

define('TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE', 'toebox_feature_stories');
define('TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE', 'toebox_carousel_links');


define('TOEBOX_TEMPLATE_SINGLE', 'single_');
define('TOEBOX_TEMPLATE_LIST', 'list_');

define('TOEBOX_LINK_PAGES_ARGS', 'toebox_link_pages_args');


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
        TOEBOX_ENABLE_404_SEARCH => true,
        TOEBOX_ENABLE_LIST_PAGING => false,
        
        TOEBOX_ENABLE_FEATURE_STORIES_POSTTYPE => false,
        TOEBOX_ENABLE_CAROUSEL_LINKS_POSTTYPE => false,
        
        TOEBOX_MENU_SUBTITLES => true,
        
        TOEBOX_LINK_PAGES_ARGS => array(
            'before'      => '<nav><ul class="page-links pagination"><li>',
            'after'       => '</li></ul></nav>',
            'link_before' => '',
            'link_after'  => '',
            'pagelink'    => '%',
            'separator'   => '</li><li>',
//             'next_or_number'=>'next',
//             'previouspagelink' => ' &laquo; ',
//             'nextpagelink'=>' &raquo;',
            )
        
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
            $templatePath = TEMPLATEPATH.self::$LaoutPrefix . $settings[TOEBOX_FEATURED_STORY_LAYOUT] . '.php';
        }
        else 
        {
            $templatePath = TEMPLATEPATH.self::$LaoutPrefix . $settings[TOEBOX_PAGE_LAYOUT] . '.php';
        }
        
        require $templatePath;
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
        extract((array)$post);
        extract($settings);
        
        // set template
        if (is_single() || is_sticky())
        {
            $templateType = TOEBOX_TEMPLATE_SINGLE;
        }
        else 
        {
            $templateType = TOEBOX_TEMPLATE_LIST;
        }
        
        $body = self::GetCurrentContent();
        
        if (in_array($post_type, self::$CustomLayoutTemplates))
        {
            $extension = (is_single()) ? 'single' : 'list';
            $templatePath = sprintf('%s%s_%s.php', TEMPLATEPATH.self::$LaoutContentPrefix, $post_type, $extension);
        }
        else
        {
            $template = (is_single() || is_page()) ? $settings[TOEBOX_STORY_LAYOUT] : $settings[TOEBOX_LIST_LAYOUT];
            $templatePath = sprintf('%s%s.php', TEMPLATEPATH.self::$LaoutContentPrefix, $template);
        }
        
        // wordpress output
        $post_title = get_the_title();
        $post_date = get_the_time(get_option('date_format'));
        
        self::DebugFile('START', $templatePath);
        require $templatePath;
        self::DebugFile('END', $templatePath);
    }
    /**
     * get the content from the current clobal post
     * @return string
     */
    public static function GetCurrentContent()
    {
        // process body content
        $body = get_the_content(__(self::$Settings[TOEBOX_MORE_TEXT],'toebox-basic' ));
        $body = apply_filters('the_content', $body);
        return str_replace( ']]>', ']]&gt;', $body );
        
    }
    /**
     * process content from a post object
     * @param \WP_Post $post
     * @return Ambigous <string, mixed>
     */
    public static function GetContent(\WP_Post $post)
    {
        if ( post_password_required( $post ) )
            return get_the_password_form( $post );
    
        // process body content
        $body = $post->post_content;
        $body = apply_filters('the_content', $body);
        return str_replace( ']]>', ']]&gt;', $body );
    
    }
    /**
     * Handle the wordpress loop
     * @param unknown $posts
     * @param string $slug
     */
    public static function HandleLoop($posts, $slug)
    {
        $slug = empty($slug) ? 'content' : $slug;
        
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
            if (self::$Settings[TOEBOX_ENABLE_404_SEARCH]) include TEMPLATEPATH . '/tpl/widget/search_row.php';
        }
    }
    public static function HandleLinkPages()
    {
        wp_link_pages( self::$Settings[TOEBOX_LINK_PAGES_ARGS] );
    }
    public static function HandleListNavigation()
    {
        print self::$Settings[TOEBOX_ENABLE_LIST_PAGING];
        if (self::$Settings[TOEBOX_ENABLE_LIST_PAGING])
            print sprintf("<div class='postlinks clearfix'>
                        <div class='new-posts-link pull-right'>%2\$s </div>
                        <div class='old-posts-link'>%1\$s </div>
                        </div>",
                        get_next_posts_link('<< Older Posts'), get_previous_posts_link('Newer Posts >>'));
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

        $image =  self::GetImageForPost($post_id, $size);

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

        $filePath = TEMPLATEPATH.self::$TemplatePrefix . $template . '.php';
        
        self::DebugFile('START', $filePath);
        require $filePath;
        self::DebugFile('END', $filePath);

    }
    /**
     * obtain the thumbnail image array from a post id
     * @param string $post_id
     * @param string $size
     * @return Ambigous <boolean, multitype:, multitype:unknown multitype: Ambigous <string, boolean, mixed> , mixed, multitype:boolean mixed unknown Ambigous <multitype:, mixed, multitype:int > >
     */
    public static function GetImageForPost($post_id = null, $size = 'post-thumbnail')
    {
        $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
        
        $attachment_id = get_post_thumbnail_id( $post_id );
        return wp_get_attachment_image_src($attachment_id, $size);
    }
    /**
     * obtain the thumbnail url for a post id 
     * @param string $post_id
     * @param string $size
     * @return mixed|NULL
     */
    public static function GetImageUrlForPost($post_id = null, $size = 'post-thumbnail')
    {
        $imgArray = self::GetImageForPost($post_id, $size);
        if (is_array($imgArray) && count($imgArray)) return array_shift($imgArray);
        return null;
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
    
    public static $Debug = false;
    
    public static function DebugFile($location = 'START', $callingFileName = '')
    {
        
        
        if (self::$Debug)
        {
            
            if (empty($callingFileName))
            {
                $trace = debug_backtrace();
                try 
                {
                    $callingFileName = array_shift($trace)['file'];
                }
                catch(Exception $e){}
            }
            
            print sprintf('%3$s<!-- %1$s %2$s -->', self::GetThemeRealtiveFileTitle($callingFileName), $location, str_repeat(' ', count($trace)) );

        }
    }
    /**
     * reduces a full file path to a title (no .php)
     * @param string $fileName
     * @return string
     */
    public static function GetThemeRealtiveFileTitle($fileName)
    {
        return str_ireplace('.php', null, self::GetThemeRelativeFileName($fileName));
    }
    /**
     * reduces a absolute file name to a path relative to the theme root
     * @param string $fileName
     * @return string
     */
    public static function GetThemeRelativeFileName($fileName)
    {
        return str_replace(
                            str_replace('/', '\\', TEMPLATEPATH), null,
                            str_replace('/', '\\', $fileName));
    }
}

?>