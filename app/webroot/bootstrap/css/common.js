/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {

    var FULL_BASE_URL = $('#hidden_site_baseurl').val(); // For base path of value;
    var SITE_PUBLIC_URL = $('#hidden_site_public_url').val();// exp- http://lserver/project/cramdude/web/
	
	$('.open-popup-link').magnificPopup({type:'iframe',
   		iframe: {
       				markup: '<div class="mfp-iframe-scaler your-special-css-class">'+
                        '<div class="mfp-close"></div>'+
                        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                    '</div>'
   		},callbacks: {
				open: function() {
				  var $obj=$(".mfp-iframe-scaler").find("iframe");
				  $obj.bind("load",function(){
        				var paddTop=$(this).contents().find(".pop-outer").height();
						$(".your-special-css-class").css({"padding-top":paddTop});
    			  });
				  
				},
				close: function() {
				 
				}
  		}  
    });
	
	$(".collapse").css({"display":"block"});
	$("#toggle_search_panel").click(function(){
		var CurrentClass = $(this).attr('class');
		$(this).removeClass(CurrentClass);
		if(CurrentClass == 'icon-plus')
		 	$(this).addClass("icon-minus");
		else
			$(this).addClass("icon-plus");
		  
		  $("#search_panel_controls").toggle();
		});
	
	
	/*****************Sibebar************************/
	
	$('#wrapper_all').addClass("mini-sidebar");
	$('li.nav-toggle > button').click(function(e){
		$('.fa-angle-double-left').toggleClass("open");
	});
	
	$('li.nav-toggle > button').click(function(e){
    e.preventDefault();
    $('.hidden-minibar').toggleClass("hide");
    $('#wrapper_all').toggleClass("mini-sidebar");
    if($('#wrapper_all').hasClass('mini-sidebar'))
    {    
      $('#icon_nav_v li a').tooltip({
        });
        $('li.submenu ul').tooltip('destroy');
     }
     else
     {
      $('#icon_nav_v li a').tooltip('destroy');
     } 
  });
	
	/*************************End sidebar************/
       
    /**
     * Ajax call to role permission active mode from database.
     * 
     */
    /**
     * listing project by city_id in project details page. 
     */
    
     $('#city_id').change(function(){
        var city_id = $(this).val();
        var model = $('#model_name').val();
        var dataString = 'city_id=' + city_id + '&model=' + model;
        $('#ProjectId').attr('disabled', 'disabled');
         $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/get_project',
             beforeSend: function() {
                 $('#ProjectId').attr('disabled', 'disabled');
                //return false;
            },
            success: function(return_data) {
               $('#ProjectId').removeAttr('disabled');
              $('#project').html(return_data);
            }
        });  
        
    });
     

     
var pointer = function(){
        var id = $(this).attr('id');
         var dataString = 'id=' + id ;
         $('#ajax_permission').css("display", "block");
          $('#'+id).css("display", "block");
          
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/permission_sets/set_perm',
            success: function(return_data) {
                $('#'+id).css("display", "none");
                $('#ajax_permission').css("display", "none");
                $('#ajax'+id).html(return_data);
			$('.pointer,.del_perm').unbind('click');
		    $('.pointer').bind('click',pointer);
		    $('.del_perm').bind('click',del_perm);
            }
        });      
    }
   var del_perm = function(){
        var id = $(this).attr('id');
        var permission_id = $(this).attr('name');
         var dataString = 'id=' + id + '&permission_id='+permission_id ;
         $('#ajax_permission').css("display", "block");
          $('#'+id).css("display", "block");
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/permission_sets/del_perm',
            success: function(return_data) {
                $('#'+id).css("display", "none");
                $('#ajax_permission').css("display", "none");
                $('#ajax'+id).html(return_data);
			$('.pointer,.del_perm').unbind('click');
		    $('.pointer').bind('click',pointer);
		    $('.del_perm').bind('click',del_perm);
			 
            }
        });      
    }
    $('.pointer').bind('click',pointer);
    $('.del_perm').bind('click',del_perm);
    
     /**
     * Ajax call to role permission deactive mode from database.
     * 
     */
	
    
   
    
    $('.row_color').click(function(){
        
       // $('.row_color').parents('<tr>').css( "background", "yellow" );
       $('.row_color').parent().parent().parent().css( "background", "yellow" );
       
        
//        /alert('aa');
        
    })
	$(window).resize(function(){
				var $obj=$(".mfp-iframe-scaler").find("iframe");
				var paddTop= $obj.contents().find(".pop-outer").height();
				$(".your-special-css-class").css({"padding-top":paddTop});
	});
    $(".collapse").css({"display":"none"});
});

function row_color(color){
    //alert($(this).parents().find('table_1').parent().parent().attr('id'));//parent().addClass( "row-color" );
    $('#table_1 tr').removeClass('row-color');
    $('#row_'+color).addClass( "row-color" );
   
    //$('#row_'+color).removeClass("current");
    
    
}









