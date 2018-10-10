$(document).ready(function() { 	
	$('#side_combase').addClass('active');
	$('#side_combase_jadwal').addClass('active');
});

function load_modmodalcomjadwal(id){
	var $modal = $("#comjadwal_modmodal");
	var data = {
		idk : id			
	};
	$.ajax({
		type: "POST",cache: false, data: data,async: true,
		url: url+con+"kelompok/load_modmodal",
		beforeSend: function() {
			$('#xloading').fadeIn();
			load_modmodalcomjadwal_dtanggota(id);
			load_modmodalcomjadwal_form(id);
		},
		success: function(){
			
		},
		complete: function() {$('#xloading').fadeOut();$modal.modal();}
	})
}

function load_modmodalcomjadwal_dtanggota(id){
	var data = {
		groupid : id				
	};
	$.ajax({
		type: "POST",
		cache: false,
		data : data,
		url: url+con+"jadwal/load_comjad_dtanggota",
		success: function(msg){
			$("#comjadwal_modmodal_dtanggota").html(msg);
		}
	});	
}

function load_modmodalcomjadwal_form(id){
	var data = {
		groupid : id				
	};
	$.ajax({
		type: "POST",
		cache: false,
		data : data,
		url: url+con+"jadwal/load_comjad_detail",
		success: function(msg){
			$("#comjadwal_modmodal_form").html(msg);
		}
	});	
}	

function commhs_ajaxcrud(fn){
	var $modal = $("#comjadwal_modmodal");
	var data = $('#comjadwal_modmodal_form').serialize();
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"mhs/"+fn,
		beforeSend: function() {$modal.modal('loading');},
		success: function(msg){
			var buffer = msg.split("|");
			showAlert(buffer[2],buffer[0],buffer[1],'tl');
		},
		complete: function() {$modal.modal('loading');}
  	});
}

function comjad_mod(id){
	quest = confirm('Ubah Jadwal!\nYakin?');
	if(quest==1){
		var data = $('#comjadwal_ditform').serialize();
		btn = $("#comjad_btn_mod");
		$.ajax({
			type: "POST",cache: false,data : data,
			url: url+con+"jadwal/mod",
			beforeSend: function() {btn.button('loading');},
			success: function(msg){
				var buffer = msg.split("|");
				if(buffer[1]=='i'){
					load_modmodalcomjadwal_form(id);
				}
				showAlert(buffer[2],buffer[0],buffer[1],'tl');
			},
			complete: function() {btn.button('reset');}
		});
	}
}

function load_mhsmodalcomjadwal(){
	var $modal = $("#comjadwal_mhsmodal");
	//$modal.modal('loading');
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"jadwal/load_jadmhsmodal_form",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			$("#comjad_jadmhsmodal_form").html(msg);
		},
		complete: function() {$('#xloading').fadeOut();$modal.modal();}
	});	
}

function load_comjad_mhsmodal_combothp(){
	var $modal = $("#comjadwal_mhsmodal");
	npm = $('#comjadwal_mhsmodal_txtnpm').val();
	var data = {
		npm : npm				
	};
	$.ajax({
		type: "POST",cache: false,data : data,
		url: url+con+"jadwal/load_mhsjadmodal_combothp",
		beforeSend: function() {$modal.modal('loading');},
		success: function(msg){
			$("#comjad_mhsjadmodal_combothp").html(msg);
		},
		complete: function() {$modal.modal('loading');}
	});	
}

function load_comjad_jadmhsmodal_detail(npm,ujk){
	var $modal = $("#comjadwal_mhsmodal");
	var data = {
		npm : npm, ujk : ujk			
	};
	$.ajax({
		type: "POST",cache: false,data : data,
		url: url+con+"jadwal/load_jadmhsmodal_detail",
		beforeSend: function() {$modal.modal('loading');},
		success: function(msg){
			$("#comjad_jadmhsmodal_detail").html(msg);
		}
		,complete: function() {$modal.modal('loading');}
	});	
}

