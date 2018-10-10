$(document).ready(function() { 
	$('#side_dtcombase').addClass('active');
	$('#side_dtcombase_dtruang').addClass('active');
});


function load_dtcomdtruang(){
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"combase/load_klsdt",
		beforeSend: function() {$('#xloading').fadeIn()},
		success: function(msg){
			$('#comdtruang_dt').html(msg);
		},
		complete: function() {$('#xloading').fadeOut()}	
	})
}

function load_fmcomdtruang(kd){
	var data = {kls : kd};
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"combase/load_klsview",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			$('#comdtruang_fm').html(msg);
		},
		complete: function() {$('#xloading').fadeOut();}
	})
}

function comruang_ajaxcrud(fn,btnid){
	var btn = $("#"+btnid);
	var data = $('#comdtruangfm').serialize();
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"ruang/"+fn,
		beforeSend: function() {btn.button('loading')},
		success: function(msg){
			var buffer = msg.split("|");
			showAlert(buffer[2],buffer[0],buffer[1],'tl',url);
			if(buffer[1]=='i'){
				load_dtcomdtruang()	
			}
		},
		complete: function() {btn.button('reset')}
  	});
}

/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/