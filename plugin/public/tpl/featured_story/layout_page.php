<?php
/*
Template Name: Featured Story No Columns
Description: A Page with a fluid container and featured header and footer.
*/
wp_enqueue_style('toebox-theme-style', get_theme_root_uri() . '/css/featured_story.css');
wp_enqueue_script('toebox-script', get_theme_root_uri() . '/js/featured_story.js', array(), false, true);
global $the_nav_header;

?>
<!doctype html>
<html <?php language_attributes(); ?>/>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<title><?php wp_title( ' ', true, 'right' ); ?></title>

<!-- WP HEAD -->
<?php wp_head(); ?>
<!-- WP HEAD END -->
<!--  FEATURED STORY CSS -->
<style>
<?php print get_post_meta($post->ID, 'featured_story_css', true); ?>
</style>
<!--  FEATURED STORY CSS -->
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 9]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
<!-- END HEADER -->
<!-- TOEBOX HEADER -->

<?php
toebox\inc\ToeBox::HandleDynamicSidebar('featured_header');

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
toebox\inc\ToeBox::HandleDynamicSidebar('featured_footer');
?>
<!-- END TOEBOX FOOTER -->
	<?php wp_footer(); ?>
</body>
</html>