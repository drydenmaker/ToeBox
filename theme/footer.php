
<!-- TOEBOX FOOTER -->
<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-footer');
?>
<!-- END TOEBOX FOOTER -->
<!-- START FOOTER -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<?php wp_footer(); ?>
	<?php print toebox\inc\ToeBox::$Settings[TOEBOX_EXTRA_FOOTER]; ?>
	
</body>
</html>