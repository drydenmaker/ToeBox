<?php get_header(); ?>
<!-- START INDEX CONTENT -->
<div class="col-sm-8 tb-main">
<?php
if (have_posts()) :
 
    while (have_posts()) : the_post();
       get_template_part( 'content', get_post_format() );
     endwhile;
     
    else :
        echo '<p>No content found</p>';
    endif;
?>
	<div class="tb-comments">
        <?php comments_template(); ?> 
    </div>
</div>
<div class="col-sm-3 col-sm-offset-1 tb-sidebar">
    <?php get_sidebar() ?>
</div>
<!-- END INDEX CONTENT -->
<?php get_footer(); ?>