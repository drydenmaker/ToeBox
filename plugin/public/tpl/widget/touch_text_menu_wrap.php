<?php

$backgroundStyle = '';
if (isset($args['background']) && !empty($args['background'])) 
{
    $backgroundStyle = sprintf(" style=\"background: transparent url('%s') no-repeat center;background-size: contain;\"", $args['background']);
    
}

?>
<div class="nav-container container-fluid">
  <div class="row" <?php echo $backgroundStyle; ?>>	
	<div class="col-sm-9 tb-nav navbar-menu">
    	<div class="navbar-header">
        		 <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target="#tb-navbar-collapse">
        		   <span class="sr-only">Toggle navigation</span>
        		   <span class="icon-bar"></span>
        		   <span class="icon-bar"></span>
        		   <span class="icon-bar"></span>
        		 </button>
        		 
        		
	 <?php
	   if (isset($args['extra_header_text']) && !empty($args['extra_header_text'])) 
	   {
	       $content = do_shortcode($args['extra_header_text']);
	       if (isset($args['extra_header_text_strip_p']) && $args['extra_header_text_strip_p'])
	       {
	           $content = \toebox\plugin\inc\core\StringTransform::removeBreakParagraph($content);
	       }
	       
	       print $content;
	   }
	  ?>
        </div>
    	<div class="collapse navbar-collapse" id="tb-navbar-collapse">
    		<ul class="nav navbar-nav">
    			%3$s
    		</ul>
    	</div>
	</div>
	<div class="hidden-xs col-sm-3 tb-nav-text">
	  <?php
	   if (isset($args['extra_text']) && !empty($args['extra_text'])) 
	   {
	       $content = do_shortcode($args['extra_text']);
	       if (isset($args['extra_text_strip_p']) && $args['extra_text_strip_p'])
	       {
	           $content = \toebox\plugin\inc\core\StringTransform::removeBreakParagraph($content);
	       }
	       
	       print $content;
	   }
	  ?>
	</div>
	
  </div>	
</div>