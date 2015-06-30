
<div class="row">

  <div class="col-xs-5 pull-right">
<?php
toebox\inc\ToeBox::HandleFeaturedImage();
?>
  </div>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
        print \toebox\inc\ToeBox::FormatSingleTitle($post_title, get_the_permalink());
    ?>
    
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