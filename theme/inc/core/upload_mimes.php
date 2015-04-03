<?php
/**
 * ----------------------------------------------------------------------------
 * EXTRA MIME TYPES
 * ----------------------------------------------------------------------------
 */
add_filter('upload_mimes', function ( $existing_mimes=array() ) {

    $existing_mimes['svg'] = 'image/svg+xml';
    $existing_mimes['svgz'] = 'image/svg+xml';
    return $existing_mimes;

});