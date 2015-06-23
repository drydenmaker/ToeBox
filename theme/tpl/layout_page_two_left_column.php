<?php
/*
Template Name: Three Column - Content Right
Description: A page template with two columns to the left of the content.
*/
global $toeboxSlug, $toebox_link_pages_args;
get_header();
?>
<!-- START two right CONTENT -->
<div class="container">
<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-container-header');
?>
	<div class="row">
		<!-- START MAINBODY ROW -->

		<div class="col-sm-3  <?php print $ifHideOnSmallCss ?> tb-sidebar">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox_left_sidebar') ?>
        </div>

        <div class="col-lg-3 <?php print $ifHideOnSmallCss ?> tb-sidebar">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox_right_sidebar') ?>
        </div>


		<div class="col-sm-9 col-md-5 col-lg-offset-1 tb-main">

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
<!-- END two right CONTENT -->
<?php
// output footer
get_footer();