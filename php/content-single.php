<!-- START CONTENT - SINGLE -->

<article id="post-<?php print $post->ID; ?>" <?php post_class(); ?>>

<?php if (has_post_thumbnail()) : ?>
    <div class="post-thumbnail">
    		<?php the_post_thumbnail(); ?>
    </div><!-- .post-thumbnail -->
<?php endif; ?>

    <header class="entry-header">
        <h2><a href="<?php the_permalink(); ?>"><?php print $post->post_title; ?></a></h2>
    </header>
    <div class="tb-entry-metadata">
    
        <!-- TODO: allow setting for turning author and date off on posts -->
        <span class="tb-date"><?php the_time('F j, Y'); ?></span>
        |
        <span class="tb-author"><?php print get_the_author_meta( 'name', $post->post_author ); ?></span>
      
    </div>
    
    <div class="entry-content">
    <?php print $post->post_content; ?>
    </div>

</article>
<!-- END CONTENT -->