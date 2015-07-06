<!-- --------------------------------------------------------------------------  EXTRA HEADER TEXT -->
<hr /><h4>Extra Injected Text</h4>
<div class="widget-content">
    <p>
    
       <label for="<?php echo $widget->get_field_id( 'extra_header_text' ); ?>"><?php _e( 'Header Text', 'toebox-basic' ); ?>:</label>
    
        <textarea class="widefat wp-editor-area"
    		id="<?php echo $widget->get_field_id( 'extra_header_text' ); ?>"
    		name="<?php echo $widget->get_field_name( 'extra_header_text' ); ?>" 
    		rows="8" cols="20" ><?php echo esc_textarea( $extra_header_text ); ?></textarea>
    
    	<small>(you can use shortcodes)</small>
    	
    	<p>
        	<input id="<?php echo $widget->get_field_id( 'extra_header_text_strip_p' ); ?>"
        		name="<?php echo $widget->get_field_name( 'extra_header_text_strip_p' ); ?>" 
        		<?php checked($extra_header_text_strip_p, 'on'); ?> type="checkbox">&nbsp;
        		<label for="<?php echo $widget->get_field_id( 'extra_header_text_strip_p' ); ?>">Strip all paragraphs</label>
    	</p>
    	
    </p>
</div>

<!-- --------------------------------------------------------------------------  EXTRA TEXT -->
<div class="widget-content">
    <p>
    
        <label for="<?php echo $widget->get_field_id( 'extra_text' ); ?>"><?php _e( 'Extra Text', 'toebox-basic' ); ?>:</label>
    
        <textarea class="widefat wp-editor-area"
    		id="<?php echo $widget->get_field_id( 'extra_text' ); ?>"
    		name="<?php echo $widget->get_field_name( 'extra_text' ); ?>" 
    		rows="8" cols="20" ><?php echo esc_textarea( $extra_text ); ?></textarea>
    
    	<small>(you can use shortcodes)</small>
    	
    	<p>
        	<input id="<?php echo $widget->get_field_id( 'extra_text_strip_p' ); ?>"
        		name="<?php echo $widget->get_field_name( 'extra_text_strip_p' ); ?>" 
        		<?php checked($extra_text_strip_p, 'on'); ?> type="checkbox">&nbsp;
        		<label for="<?php echo $widget->get_field_id( 'extra_text_strip_p' ); ?>">Strip all paragraphs</label>
        </p>
        
    </p>

</div>