<!-- START CONTENT text only -->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <header class="entry-header">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    </header>
    <div class="tb-entry-metadata">

        <!-- TODO: allow setting for turning author and date off on posts -->
        <span class="tb-date"><?php the_time('F j, Y'); ?></span>
        |
        <span class="tb-author"><?php print get_the_author(); ?></span>

    </div>

    <div class="entry-excerpt">
        <?php print $body; ?>
    </div>

</article>
<!-- END CONTENT -->