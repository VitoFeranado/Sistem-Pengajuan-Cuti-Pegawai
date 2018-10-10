$(document).ready(function() { 	
	$('#side_konfig').addClass('active');
	$('#side_konfig_gateway').addClass('active');
	$('#side_konfig_gateway_gammu').addClass('active');
	
	btn1 = $('#gtw_gammurc_form_btnsimpan');
	var form1options = { 
        //target:        '#combyr_dtmhs',
		//resetForm: true,
        beforeSubmit:  showRequest1,
        success:       showResponse1,
		
    }; 
	
	btn2 = $('#gtw_smsdrc_form_btnsimpan');
	var form2options = { 
        //target:        '#combyr_dtmhs',
		//resetForm: true,
        beforeSubmit:  showRequest2,
        success:       showResponse2,
		
    }; 
	
	btn3 = $('#tes_btnkirim');
	var form3options = { 
        //target:        '#combyr_dtmhs',
		//resetForm: true,
        beforeSubmit:  showRequest3,
        success:       showResponse3,
		
    }; 
 
    $('#gtw_gammurc_form').submit(function() { 
        $(this).ajaxSubmit(form1options); 
        return false; 
    }); 
	
	$('#gtw_smsdrc_form').submit(function() { 
        $(this).ajaxSubmit(form2options); 
        return false; 
    }); 
	
	$('#gtw_tespesan_form').submit(function() { 
        $(this).ajaxSubmit(form3options); 
        return false; 
    }); 
	
});

function showRequest2(formData, jqForm, form1options) {
	/*var queryString = $.param(formData);
    alert('About to submit: \n\n' + queryString); 
	*/
	btn2.button('loading');
    return true; 
} 

function showResponse2(responseText, statusText)  {
	var buffer = responseText.split("|");
	showAlert(buffer[2],buffer[0],buffer[1],'tl');
	load_infosmsdrc();
	btn2.button('reset');
}

function showResponse3(responseText, statusText)  {
	var buffer = responseText.split("|");
	showAlert(buffer[2],buffer[0],buffer[1],'tl');
	load_infosmsdrc();
	btn3.button('reset');
}

function showRequest3(formData, jqForm, form3options) {
	btn3.button('loading');
    return true; 
} 

function showRequest1(formData, jqForm, form1options) {
	/*var queryString = $.param(formData);
    alert('About to submit: \n\n' + queryString); 
	*/
	btn1.button('loading');
    return true; 
} 

function showResponse1(responseText, statusText)  {
	var buffer = responseText.split("|");
	showAlert(buffer[2],buffer[0],buffer[1],'tl');
	load_infogammurc();
	btn1.button('reset');
} 

function gtw_cekkoneksi(){
	var btn = $('#gtw_gammurc_form_btncekkoneksi');
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"gammu/cek_koneksi",
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			showAlert(msg,'Respon Modem : ','w','tl');
		},
		complete: function() {btn.button('reset');}
	});  
}

function load_infogammurc(){
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"gateway/load_infogammurc",
		success: function(msg){
			$('#gtw_gammurc_info').html(msg);
		}
	});  
}

function load_infosmsdrc(){
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"gateway/load_infosmsdrc",
		success: function(msg){
			$('#gtw_smsdrc_info').html(msg);
		}
	});  
}

function gtw_instalgammus(){
	var btn = $('#btn_instal_gammus');
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"gammu/instal_services",
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			showAlert(msg,'Info!','i','tl');
		},
		complete: function() {btn.button('reset');}
	});  
}

function gtw_removegammus(){
	var btn = $('#btn_remove_gammus');
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"gammu/remove_services",
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			showAlert(msg,'Info!','i','tl');
		},
		complete: function() {btn.button('reset');}
	});  
}

function gtw_startgammus(){
	var btn = $('#btn_start_gammus');
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"gammu/start_services",
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			showAlert(msg,'Info!','i','tl');
		},
		complete: function() {btn.button('reset');}
	});  
}

function gtw_cekpulsa(){
	var btn = $('#btn_cekpulsa');
	var data = {
		no : $('#nolay').val()				
	};
	$.ajax({
		type: "POST",data : data,cache: false,
		url: url+con+"gammu/cek_pulsa",
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			showAlert(msg,'Info!','i','tl');
		},
		complete: function() {btn.button('reset');}
	});  
}

function gtw_stopgammus(){
	var btn = $('#btn_stop_gammus');
	$.ajax({
		type: "POST",cache: false,
		url: url+con+"gammu/stop_services",
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			showAlert(msg,'Info!','i','tl');
		},
		complete: function() {btn.button('reset');}
	});  
}

function count_msg(){ 
	var maks = 153;
	var txt = $("#txt_pesan");
	nMsg = Math.ceil((txt.val().length)/maks);
	if (nMsg >> 1) {
		$("#counter_pesan").text(txt.val().length - (maks*(nMsg-1)));
		$("#total_pesan").text(nMsg+' Pesan');  
	} 
	else {
		$("#counter_pesan").text(txt.val().length);
		$("#total_pesan").text('1 Pesan');
	}	
}


/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/