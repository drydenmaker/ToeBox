<!-- START INDEX CONTENT -->
<div class="container">

	<div class="row">
		<!-- START MAINBODY ROW -->

		<div class="col-sm-9 col-lg-8 tb-main">

<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-content-top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-content-bottom');
?>

        </div>

		<div class="col-sm-3 col-lg-offset-1 tb-sidebar">
<?php inc\ToeBox::HandleDynamicSidebar('toebox-right-sidebar') ?>
        </div>

		<!-- END MAINBODY ROW -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->
<!-- END INDEX CONTENT -->