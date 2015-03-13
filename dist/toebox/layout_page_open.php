<!-- START INDEX CONTENT -->
<div class="container">

<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-content-top');
toebox\inc\ToeBox::HandleLoop($posts, $toeboxSlug);
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-content-bottom');
?>

</div>
<!-- /.container -->
<!-- END INDEX CONTENT -->