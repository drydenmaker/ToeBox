<?php
/*
Template Name: Right Column
Description: A page template with a single column 1/3 of the page width on the right side of the content.
*/
global $toeboxSlug, $toebox_link_pages_args;
get_header();
?>
<!-- START INDEX CONTENT -->
<div class="container">
<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-container-header');
?>

	<div class="row">
		<!-- START MAINBODY ROW -->

		<div class="col-sm-9 col-lg-8 tb-main">

<?php
include get_template_directory() . '/tpl/content/loop.php';
?>

        </div>

		<div class="col-sm-3 col-lg-offset-1 tb-sidebar">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox_right_sidebar') ?>
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

