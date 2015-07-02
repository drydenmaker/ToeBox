<?php
/*
Template Name: No Title Single Column
Description: A page template that puts everything inside a single bootstrap 'container'.
*/
global $toeboxSlug, $toebox_link_pages_args;
get_header();

?>
<!-- START INDEX CONTENT LAYOUT PAGE OPEN -->
<div class="container">
<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-container-header');
?>
    
<?php
global $posts;
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_top');

$slug = empty($slug) ? 'content' : $slug;

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>       

<div class="clearfix">
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> title="<?php esc_attr(get_the_title()) ?>">
            <?php the_content() ?>
 </article>
    
</div><!-- /row -->

<?php 
endwhile; else: ?>
<p>Error</p>
<?php
endif;
toebox\inc\ToeBox::HandleDynamicSidebar('toebox_content_bottom');

toebox\inc\ToeBox::HandleDynamicSidebar('toebox-container-footer');
?>   
</div>
<!-- /.container -->
<!-- END INDEX CONTENT -->
<?php 
// output footer
get_footer();