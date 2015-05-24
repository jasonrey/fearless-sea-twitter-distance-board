$(function() {
	var $body = $('body');
		$structure = $('.structure'),
		$list = $('.list');

	$body.on('click', '.more', function() {
		var button = $(this),
			start = $('.list .item').length;

		button.addClass('loading');

		$.ajax('api/load.php', {
			data: {
				start: start,
				limit: 20
			},
			dataType: 'json',
			method: 'post'
		}).done(function(response) {
			var structure = $structure.val(),
				matches = structure.match(new RegExp(/\{(.*?)\}/g));

			if (response.data.length == 0) {
				button.remove();
			}

			$.each(response.data, function(i, data) {
				var item = structure;

				$.each(matches, function(i, m) {
					item = item.replace(m, data[m.slice(1, -1)]);
				});

				$list.append(item);
			});

			button.removeClass('loading');
		});
	});

	$('.more').trigger('click');
});