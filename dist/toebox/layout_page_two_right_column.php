<!-- START two right CONTENT -->
<div class="container">

	<div class="row">
		<!-- START MAINBODY ROW -->


		<div class="col-sm-9 col-lg-5 tb-main">

		<?php
		  //$options = get_option( 'toebox_settings' );
		  //print '<pre>' . print_r($options, true) . '</pre>';
		  //print '<pre>' . print_r(get_defined_vars(), true) . '</pre>';
		?>

<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-content-top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-content-bottom');
?>

        </div>

        <div class="col-sm-3  col-lg-offset-1 tb-sidebar">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox-left-sidebar') ?>
        </div>

        <div class="col-lg-3 tb-sidebar">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox-right-sidebar') ?>
        </div>

		<!-- END MAINBODY ROW -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->
<!-- END two right CONTENT -->