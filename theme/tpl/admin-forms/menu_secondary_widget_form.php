<?php
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
?>

<div class="widget-content">
	<p>
		<label for="<?php echo $widget->get_field_id( 'menu_id' ); ?>"><?php _e( 'Select Menu', 'toebox-basic' ); ?>:</label>
		<select  class="widefat"
		  id="<?php echo $widget->get_field_id( 'menu_id' ); ?>" 
		  name="<?php echo $widget->get_field_name( 'menu_id' ); ?>">
		      <option value="0">- Select -</option><?php
		  
		foreach ( $menus as $menu )
		{
		  print sprintf('<option value="%1$s" %3$s>%2$s</option>', $menu->term_id, 
		                  $menu->name, 
		                  ($menu_id == $menu->term_id) ? 'selected' : '' );
		}
		
		?></select>
	</p>
</div>
