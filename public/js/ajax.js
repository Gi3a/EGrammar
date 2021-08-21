

$(document).ready(function() {
	$('form').submit(function(event) {
		var json;
		$(".load").show();
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				json = jQuery.parseJSON(result);
				if(json.status && json.url){
					$(".load").show();
					Toast.fire({
						icon: json.status,
						title: json.title,
						text: json.message,
					}).then(function() {
						location.href = '/' + json.url;;
					});
				} else if (json.url) {
					window.location.href = '/' + json.url;
				}
				else if (json.html)
				{
					$(".load").show();
					Toast.fire({
						icon: json.status,
						title: json.title,
						text: json.html,
					}).then(function() {
						$(".load").hide();
					});
				}
				else {
					$(".load").show();
					Toast.fire({
						icon: json.status,
						title: json.title,
						text: json.message,
					}).then(function() {
						$(".load").hide();
					});
				}
			},
		});
	});
});