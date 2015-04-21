<?php
/*
Template Name: Three Column - Content Right
Description: A page template with two columns to the left of the content.
*/
get_header();
?>
<!-- START two right CONTENT -->
<div class="container">

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
global $posts;
print $the_nav_header;
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);

wp_link_pages( $toebox_link_pages_args );

toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_bottom');
?>

        </div>

<?php 
toebox\inc\ToeBox::HandleListNavigation();
?>

		<!-- END MAINBODY ROW -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->
<!-- END two right CONTENT -->
<?php
// output footer
get_footer();