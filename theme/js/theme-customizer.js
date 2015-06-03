/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {
	
	// EXAMPLE
//	wp.customize( 'YOUR_SETTING_ID', function( value ) {
//		value.bind( function( newval ) {
//			//Do stuff (newval variable contains your "new" setting data)
//		} );
//	} );
	// Update the site title in real time...
//	wp.customize( 'blogname', function( value ) {
//		value.bind( function( newval ) {
//			$( '#site-title a' ).html( newval );
//		} );
//	} );
	
	wp.customize( 'toebox_use_less', function( value ) {
		
		value.bind( function( newval ) {

			ToggleCustomColorEditor(newval);
	 
		});
		
	});
	// set the initial state of the color boxes
	ToggleCustomColorEditor($('#customize-control-toebox_use_less>label>[type="checkbox"]', window.parent.document).attr('checked'));
	
	
} )( jQuery );

function ToggleCustomColorEditor(checked)
{
	console.log('CHECKED ' + checked);
	
	if ( checked ) 
	{
		$( '#customize-control-toebox_less_primary', window.parent.document ).css( 'display', 'list-item' );

		$( '#customize-control-toebox_less_success', window.parent.document ).css( 'display', 'list-item' );
		$( '#customize-control-toebox_less_info', window.parent.document ).css( 'display', 'list-item' );
		$( '#customize-control-toebox_less_warning', window.parent.document ).css( 'display', 'list-item' );
		$( '#customize-control-toebox_less_danger', window.parent.document ).css( 'display', 'list-item' );
	} 
	else 
	{
		$( '#customize-control-toebox_less_primary', window.parent.document ).hide() // css( 'display', 'none' );
		$( '#customize-control-toebox_less_success', window.parent.document ).css( 'display', 'none' );
		$( '#customize-control-toebox_less_info', window.parent.document ).css( 'display', 'none' );
		$( '#customize-control-toebox_less_warning', window.parent.document ).css( 'display', 'none' );
		$( '#customize-control-toebox_less_danger', window.parent.document ).css( 'display', 'none' );
	}
}