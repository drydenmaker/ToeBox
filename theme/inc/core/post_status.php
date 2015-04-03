<?php
// Register Custom Status
add_action( 'init', function () {

    $args = array(
        'label'                     => _x( 'pending', 'Status General Name', 'text_domain' ),
        'label_count'               => _n_noop( 'Pending (%s)',  'Pending (%s)', 'text_domain' ),
        'public'                    => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'exclude_from_search'       => true,
    );
    
    register_post_status( 'pending', $args );

}, 0 );