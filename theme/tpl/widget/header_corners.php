<?php 

// $arr = get_defined_vars();
// print __FUNCTION__.'<pre>'.htmlspecialchars(print_r($arr, true)).'</pre>';

?>
<div class="<?php print $container_class ?> clearfix" style="background: url(<?php print $background ?>) <?php print $background_style ?>">

    <div class=" <?php print $description_class ?>">
        <?php if ($sub_logo) : ?><img src="<?php print $sub_logo ?>" style="<?php print $sub_logo_style ?>" /><?php endif;?>
        <div class='visible-sm-block visible-md-block visible-lg-block visible-xl-block description'><?php echo get_bloginfo( 'description', 'display' ); ?></div>
    </div>

    <h1 class="<?php print $title_class ?>">
        <a href="<?php print esc_url( home_url( '/' ) ); ?>" rel="home">
            <?php if ($logo) : ?><img src="<?php print $logo ?>" style="<?php print $logo_style ?>" /><?php endif;?>
            <div><?php bloginfo( 'name' ); ?></div>
        </a>
    </h1>
    <div class="visible-xs-inline-block <?php print $description_class ?>">
        <span class='description'><?php echo get_bloginfo( 'description', 'display' ); ?></span>
    </div>
</div>