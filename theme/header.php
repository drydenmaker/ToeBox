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


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- WP HEAD -->
<?php wp_head(); ?>
<!-- WP HEAD END -->

    <style>
        .tb-main
        {
        	background-color: <?php print toebox\inc\Toebox::$Settings[TOEBOX_CONTENT_BACKGROUND_COLOR]; ?>;
        }
    </style>

</head>
<body <?php body_class(); ?>>
<!--[if lt IE 9]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
<?php

if (!empty(get_header_image())) :?>
<div style="height: 39vh; margin-bottom: -39vh; overflow:hidden; background: transparent url('<?php header_image(); ?>'); background-repeat: no-repeat; background-position: center center; background-size: cover;">
&nbsp;
</div>
<?php endif;

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
    
    toebox\inc\Walker\NavMenu\Primary::HandleMenu(array(
            'theme_location' => 'header-menu',
            'wrap' => 'menu_wrap'));

    echo '</div>';
}


?>
<!-- END TOEBOX HEADER -->

