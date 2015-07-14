<h2 class="nav-tab-wrapper">
<?php 

$tab = (isset($_GET['tab'])) ?  $_GET['tab'] : 'main';

foreach ($this->settings as $tabKey => $sections): ?>
    <a href="?page=<?php echo $this->PluginSlug ?>&tab=<?php echo $tabKey; ?>" class="nav-tab<?php if ($tab == $tabKey) print ' nav-tab-active'; ?>">
    <?php
      print (array_key_exists('title', $sections)) ? $sections['title'] : $tabKey ;
    ?></a>
<?php endforeach; ?>
</h2>

    <form action='options.php' method='post'>
		<table>
		<?php

        $sections = $this->settings[$tab];
        
        foreach ($sections as $sectionKey => $settings)
        {
            settings_fields( $sectionKey);
            do_settings_fields($this->PluginSlug, $sectionKey);
        }
        ?>
        
        <tfoot>
        
		</tfoot>	
		
		</table>
		<?php print get_submit_button(); ?>
	</form>
