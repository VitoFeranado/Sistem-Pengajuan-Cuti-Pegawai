$(document).ready(function() { 
	$('#menuadmin').addClass('active');
	$('#menuadmin_dtruangann').addClass('active');
});


function load_dtruangan(e){
	var btn = $('#'+e);
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"ruangan/load_ruangandt",
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			$('#provinsi_dt').html(msg);
		},
		complete: function() {btn.button('reset')}	
	})
}

function load_fmruangan(kd,e){
	var btn = $('#'+e);
	$.ajax({
		type: "POST",cache: false, data: 'id=' + kd,
		url: url+con+"ruangan/load_provinsifm",
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
		url: url+con+"ruangan/"+fn,
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			var buffer = msg.split("|");
			showAlert(buffer[2],buffer[0],buffer[1],'tl');
			if(buffer[1]=='i'){
				load_dtruangan();
				load_fmruangan();
			}
		},
		complete: function() {btn.button('reset')}
  	});
}

/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/