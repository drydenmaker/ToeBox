<?php
toebox\inc\ToeBox::DebugFile();
?>

<article id="post-<?php print $ID ?>" <?php post_class(); ?>>
<?php
toebox\inc\ToeBox::HandleFeaturedImage();
?>

    <header class="entry-header">
        <h3><a href="<?php the_permalink(); ?>"><?php print $post_title ?></a></h3>
    </header>
    <div class="entry-metadata">

        <!-- TODO: allow setting for turning author and date off on posts -->
        <span class="tb-date"><?php the_time(get_option('date_format')); ?></span>
        |
        <span class="tb-author"><?php print get_the_author(); ?></span>

    </div>

    <div class="entry-excerpt">
        <?php print $body ?>

    </div>
   

</article>
<?php
toebox\inc\ToeBox::DebugFile('END');
?>