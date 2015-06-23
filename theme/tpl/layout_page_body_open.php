<?php
/*
Template Name: Open Post Body
Description: A page template that only displayes a single post body
*/
global $toeboxSlug, $toebox_link_pages_args;
get_header();
?>
<!-- START <?php echo basename( __FILE__ ); ?> -->

<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-container-header');
include get_template_directory() . '/tpl/content/loop.php';
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-container-footer');
?>

<!-- /.container -->
<!-- END INDEX CONTENT -->
<?php 
// output footer
get_footer();