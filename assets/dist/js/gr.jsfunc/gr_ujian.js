$(document).ready(function() { 	
	//$('#side_combase').addClass('active');
	//$('#side_combase_jadwal').addClass('active');
});

function load_modmodalcomnilai(id){
	var $modal = $("#comjadwal_modmodal");
	var data = {
		idk : id			
	};
	$.ajax({
		type: "POST",cache: false, data: data,async: true,
		url: url+con+"kelompok/load_modmodal",
		beforeSend: function() {
			$('#xloading').fadeIn();
			load_modmodalcomnilai_dtanggota(id);
			//load_modmodalcomjadwal_form(id);
		},
		success: function(){
			$('#comnilai_hdnidk').val(id);
		},
		complete: function() {$('#xloading').fadeOut();$modal.modal();}
	})
}

function load_modmodalcomnilai_dtanggota(id){
	var btn = $('#btn_comnilai_reload');
	var data = {
		groupid : id				
	};
	$.ajax({
		type: "POST",
		cache: false,
		data : data,
		url: url+con+"ujian/load_comnilai_dtanggota",
		beforeSend: function() {$("#btn_comnilai_reload").hide();btn.button('loading');},
		success: function(msg){
			$("#comnilai_modmodal_dtanggota").html(msg);
			btn.hide();
		}
		,complete: function() {btn.button('reset');}
	});	
}

function reload_modmodalcomnilai_dtanggota(){
	load_modmodalcomnilai_dtanggota($('#comnilai_hdnidk').val());
}

function comnilai_modujian(ntf){
	var btn = $('#btn_comnilai_input');
	var data = $('#comnilai_fminputnilai').serialize();
	console.debug(data);
	$.ajax({
		type: "POST",cache: false,data : data,
		url: url+con+"ujian/mod",
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			var buffer = msg.split("|");
			if(ntf)showAlert(buffer[2],buffer[0],buffer[1],'tl');
			$("#btn_comnilai_reload").show();
		}
		,complete: function() {btn.button('reset');},error: function(xhr, status, error) {alert(xhr.responseText)}
	});
}

function simpanoninput(i){
	if($('#cb_simpanoninput').prop("checked")){	
		comnilai_modujian(0);
	}
}

/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/