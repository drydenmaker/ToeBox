<?php

// $arr = get_defined_vars();
// print __FUNCTION__.'<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';

toebox\plugins\inc\Walker\NavMenu\TouchText::HandleMenu(array(
    'menu'               => $menu_id,
    'hide_on_small'      => $hide_on_small,
    'show_only_on_small' => $show_only_on_small,
    'open_on_small'      => $open_on_small,
    'extra_header_text'         => $extra_header_text,
    'extra_header_text_strip_p' => $extra_header_text_strip_p,
    'extra_text'         => $extra_text,
    'extra_text_strip_p' => $extra_text_strip_p,
    'background'         => $background,
    'sub_text'           => $sub_text,
));
