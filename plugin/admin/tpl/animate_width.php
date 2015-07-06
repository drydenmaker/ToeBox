<div class="widget-content">
<hr /><h4>Menu Direction</h4>
<p>
<label for="<?php echo $widget->get_field_id( 'anamate_width' ); ?>"><?php _e( 'Hamburger from Left', 'toebox-basic' ); ?>:</label>

    <input <?php checked($anamate_width, 'on'); ?>
		id="<?php echo $widget->get_field_id( 'anamate_width' ); ?>"
		name="<?php echo $widget->get_field_name( 'anamate_width' ); ?>" type="checkbox" >
		
	<small>(display link titles as sub-text)</small>
	</p>
</div>
