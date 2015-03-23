<input id="<?php print $id ?>" type="text" name="<?php print  $name; ?>" value="<?php print $value; ?>" class="tb-color-picker" >
<script>
(function( $ ) {
    $(function() {
         
        // Add Color Picker to all inputs that have 'color-field' class
        $( '#<?php print $id ?>' ).wpColorPicker();
         
    });
})( jQuery );
</script>