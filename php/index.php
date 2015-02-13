<?php get_header(); ?>
<!-- START INDEX CONTENT -->
<div class="container">

      <div class="tb-header">
        <h1 class="tb-title">The Bootstrap Blog</h1>
        <p class="lead tb-description">The official example template of creating a blog with Bootstrap.</p>
      </div>

      <div class="row">
<!-- START MAINBODY ROW -->	  

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
</div>
<div class="col-sm-3 col-sm-offset-1 tb-sidebar">
    <?php get_sidebar() ?>
</div>

<!-- END MAINBODY ROW -->
	</div><!-- /.row -->
</div><!-- /.container -->
<!-- END INDEX CONTENT -->
<?php get_footer(); ?>