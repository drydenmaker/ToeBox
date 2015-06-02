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
include get_template_directory() . '/tpl/content/loop.php';
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