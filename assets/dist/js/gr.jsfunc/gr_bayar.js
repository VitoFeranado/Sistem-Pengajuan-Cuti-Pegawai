$(document).ready(function() { 
	$('#side_combase').addClass('active');
	$('#side_combase_bayar').addClass('active');
	
	var options = { 
        target:        '#combyr_dtmhs',
		//resetForm: true,
        beforeSubmit:  showRequest,
        success:       showResponse,
		
    }; 
 
    $('#combyrfmsetnpm').submit(function() { 
        $(this).ajaxSubmit(options); 
        return false; 
    }); 
	
	
});


function showRequest(formData, jqForm, options) {
	$('#xloading').fadeIn();
    return true; 
} 

function showResponse()  {
	combyr_loadview();
	$('#xloading').fadeOut();
} 

function combyr_loaddtmhs(){
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"combase/load_byrdtmhs",
		success: function(msg){	
			$("#combyr_dtmhs").html(msg);
		}
	});  
}

function combyr_loadview(){
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"combase/load_byrview",
		success: function(msg){	
			$("#combyr_view").html(msg);
		}
	});  
}

function combyr_loadstt(){
	var data = {
		ujk : $("#combyrdtmhs_slcujk").val()						
	};
	$.ajax({
		type: "POST",data: data,cache: false,
		url: url+con+"combase/load_byrstt",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			combyr_loaddtmhs();
			combyr_loadview();
		},
		complete: function() {$('#xloading').fadeOut();},
	}); 
}

function combyr_ambilmu(){
	var arr_kdmu = $('.cb_addmu:checked').serialize();
	$.ajax({
		type: "POST",data: arr_kdmu,cache: false,
		url: url+con+"matauji/ambil_mu",
		beforeSend: function() {
			if(!arr_kdmu){
				showAlert('Belum ada yang ditandai!!','INFO :','w','tl');
				return false	
			}
			$('#xloading').fadeIn();
		},
		success: function(msg){
			var buffer = msg.split("||");
			$.each(buffer, function(key,val){	
				var buf = val.split("|");
				showAlert(buf[1],'INFO :',buf[0],'tl')	
			});
			$('#combyrview_addmod').modal('hide');
			
		},
		complete: function() {$('#xloading').fadeOut();}
	}); 
}

function combyr_batalmu(){
	var arr_kdmu = $('.cb_delmu:checked').serialize();
	$.ajax({
		type: "POST",data: arr_kdmu,cache: false,
		url: url+con+"matauji/batal_mu",
		beforeSend: function() {
			if(!arr_kdmu){
				showAlert('Belum ada yang ditandai!!','INFO :','w','tl');
				return false	
			}
			$('#xloading').fadeIn();
		},
		success: function(msg){
			var buffer = msg.split("||");
			$.each(buffer, function(key,val){	
				var buf = val.split("|");
				showAlert(buf[1],'INFO :',buf[0],'tl')	
			});
			combyr_loadstt();
		},
		complete: function() {$('#xloading').fadeOut();}
	});
}

function combyr_addujk(){
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"bayar/add_thp",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			var buf = msg.split("|");
			showAlert(buf[1],'INFO :',buf[0],'tl');
			combyr_loadstt();
		},
		complete: function() {$('#xloading').fadeOut();}
	})
}

function combyr_remthp(){
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"bayar/rem_thp",
		beforeSend: function() {$('#xloading').fadeIn();},
		success: function(msg){
			var buf = msg.split("|");
			showAlert(buf[1],'INFO :',buf[0],'tl');
			combyr_loadstt();
		},
		complete: function() {$('#xloading').fadeOut();}
	}) 
}

function combyrcombo_upstt(i){
	$('#combyrdtmhs_slcstt').confirmation({
		onConfirm: function() { ya() },
		btnOkLabel : 'Ya',
		btnCancelLabel : 'Tidak',
		title : 'Ubah status pembayaran?',
		onCancel: function() { combyr_loadstt() }
	});
	function ya(){
		var data = {
			stt : i						
		};
		$.ajax({
			type: "POST",data: data,cache: false,
			url: url+con+"bayar/update_sttbyrMhs",
			beforeSend: function() {$('#xloading').fadeIn();},
			success: function(msg){	
				var buf = msg.split("|");
				showAlert(buf[1],'INFO :',buf[0],'tl');
				combyr_loadstt();
			},
			complete: function() {$('#xloading').fadeOut();}
		})
	}
}

/*


*/





function tes_closemodal(){
	$('#combyrview_addmod').modal('hide');
}
		
function tes_loader(){
	$('.load-view').oLoader();
	$('#xloading').show();
}

function tes_collapse(){
	$('.load-view').addClass('collapsed-box');
}

function tes_uncollapse(){
	//$('.load-view').addClass('collapsed-box');
	var temp = $('.load-view');
	if(temp.hasClass('collapsed-box')){
	   temp.removeClass('collapsed-box')
	}else{
	   temp.addClass('collapsed-box')
	}
}

/*function combyr_setdtmhs(){
	tes_loader();
	$.ajax({
		type: "POST",
		url: url+con+"combase/set_byrdtmhs",
		data: data,
		cache: false,
		success: function(msg){	
			$("#m_byr_dtmhs").html(msg);
			combyr_loaddtmu();
		}
	}).always(function () {
		$('#m_byr_loading').hide();
	});
}
/*
$(document).ready(function() {
	$("#fm_byr_pm").keypress(function(event){
		combyr_setdtmhs();
	});
});






function combyr_loaddtmu(){
	url = $("#base_url").val();con = $("#def_con").val();
	$.ajax({
		type: "POST",
		url: url+con+"combase/load_byrdtmu",
		cache: false,
		success: function(msg){	
			$("#m_byr_dtmu").html(msg);
		}
	});  
}



function combyr_remthp(){
	url = $("#base_url").val();con = $("#def_con").val();
	$("#m_byr_loading").show();
	$.ajax({
		type: "POST",
		url: url+con+"bayar/rem_thp",
		cache: false,
		success: function(msg){
			if(msg!='')showAlert(msg,'INFO :','w','tl');
			combyr_loaddtmu();
			combyr_loaddtmhs();
		}
	}).always(function () {
		$('#m_byr_loading').hide();
	});   
}







function combyr_batalmu(i){
	url = $("#base_url").val();con = $("#def_con").val();
	$("#m_byr_loading").show();
	var data = {
		kd_mu : i						
	};
	$.ajax({
		type: "POST",
		url: url+con+"matauji/batal_mu",
		data: data,
		cache: false,
		success: function(msg){	
			if(msg!='')showAlert(msg,'INFO :','w','tl');
			combyr_loaddtmu();
		}
	}).always(function () {
		$('#m_byr_loading').hide();
	});  
}

function combyrbtn_upstt(i){
	var quest = confirm("Lunasi pembayaran! Yakin?");
  	if(quest==1){
		url = $("#base_url").val();con = $("#def_con").val();
		$("#m_byr_loading").show();
		var data = {
			stt : i						
		};
		$.ajax({
			type: "POST",
			url: url+con+"bayar/update_sttbyrMhs",
			data: data,
			cache: false,
			success: function(msg){	
				if(msg!='')showAlert(msg,'INFO :','w','tl');
				combyr_loaddtmhs();
				combyr_loaddtmu();
			}
		}).always(function () {
			$('#m_byr_loading').hide();
		});
	}
}




*/