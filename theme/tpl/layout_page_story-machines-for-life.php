<?php
/*
 Template Name: Machines For Life
 Description: A Page with a fluid container and featured header and footer.
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" /> 		
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<meta name="description" content="Add excerpt here">

		<link rel="icon" type="image/x-icon" href="favicon.ico">
		
		<style>
		
			*  { 
  				-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
  				-moz-box-sizing: border-box;    /* Firefox, other Gecko */
  				box-sizing: border-box;         /* Opera/IE 8+ */
			}
		
			html, body, article {
				width: 100%;
				background: none;
				padding: 0;
				margin: 0;
				font-size: 16px;			
			}
			
			p {
				margin-bottom: 30px;
				line-height: 1.5em;
			}
			
			#scroll-wrapper {
				position: relative;	
				width: 100%;
				overflow-y: scroll;
				overflow-x: hidden;
			}
			
			.maintitle {
				width: 90%;
				vertical-align: middle;
				text-align: center;
				padding: 0;
				margin: 0 auto;
				border-bottom: 1px solid #ffffff;
			}
			
			.excerpt, .credits {
				width: 65%;
				padding: 20px 0px;
				margin: 20px auto;		
				color: #ffffff;	
				font-size: 175%;
				text-align: center;	
			}			
			
			.bgvideo {
				position : absolute;		
			}
			
			.middle {
				top : 50%;
				left : 50%;
				-webkit-transform : translate(-50%, -50%);
				-ms-transform : translate(-50%, -50%);
				transform : translate(-50%, -50%);			
			}
			
			.topleft {
				top : 0%;
				left : 0%;
				-webkit-transform : translate(0,0);
				-ms-transform : translate(0,0);
				transform : translate(0,0);				
			}
			
			.topright {
				top : 0%;
				right : 0%;
				-webkit-transform : translate(0,0);
				-ms-transform : translate(0,0);
				transform : translate(0,0);				
			}			

			.bgvideo-wrapper {
				visibility : hidden;
				position: absolute;
				top: 0; 
				left: 0;
				width: 100%;
				height: 100%;
				overflow: hidden;
				z-index: -1;
			}	
			
			.panel-grid {
				background: #ffffff;
				display: table;
				position: relative;
			}
			
			.panel-grid-cell {
				padding: 1em;	
				display: table-cell;
				width: 50%;		
				position: relative;
				vertical-align: top;
			}	
			
			#slideshow1 {
				position: relative;
				width: 350px;
				top: 634px;
				left: 0px;
				margin: 0 auto;
			}	
			
			#slideshow1 img {
				position: absolute;
				bottom: 0px;
				left: 0px;
				width: 100%;
			}			
		
			#pg-1574-2 {
				position: fixed;
				top: 0px;
				left: 120%;
				width: 80%;
				z-index: 10;			
			}
				
			#pg-1574-3 {
				padding-top: 100%;
			
			}		
			
			.wrap1 {
				background-image: linear-gradient(bottom, #f7dfcb 7%, #02324c 63%, #b6d8e8 97%);
				background-image: -o-linear-gradient(bottom, #f7dfcb 7%, #02324c 63%, #b6d8e8 97%);
				background-image: -moz-linear-gradient(bottom, #f7dfcb 7%, #02324c 63%, #b6d8e8 97%);
				background-image: -webkit-linear-gradient(bottom, #f7dfcb 7%, #02324c 63%, #b6d8e8 97%);
				background-image: -ms-linear-gradient(bottom, #f7dfcb 7%, #02324c 63%, #b6d8e8 97%);
				background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0.07, #f7dfcb), color-stop(0.63, #02324c), color-stop(0.97, #b6d8e8));										
			}	
			
			.wrap1 .panel-grid {
				background: none;
			}		
			
			.binary-text-area {
				color: #ffffff;
				width: 50%;
				position: relative;
				top: 120px;
				left: 30px;
				font-size: 120%;
			}
			
			#pg-1574-5 {
				background-image: linear-gradient(bottom, #f4d7da 16%, #2ca2c2 50%, #fefee2 82%);
				background-image: -o-linear-gradient(bottom, #f4d7da 16%, #2ca2c2 50%, #fefee2 82%);
				background-image: -moz-linear-gradient(bottom, #f4d7da 16%, #2ca2c2 50%, #fefee2 82%);
				background-image: -webkit-linear-gradient(bottom, #f4d7da 16%, #2ca2c2 50%, #fefee2 82%);
				background-image: -ms-linear-gradient(bottom, #f4d7da 16%, #2ca2c2 50%, #fefee2 82%);
				background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0.16, #f4d7da), color-stop(0.5, #2ca2c2), color-stop(0.82, #fefee2));
			}
			
			#pg-1574-4 {
				background: none;
				width: 40%;
				color: #ffffff;
				position: fixed;
				top: 30%;
				right: 120%;
				z-index: 10;
				font-size: 150%;
			}
			
			#pg-1574-5 {
				margin-top: 200%;
			}
			
			#pg-1574-6 {
				width: 50%;
				color: #ffffff;
				background: none;
			}		

		</style>

		<style>
			/* ipad styles */
			@media only screen 
			and (min-device-width : 768px) 
			and (max-device-width : 1024px) 
			and (orientation : portrait) {

				body, html, article, #scroll-wrapper {
					font-size: 16px;
				}
				
				.bgvideo {
					display: none;
				}	

				.bgvideo-wrapper {
					visibility: visible;
					height: 200%;
					width: 200%;
					background-color: #000000;
					background-image: url(/wp-content/uploads/2015/03/pq3v2.jpg);
					background-size: cover;
					z-index: -1;
				}
				
				.middle {
					top: 0%;
					left: -45%;
					-webkit-transform : translate(0%, 0%);
					-ms-transform : translate(0%, 0%);
					transform : translate(0%, 0%);			
				}
			
				.topleft {
					top: 0%;
					left: 0%;
					-webkit-transform : translate(0%,0%);
					-ms-transform : translate(0%,0%);
					transform : translate(0%,0%);				
				}
			
				.topright {
					top: 0%;
					left: -75%;
					-webkit-transform : translate(0%,0%);
					-ms-transform : translate(0%,0%);
					transform : translate(0%,0%);				
				}			
				
				
			}		
		
		</style>	
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
	</head>

	<body>
	
		<!-- background video main title -->
		<div class="bgvideo-wrapper">
    		<video class="bgvideo" preload="auto" loop="loop" autoplay>
        		<source src="/wp-content/uploads/2015/03/Sequence4.mp4" type="video/mp4">
    		</video>
		</div>
				
		<div id="scroll-wrapper">
		
			<article>
				
				<header>
				<?php while ( have_posts() ) : the_post(); ?>
						
					<h1 class="maintitle">
						<img src="/wp-content/uploads/2015/03/MACHINES.svg" width="90%">
					</h1>
								
					<div class="credits">
						<?php echo get_post_meta( get_the_ID(), 'credits', true );?>
					</div>
	
					<div class="excerpt">
						<?php the_excerpt(); ?> 
					</div>
				</header>	

				<?php the_content(); ?>
							
				<?php endwhile; // end of the loop. ?>

			</article>
			
		</div>			
			
		<!-- scripts -->
		<script src="/vendor/covervid.min.js"></script>	
		<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>				
		<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.1/ScrollMagic.min.js></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.1/plugins/addIndicators.min.js></script>
		
		<script type="text/javascript">
	
				
				jQuery(document).ready(function($) {
								
					initPage($);
					
				});

				function initPage($) {	
				
					var win_height = $(window).height();	
					var bg_el = '.bgvideo-wrapper';

                    // make maintitle, scroll-wrapper, background video the height of the viewport					
					$('.maintitle').height(win_height);
					$('#scroll-wrapper').height(win_height);
					$('.bgvideo-wrapper').height(win_height);	
					
					//resize video if one being shown
					if ( $('.bgvideo').css('display') != 'none' ) {
						bg_el = '.bgvideo';
						resizeBgVideo(1440, 810);
					}
												
					// add wrapper for slides 1, 2 and 3 so they can share same background
					$('#pg-1574-1,#pg-1574-2,#pg-1574-3').wrapAll('<div class="wrap1"></div>');	
					
					// add wrapper for slide 1 images 
					$('#pgc-1574-0-0 > *').wrapAll('<div id="slideshow1"></div>');				
					
					// ScrollMagic 
					
					// Effects based on iPad portrait dimensions, allow for difference
					var win_diff = (927 - win_height) / 2;
					
					// Slide 1 - pin images then 'scroll' through slides
					var s1_height = $('#pg-1574-0').height();
					var s1_offset = Math.round( ( $('#pg-1574-0').offset().top - ( win_height / 2 ) ) + (186 + win_diff) );					
					var s1_duration = Math.round( ( s1_height - (win_height / 2) ) - ( 187 + win_diff) );
					var s1_interval = Math.round(s1_duration / 5);
					
					var controller;
					controller = new ScrollMagic({container: '#scroll-wrapper'});
					
					// Add pinning of slideshow
					var scene = new ScrollScene({offset: s1_offset, duration: s1_duration })
						.setPin("#slideshow1")
						.addTo(controller);
						
					// Create image tweens	
					var tween1 = TweenMax.to("#panel-1574-0-0-3 img", 1.0, {opacity: 0});
					var tween2 = TweenMax.to("#panel-1574-0-0-2 img", 1.0, {opacity: 0});
					var tween3 = TweenMax.to("#panel-1574-0-0-1 img", 1.0, {opacity: 0});

					// Add Tweens to scene 1
					var scene = new ScrollScene({offset: s1_offset + s1_interval })
						.setTween(tween1)
						.addTo(controller);

					// build scene
					var scene = new ScrollScene({offset: s1_offset + (s1_interval * 2) })
						.setTween(tween2)
						.addTo(controller);

					// build scene					
					var scene = new ScrollScene({offset: s1_offset + (s1_interval * 3) })
						.setTween(tween3)
						.addTo(controller);
						
					// pg-1574-2 - slide in from the right
					// offset is top of pg-1574-3 + half height of win_height
					// duration is 150% of win_height			
				
					// Create TimeLine
					var slideinright = new TimelineMax()
						.add(TweenMax.to('#pg-1574-2', 1, {left: '-100%'}));
					
					// add scene
					new ScrollScene({
						offset: $('#pg-1574-3').offset().top - (win_height / 2),
						duration:win_height * 1.5,
					})
					.setTween(slideinright)
					.addTo(controller);						

					// Create TimeLine
					var slideinleft = new TimelineMax()
						.add(TweenMax.to('#pg-1574-4', 1, {right: '-100%'}));
					
					// add scene
					new ScrollScene({
						offset: $('#pg-1574-5').offset().top - ( win_height * 2 ),
						duration: win_height * 2,
					})
					.setTween(slideinleft)
					.addTo(controller);		
					
					// build scenes
					new ScrollScene({triggerElement: 'header', duration: jQuery('header').height() + win_height})
					.setClassToggle(bg_el, 'middle') // add class toggle					
					.addTo(controller);	

					new ScrollScene({offset: jQuery('#pg-1574-5').offset().top - parseInt(jQuery('#pg-1574-5').css('margin-top')) - win_height, duration: parseInt(jQuery('#pg-1574-5').css('margin-top')) + jQuery('#pg-1574-5').height()})
					.setClassToggle(bg_el, 'topright') // add class toggle					
					.addTo(controller);	

					new ScrollScene({offset: jQuery('#pg-1574-6').offset().top - win_height, duration: jQuery('#pg-1574-6').height() + win_height})
					.setClassToggle(bg_el, 'topleft') // add class toggle					
					.addTo(controller);							

					// show indicators (requires debug extension)
					scene.addIndicators({
						zindex: 999,
					});				
				
				}
				
				function resizeBgVideo(bg_width, bg_height){
	
					var newHeight, newWidth;

					jQuery('html').css({'overflow':'hidden'});
	
					var $wrapper = jQuery('.bgvideo-wrapper');
	
					// Get parent element height, width, ratio
					var parentHeight = $wrapper.height();
					var parentWidth = $wrapper.width();
					var parentRatio = parentHeight / parentWidth;
	
					// Get native ratio
					var nativeRatio = bg_height / bg_width;
	
					console.log('height = ' + parentHeight + ' width = ' + parentWidth);
	
					newWidth = parseInt(parentHeight / nativeRatio);

					// If not wide enough then recalculate height
					if (newWidth < parentWidth) {
		
						newWidth = parentWidth;
						newHeight = parseInt(newWidth * nativeRatio);

					} else {
	
						newWidth = parseInt(parentHeight / nativeRatio);
						newHeight = parentHeight;

					}	
	
					console.log('new height = ' + newHeight + ' width = ' + newWidth);	
			
					jQuery('.bgvideo').css({
						'height': newHeight,
						'width': newWidth,
						'max-width' : newWidth
					}); 
	
					jQuery('.bgvideo-wrapper').css({'visibility':'visible'});
	
					jQuery('html').css({'overflow':'auto'});

				};

							
		</script>	


	</body>

</html>