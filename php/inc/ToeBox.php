<?php
namespace inc;

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
    
    public static function GetThumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }
    
        if ( is_singular() ) :
        ?>
    
    	<div class="post-thumbnail">
    		<?php the_post_thumbnail(); ?>
    	</div><!-- .post-thumbnail -->
    
    	<?php else : ?>
    
    	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
    		<?php
    			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
    		?>
    	</a>
    
    	<?php endif; // End is_singular()
    }
}

?>