<?php get_header(); ?>
<!-- START INDEX CONTENT -->
<div class="col-sm-8 tb-main">
<?php
if (have_posts()) :
 
    while (have_posts()) : the_post();
		?>  
        <header class="page-header">
            <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">', '</div>' );
            ?>
        </header>
		<?php
       get_template_part( 'content', get_post_format() );
     endwhile;
     
    else :
        echo '<p>No content found</p>';
    endif;
?>
</div>
<div class="col-sm-3 col-sm-offset-1 tb-sidebar">
    <?php get_sidebar() ?>
</div>
<!-- END INDEX CONTENT -->
<?php get_footer(); ?>