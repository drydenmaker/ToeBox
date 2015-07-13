<?php
// set some defaults so templates work native
global $the_nav_header;
$toeboxSlug = empty($toeboxSlug) ? 'content' : $toeboxSlug;
$toebox_link_pages_args = empty($toebox_link_pages_args) ? array() : $toebox_link_pages_args;
?><!doctype html>
<html <?php language_attributes(); ?>/>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<title><?php wp_title(); ?></title>

<?php print toebox\inc\ToeBox::$Settings[TOEBOX_EXTRA_HEADER]; ?>
<!-- WP HEAD -->
<?php wp_head(); ?>
<!-- WP HEAD END -->
</head>
<body <?php body_class(); ?>>
<header class="clearfix" <?php if (!empty(get_header_image())) echo 'style="background: transparent url(\''.header_image().'\);background-repeat: no-repeat;background-position: center center;background-size: cover;"' ?>>
<!--[if lt IE 9]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
<?php 

if (!toebox\inc\ToeBox::$Settings[TOEBOX_USE_WIDGET_FOR_HEADER]) include get_template_directory() . '/tpl/widget/header.php';

?>
<!-- END HEADER -->
<!-- TOEBOX HEADER -->
<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-header');
print '<!-- NAV HEADER -->';

if (!array_key_exists(TOEBOX_USE_WIDGET_FOR_NAV_MENU, toebox\inc\ToeBox::$Settings) ||
                !toebox\inc\ToeBox::$Settings[TOEBOX_USE_WIDGET_FOR_NAV_MENU])
{
    echo '<div class="tb-default-nav">';
    
    toebox\inc\Walker\NavMenu\Touch::HandleMenu(array(
            'theme_location' => 'header-menu',
            'wrap' => 'menu_wrap'));

    echo '</div>';
}


?>
</header>
<!-- END TOEBOX HEADER -->

