$(document).ready(function() {
	var $fmvalid_attach = $("#form_uploadlampiran").validate({
	  rules: {
		upact_nama: {
			required: true,
		},
		upact_ket: {
			required: true,
		},
		upact_file: {
			required: true,
		}
	  },
	  messages: {
		upact_nama: {
		  required: "Tidak boleh kosong!"
		}
	  },
	});
	
	$('#form_uploadlampiran').submit(function() { 
		var btn = $(this).find('button');
        btn.button('loading');
		$(this).ajaxSubmit({
			beforeSubmit: function(){
				/*if(!$(this).valid()) {
					$fmvalid_attach.focusInvalid();
					return false;
				}*/
			},
			success: function(responseText){
				var buf = responseText.split('|');
				shownotif(buf[1],buf[2],buf[0]);
				if(buf[0]=='s')reload_tbllampiran();
				btn.button('reset');
			},
			resetForm: true
		}); 
        return false; 
    }); 
	
	var n = $('#report_fmbiodata select[name=bio_negara]');
	var p = $('#report_fmbiodata select[name=bio_provinsi]');
	var k = $('#report_fmbiodata select[name=bio_kota]');
	var $validator = $("#report_fmbiodata").validate({
	  rules: {
		bio_nama: {
		  required: false,
		},
		bio_tplahir: {
		  required: false,
		},
		bio_tgllahir: {
		  required: false,
		},
		bio_kelamin: {
		  required: false,
		}/*,
		bio_pendidikan: {
		  required: false,
		},
		bio_kerja: {
		  required: false,
		},
		bio_nohp1: {
		  required: false,
		},
		bio_nohp1: {
		  required: false,
		},
		bio_email: {
		  required: false,
		  email: true,
		},*/
	  },
	  messages: {
		required: "Tidak Boleh Kosong",
		bio_email: {
		  required: "Tidak boleh kosong!",
		  email: "Your email address must be in the format of name@domain.com"
		}
	  },
	  errorElement: "p",
	  errorClass: "help-block",
	  errorPlacement: function ( error, element ) {
		error.appendTo(element.parent(".has"));
		element.parents( ".has" ).addClass( "has-feedback" );
		/*if ( element.prop( "type" ) === "checkbox" ) {
			error.insertAfter( element.parent( "label" ) );
		} else {
			error.insertAfter( element );
		}*/
		
		if ( !element.next( "span" )[ 0 ] ) {
			$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
		}
	  },
	  success: function ( label, element ) {
		if ( !$( element ).next( "span" )[ 0 ] ) {
			$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
		}
	  },
	  highlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".has" ).addClass( "has-error" ).removeClass( "has-success" );
		$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
	  },
	  unhighlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".has" ).addClass( "has-success" ).removeClass( "has-error" );
		$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
	  }
	});
	
	$('#rootwizard').bootstrapWizard({
		onTabClick: function(tab, navigation, index) {
			var fm_bio = $("#report_fmbiodata");
			if(!fm_bio.valid()) {
				$validator.focusInvalid();
				return false;
			}else save_drafreport();
		},
		onTabShow: function(tab, navigation, index) {
			var $total = navigation.find('li').length;
			var $current = index+1;
			var $percent = ($current/$total) * 100;
			$('#rootwizard .progress-bar').css({width:$percent+'%'});
		},
		'onNext': function(tab, navigation, index) {
			var $valid = $("#report_fmbiodata").valid();
			if(!$valid) {
				$validator.focusInvalid();
				return false;
			}else save_drafreport();
		},
		'nextSelector': '.button-next', 'previousSelector': '.button-previous'
	});
	
	$("#rpt_file").fileinput({
		uploadUrl: url+"laporan/upload_atc.php",
		allowedPreviewTypes: null,
		previewSettings: {
			other: {width: "80px", height: "80px"}
		},
		previewFileIconClass: 'file-icon-2x',
		autoReplace: false,
		maxFileCount: 12,
		uploadAsync: true,
		validateInitialCount: true,
	}).on('filebatchuploadcomplete', function(event, files, extra) {
		$(this).fileinput('clear');
	});
		
	$("#idn_file").fileinput({
		uploadUrl: url+"laporan/upload_idn.php",
		previewFileType: ['object/pdf'],
		allowedPreviewTypes: ['object/pdf','image'],
		allowedFileExtensions: ["pdf", "jpg", "png","gif"],
		previewSettings: {other: {width: "80px", height: "80px"}},
		previewFileIconClass: 'file-icon-2x',
		autoReplace: false,
		maxFileCount: 1,
		uploadAsync: true,
		validateInitialCount: true,
	}).on('filebatchuploadcomplete', function(event, files, extra) {
		$(this).fileinput('clear');
	});
	
	$("#report_fmbiodata input[name=bio_tglahir]").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
	$('#report_fmbiodata input[name=bio_tptinggal]').on('change', function() {
		$('#report_fmbiodata textarea[name=bio_alamat]').prop('disabled', false)
		if($(this).val()=='luarnegeri'){
			n.prop('disabled', false);p.prop('disabled', true);k.prop('disabled', true);
		}else {
			n.prop('disabled', true);p.prop('disabled', false);k.prop('disabled', false);
			n.val(0);p.val(0);
		}
	});
	
	$('#report_fmbiodata input[name=org_slc]').on('change', function() {
		var ornam = $('#report_fmbiodata input[name=org_nama]');
		var orja = $('#report_fmbiodata input[name=org_jabatan]');
		if($(this).val()=='O'){
			ornam.prop('disabled', false);
			orja.prop('disabled', false);
		}else {
			ornam.val('').prop('disabled', true);
			orja.val('').prop('disabled', true);
		}
	});
	
	p.on('change', function() {
		$.ajax({
			url:url+'kota/getbyprov.php',
			type:'POST',
			data: 'idp=' + $(this).val(),
			dataType: 'json',
			success: function( json ) {
				k.find('option:not(:first)').remove();
				$.each(json, function(i, value) {
					k.append($('<option>').text(value['nmkota']).attr('value',  value['idkota']));
				});
			},error: function(xhr, status, error) {alert(xhr.responseText)}
		});
	});
});

