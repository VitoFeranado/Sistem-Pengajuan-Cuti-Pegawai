$(document).ready(function() { 	
	//$('#side_combase').addClass('active');
	//$('#side_combase_jadwal').addClass('active');
});

function valid_img(e){
   var img_file = $('#'+e);
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		if(img_file.val())
		{
			var fsize = img_file[0].files[0].size;
			var ftype = img_file[0].files[0].type;	
			
			switch(ftype)
			{
				case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
					break;
				default:
					showAlert("Format file <b>"+ftype+"</b> tidak didukung! Hanya <b>jpeg</b>/<b>gif</b>/<b>png</b>",'INFO','w','tl');
					return false
			}
			
			if(fsize>1048566) 
			{
				showAlert("Kapasistas gambar <b>"+bytesToSize(fsize) +"</b> terlalu besar! Harus Kurang dari <b>1MB</b>.",'INFO','w','tl');
				return false
			}
		}else {
			showAlert("Silahkan pilih foto terlebih dahulu",'INFO','w','tl');
			return false
		} 
	}
	else
	{
		showAlert("Maaf tidak dapat merubah gambar, kami mendeteksi browser yang Anda tidak kompatibel dengan 'HTML5 File API'",'INFO','w','tl');
		return false;
	}
	return true;
}

function init_tbluser(){
	initdatatable = $('#user_tbluser').dataTable( {
		"processing": true,
		"serverSide": true,
		"sAjaxSource": "user/json_dtuser",
		"aaSorting": [[1,'asc']],
		"fnRowCallback" : function(nRow, aData, iDisplayIndex){
			$("td:first", nRow).html(iDisplayIndex +1);
			return nRow;
		}
	});
}

function upload_userimg(){
	$('#userfmuploadimg').submit();
}

function redraws_tbluser(tableId, urlData){
	var btn = $('#btn_reloadtbluser');
	btn.button('loading');
	$.getJSON(urlData, null, function( json ){
		table = $(tableId).dataTable();
		oSettings = table.fnSettings();
		table.fnClearTable(this);
		for (var i=0; i<json.aaData.length; i++){
		  table.oApi._fnAddData(oSettings, json.aaData[i]);
		}
		oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
		table.fnDraw();
		btn.button('reset');
	});
}

function reload_tbluser(){
  redraws_tbluser('#user_tbluser', url+con+'user/json_dtuser');
}

function load_modaluser(id,e){
	var btn = $('#'+e);
	var data = {
		id_user : id			
	};
	$.ajax({
		type: "POST",cache: false, data: data,
		url: "user/load_form_mod",
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			$('#user_modalcontent').html(msg);
		},
		complete: function() {btn.button('reset');$("#user_modal").modal();}
	})
}

function reload_contentmodaluser(id){
	var modal = $("#user_modal");
	var data = {
		id_user : id			
	};
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"user/load_form_mod",
		beforeSend: function() {modal.modal('loading');},
		success: function(msg){
			$('#user_modalcontent').html(msg);
		},
		complete: function() {modal.modal('loading');}
	})
}

function ajax_cruduser(op){
	var modal = $("#user_modal");
	var data = $('#usermodalfm').serialize();
	$.ajax({
		type: "POST",cache: false, data: data,
		url: url+con+"user/"+op,
		beforeSend: function() {modal.modal('loading');},
		success: function(msg){
			var buffer = msg.split("|");
			showAlert(buffer[2],buffer[0],buffer[1],'tl');
			reload_tbluser();
		},
		complete: function() {modal.modal('loading');},
		error: function(xhr, status, error) {alert(xhr.responseText)}
	})
}


function user_remove(id,e){
	if(confirm("Hapus user!Yakin?")){
		var btn = $("#"+e);
		var data = {id:id};
		$.ajax({
			type: "POST",cache: false, data: data,
			url: url+con+"user/delusr",
			beforeSend: function() {btn.button('loading');},
			success: function(msg){
				var buffer = msg.split("|");
				showAlert(buffer[2],buffer[0],buffer[1],'tl');
				reload_tbluser();
			},
			complete: function() {bnt.button('reset');}
		});
	}
}

/* ajax error show respon status
error: function(xhr, status, error) {alert(xhr.responseText)}
*/