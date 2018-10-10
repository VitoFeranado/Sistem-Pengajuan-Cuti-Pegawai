$(document).ready(function() { 
	$('#side_konfig').addClass('active');
	$('#side_konfig').addClass('active');
});


function load_dtnegara(e){
	var btn = $('#'+e);
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"crjadwal/load_negaradt",
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			$('#negara_dt').html(msg);
		},
		complete: function() {btn.button('reset')}	
	})
}

function load_fmnegara(kd,e){
	var btn = $('#'+e);
	$.ajax({
		type: "POST",cache: false, data: 'id=' + kd,
		url: url+con+"crjadwal/load_negarafm",
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			$('#negara_fm').html(msg);
		},
		complete: function() {btn.button('reset')}
	})
}

function ajaxcrud_negara(fn,e){
	var btn = $("#"+e);
	var data = $('#negarafm').serialize();
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"crjadwal/"+fn,
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			var buffer = msg.split("|");
			showAlert(buffer[2],buffer[0],buffer[1],'tl');
			if(buffer[1]=='i'){
				load_dtnegara();
				load_fmnegara();
			}
		},
		complete: function() {btn.button('reset')}
  	});
}

/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/