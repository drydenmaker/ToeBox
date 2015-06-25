<div class="widget-content">
<p>
<label for="<?php echo $widget->get_field_id( 'sub_text' ); ?>"><?php _e( 'Sub-Titles', 'toebox-basic' ); ?>:</label>

    <input <?php checked($sub_text, 'on'); ?>
		id="<?php echo $widget->get_field_id( 'sub_text' ); ?>"
		name="<?php echo $widget->get_field_name( 'sub_text' ); ?>" type="checkbox" >
		
	<small>(display link titles as sub-text)</small>
	</p>
</div>