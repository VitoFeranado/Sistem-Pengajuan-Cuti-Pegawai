$(document).ready(function() { 
    var options = { 
        //target:        '#output',
		//resetForm: true,
        beforeSubmit:  showRequest,
        success:       showResponse
    }; 
 
    $('#cmbsii_loginform').submit(function() { 
        $(this).ajaxSubmit(options); 
        return false; 
    }); 
	
	$("#txt_username").focusout(function(event){
		var data = {
			us : $(this).val()						
		};
		$.ajax({
			type: "POST",
			url: url+"log/cek_username",
			data: data,
			cache: false,
			success: function(msg){	
				if(msg){
					$(".profile-img").attr("src", msg);
				}
			}
		});	
	});	
}); 
 
function showRequest(formData, jqForm, options) {
    //var queryString = $.param(formData);
	//showAlert(queryString,'info!','w','tl',url);
    return true; 
} 

function showResponse(responseText, statusText, xhr, $form)  {
	var buffer = responseText.split("|");
	if(buffer[2]=='i'){
		$(location).attr('href',url); 
	}else {
		showAlert(buffer[1],buffer[0],buffer[2],'tl',url,3);
	}
} 