<?php
/*
Template Name: Wide Open
Description: A page template that puts everything inside a single bootstrap 'container'.
*/
global $toeboxSlug, $toebox_link_pages_args;
get_header();
?>
<!-- START INDEX CONTENT LAYOUT PAGE OPEN -->
<div class="container-fluid">
<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-container-header');
?>
    <div class="tb-main">
    
<?php
include get_template_directory() . '/tpl/content/loop.php';
?>

    </div>
<?php 
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-container-footer');
?>
</div>
<!-- /.container -->
<!-- END INDEX CONTENT -->
<?php 
// output footer
get_footer();