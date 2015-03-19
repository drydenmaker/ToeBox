<select name='<?php print $name ?>'>
<?php foreach ($options as $option => $label ) :?>
        <option value='<?php print $option; ?>' <?php selected($value, $option, true); ?>><?php print $label; ?></option>
<?php endforeach;?>
</select>