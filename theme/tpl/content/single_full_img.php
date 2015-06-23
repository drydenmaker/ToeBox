
<div class="tb-container-row-fluid">
<?php
toebox\inc\ToeBox::HandleFeaturedImage();

?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <h3><a href="<?php the_permalink(); ?>"><?php print $post_title; ?></a></h3>
        </header>
        
        <?php if (!is_page()) : ?>
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
        <?php endif;?>
    
        <div class="entry-content">
            <?php print $body; ?>
        </div>
        <div class="entry-paging">
        <?php  toebox\inc\ToeBox::HandleLinkPages(); ?>
        </div>
        
    </article>
    
</div><!-- /row -->

<?php 
comments_template(); 
?>