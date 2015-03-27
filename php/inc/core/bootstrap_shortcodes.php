<?php

add_action( 'init', function(){
    // enable shortcodes in widget text and exerpts
    add_filter('widget_text', 'do_shortcode');
    add_filter( 'the_excerpt', 'do_shortcode');
    
    add_shortcode('bootstrap-button', 'bootstrap_button_function');
    add_shortcode('imgmedia-object', 'imgmedia_block_function');
    add_shortcode('badge', 'badge_function');
    add_shortcode('jumbotron', 'jumbotron_function');
});

function badge_function($attirbutes, $content = '&nbsp;')
{
    return sprintf('<span class="badge">%s</span>', $content);
}

function jumbotron_function($attirbutes, $content = '&nbsp;')
{
    return sprintf('<div  class="jumbotron">%s</div >', $content);
}

function thumbnail_content_function($attirbutes, $content = '&nbsp;')
{
    static $defaults = array(
        'url' => '#',
        'src' => '',
        'img_title' => '',
        'heading' => '',
    );
    // combine and filter attributes
    $attirbutes = shortcode_atts($defaults, $attirbutes, 'bootstrap_media_object');
    
    // prefer href but allow url
    if (!array_key_exists('href', $attirbutes))
    {
        $attirbutes['href'] = $attirbutes['url'];
    }
    
    extract(array_diff_key($attirbutes, array_flip(array('size', 'url', 'alignment'))));
    
    return sprintf("<div class='thumbnail'>
      <img src='$src' alt='$heading'>
      <div class='caption'>
        <h3>$heading</h3>
        $content
      </div>
    </div>", $content);
}

/**
 * expands to a media block
 * @param unknown $attirbutes
 * @param string $content
 * @return string
 * <example>
 *  [imgmedia-object src='/img/my.jpg' url=# heading="OOO" img_title="an image" align="middle"] ... [/imgmedia-object]
 * </example>
 */
function imgmedia_block_function($attirbutes, $content = '&nbsp;')
{
    static $defaults = array(
        'url' => '#',
        'src' => '',
        'style' => 'left', // deafult, primary, success, info, warning, danger, link
        'size' => 2, // 1-4 (xsmall - large)
        'img_title' => '',
        'heading' => '',
        'alignment' => 'top',
    );    

    // combine and filter attributes
    $attirbutes = shortcode_atts($defaults, $attirbutes, 'bootstrap_media_object');
    
    // prefer href but allow url
    if (!array_key_exists('href', $attirbutes))
    {
        $attirbutes['href'] = $attirbutes['url'];
    }
    
    
    $imgClass = '';
    switch ($defaults['size']) {
        case 1:
            $imgClass = 'img-xs';
            break;
        case 3:
            $imgClass = 'img-md';
            break;
        case 4:
            $imgClass = 'img-lg';
            break;
        default:
            $imgClass = 'img-sm';
    }
    
    $mediaAlignment = '';
    switch($defaults['alignment']) {
        case 'center':
        case 'middle':
            $mediaAlignment = 'media-middle';
            break;
        case 'bottom':
            $mediaAlignment = 'media-bottom';
            break;            
    }
    
    extract(array_diff_key($attirbutes, array_flip(array('size', 'url', 'alignment'))));
    
    if ($style === 'right')
    {
        return "
        <div class='media'>
            <div class='media-body'>
                <h4 class='media-heading'>$heading</h4>
                $content
            </div>
            <div class='media-right $mediaAlignment'>
                <a href='$href'>
                    <img class='media-object {$imgClass}' src='$src' alt='$img_title'>
                </a>
            </div>
        </div>
        ";
    }
    
    return "
         <div class='media'>
          <div class='media-left $mediaAlignment'>
            <a href='$href'>
              <img class='media-object {$imgClass}' src='$src' alt='$img_title'>
            </a>
          </div>
          <div class='media-body'>
            <h4 class='media-heading'>$heading</h4>
            $content
          </div>
        </div>
        ";
    
}
/**
 * expands to a bootstrap button
 * @param unknown $attirbutes
 * @param string $content
 * @return string
 */
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
        'disabled' => '',
        'class' => ''
    );
    
    // combine and filter attributes
    $attirbutes = shortcode_atts($defaults, $attirbutes, 'bootstrap_button');
    
    // prefer href but allow url
    if (!array_key_exists('href', $attirbutes))
    {
        $attirbutes['href'] = $attirbutes['url'];
    }
    
    // setup classes
    $class .= ' btn-'.$attirbutes['style'];
    switch ($defaults['size']) {
        case 1:
            $class .= ' btn-xs';
            break;
        case 2:
            $class .= ' btn-sm';
            break;
        case 3:
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
    
    $filteredAttributes = array_diff_key($attirbutes, array_flip(array('url', 'size', 'block', 'active', 'class')));
        
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