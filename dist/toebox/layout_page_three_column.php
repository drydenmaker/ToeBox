<!-- START three col CONTENT -->
<div class="container">

	<div class="row">
		<!-- START MAINBODY ROW -->

	   <div class="col-sm-3 tb-sidebar">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox-left-sidebar') ?>
        </div>

		<div class="col-sm-9 col-lg-5 col-lg-offset-1 tb-main">

<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-content-top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-content-bottom');
?>

        </div>

        <div class="col-lg-3 tb-sideba">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox-right-sidebar') ?>
        </div>

		<!-- END MAINBODY ROW -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->
<!-- END three col CONTENT -->