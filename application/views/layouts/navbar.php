<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  
  <!-- Navbar Right Menu -->
       <div id="xloading" class="grspinner" style="display:none">
            <div class="rect1"></div>
          	<div class="rect2"></div>
          	<div class="rect3"></div>
        </div>
  
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo base_url() ?>assets/dist/img/thumb_def_user_picture.jpg" class="user-image" alt="User Image"/>
        <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span> </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header"> <img src="<?php echo base_url() ?>assets/dist/img/thumb_def_user_picture.jpg" class="img-circle" alt="User Image" />
            <p> <?php echo $this->session->userdata('nama'); ?> <small><?php echo $this->session->userdata('username'); ?></small> </p>
          </li>
          <!-- Menu Body -->          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left"> <a href="<?php echo base_url() ?>Admin/fm_ubahpw" class="btn btn-default btn-flat">Ubah Password</a> </div>
            <div class="pull-right"> <a href="<?php echo base_url() ?>Admin/logout" class="btn btn-default btn-flat">Keluar</a> </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>