<?php
/*
Template Name: Three Column - Content Left
Description: A page template with two columns to the right of the content.
*/
get_header();
?>
<!-- START two right CONTENT -->
<div class="container">

	<div class="row">
		<!-- START MAINBODY ROW -->


		<div class="col-sm-9 col-md-5 tb-main">

<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_bottom');
?>

        </div>

        <div class="col-sm-3  col-lg-offset-1 tb-sidebar">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox_left_sidebar') ?>
        </div>

        <div class="col-lg-3 tb-sidebar">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox_right_sidebar') ?>
        </div>

		<!-- END MAINBODY ROW -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->
<!-- END two right CONTENT -->
<?php
// output footer
get_footer();