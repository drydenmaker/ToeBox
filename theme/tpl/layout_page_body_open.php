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
?>

<!-- /.container -->
<!-- END INDEX CONTENT -->
<?php 
// output footer
get_footer();