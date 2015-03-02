<?php
// output header
get_header();

// output layout with content
toebox\inc\ToeBox::Layout(get_option( 'toebox_settings' ));

// output footer
get_footer();
