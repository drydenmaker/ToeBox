<?php 
$active = true;
$counter = 0;
?>
<!-- <?php echo basename(__FILE__); ?> -->
<div class="container-fluid">
    <div class="row-fluid">
<div id="carousel-<?php print $carouselCount; ?>" class="carousel tripple carousel-effect-<?php print $effect ?>  <?php $class ?>" 
    data-ride="carousel" 
    data-interval="<?php print $interval?>"
    data-pause="<?php print $pause ?>"
    data-wrap="<?php print $wrap ?>"
    data-keyboard="<?php print $keyboard ?>">
	<!-- Indicators -->
	<ol class="carousel-indicators">
	<?php for ($x = 0; $x < ($post_count / 3); $x++) :?>
		<li data-target="#carousel-<?php print $carousel_count; ?>" data-slide-to="<?php print $counter++; ?>" <?php if ($active) print 'class="active"'; ?>></li>
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
	   if ($close_open) : ?>
        <!-- ITEM START -->
        <div class="item<?php print $active?>">
            
            <img src="<?php print get_theme_root_uri() . '/images/carousel_triple_clear_bg.png' ?>">
            <div class="carousel-caption">
		<?php endif; ?>
              <div class="col col-md-4">
                <div class="inner-item_<?php print $position ?>" style="background-image: url(<?php print \toebox\inc\ToeBox::GetImageUrlForPost($slide->ID, 'full'); ?>);">

					   <?php print \toebox\inc\ToeBox::GetContent($slide); ?>

                </div>
    		  </div>        
        		      
                  
        <?php 
        
        $counter++;
        $close_open = (($counter % 3) == 0);
        
        if ($close_open) : ?>
            </div>
        </div><!-- / ITEM -->
        <?php endif; 
	   
	   $active = null;
	endwhile;
	?>
	   <?php if (!$close_open) :?>
	   </div><!-- / ITEM (LAST) --><?php endif; ?>
	</div>

</div>
    </div>
</div>

