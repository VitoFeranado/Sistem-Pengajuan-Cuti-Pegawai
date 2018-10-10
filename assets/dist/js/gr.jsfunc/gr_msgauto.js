$(document).ready(function() { 	
	$('#side_konfig').addClass('active');
	$('#side_konfig_gateway').addClass('active');
	$('#side_konfig_gateway_msgauto').addClass('active');
});

function config_autonew(){
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
}

function get_autonew_val(){
	var val = [];
	$("[name^='msgauto_dbautonew']").each(function(i){
	  val[i] = $(this).prop("checked");
	});
	$("#hdn_autonew").val(val);
	$("#btn_autonew").prop('disabled', false).removeClass('btn-default').addClass('btn-danger').show();
}
/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/