
<div class="<?php print $container_class ?>" style="background: url(<?php print $background ?>) <?php print $background_style ?>">
    <h1 class="<?php print $title_class ?>">
        <a href="<?php print esc_url( home_url( '/' ) ); ?>" rel="home">
            <?php if ($logo) : ?><img src="<?php print $logo ?>" style="<?php print $logo_style ?>" /><?php endif;?>
            <div><?php bloginfo( 'name' ); ?></div>
        </a>
    </h1>
    <p class="<?php print $description_class ?>">
<?php echo get_bloginfo( 'description', 'display' ); ?>
    </p>
</div>