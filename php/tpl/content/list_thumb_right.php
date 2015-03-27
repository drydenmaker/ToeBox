
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="media">
        
        <div class="media-body">
            
            <header class="media-heading entry-header">
                <h3><a href="<?php the_permalink(); ?>"><?php print $post_title; ?></a></h3>
            </header>
            <div class="entry-metadata">
        <!-- TODO: allow setting for turning author and date off on posts -->
            <span class="tb-date"><?php the_time(get_option('date_format')); ?></span>
            |
            <span class="tb-author"><?php print get_the_author(); ?></span>
            |
            <span class="tb-category"><?php the_category(', ') ?></span>
            |
            <span class="tb-tags"><?php the_tags( 'Tags: ', ', ', '' ); ?></span>
            </div>
        
            <div class="entry-excerpt">
                <?php print $body; ?>
                <div class="page-link">
                <?php wp_link_pages(); ?>
                </div>
            </div>
            
        </div>
        
        <div class="media-left">
<?php 
toebox\inc\ToeBox::HandleFeaturedImageTemplated('featured_image_media')
?>
        </div>        
    
    </div>
    
</article>
