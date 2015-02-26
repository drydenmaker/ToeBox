<?php 
get_header();
?>

<!-- START INDEX CONTENT -->
<div class="container">

	<div class="tb-header">
		<h1 class="tb-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<p class="lead tb-description"><p class="site-description"><?php echo get_bloginfo( 'description', 'display' ); ?></p></p>
	</div>

	<div class="row">
		<!-- START MAINBODY ROW -->

		<div class="col-sm-8 tb-main">
   
<?php
inc\ToeBox::HandleLoop($posts); 
?>

        </div>
        
		<div class="col-sm-3 col-sm-offset-1 tb-sidebar">
<?php get_sidebar() ?>
        </div>

		<!-- END MAINBODY ROW -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->
<!-- END INDEX CONTENT -->
<?php 
get_footer(); 
?>