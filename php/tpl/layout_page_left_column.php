<?php
/*
Template Name: Left Column
Description: A page template with a single column 1/3 of the page width on the left side of the content.
*/
get_header();
?>
<!-- START INDEX CONTENT -->
<div class="container">

	<div class="row">
		<!-- START MAINBODY ROW -->

	   <div class="col-md-3 col-lg-offset-1 <?php print $ifHideOnSmallCss ?> tb-sidebar"">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox_left_sidebar') ?>
        </div>

		<div class="col-md-9 col-lg-8 tb-main">

<?php
global $posts;
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_bottom');
?>

        </div>

		<!-- END MAINBODY ROW -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->
<!-- END INDEX CONTENT -->
<?php 
// output footer
get_footer();