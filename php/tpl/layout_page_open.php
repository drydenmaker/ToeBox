<?php
/*
Template Name: Wide Open
Description: A page template that puts everything inside a single bootstrap 'container'.
*/
get_header();
?>
<!-- START INDEX CONTENT -->
<div class="container">
    <div class="tb-main">
<?php
global $posts;
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_bottom');
?>
    </div>
</div>
<!-- /.container -->
<!-- END INDEX CONTENT -->
<?php 
// output footer
get_footer();