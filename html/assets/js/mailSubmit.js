$(function() {
	var form = $('#contact-form');
	var formMessages = $('#form-messages');
	$(formMessages).css('display','none');

	$(form).submit(function(e) {
		e.preventDefault();

		var formData = $(form).serialize();

		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData
		})
		.done(function(response) {
			$(formMessages).fadeIn('fast');
			$(formMessages).removeClass('alert-danger');
			$(formMessages).addClass('alert-info');

			$(formMessages).text(response);

			$('#name').val('');
			$('#phone').val('');
			$('#email').val('');
			$('#subject').val('');
			$('#message').val('');
		})
		.fail(function(data) {
			$(formMessages).fadeIn('fast');
			$(formMessages).removeClass('alert-info');
			$(formMessages).addClass('alert-danger');

			if (data.responseText !== '') {
				$(formMessages).text(data.responseText);
			} else {
				$(formMessages).text('An error occured and your message could not be sent.');
			}
		});

	});

});
