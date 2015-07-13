
<!-- TOEBOX FOOTER -->
<?php
toebox\inc\ToeBox::HandleDynamicSidebar('toebox-footer');
?>
<!-- END TOEBOX FOOTER -->
<!-- START FOOTER -->
<?php print toebox\inc\ToeBox::$Settings[TOEBOX_EXTRA_FOOTER]; ?>
<!-- WP FOOT -->
<?php wp_footer(); ?>
<!-- WP FOOT END -->
</body>
</html>