$(document).ready(function() { 
	$('#menuadmin').addClass('active');
	$('#menuadmin_dtprovinsi').addClass('active');
});


function load_dtprovinsi(e){
	var btn = $('#'+e);
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"matakuliah/load_provinsidt",
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			$('#provinsi_dt').html(msg);
		},
		complete: function() {btn.button('reset')}	
	})
}

function load_fmprovinsi(kd,e){
	var btn = $('#'+e);
	$.ajax({
		type: "POST",cache: false, data: 'id=' + kd,
		url: url+con+"matakuliah/load_provinsifm",
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			$('#provinsi_fm').html(msg);
		},
		complete: function() {btn.button('reset')}
	})
}

function ajaxcrud_provinsi(fn,e){
	var btn = $("#"+e);
	var data = $('#provinsifm').serialize();
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"matakuliah/"+fn,
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			var buffer = msg.split("|");
			showAlert(buffer[2],buffer[0],buffer[1],'tl');
			if(buffer[1]=='i'){
				load_dtprovinsi();
				load_fmprovinsi();
			}
		},
		complete: function() {btn.button('reset')}
  	});
}

/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/