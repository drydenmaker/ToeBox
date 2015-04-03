<?php
namespace toebox\plugins\inc;

/**
 *
 * @author alton.crossley
 *        
 */
class AdminForm
{
    /*
     * 
     * TOEBOX_LIST_LAYOUT => array(
                            'label' => __( 'Post List Layout', 'toebox-basic' ),
                            'section' => 'toebox_content_layout_section',
                            'type' => 'select',
                            'choices' => array(
                                'list_text_only' => __( 'Text Only','toebox-basic' ),
                                'list_large_img' => __( 'Large Image Content','toebox-basic' ),
                                'list_short_img' => __( 'Short Image Content','toebox-basic' ),
                                'list_thumb_left' => __( 'Thumbnail Left','toebox-basic' ),
                                'list_thumb_right' => __( 'Thumbnail Right','toebox-basic' ),
                                'list_thumb_grid' => __( 'Thumbnail Grid','toebox-basic' )
                            )
     * 
     */
     
    protected $settings = array();
    public function AddSelect($settingKey, $label, $sectionKey, array $choices, $defaultValue, $sanitizeCallBack = 'sanitize_text_field')
    {
        $this->getSection($sectionKey)[$settingKey] = array(
                'type' => 'select'
                'label' => $label,
                'section' => $sectionKey,
                'chooices' => $choices,   
                'default' => $defaultValue,
            );
    }
    
    public function AddCtrl($key, array $x)
    {
        /**
         * TOEBOX_PAGE_LAYOUT
         */
//         $wp_customize->add_setting(
//                         TOEBOX_PAGE_LAYOUT,
//                         array(
//                             'default' => toebox\inc\ToeBox::$Settings[TOEBOX_PAGE_LAYOUT],
//                             'sanitize_callback' => 'sanitize_text_field'
//                         )
//         );
        
//         $wp_customize->add_control(
//                         TOEBOX_PAGE_LAYOUT,
//                         $SettingsControls[TOEBOX_PAGE_LAYOUT]
//         );
    }
    protected $defaultSetting = array(
        'type' => 'text',
        'sanitize_callback' => 'sanitize_text_field',
        'label' => '',
        
    );
    public function AddSetting($section, $setting, array $configuration)
    {
        if (array_key_exists('type', $configuration)&&
                        array_key_exists('sanitize_callback', $configuration))
        {
            $this->getSection($section)[$setting] = $configuration;
        }
        
        throw new \Exception("$section $setting configuration must be complete with a type and sanitize_callback");
    }
    protected function getSection($sectionKey)
    {
        if (!array_key_exists($sectionKey, $this->settings) || empty($this->settings[$sectionKey]))
        {
            $this->settings[$sectionKey] = array('settings' => array());
        }
        
        return $this->settings[$sectionKey];
    }

    public static function FormatSelect($options, $name, $value)
    {

        $output = "<select name='{$name}'>";
        foreach ($options as $option => $label )
        {
            $output .=  "<option value='{$option}' " . selected($value, $option, true) . ">{$label}</option>";
        }
        $output .= '</select>'
        
        return $output;
    }
    
    public static function FormatCheckbox($checkedValue, $name, $value)
    {
        $output = "<input type='checkbox' name='{$name}' ".checked($value, $checkedValue)." value='1'>";
        return $output;
    }
    
    public static function FormatColorPicker($name, $value)
    {
        $id = str_replace(']', '', str_replace('[', '', $name));
        
        $output = "<input id='{$id}' type="text" name='{$name}' value='{$value}' class='tb-color-picker' >
            <script>
            (function( $ ) {
                $(function() { $( '#{$id}' ).wpColorPicker(); });
            })( jQuery );
            </script>";
        
        return $output;
    }
}

?>