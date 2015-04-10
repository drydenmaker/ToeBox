<?php

wp_nav_menu(array(
    'menu'            => $menu_id,
    'container'       => 'div',
    'container_class' => '',
    'container_id'    => '',
    'menu_class'      => 'flat_menu',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul id="%1$s" class="bare">%3$s</ul>',
    'depth'           => 0,
    'walker'          => new toebox\inc\Walker\NavMenu\Flat()
));
