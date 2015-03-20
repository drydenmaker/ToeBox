<!-- START CONTENT thumb left-->


<div class="row">

    <div class="col-xs-5">
<?php
toebox\inc\ToeBox::HandleFeaturedImage();
?>
    </div>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>    
        <header class="entry-header">
            <h3><?php the_title(); ?></h3>
        </header>
        
        <?php if (!is_page()) : ?>
        <div class="entry-metadata">
            <!-- TODO: allow setting for turning author and date off on posts -->
            <span class="tb-date"><?php the_time(get_option('date_format')); ?></span>
            |
            <span class="tb-author"><?php print get_the_author(); ?></span>
            |
            <span class="tb-categoryr"><?php the_category(', ') ?></span>
        </div>
        <?php endif;?>
    
        <div class="entry-content">
            <?php print $body; ?>
        </div>
    </article>    
    
</div><!-- /row -->

<?php comments_template(); ?>

<!-- END CONTENT -->