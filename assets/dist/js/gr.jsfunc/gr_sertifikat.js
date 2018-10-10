$(document).ready(function() { 
	$('#side_cetak').addClass('active');
	$('#side_cetak_sertifikat').addClass('active');
});


function load_dtcomsertifikat(){
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"combase/load_srtdt",
		beforeSend: function() {$('#xloading').fadeIn()},
		success: function(msg){
			$('#comsertifikat_dt').html(msg);
		},
		complete: function() {$('#xloading').fadeOut()}	
	})
}

function load_fmcomsertifikat(id){
	var data = {npm : id};
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"combase/load_srtview",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			$('#comsertifikat_fm').html(msg);
		},
		complete: function() {$('#xloading').fadeOut();}
	})
}

function comsertifikat_ajaxcrud(fn,btnid){
	var btn = $("#"+btnid);
	var data = $('#comsertifikatfm').serialize();
	alert(data);
	/*$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"ruang/"+fn,
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			var buffer = msg.split("|");
			showAlert(buffer[2],buffer[0],buffer[1],'tl',url);
			if(buffer[1]=='i'){
				load_dtcomsertifikat()	
			}
		},
		complete: function() {btn.button('reset')}
  	});*/
}

/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/