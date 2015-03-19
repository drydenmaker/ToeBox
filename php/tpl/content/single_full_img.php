<!-- START CONTENT full image-->

<div class="row">
<?php
toebox\inc\ToeBox::HandleFeaturedImage();

?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <h3><a href="<?php the_permalink(); ?>"><?php print $post_title; ?></a></h3>
        </header>
        <div class="entry-metadata">
    
            <!-- TODO: allow setting for turning author and date off on posts -->
            <span class="tb-date"><?php the_time(); ?></span>
            |
            <span class="tb-author"><?php print get_the_author(); ?></span>
            |
            <span class="tb-categoryr"><?php the_category(', ') ?></span>
    
        </div>
    
        <div class="entry-content">
            <?php print $body; ?>
        </div>
        
    </article>
    
</div><!-- /row -->

<?php comments_template(); ?>

<!-- END CONTENT -->