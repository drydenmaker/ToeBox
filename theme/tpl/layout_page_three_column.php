<?php
/*
Template Name: Three Column - Content Center
Description: A page template with a column on both sides of the content. Each column is half the width of the content.
*/
global $toeboxSlug, $toebox_link_pages_args;
get_header();
?>
<!-- START three column CONTENT -->
<div class="container">

	<div class="row">
		<!-- START MAINBODY ROW -->

	   <div class="col-sm-3 <?php print $ifHideOnSmallCss ?> tb-sidebar">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox_left_sidebar') ?>
        </div>

		<div class="col-sm-9 col-md-5 col-lg-offset-1 tb-main">

<?php
global $posts;
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);

wp_link_pages( $toebox_link_pages_args );

toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_bottom');

?>

        </div>

        <div class="col-sm-3 tb-sidebar">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox_right_sidebar') ?>
        </div>
        
<?php 
toebox\inc\ToeBox::HandleListNavigation();
?>
		<!-- END MAINBODY ROW -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->
<!-- END three col CONTENT -->
<?php
// output footer
get_footer();