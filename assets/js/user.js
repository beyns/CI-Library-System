$(document).ready(() => {
	var base_url = window.location.origin;

	$("#btn-create").click(() => {
		$.post(
			base_url + "/index.php/auth/register/create_user",
			$(".auth-form").serialize()
		)
			.done(result => {
				$(".auth-form")[0].reset();
				console.log(result);
			})
			.fail(result => {
				$(".page-message").html(
					'<span class="mr-5">' +
						result.responseJSON.message +
						"</span>" +
						'<a href="user-notification-settings.html" ' +
						'class="btn btn-sm btn-warning circle mr-1">' +
						'Notifications settings</a> <a href="#" class="btn btn-sm btn-icon btn-warning"' +
						'aria-label="Close" onclick="$(this).parent().fadeOut()">' +
						'<span aria-hidden="true"><i class="fa fa-times"></i></span></a>'
				);
			});
	});

	$("#btn-login").click(() => {
		$.post(base_url + "/auth/login/login", $(".frm-login").serialize()).done(
			result => {
				// console.log(result);
			}
		);
	});
});