function close_modaladdreport(){
	if(confirm('Jika pengisian formulir belum selesai, formulir akan disimpan sebagai draf. Yakin?')){
		$('#modal_addreport').modal('hide');
		save_drafreport();
		reload_tbldraftreport();
	}
}

function toogle_nohp2(i){
	var nohp2 = $('#report_fmbiodata input[name=bio_nohp2]')
	nohp2.prop('disabled',(!$('#'+i).prop('checked')))
}

function toogle_org(i){
	var nohp2 = $('#report_fmbiodata input[name=bio_nohp2]')
	nohp2.prop('disabled',(!$('#'+i).prop('checked')))
}

function load_modaladdreport(e){
	var btn = $('#'+e);
	$.ajax({
		url:url+'laporan/load_addform.php',
		type: "POST",cache: false,
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			$('#modal_addreport_content').html(msg);
		},
		complete: function(tes) {btn.button('reset');if(tes['statusText'])$('#modal_addreport').modal('show');},
		error: function(xhr, status, error) {alert(xhr.responseText)}
	});		
}

function load_modaleditreport(e,id){
	var btn = $('#'+e);
	$.ajax({
		url:url+'laporan/load_editform.php',
		type: "POST",cache: false,
		data: 'idr=' + id,
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			$('#modal_addreport_content').html(msg);
		},
		complete: function(tes) {btn.button('reset');if(tes['statusText'])$('#modal_addreport').modal('show');},
		error: function(xhr, status, error) {alert(xhr.responseText)}
	});		
}

function save_drafreport(){
	var data = $('#report_fmbiodata').serialize()+'&'+$('#report_fmidentitas').serialize()+'&'+$('#report_fmlampiran').serialize();
	$.ajax({
		url:url+'laporan/update_draf.php',
		data: data,
		type: "POST",cache: false,
		beforeSend: function() {/*btn.button('loading');*/},
		success: function(msg){
			//alert(msg);
		},
		complete: function(tes) {/*btn.button('reset');*/},
		error: function(xhr, status, error) {alert(xhr.responseText)}
	});		
}

function delete_drafreport(i){
	var btn = $('#'+i);
	$.ajax({
		url:url+'laporan/remdraf.php',
		type: "POST",cache: false,
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			alert(msg);
			var buf = msg.split('|');
			if(buf[0]=='i'){$('#modal_addreport').modal('hide');reload_tbldraftreport();}
			shownotif(buf[1],buf[2],buf[0]);
		},
		complete: function(tes) {btn.button('reset');},
		error: function(xhr, status, error) {alert(xhr.responseText)}
	});		
}

function upload_filelampiran(i){
	var data = $('#form_uploadlampiran').serialize();
	var btn = $('#'+i);
	$.ajax({
		url:url+'laporan/upload_atc2.php',
		type: "POST",cache: false,
		data: data,
		beforeSend: function() {btn.button('loading');},
		success: function(msg){
			alert(msg);
			var buf = msg.split('|');
			/*if(buf[0]=='i'){$('#modal_addreport').modal('hide');reload_tbldraftreport();}
			shownotif(buf[1],buf[2],buf[0]);*/
		},
		complete: function(tes) {btn.button('reset');},
		error: function(xhr, status, error) {alert(xhr.responseText)}
	});
}

function reload_tbllampiran(){
	$.ajax({
		url:url+'laporan/filelampiran.php',
		type: "POST",cache: false,
		success: function(msg){
			$('#formlampiran_file').html(msg);
		},
		error: function(xhr, status, error) {alert(xhr.responseText)}
	});
}