function load_jadwaldt(){
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"jadwal/load_jadwaldt",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			$("#comjadwal_dt").html(msg);
		},
		complete: function() {$('#xloading').fadeOut();}
	});	
}
/*function comgrb_movetoanggota(id,npm,ujk){
	var $modal = $("#comgrbdt_modmodal");
	var data = {
		idk : id, npm : npm, ujk : ujk			
	};
	$.ajax({
		type: "POST",
		cache: false,
		data: data,
		url: url+con+"anggota/addanggota",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			var buffer = msg.split("|"),icon;
			showAlert(buffer[2],buffer[0],buffer[1],'tl');
			if(buffer[1]=='i'){
				reload_comgrb_modmodal(id);
			}
		}
		,complete: function() {$('#xloading').fadeOut();$modal.modal();}
	});	
}

function comgrb_movetopeserta(id,npm,ujk){
	var $modal = $("#comgrbdt_modmodal");
	var data = {
		idk : id, npm : npm, ujk : ujk			
	};
	$.ajax({
		type: "POST",
		cache: false,
		data: data,
		url: url+con+"anggota/delanggota",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			var buffer = msg.split("|"),icon;
			showAlert(buffer[2],buffer[0],buffer[1],'tl');
			if(buffer[1]=='i'){
				reload_comgrb_modmodal(id);
			}
		}
		,complete: function() {$('#xloading').fadeOut();$modal.modal();}
	});	
}

function relaod_comgrb(){
	$.ajax({
		type: "GET",
		cache: false,
		url: url+con+"kelompok/reload",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			$("#comdtgrb_dt").html(msg);
		}
		,complete: function() {$('#xloading').fadeOut();}
		,error: function(xhr, status, error) {alert(xhr.responseText)}
	});	
}

function reload_comgrb_modmodal(id){
	var $modal = $("#comgrbdt_modmodal");
	var data = {
		idk : id			
	};
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"kelompok/load_modmodal",
		beforeSend: function() {$modal.modal('loading');},
		success: function(msg){
			$('#comgrbdt_modmodalcontent').html(msg);
		},
		complete: function() {$modal.modal('loading');}
	})
}

function load_addmodalcomdtgrb(){
	var $modal = $("#comgrbdt_addmodal");
	$.ajax({
		url: url+con+"kelompok/load_addmodal_form",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(){
			load_addmodalcomdtgrb_form();
		},
		complete: function() {$('#xloading').fadeOut();$modal.modal();}
	});
}

function load_addmodalcomdtgrb_form(){
	$.ajax({
		url: url+con+"kelompok/load_addmodal_form",
		success: function(msg){
			$('#comgrbdt_addmodalcontent').html(msg);
		}
	});
}

function comgrb_setujk(i){
	$('#comgrb_put_slcmu').prop( "disabled", true );
	$("#comgrb_put_slcmu option").text('Loading...');
	$.ajax({
		type: "POST",
		cache: false,
		url: url+con+"combase/set_ujk/"+i,
		success: function(){
			load_addmodalcomdtgrb_form();
		}
	});	
}

function comgrb_addmodal_setmax(){
	var maxmhs = $("#comgrb_put_slcmu").find('option:selected').data('max');
	$("#comgrb_put_txtmaxmhs").val(maxmhs);
	comgrb_addmodal_setnm();
}

function comgrb_addmodal_setnm(){
	var mu = $("#comgrb_put_slcmu").val();
	var data = {
		mu : mu				
	};
	$.ajax({
		type: "POST",
		cache: false,
		data: data,
		url: url+con+"kelompok/create_nmkelompok",
		success: function(msg){
			$("#comgrb_put_txtnama").val(msg);
		}
	});	
}

function comgrb_add(){
	var btn = $('#comgrb_btn_addgrb');
	btn.button('loading');
	
	var $modal = $("#comgrbdt_addmodal");
	var data = $('#comgrb_put_form').serialize();
	$.ajax({
		type: "POST",
		cache: false,
		data: data,
		url: url+con+"kelompok/addgrb",
		success: function(msg){
			var buffer = msg.split("|"),icon;
			showAlert(buffer[2],buffer[0],buffer[1],'tl');
			if(buffer[1]=='i'){
				load_addmodalcomdtgrb_form();
				$('#comgrbdt_addmodal').modal('hide');
			}
			btn.button('reset');
		}
		,error: function(xhr, status, error) {alert(xhr.responseText)}
	});
}

function comgrb_del(i){
	quest = confirm('Hapus Kelompok!\nYakin?');
	if(quest==1){
		var data = {
			idk : i				
		};
		$.ajax({
			type: "POST",
			cache: false,
			data : data,
			url: url+con+"kelompok/rmvgrb",
			success: function(msg){
				var buffer = msg.split("|"),icon;
				showAlert(buffer[2],buffer[0],buffer[1],'tl');
				if(buffer[1]=='i'){
					//relaod_comgrb();
				}
			}
		});	
	}
}


/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/