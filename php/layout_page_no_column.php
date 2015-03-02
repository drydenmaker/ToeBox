<!-- START INDEX CONTENT -->
<div class="container">

	<div class="row">
		<!-- START MAINBODY ROW -->
		<div class="col-sm-12 tb-main">

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