$(document).ready(function() { 
	$('#side_dtcombase').addClass('active');
	$('#side_dtcombase_dtmu').addClass('active');
});

function load_dtpengaduan(){
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"validasi/load_lpview",
		beforeSend: function() {$('#xloading').fadeIn()},
		success: function(msg){
			$('#pengaduan_dt').html(msg);
		},
		complete: function() {$('#xloading').fadeOut()}	
	})
}

function load_fmcomdtmu(kd){
	var data = {mu : kd};
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"combase/load_lpview",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			$('#comdtmu_fm').html(msg);
		},
		complete: function() {$('#xloading').fadeOut();}
	})
}

function comdtmu_ajaxcrud(fn,btnid){
	var btn = $("#"+btnid);
	var data = $('#comdtmufm').serialize();
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"matauji/"+fn,
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			var buffer = msg.split("|");
			showAlert(buffer[2],buffer[0],buffer[1],'tl',url);
			if(buffer[1]=='i'){
				load_dtcomdtmu()	
			}
		},
		complete: function() {btn.button('reset')}
  	});
}

/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/