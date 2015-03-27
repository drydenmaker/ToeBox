<?php 
// set some defaults so templates work native
$toeboxSlug = empty($toeboxSlug) ? 'content' : $toeboxSlug;
$toebox_link_pages_args = empty($toebox_link_pages_args) ? array() : $toebox_link_pages_args;
?><!doctype html>
<html <?php language_attributes(); ?>/>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<title><?php wp_title(' | ', 'echo', 'right'); ?><?php bloginfo('name'); ?></title>


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
<!-- END HEADER -->
<!-- TOEBOX HEADER -->
<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-header');
?>
<!-- END TOEBOX HEADER -->

