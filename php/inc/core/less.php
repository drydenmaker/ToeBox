<?php
require_once get_template_directory().'/vendor/autoload.php';
require_once get_template_directory().'/vendor/oncletom/wp-less/bootstrap-for-theme.php';

add_action( 'init', function()
{
    $WPLessPlugin = WPLessPlugin::getInstance();
    if (WP_DEBUG) $WPLessPlugin->processStylesheets();
    $WPLessPlugin->dispatch();
}, 0);