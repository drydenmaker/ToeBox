<div class="post-thumbnail">
    <?php 
		  //print '<pre>' . print_r(get_defined_vars(), true) . '</pre>';
		?>
		
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		  <img src="<?php print $src ?>" class="<?php print $sizeClass ?> img-responsive" title="<?php print $title ?>" alt="<?php print $alt ?>">
	    </a>
</div>