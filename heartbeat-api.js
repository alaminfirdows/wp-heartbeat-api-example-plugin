(function ($) {
	// hook into heartbeat-send: client logs data to console
	$(document).on('heartbeat-send', function (e, data) {
		data = data ?? {};
		data.message = $('#my-input').val();

		$('#my-input').val('');
	});

	// hook into heartbeat-tick: client logs server response to console
	$(document).on('heartbeat-tick', function (e, data) {
		if (data.status === 'success' && data.message) {
			console.log('Response from server: ', data);
		}
	});

	// hook into heartbeat-error: client logs error to console
	$(document).on('heartbeat-error', function (e, jqXHR, textStatus, error) {
		console.log('Error: ', jqXHR, textStatus, error);
	});

	wp.heartbeat.interval('fast');
})(jQuery);
