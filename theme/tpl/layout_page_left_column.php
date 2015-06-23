<?php
/*
Template Name: Left Column
Description: A page template with a single column 1/3 of the page width on the left side of the content.
*/
global $toeboxSlug, $toebox_link_pages_args, $ifHideOnSmallCss;

get_header();
?>
<!-- START INDEX CONTENT -->
<div class="container">
<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-container-header');
?>
	<div class="row">
		<!-- START MAINBODY ROW -->

	   <div class="col-md-3 col-lg-4 <?php print $ifHideOnSmallCss ?> tb-sidebar"">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox_left_sidebar') ?>
        </div>

		<div class="col-md-9 col-lg-8 tb-main">

<?php
include get_template_directory() . '/tpl/content/loop.php';
?>

        </div>

		<!-- END MAINBODY ROW -->
	</div>
	<!-- /.row -->
<?php 
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-container-footer');
?>
</div>
<!-- /.container -->
<!-- END INDEX CONTENT -->
<?php 
// output footer
get_footer();