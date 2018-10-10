<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo base_url()?>/assets/dist/img/favicon.ico">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url()?>assets/dist/css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url()?>assets/dist/css/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url()?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/lobibox/css/Lobibox.min.css"/>
    
    <style>
        .modal-body {
            max-height: calc(100vh - 212px);
            overflow-y: auto;
        }

        .select-in-modal + .select2-container {
            width: 100% !important;
            padding: 0;
            z-index: 10000;
        }

        .select2-container--open {
            z-index: 10000;
        }
    </style>
    
    <!-- jQuery-->
    <script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/jQuery/jquery.form.min.js"></script>
	<script src="<?php echo base_url()?>assets/plugins/jQuery/jquery.preload.min.js"></script>
    
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url()?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url()?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>/assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/lobibox/js/Lobibox.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
 	
  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a class="logo" href="<?php echo base_url('SU');?>">
        <img alt="Brand" src="<?php echo base_url("assets/dist/img/jamkrindo.png");?>" height="30">
        <!--strong>CUTI PEGAWAI</strong--></a>
        <?php $this->load->view('layouts/navbar'); ?>
      </header>
      <?php $this->load->view('layouts/sidebar'); ?>
      <div class="content-wrapper">
        <section class="content">
        	<?php $this->load->view($content); ?>
        </section>
      </div>
      <?php $this->load->view('layouts/footer'); ?>
    </div>
  </body>
</html>