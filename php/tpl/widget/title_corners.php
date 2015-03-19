<div class="<?php print $container_class ?>" style="background: url(<?php print $background ?>) <?php print $background_style ?>">

    <div class="visible-sm-inline visible-md-inline visible-lg-inline visible-xl-inline <?php print $description_class ?>">
        <?php if ($sub_logo) : ?><img src="<?php print $sub_logo ?>" style="<?php print $sub_logo_style ?>" /><?php endif;?>
        <h2><?php echo get_bloginfo( 'description', 'display' ); ?></h2>
    </div>

    <h1 class="<?php print $title_class ?>">
        <a href="<?php print esc_url( home_url( '/' ) ); ?>" rel="home">
            <?php if ($logo) : ?><img src="<?php print $logo ?>" style="<?php print $logo_style ?>" /><?php endif;?>
            <div><?php bloginfo( 'name' ); ?></div>
        </a>
    </h1>
    <div class="visible-xs-inline-block <?php print $description_class ?>">
        <h2><?php echo get_bloginfo( 'description', 'display' ); ?></h2>
    </div>
</div>