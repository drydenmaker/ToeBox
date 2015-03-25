<?php

add_action( 'init', function(){
    // enable shortcodes in widget text and exerpts
    add_filter('widget_text', 'do_shortcode');
    add_filter( 'the_excerpt', 'do_shortcode');
    
    add_shortcode('bootstrap-button', 'bootstrap_button_function');
});

function bootstrap_button_function($attirbutes, $content = 'Button') 
{
    $class = 'btn';
    static $defaults = array(
        'url' => '#',
        'style' => 'primary', // deafult, primary, success, info, warning, danger, link
        'size' => 3, // 1-4 (xsmall - large)
        'onclick' => 'void(0)',
        'title' => '',
        'type' => 'button',
        'block' => false,
        'active' => false,
        'disbled' => null
    );
    
    // combine and filter attributes
    $attirbutes = shortcode_atts($defaults, $attirbutes, 'bootstrap_button');
    
    // prefer href but allow url
    if (!array_key_exists('href', $attirbutes))
    {
        $attirbutes['href'] = $attirbutes['url'];
    }
    
    if (array_key_exists('url', $attirbutes)) 
        { unset($attirbutes['url']); }
        
    // setup classes
    $class .= ' btn-'.$attirbutes['style'];
    switch ($defaults['size']) {
        case 1:
            $class .= ' btn-xs';
            break;
        case 2:
            $class .= ' btn-sm';
            break;
        case 4:
            $class .= ' btn-lg';
            break;
    }
    
    
    if (array_key_exists('block', $attirbutes) && $attirbutes['block'])
    {
        $class .= ' btn-block';
    }
    if (array_key_exists('active', $attirbutes) && $attirbutes['active'])
    {
        $class .= ' active';
    }
    
    // append classes
    if (!array_key_exists('class', $attirbutes))
    {
        $class .= ' '. $attirbutes['class'];
    }
    
    $filteredAttributes = array_diff_key($target, array_flip(array('size', 'block', 'active', 'class')));
        
    $tag = "<a class='$class'";
    foreach ( $filteredAttributes as $attribute => $value ) {
        if ( ! empty( $value ) ) {
            $value = ( 'href' === $attribute ) ? esc_url( $value ) : esc_attr( $value );
            $tag .= sprintf(' %1$s="%2$s"', $attribute, $value);
        }
    }
    $tag .= ">$content</a>";
    
    
    return $tag;
}