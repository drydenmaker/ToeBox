<?php
//require_once  \toebox\plugin\inc\PluginController::$IncPath . '/core/StringTransform.php';
include dirname(__FILE__) . '/menu_widget_form.php';
include dirname(__FILE__) . '/sub_text.php';
include dirname(__FILE__) . '/small_show_hide.php';
include dirname(__FILE__) . '/extra_text.php';

?>	


<!-- --------------------------------------------------------------------------  LOGO -->
<p>
<div style="border:thin solid Silver; padding: 4px; margine: 4px;">

	<label for="<?php echo $widget->get_field_id( 'background' ); ?>"><?php _e( 'Background URL', 'toebox-basic' ); ?>:</label>
	<div id="logo_preview" class="preview_placholder">
<?php 
	if (isset($background) && $background) echo '<img src="' . $background . '" style="max-width: 100%;">';
?>				
	</div>
	<input class="widefat"
		id="<?php echo $widget->get_field_id( 'background' ); ?>"
		name="<?php echo $widget->get_field_name( 'background' ); ?>" type="text"
		value="<?php echo esc_attr( $background ); ?>">
	<button id="logo_button" class="button"
    	onclick="image_button_click('Choose Background Image','Select Image','image','logo_preview','<?php echo $widget->get_field_id( 'background' );  ?>');">
    	Select Image</button>
	
</div>
</p>