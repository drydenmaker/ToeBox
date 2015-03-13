<!-- START INDEX CONTENT -->
<div class="container">

	<div class="row">
		<!-- START MAINBODY ROW -->

	   <div class="col-md-3 col-lg-offset-1 .hidden-sm tb-sidebar"">
<?php toebox\inc\ToeBox::HandleDynamicSidebar('toebox-left-sidebar') ?>
        </div>

		<div class="col-md-9 col-lg-8 tb-main">

<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-content-top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-content-bottom');
?>

        </div>

		<!-- END MAINBODY ROW -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->
<!-- END INDEX CONTENT -->