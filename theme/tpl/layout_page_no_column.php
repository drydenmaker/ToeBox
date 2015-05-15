<?php
/*
Template Name: Without Sidebars
Description: A Page with a sinle container constraining it to a max width.
*/
global $toeboxSlug, $toebox_link_pages_args;
get_header();
?>
<!-- START INDEX CONTENT -->
<div class="container">

	<div class="row">
		<!-- START MAINBODY ROW -->
		<div class="col-sm-12 tb-main">

<?php
global $posts;
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);

wp_link_pages( $toebox_link_pages_args );

toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_bottom');

toebox\inc\ToeBox::HandleListNavigation();
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