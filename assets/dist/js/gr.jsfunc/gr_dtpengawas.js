$(document).ready(function() { 
	$('#side_dtcombase').addClass('active');
	$('#side_dtcombase_dtpengawas').addClass('active');
});


function load_dtcomdtpengawas(){
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"combase/load_dsndt",
		beforeSend: function() {$('#xloading').fadeIn()},
		success: function(msg){
			$('#comdtpengawas_dt').html(msg);
		},
		complete: function() {$('#xloading').fadeOut()}	
	})
}

function load_fmcomdtpengawas(id){
	var data = {id : id};
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"combase/load_dsnview",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			$('#comdtpengawas_fm').html(msg);
		},
		complete: function() {$('#xloading').fadeOut();}
	})
}

function compengawas_ajaxcrud(fn,btnid){
	var btn = $("#"+btnid);
	var data = $('#comdtpengawasfm').serialize();
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"pengawas/"+fn,
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			var buffer = msg.split("|");
			showAlert(buffer[2],buffer[0],buffer[1],'tl',url);
			if(buffer[1]=='i'){
				load_dtcomdtpengawas()	
			}
		},
		complete: function() {btn.button('reset')}
  	});
}

/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/