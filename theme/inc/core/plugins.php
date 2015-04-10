<?php
require_once get_template_directory().'/vendor/autoload.php';
require_once get_template_directory().'/vendor/tgm/plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', function()
{
    $plugins = array(
        array(
            'name'      => 'WP-Less',
            'slug'      => 'wp-less',
            'required'  => true,
        ),
        array(
            'name'      => 'WP-ToeBox',
            'slug'      => 'toebox_plugin',
            'required'  => true,
        ),
        array(
            'name' => 'Amazon S3 and Cloudfront',
            'slug' => 'amazon-s3-and-cloudfront',   
            'required'  => false,
        ),
        array(
            'name' => 'W3 Total Cache',
            'slug' => 'w3-total-cache',
            'required'  => false,
        ),
    );
    
    $config = array(
        'default_path' => ' ',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => ' ',                      // Message to output right before the plugins table.
        'strings'       => array(
            'notice_can_install_required'     => _n_noop( 'ToeBox requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'ToeBox recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
        )
    );
    
    tgmpa( $plugins, $config );

});
