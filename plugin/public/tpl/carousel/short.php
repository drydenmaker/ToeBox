<?php 
$active = true;
$counter = 0;
?>
<!-- <?php echo basename(__FILE__); ?> -->
<div id="carousel-<?php print $carousel_count; ?>" class="carousel short carousel-effect-<?php print $effect ?> <?php $class ?>" 
    data-ride="carousel" 
    data-interval="<?php print $interval?>"
    data-pause="<?php print $pause ?>"
    data-wrap="<?php print $wrap ?>"
    data-keyboard="<?php print $keyboard ?>">
    
	<!-- Indicators -->
	<ol class="carousel-indicators">
	<?php for ($x = 0; $x < $post_count; $x++) :?>
		<li data-target="#carousel-<?php print $carousel_count; ?>" data-slide-to="<?php print $x; ?>" <?php if ($active) print 'class="active"'; ?>></li>
    <?php
        $active = false; 
        endfor;
         ?>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
	<?php 
	$mobilePost = null;
	$active = ' active';
	while ($carouselQuery->have_posts()): $slide = $carouselQuery->next_post(); 
	
	   if (empty($mobilePost)) $mobilePost = $slide;
	?>
	
		<div id="frame-<?php print $counter++?>" class="item<?php print $active ?>" link='<?php get_metadata('carousel_link_post_url', $slide->ID)?>'>
		    <a href="<?php print get_post_meta($slide->ID, 'carousel_link_post_url', true); ?>">
			 <img src="<?php print \toebox\inc\ToeBox::GetImageUrlForPost($slide->ID, 'full'); ?>" alt="<?php print $slide->post_title?>">
			</a>
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

<?php if (!empty($mobilePost)):?>
<div class="carousel-inner visible-xs-block" role="listbox">
<div id="carousel-sticky-<?php print $carousel_count; ?>" class="">
	
    <img src="<?php print \toebox\inc\ToeBox::GetImageUrlForPost($mobilePost->ID, 'full'); ?>" alt="<?php print $mobilePost->post_title?>">
    
    <div class="container">
			<div class="carousel-caption-left">
		<?php print \toebox\inc\ToeBox::GetContent($mobilePost); ?>
		  </div>
	</div>
	
</div>
</div>
<?php endif; ?>
