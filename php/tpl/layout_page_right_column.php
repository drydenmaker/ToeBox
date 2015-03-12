<?php
/*
Template Name: Right Column
Description: A page template with a single column 1/3 of the page width on the right side of the content.
*/
get_header();
?>
<!-- START INDEX CONTENT -->
<div class="container">

	<div class="row">
		<!-- START MAINBODY ROW -->

		<div class="col-sm-9 col-lg-8 tb-main">

<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_bottom');
?>

        </div>

		<div class="col-sm-3 col-lg-offset-1 tb-sidebar">
<?php inc\ToeBox::HandleDynamicSidebar('toebox_right_sidebar') ?>
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