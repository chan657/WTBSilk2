/* [ ---- Ebro Admin - notifications ---- ] */

	$(function() {
		//* bootbox.js
		ebro_bootbox.init();
		//* stickyNote
		ebro_sticky.init();
	});
	
	//* bootbox.js
	ebro_bootbox = {
		init: function() {
			$('.bootbox_alert').click(function(e) {
				e.preventDefault();
				bootbox.alert("Hello world!", function() {
					//* callback
				});
			});
			$('.bootbox_confirm').click(function(e) {
				e.preventDefault();
				bootbox.confirm("Are you sure?", function(result) {
					bootbox.alert("Confirm result: "+result);
				}); 
			});
			$('.bootbox_prompt').click(function(e) {
				e.preventDefault();
				bootbox.prompt("What is your name?", function(result) {
					if (result !== null) {
						bootbox.alert('Hi <strong>'+result+'</strong>');
					}
				});
			});
			$('.bootbox_custom').click(function(e) {
				e.preventDefault();
				bootbox.dialog({
					message: "I am a custom dialog",
					title: "Custom title",
					buttons: {
						success: {
							label: "Success!",
							className: "btn-success",
							callback: function() {
							}
						},
						danger: {
							label: "Danger!",
							className: "btn-danger",
							callback: function() {
							}
						},
						main: {
							label: "Click ME!",
							className: "btn-primary",
							callback: function() {
							}
						}
					}
				});
			});
			$('.city_bootbox_custom').click(function(e) {
				var city = $('#LeadCityId').val();
				if(city == ''){
					e.preventDefault();
					bootbox.dialog({
						message: "Please select city",
						title: "Message",
						buttons: {
							success: {
								label: "Got It!",
								className: "btn-success",
								callback: function() {
								}
							},
							
							main: {
								label: "More Info!",
								className: "btn-primary",
								callback: function() {
									bootbox.alert('Information-<strong>Goes here..</strong>');
								}
							}
						}
					
					});
				}
					
			});
	
			
			$('.pre_bootbox_custom').click(function(e) {
				var id = $(this).parent().prev('div').find('select').attr('id');	
				var pref = $('#'+id).val();
			
				if(pref == '' || pref == null){
					e.preventDefault();
					bootbox.dialog({
						message: "Please select preference",
						title: "Message",
						buttons: {
							success: {
								label: "Got It!",
								className: "btn-success",
								callback: function() {
								}
							},
							
							main: {
								label: "More Info!",
								className: "btn-primary",
								callback: function() {
									bootbox.alert('Information-<strong>Goes here..</strong>');
								}
							}
						}
					
					});
				}
					
			});
			
			$('.user_role_bootbox_custom').click(function(e) {
				var id = $(this).parent().prev('div').find('select').attr('id');
				
				
				var pref = $('#'+id).val();
			
				if(pref == '' || pref == null){
					e.preventDefault();
					bootbox.dialog({
						message: "Please select channel manager",
						title: "Message",
						buttons: {
							success: {
								label: "Got It!",
								className: "btn-success",
								callback: function() {
								}
							},
							
							main: {
								label: "More Info!",
								className: "btn-primary",
								callback: function() {
									bootbox.alert('Information-<strong>Goes here..</strong>');
								}
							}
						}
					
					});
				}
					
			});
			
			$('#LeadLeadCreationType').click(function(e) {
				if($('#LeadCityId').val() == ''){
						e.preventDefault();
						bootbox.dialog({
						message: "Please select city!",
						title: "Message",
						buttons: {
							success: {
								label: "OK",
								className: "btn-success",
								callback: function() {
								}
							},
						}
					
					});
						
						$('#phone_officer_id').val('');
				}
				else if($('#LeadLeadCreationType').val() == '4'){
				$('#phone_officer_id').css('display','none');
				$('#phone_div_id').css('display','block');
				$('#phonemng_div_id').css('display','block');
				$('#lead_phone_managment').css('display','none');
				$('#associate_div_id').css('display','none');
				$('#LeadLeadAssociate').css('display','block');
				
				
				
			}
			else if($('#LeadLeadCreationType').val() == '1'){
				$('#phone_officer_id').css('display','block');
				$('#phone_div_id').css('display','none');
				$('#phonemng_div_id').css('display','none');
				$('#lead_phone_managment').css('display','block');
				$('#associate_div_id').css('display','block');
				$('#LeadLeadAssociate').css('display','none');
				
			}
				
			});
			
			$('#phone_officer_id').click(function(e) {
				var creation_type = $('#LeadLeadCreationType').val();
				if(creation_type == ''){
					e.preventDefault();
					bootbox.dialog({
						message: "Please select creation type!",
						title: "Message",
						buttons: {
							success: {
								label: "OK",
								className: "btn-success",
								callback: function() {
								}
							},
						}
					
					});
					
				}
		
				
			});
			
			$('#LeadLeadAssociate').click(function(e) {
				var creation_type = $('#LeadLeadCreationType').val();
				if(creation_type == ''){
					e.preventDefault();
					bootbox.dialog({
						message: "Please select creation type!",
						title: "Message",
						buttons: {
							success: {
								label: "OK",
								className: "btn-success",
								callback: function() {
								}
							},
						}
					
					});
					
				}
		
				
			});
			
			
			
			
		}
	}
	
	//* sticky
	ebro_sticky = {
		init: function() {
			$(function(){
                var defaults = {
                    position: 'top-right', // top-left, top-right, bottom-left, or bottom-right
                    speed: 'fast', // animations: fast, slow, or integer
                    allowdupes: false, // true or false
                    autoclose: 0,  // delay in milliseconds. Set to 0 to remain open.
                    classList: '' // arbitrary list of classes. Suggestions: success, warning, important, or info. Defaults to ''.
                };

                function callback(r) {
                    console.log(JSON.stringify(r));
                }

                $('.sticky_plaintext').click(function(){
                    $.stickyNote('Plain text note.', defaults, callback);
                });
                $('.sticky_withhtml').click(function(){
                    $.stickyNote('<strong>HTML note</strong>. Lorem ispusm...', defaults)
                });
                $('.sticky_callback').click(function(){
                    $.stickyNote('Sticky note callback. Lorem ipsum...', defaults, function(){
                        alert("Callback. Lorem ipsum...");
                    });
                });
				$('.sticky_timeout').click(function(){
                    $.stickyNote('This notification will close after 5000ms.', $.extend({}, defaults, {autoclose: 5000}), callback)
                });
                $('.sticky_top_center').click(function(){
                    $.stickyNote('Top center notification.', $.extend({}, defaults, {position: 'top-center'}))
                });
                $('.sticky_bottom_center').click(function(){
                    $.stickyNote('Bottom center notification.', $.extend({}, defaults, {position: 'bottom-center'}))
                });
				$('.sticky_top_right').click(function(){
                    $.stickyNote('Top right notification.', $.extend({}, defaults, {position: 'top-right'}))
                });
				$('.sticky_bottom_right').click(function(){
                    $.stickyNote('Bottom right notification.', $.extend({}, defaults, {position: 'bottom-right'}))
                });
                $('.sticky_success').click(function(){
                    $.stickyNote('Success notification. Lorem...', $.extend({}, defaults, {classList: 'stickyNote-success'}), callback)
                });
                $('.sticky_info').click(function(){
                    $.stickyNote('Info notification. Lorem ipsum dolor...', $.extend({}, defaults, {classList: 'stickyNote-info'}), callback);
                });
				$('.sticky_warning').click(function(){
                    $.stickyNote('Warning notification. Lorem ipsum...', $.extend({}, defaults, {classList: 'stickyNote-warning'}), callback)
                });
                $('.sticky_important').click(function(){
                    $.stickyNote('Important notification. Lorem...', $.extend({}, defaults, {classList: 'stickyNote-important'}), callback);
                });
            });
		}
	}