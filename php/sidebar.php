<!-- START SIDEBAR -->
<div class="sidebar">
 
    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else :
      get_links_list();
    endif; ?>
 
</div>
<!-- END SIDEBAR -->