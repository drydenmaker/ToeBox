<?php 
$active = true;
$counter = 0;

?>
<!--  TOEBOX THEME TEMPLATE FOR CAROUSEL -->
<div id="carousel-<?php print $carouselCount; ?>" class="carousel slide carousel-effect-<?php print $effect ?>" 
    data-ride="carousel" 
    data-interval="<?php print $interval?>"
    data-pause="<?php print $pause ?>"
    data-wrap="<?php print $wrap ?>"
    data-keyboard="<?php print $keyboard ?>">
	<!-- Indicators -->
	<ol class="carousel-indicators">
	<?php for ($x = 0; $x < $post_count; $x++) :?>
		<li data-target="#carousel-<?php print $carouselCount; ?>" data-slide-to="<?php print $counter++; ?>" <?php if ($active) print 'class="active"'; ?>></li>
    <?php
        $active = false; 
        endfor;
         ?>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
	<?php 
	$active = ' active';
	while ($carouselQuery->have_posts()): $slide = $carouselQuery->next_post(); ?>
		<div class="item<?php print $active ?>">
			<img src="<?php print \toebox\inc\ToeBox::GetImageUrlForPost($slide->ID, 'full'); ?>" alt="<?php print $slide->post_title?>">
			<div class="container">
				<div class="carousel-caption-left">
					<?php print \toebox\inc\ToeBox::GetContent($slide); ?>
				</div>
			</div>
		</div>
	<?php
	   $active = null;
	endwhile;
	?>

	</div>

</div>

