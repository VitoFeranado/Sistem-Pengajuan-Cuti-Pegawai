$(document).ready(function() { 
	$('#menuadmin').addClass('active');
	$('#menuadmin_dtkelas').addClass('active');
});


function load_dtkota(e){
	var btn = $('#'+e);
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"kelas/load_kotadt",
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			$('#kota_dt').html(msg);
		},
		complete: function() {btn.button('reset')}	
	})
}

function load_fmkota(kd,e){
	var btn = $('#'+e);
	$.ajax({
		type: "POST",cache: false, data: 'id=' + kd,
		url: url+con+"kelas/load_kotafm",
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			$('#kota_fm').html(msg);
		},
		complete: function() {btn.button('reset')}
	})
}

function ajaxcrud_kota(fn,e){
	var btn = $("#"+e);
	var data = $('#kotafm').serialize();
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"kelas/"+fn,
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