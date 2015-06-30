
<article id="post-<?php print $ID ?>" <?php post_class(); ?>>
<?php
toebox\inc\ToeBox::HandleFeaturedImageTemplated('featured_image_featured_story');
?>

        <?php
        print \toebox\inc\ToeBox::FormatSingleTitle($post_title, get_the_permalink());
    ?>
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
        <?php print $body ?>
    </div>

</article>
