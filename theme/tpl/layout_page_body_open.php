<?php
/*
Template Name: Open Post Body
Description: A page template that only displayes a single post body
*/
global $toeboxSlug, $toebox_link_pages_args;
get_header();
?>
<!-- START INDEX CONTENT LAYOUT PAGE OPEN -->

<?php
include get_template_directory() . '/tpl/content/loop.php';
?>

<!-- /.container -->
<!-- END INDEX CONTENT -->
<?php 
// output footer
get_footer();