$(document).ready(function(){
	url = $("#base_url").val();con = $("#def_con").val();
	$.ajaxSetup({
		//error: function(xhr, status, error) {/*alert(xhr.responseText)*/alert('OOPS! Error Function Detected!');}
	});
	cek();
});

function showAlert(wrd,ttl,icon,pos,tutup,clon){
	if(!tutup)tutup = false;
	var img='icon fa fa-info', cls='info';
	if(icon=='s'){img='icon fa fa-check';cls='success'}else if(icon=='e'){img='icon fa fa-ban';cls='danger'}else if(icon=='w'){img='icon fa fa-warning';cls='warning'};
	if(pos=='bl')pos='bottom-left';else if(pos=='br')pos='bottom-right';else if(pos=='tr')pos='top-right';else pos='top-left';
	
	$.extend($.gritter.options, {
	    position: pos,
		fade_out_speed: 3000
	});
	$.gritter.add({
		title: ttl, 
		text: wrd,		
		sticky: tutup,
		image: img,
		time: '',
		class_name: cls,
		before_open: function(){
        	if($('.gritter-item-wrapper').length == clon){
                        return false;
			}
			//ringAlert();
		},
	});

	return false;
}

function setRed(a){
  var x = document.getElementById(a);
  x.style.color='#FF0000';
}

function cek(){
    $.ajax({
		//type: "POST",
        url: url+"administrator/autoreply",
        cache: false,
        success: function(msg){
			var buffer = msg.split("|");
			if(buffer[3]){
				ringNotif();
				showAlert(buffer[2],buffer[0],buffer[1],'tl');
			}
			
        }
    });
    var timeup = setTimeout("cek()",1000);
}

function showNotif(msg){
	var buffer = msg.split("|");
	var img;
	if(buffer[5]!=''){
		img = buffer[5];	
	}
	
	$.extend($.gritter.options, {
	    position: 'top-left',
		fade_out_speed: 10000
	});
	
	$.gritter.add({
		title: '1 Pesan Baru:', 
		text: '"'+buffer[2]+'", dari '+buffer[1],		
		sticky: false,
		image: url+'assets/img/usr/thumb/thumb_'+img,
		time: '',
		before_open: function(){
        	if($('.gritter-item-wrapper').length == 7){
                        return false;
                    }
                },
		after_open: function(e){
				//ringNotif();
		},
	});

	return false;

}

function upNotif(ibxID){
	if(ibxID){
		$.ajax({
			type: "POST",
			url: url+con+"msg/ibx_update_notif",
			data: "ibx="+ibxID,
			cache: false
		});
	}
}

function ringNotif(){
	//var s1 = "ursounds/xx.ogg";
	var s2 = url+"asset/dist/sound/tone_sms.mp3";
	//var s3 = "sounds/xx.wav";
	$('<audio id="chatAudio"><source src="'+s2+'" type="audio/mpeg"></audio>').appendTo('body');
	$('#chatAudio')[0].play();
}

function load_navbarnewibx(){
	if(($("#nav_ibxnew_counter").text())>0){
		var loader = $(".messages-menu-loader");
		if(!$('.messages-menu').hasClass('open')){
			$.ajax({
				type: "POST",cache: false,
				url: url+con+"msg/load_navbarnewibx",
				beforeSend: function() {loader.show()},
				success: function(msg){
					$('#navbarnewibx').html(msg);
				},
				complete: function() {loader.hide()}
			});
		}
	}
}

function bytesToSize(bytes) {
	var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	if (bytes == 0) return '0 Bytes';
	var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}