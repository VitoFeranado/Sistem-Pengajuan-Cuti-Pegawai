<!DOCTYPE html>
<html>
<head>
  <title>Login Sistem Pengajuan Cuti Pegawai</title>
 <!-- custom-theme -->
 <link rel="shortcut icon" href="<?php echo base_url()?>/assets/dist/img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Elegant Login Form Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme  -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/login/css/style.css">
   <!-- font-awesome icons -->
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
<!-- //font-awesome icons -->

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
<script src="<?php echo base_url() ?>assets/js/libs/jquery-2.1.1.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </head>
  <body>
<div class="login-form w3_form">
  <!--  Title-->
      <div class="login-title w3_title">
           <h1 style="color:#000000">SISTEM PENGAJUAN CUTI PEGAWAI</h1>
      </div>
           <div class="login w3_login">
                <h2 class="login-header w3_header">Log in</h2>
				    <div class="w3l_grid">
              <?php echo $this->session->flashdata('notif'); ?>
                        <form class="login-container" action="<?php echo base_url() ?>Login/auth" method="post">
                             <input type="text" placeholder="Username" Name="username_txt">
                             <input type="password" placeholder="Password" Name="password_txt">
                             <input type="submit" value="Login">
                        </form>
                 

                  </div>
       </div>
  
</div>
  
  


  
<div class="footer-w3l">
		<p class="agile" style="color:#4dacef"> &copy; 2017 Sistem Pengajuan Cuti Pegawai . All Rights Reserved </a></p>
</div>
<script>
$(document).ready(function(){setTimeout(function(){$(".alert").fadeIn('slow');}, 500);});
        setTimeout(function(){$(".alert").fadeOut('slow');}, 3000);
</script>
</body>
</html>