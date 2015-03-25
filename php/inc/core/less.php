<?php
require_once TEMPLATEPATH.'/vendor/autoload.php';
require_once TEMPLATEPATH.'/vendor/oncletom/wp-less/bootstrap-for-theme.php';

add_action( 'init', function()
{
    $WPLessPlugin = WPLessPlugin::getInstance();
    if (WP_DEBUG) $WPLessPlugin->processStylesheets();
    $WPLessPlugin->dispatch();
}, 0);