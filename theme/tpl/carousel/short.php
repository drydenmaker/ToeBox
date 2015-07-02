<?php 
$active = true;
$counter = 0;
?>
<!--  TOEBOX THEME TEMPLATE FOR CAROUSEL -->
<div class="container-fluid">
	<div class="row-fluid">
		<div id="carousel-<?php print $carouselCount; ?>"
			class="carousel-short carousel slide carousel-effect-<?php print $effect ?>"
			data-ride="carousel" data-interval="<?php print $interval?>"
			data-pause="<?php print $pause ?>" data-wrap="<?php print $wrap ?>"
			data-keyboard="<?php print $keyboard ?>">
			<!-- Indicators -->
			<ol class="carousel-indicators">
	<?php for ($x = 0; $x < ($post_count / 3); $x++) :?>
		<li data-target="#carousel-<?php print $carouselCount; ?>"
					data-slide-to="<?php print $counter++; ?>"
					<?php if ($active) print 'class="active"'; ?>></li>
    <?php
        $active = false; 
        endfor;
         ?>
	</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
	   
	<?php 
	// group three items together
	$active = ' active';
	$counter = 0;
	$close_open = true;
	while ($carouselQuery->have_posts()): 
	   $slide = $carouselQuery->next_post();
    ?>
<div class="item<?php print $active?>">
					<img
						src="<?php print get_theme_root_uri() . '/images/carousel_triple_clear_bg.png' ?>">
					<div class="carousel-caption">
						<div class="col col-md-4">
							<div class="inner-item_<?php 
							     print $position 
							         ?>" style="background-image: url(<?php 
							             print \toebox\inc\ToeBox::GetImageUrlForPost($slide->ID, 'full'); ?>);">

<?php print \toebox\inc\ToeBox::GetContent($slide); ?>

                            </div>
						</div>
					</div>
				</div>
        <?php
    
        $active = null;
    endwhile;
?>
	</div>
		</div>
	</div>
</div>

