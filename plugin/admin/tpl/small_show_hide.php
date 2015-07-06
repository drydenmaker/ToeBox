<div class="widget-content">
    <hr /><h4>Small Screens</h4>
	<p>
    <label for="<?php echo $widget->get_field_id( 'hide_on_small' ); ?>"><?php _e( 'Hide On Small', 'toebox-basic' ); ?>:</label>
    <input class="widefat"
		id="<?php echo $widget->get_field_id( 'hide_on_small' ); ?>"
		name="<?php echo $widget->get_field_name( 'hide_on_small' ); ?>" type="text"
		value="<?php echo esc_attr( $hide_on_small ); ?>">
	<small>(comma seperated list of menu slugs)</small>
	</p>
	
	<p>
    <label for="<?php echo $widget->get_field_id( 'show_only_on_small' ); ?>"><?php _e( 'Show only on Small', 'toebox-basic' ); ?>:</label>
    <input class="widefat"
		id="<?php echo $widget->get_field_id( 'show_only_on_small' ); ?>"
		name="<?php echo $widget->get_field_name( 'show_only_on_small' ); ?>" type="text"
		value="<?php echo esc_attr( $show_only_on_small ); ?>">
	<small>(comma seperated list of menu slugs)</small>
	</p>
	
	<p>
    <label for="<?php echo $widget->get_field_id( 'open_on_small' ); ?>"><?php _e( 'Open on Small', 'toebox-basic' ); ?>:</label>
    <input class="widefat"
		id="<?php echo $widget->get_field_id( 'open_on_small' ); ?>"
		name="<?php echo $widget->get_field_name( 'open_on_small' ); ?>" type="text"
		value="<?php echo esc_attr( $open_on_small ); ?>">
	<small>(comma seperated list of menu slugs)</small>
	</p>
</div>