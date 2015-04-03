
<p>
<div style="border:thin solid Silver; padding: 4px; margine: 4px;">

	<label for="<?php echo $widget->get_field_id( 'logo' ); ?>"><?php _e( 'Logo URL', 'toebox-basic' ); ?>:</label>
	<div id="logo_preview" class="preview_placholder">
<?php 
	if ($logo!='') echo '<img src="' . $logo . '" style="max-width: 100%;">';
?>				
	</div>
	<input class="widefat"
		id="<?php echo $widget->get_field_id( 'logo' ); ?>"
		name="<?php echo $widget->get_field_name( 'logo' ); ?>" type="text"
		value="<?php echo esc_attr( $logo ); ?>">
	<button id="logo_button" class="button"
    	onclick="image_button_click('Choose Background Image','Select Image','image','logo_preview','<?php echo $widget->get_field_id( 'logo' );  ?>');">
    	Select Image</button>
    	
    <hr/>
    <label for="<?php echo $widget->get_field_id( 'logo_style' ); ?>"><?php _e( 'Logo Style', 'toebox-basic' ); ?>:</label>
    <input class="widefat"
		id="<?php echo $widget->get_field_id( 'logo_style' ); ?>"
		name="<?php echo $widget->get_field_name( 'logo_style' ); ?>" type="text"
		value="<?php echo esc_attr( $logo_style ); ?>">
	<small>(In-line css styles)</small>
	
</div>
</p>
<p>
<div style="border:thin solid Silver; padding: 4px; margine: 4px;">
	<label for="<?php echo $widget->get_field_id( 'background' ); ?>"><?php _e( 'Background URL', 'toebox-basic' ); ?>:</label>
	<div id="background_preview" class="preview_placholder">
<?php 
	if ($background !='') echo '<img src="' . $background . '" style="width: 100%;">';
?>				
	</div>
	<input class="widefat"
		id="<?php echo $widget->get_field_id( 'background' ); ?>"
		name="<?php echo $widget->get_field_name( 'background' ); ?>" type="text"
		value="<?php echo esc_attr( $background ); ?>">
    <button id="background_button" class="button"
    	onclick="image_button_click('Choose Background Image','Select Image','image','background_preview','<?php echo $widget->get_field_id( 'background' );  ?>');">
    	Select Image</button>
    
    <hr/>
    <label for="<?php echo $widget->get_field_id( 'background_style' ); ?>"><?php _e( 'Background Style', 'toebox-basic' ); ?>:</label>
    <input class="widefat"
		id="<?php echo $widget->get_field_id( 'background_style' ); ?>"
		name="<?php echo $widget->get_field_name( 'background_style' ); ?>" type="text"
		value="<?php echo esc_attr( $background_style ); ?>">
	<small>(Extra background styles)</small>
    
</div>
</p>

<p>
<div style="border:thin solid Silver; padding: 4px; margine: 4px;">

    <label for="<?php echo $widget->get_field_id( 'container_class' ); ?>"><?php _e( 'Container Class', 'toebox-basic' ); ?>:</label>
    <input class="widefat"
		id="<?php echo $widget->get_field_id( 'container_class' ); ?>"
		name="<?php echo $widget->get_field_name( 'container_class' ); ?>" type="text"
		value="<?php echo esc_attr( $container_class ); ?>">
	<small>(Css class set on title container)</small>
	
	
	<label for="<?php echo $widget->get_field_id( 'title_class' ); ?>"><?php _e( 'Title Class', 'toebox-basic' ); ?>:</label>
    <input class="widefat"
		id="<?php echo $widget->get_field_id( 'title_class' ); ?>"
		name="<?php echo $widget->get_field_name( 'title_class' ); ?>" type="text"
		value="<?php echo esc_attr( $title_class ); ?>">
	<small>(Css class set on title container)</small>
	
	
	<label for="<?php echo $widget->get_field_id( 'description_class' ); ?>"><?php _e( 'Description Class', 'toebox-basic' ); ?>:</label>
    <input class="widefat"
		id="<?php echo $widget->get_field_id( 'description_class' ); ?>"
		name="<?php echo $widget->get_field_name( 'description_class' ); ?>" type="text"
		value="<?php echo esc_attr( $description_class ); ?>">
	<small>(Css class set on description container)</small>
	
</div>
</p>
