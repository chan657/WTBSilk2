/* [ ---- Ebro Admin - user profile ---- ] */

    $(function() {
		//* edit form
		$('a.edit_form').click(function(e){
		$('#mycl-det').addClass("view");
		});
		$('a.view_form').click(function(e){
			$('#mycl-det').removeClass("view");
		});
		
		$('.edit_form').click(function(e) {
			e.preventDefault();
			$('.user_form .editable p').hide();
			$('.user_form .editable div').hide();
			$('.edit_form').hide();
			$('.view_form').show();
			$('.user_form .editable .hidden_control,.user_form .form_submit').show();
		});
		$('.view_form').click(function(e) {
			e.preventDefault();
			$('.user_form .editable p').show();
			$('.user_form .editable div').show();
			$('.edit_form').show();
			$('.view_form').hide();
			$('.user_form .editable .hidden_control,.user_form .form_submit').hide();
		});
		
		//* delete user
		$('.remove_user').click(function(e) {
			e.preventDefault();
			bootbox.dialog({
				message: '<div class="text-center lead">Are you sure?</div>',
				title: 'Deleting user John Smith',
				buttons: {
					cancel: {
						label: "Cancel",
						className: "btn-link",
						callback: function() {
						}
					},
					confirm: {
						label: "Delete",
						className: "btn-primary",
						callback: function() {
							alert('User deleted!')
						}
					}
				}
			});
		})
		
	})