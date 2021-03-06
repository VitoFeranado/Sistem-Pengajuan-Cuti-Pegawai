$(document).ready(function() { 
	$('#kehadiran').addClass('active');
	$('#kehadiran').addClass('active');
});


function load_dtkehadiran(e){
	var btn = $('#'+e);
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"kehadiran/load_kehadirandt",
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			$('#kehadiran_dt').html(msg);
		},
		complete: function() {btn.button('reset')}	
	})
}

function load_fmkota(kd,e){
	var btn = $('#'+e);
	$.ajax({
		type: "POST",cache: false, data: 'id=' + kd,
		url: url+con+"kehadiran/load_kotafm",
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			$('#kota_fm').html(msg);
		},
		complete: function() {btn.button('reset')}
	})
}

function ajaxcrud_kota(fn,e){
	var btn = $("#"+e);
	var data = $('#jadwalfm').serialize();
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"kehadiran/"+fn,
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			var buffer = msg.split("|");
			showAlert(buffer[2],buffer[0],buffer[1],'tl');
			if(buffer[1]=='i'){
				load_dtkota();
				load_fmkota();
			}
		},
		complete: function() {btn.button('reset')},error: function(xhr, status, error) {alert(xhr.responseText)}
  	});
}


/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/