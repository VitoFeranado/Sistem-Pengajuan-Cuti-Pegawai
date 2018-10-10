$(document).ready(function() { 	
	$('#side_pesan').addClass('active');
	$('#side_pesan_chat').addClass('active');
	
	btn1 = $('#msgchat_btnsend');
	var form1options = { 
        //target:        '#combyr_dtmhs',
		resetForm: true,
        beforeSubmit:  showRequest1,
        success:       showResponse1,
		
    }; 
	$('#msgchat_form').submit(function() { 
        $(this).ajaxSubmit(form1options); 
        return false; 
    }); 
});

function showRequest1(formData, jqForm, form1options) {
	/*var queryString = $.param(formData);
    alert('About to submit: \n\n' + queryString); 
	*/
	btn1.button('loading');
    return true; 
} 

function showResponse1(responseText, statusText)  {
	var buffer = responseText.split("|");
	showAlert(buffer[2],buffer[0],buffer[1],'tl');
	btn1.button('reset');
} 

/*function config_autonew(){
	var doit = confirm('Simpan Konfigurasi?');
	if(doit){
		var btn = $('#btn_autonew');
		var data = {
			conf : $('#hdn_autonew').val()				
		};
		$.ajax({
			type: "POST",data : data,cache: false,
			url: url+con+"gateway/reconfig_msgauto",
			beforeSend: function() {btn.button('loading');},
			success: function(msg){
				var buffer = msg.split("|");
				showAlert(buffer[2],buffer[0],buffer[1],'tl');
			},
			complete: function() {btn.button('reset');btn.hide();$('#btn_autonew_reload').show();}
		});  
	}
}*/

function get_chatcek_val(){
	var val_ibx = [],btn = false;
	$("[name^='ibx_mark']").each(function(i){
	  if($(this).prop("checked")){
	  	val_ibx[i] = $(this).val();
		btn = true;
	  }
	});
	$("#ibx_allmark").val(val_ibx);
	var val_sbx = [];
	$("[name^='sbx_mark']").each(function(i){
	  if($(this).prop("checked")){
	  	val_sbx[i] = $(this).val();
		btn = true;
	  }
	});
	$("#sbx_allmark").val(val_sbx);
	if(btn)$("#btn_removeallmarked").show();else $("#btn_removeallmarked").hide();
}

function remove_chattext(){
	if(confirm('Hapus Pesan?')){	
		var i = $("[name^='ibx_mark']").serializeArray();
		var s = $("[name^='sbx_mark']").serializeArray();
		var btn = $('#btn_removeallmarked');
		var data = {
			ibx : i, sbx : s				
		};
		$.ajax({
			type: "POST",data : data,cache: false,
			url: url+con+"msg/sbxibx_delete",
			beforeSend: function() {btn.button('loading');},
			success: function(msg){
				var buffer = msg.split("|");
				showAlert(buffer[2],buffer[0],buffer[1],'tl');
				$.each( s, function( key, val ) {
				  $('#sbx'+val.value).remove();
				});
				$.each( i, function( key, val ) {
				  $('#ibx'+val.value).remove();
				});
			},
			complete: function() {btn.button('reset');btn.hide();$('#btn_autonew_reload').show();}
			,error: function(xhr, status, error) {alert(xhr.responseText)}
		}); 
	}
}

/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/