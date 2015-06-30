<?php
namespace toebox\inc;



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
    public static $Settings = array();
    /**
     * settings registry
     * @var Array
     */
    public static $SettingsDefaults = array( );
    /**
     * theme options to include in settings array
     * @var unknown
     */
    public static $OptionsToInclude = array();
    /**
     * prepare settings with defaults
     * @param array $otherSettings
     */
    public static function InitSettings(array $otherSettings = array())
    {
        self::$Debug = WP_DEBUG;
        
        $options = array();
        foreach (self::$OptionsToInclude as $key)
        {
            $value = get_option($key);
            if ($value !== false) $options[$key] = $value;
        }
        
        $themeMods = get_theme_mods();
        if (is_array($themeMods)) $themeMods[TOEBOX_SETUP] = true;
        $themeMods = (!empty($themeMods) && is_array($themeMods)) ? $themeMods : array() ;

        self::$Settings = array_merge(self::$SettingsDefaults, $themeMods, $options, $otherSettings);
    }
    /**
     * output dynamic sidebar contnet
     * @param unknown $sidebarName
     */
    public static function HandleDynamicSidebar($sidebarName)
    {
        if ( is_active_sidebar( $sidebarName ) )
        {
            print sprintf('<div id="sidebar-%1$s" class="%1$s tb-sidebar" role="complementary">', esc_attr($sidebarName));
            dynamic_sidebar( $sidebarName );
            print sprintf('</div><!-- #%1$s -->', $sidebarName);
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
    public static $CustomCategoryLayoutTemplates = array(
        'catch-of-the-day'
    );
    /**
     * Load page layout which contains content loop
     * @param array $settings
     */
    public static function Layout($toeboxSlug = 'content')
    {
        global $wp_the_query, $toebox_link_pages_args;

        $postType = $wp_the_query->query_vars['post_type'];

        $settings = self::$Settings;
        $hideSideBarsOnSmallScreens = $settings[TOEBOX_HIDE_SMALL_SIDEBARS];
        $ifHideOnSmallCss = ($hideSideBarsOnSmallScreens) ? 'hidden-xs hidden-sm' : 'alwaysshow' ;
        
        if (is_single())
        {
            global $post;
            $category = self::ArrayFirstMatch(self::GetSlugArray(get_the_category($post->ID)), self::$CustomCategoryLayoutTemplates);
        }
        
        if (($postType) && in_array($postType, self::$CustomLayoutTemplates))
        {
            $templatePath = get_template_directory().self::$LaoutPrefix . $settings[TOEBOX_FEATURED_STORY_LAYOUT] . '.php';
        }
        else if (!empty($category))
        {
            $templatePath = get_template_directory().self::$LaoutPrefix . $category . '.php';
        }
        else if(array_key_exists('category_name', $wp_the_query->query_vars) && 
                        !empty($wp_the_query->query_vars['category_name']) &&
                        in_array($wp_the_query->query_vars['category_name'], self::$CustomCategoryLayoutTemplates))
        {
            $templatePath = get_template_directory().self::$LaoutPrefix . $wp_the_query->query_vars['category_name'] . '.php';
        }
        else
        {
            $templatePath = get_template_directory().self::$LaoutPrefix . $settings[TOEBOX_PAGE_LAYOUT] . '.php';
        }

        require $templatePath;
    }
    /**
     * format the title string using the given template
     * @param unknown $title
     * @param string $link
     * @param string $extraClasses
     */
    public static function FormatListTitle($title, $link = '#', $extraClasses = '')
    {
        return str_replace('{title}', $title, 
                        str_replace('{link}', $link,
                        str_replace('{class}', $extraClasses, 
                                        self::$Settings[TOEBOX_LIST_HEADER])));
    }
    public static function FormatSingleTitle($title, $link = '#', $extraClasses = '')
    {
        return str_replace('{title}', $title,
                        str_replace('{link}', $link,
                        str_replace('{class}', $extraClasses,
                                        self::$Settings[TOEBOX_LIST_HEADER])));
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
            wp_enqueue_script( "comment-reply" );
        }
        else
        {
            $templateType = TOEBOX_TEMPLATE_LIST;
        }

        $body = self::GetCurrentContent();

        $postFormat = get_post_format();
        
        
        
        if (in_array($post_type, self::$CustomLayoutTemplates))
        {
            $templatePath = sprintf('%s%s_%s.php', get_template_directory().self::$LaoutContentPrefix, $post_type, $templateType);
        }
        else
        {
            $template = (is_single() || is_page()) ? $settings[TOEBOX_STORY_LAYOUT] : $settings[TOEBOX_LIST_LAYOUT];
            $templatePath = sprintf('%s%s.php', get_template_directory().self::$LaoutContentPrefix, $template);
        }

        // wordpress output
        $post_title = get_the_title();
        $post_title = (empty($post_title)) ? '(no title)' : $post_title;

        $post_date = get_the_time(get_option('date_format'));
        $the_post_thumbnail = get_the_post_thumbnail( $post->ID, 'full');
        
        self::DebugFile('START', $templatePath);
        require $templatePath;
        self::DebugFile('END', $templatePath);
    }
    public static function ArrayFirstMatch(array $needle, array $haystack)
    {
        foreach ($needle as $value)
        {
            if (in_array($value, $haystack)) return $value;
        }
        return null;
    }
    public static function GetSlugArray($categories)
    {
        return array_reduce($categories, function($slugs, $input)
        {
            $slugs[] = $input->slug;
            return $slugs;
        }, array()) ;
    }
    /**
     * get the content from the current clobal post
     * @return string
     */
    public static function GetCurrentContent()
    {
        // process body content
        $body = get_the_content(__('More','toebox-basic' ));
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
            if (self::$Settings[TOEBOX_ENABLE_404_SEARCH]) include get_template_directory() . '/tpl/widget/search_row.php';
        }
    }
    public static function HandleLinkPages()
    {
        wp_link_pages( self::$Settings[TOEBOX_LINK_PAGES_ARGS] );
    }
    public static function HandleListNavigation()
    {

        if (self::$Settings[TOEBOX_ENABLE_LIST_PAGING])
        {
            $previous = get_previous_posts_link('Newer Posts >>');
            $next = get_next_posts_link('<< Older Posts');
            
            print sprintf("<div class='postlinks clearfix'>".
                        (($previous) ? '<div class="btn btn-default new-posts-link pull-right">%2$s </div>' : '%2$s') .
                        (($next) ? '<div class="btn btn-default old-posts-link">%1$s </div>' : '%1$s') .
                        '</div>',
                        $next, $previous);
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

        $image =  self::GetImageForPost($post_id, $size);

        if ( $image === false ) return;

        list($src, $width, $height) = $image;

        $size_class = $size;
        if ( is_array( $size_class ) ) {
            $size_class = join( 'x', $size_class );
        }

        $attachment_id = get_post_thumbnail_id( $post_id );
        $attachment = get_post($attachment_id);

        $sizeClass = "attachment-$size_class";
        // TODO: make some default attributes for the image
        //$attr = wp_parse_args($attr, $default_attr);
        $attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment, $size );
        $attr = array_map( 'esc_attr', $attr );
        $alt = trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ));

        $title = get_the_title();

        $class = self::$Settings[TOEBOX_FEATURED_IMG_CLASS];

        $filePath = get_template_directory().self::$TemplatePrefix . $template . '.php';

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

    public static function DebugFile($location = 'START', $callingFileName = '', $depth = 0)
    {


        if (self::$Debug)
        {

            if (empty($callingFileName))
            {
                $trace = debug_backtrace();
                try
                {
                    $callingFileName = array_shift($trace)['file'];
                    $depth = count($trace);
                }
                catch(Exception $e){}
            }

            print sprintf('%3$s<!-- %1$s %2$s -->', self::GetThemeRealtiveFileTitle($callingFileName), $location, str_repeat(' ', $depth) );

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
                            str_replace('\\', '/', get_template_directory()), null,
                            str_replace('\\', '/', $fileName));
    }
    /**
     * includes a theme php file
     * @param string $fileName
     */
    public static function GetFileContents($fileName)
    {
        ob_start();

        require get_template_directory() . '/' . self::GetThemeRelativeFileName($fileName);

        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    /**
     * capture the output of a lamda function
     * 
     * @param callable $callback
     * @param array $parameters
     * @return string
     */
    public static function GetOutput(callable $callback, array $parameters = array())
    {
        ob_start();
        
        call_user_func_array($callback, $parameters);
        
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    /**
     * remove all widgets
     *  !! USE ONLY WHEN ABSOLUTELY NEEDED
     */
    public static function RemoveAllWidgets()
    {
        global $wp_registered_sidebars;
        
        //get saved widgets
        $widgets = get_option('sidebars_widgets');
        //loop over the sidebars and remove all widgets
        foreach ($wp_registered_sidebars as $sidebar => $value) 
        {
            unset($widgets[$sidebar]);
        }
        
        //update with widgets removed
        update_option('sidebars_widgets',$widgets);
    }
}
