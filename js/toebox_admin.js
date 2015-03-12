var custom_uploader;

function image_button_click(dialog_title, button_text, library_type,
		preview_id, control_id) {

	event.preventDefault();

	// If the uploader object has already been created, reopen the dialog
	// if (custom_uploader) {
	// custom_uploader.open();
	// return;
	// }

	// Extend the wp.media object
	custom_uploader = wp.media.frames.file_frame = wp.media({
		title : dialog_title,
		button : {
			text : button_text
		},
		library : {
			type : library_type
		},
		multiple : false
	});

	// When a file is selected, grab the URL and set it as the text field's
	// value
	custom_uploader.on('select', function() {

		attachment = custom_uploader.state().get('selection').first().toJSON();
		jQuery('#' + control_id).val(attachment.url);

		var html = '';

		if (library_type == 'image') {
			html = '<img src="' + attachment.url + '">';
		}

		if (library_type == 'video') {
			html = '<video autoplay loop><source src="' + attachment.url
					+ '" type="video/' + get_extension(attachment.url)
					+ '" /></video>';
		}

		jQuery('#' + preview_id).empty();
		jQuery('#' + preview_id).append(html);
	});

	// Open the uploader dialog
	custom_uploader.open();

}

function get_extension(url) {

	return url.substr((url.lastIndexOf('.') + 1));

}