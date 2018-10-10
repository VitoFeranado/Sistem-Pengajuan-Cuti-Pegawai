<?php
  $level = $this->session->userdata('level');
?>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url() ?>assets/dist/img/thumb_def_user_picture.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('nama'); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
  
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview beranda" id="beranda">
        <a href="<?php echo base_url(); ?>Admin/beranda">
          <i class="fa fa-home fa-fw"></i> <span>Dashboard</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <?php
        if($level=='admin'){
      ?>
      <li id="master" class="treeview">
        <a href="#">
          <i class="fa fa-hdd-o fa-fw"></i>
          <span>Data Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li id="bagian"><a href="<?php echo base_url(); ?>Admin/bagian"><i class="fa fa-circle-o"></i> Data Bagian</a></li>
          <li id="jabatan"><a href="<?php echo base_url(); ?>Admin/jabatan"><i class="fa fa-circle-o"></i> Data Jabatan</a></li>
          <li id="jcuti"><a href="<?php echo base_url(); ?>Admin/jenis_cuti"><i class="fa fa-circle-o"></i> Data Jenis Cuti</a></li>
          <li id="pegawai"><a href="<?php echo base_url(); ?>Admin/pegawai"><i class="fa fa-circle-o"></i> Data Pegawai </a></li>
        </ul>
      </li>
      <li id="manage" class="treeview">
        <a href="<?php echo base_url() ?>Admin/akun_pengguna">
          <i class="fa fa-users fa-fw"></i>
          <span>Manajemen Pengguna</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <?php
        }else if($level=='KEPALA UNIT'){
      ?>
      <li class="treeview" id="vali1">
        <a href="<?php echo base_url(); ?>Pimpinan/pengajuan_cuti">
          <i class="fa fa-file-o fa-fw"></i> <span>Data Pengajuan Cuti</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li class="treeview" id="lap">
        <a href="<?php echo base_url(); ?>Pimpinan/laporan_cuti">
          <i class="fa fa-print fa-fw"></i> <span>Laporan Cuti Pegawai</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <?php
        }else if($level=='KEPALA CABANG'){
      ?>
      <li id="master" class="treeview">
        <a href="#">
          <i class="fa fa-hdd-o fa-fw"></i>
          <span>Data Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li id="bagian"><a href="<?php echo base_url(); ?>Pimpinan/bagian"><i class="fa fa-circle-o"></i> Data Bagian</a></li>
          <li id="jabatan"><a href="<?php echo base_url(); ?>Pimpinan/jabatan"><i class="fa fa-circle-o"></i> Data Jabatan</a></li>
          <li id="jcuti"><a href="<?php echo base_url(); ?>Pimpinan/jenis_cuti"><i class="fa fa-circle-o"></i> Data Jenis Cuti</a></li>
          <li id="pegawai"><a href="<?php echo base_url(); ?>Pimpinan/pegawai"><i class="fa fa-circle-o"></i> Data Pegawai </a></li>
        </ul>
      </li>
      <li class="treeview" id="vali2">
        <a href="<?php echo base_url(); ?>Pimpinan/pengajuan_all">
          <i class="fa fa-file-o fa-fw"></i> <span>Data Pengajuan Cuti</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <li class="treeview" id="lap">
        <a href="<?php echo base_url(); ?>Pimpinan/laporan_cuti">
          <i class="fa fa-print fa-fw"></i> <span>Laporan Cuti Pegawai</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
      <?php
        }else{
      ?>
      <li id="cuti" class="treeview">
        <a href="#">
          <i class="fa fa-calendar-o fa-fw"></i>
          <span>Cuti Pegawai</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li id="ajukan"><a href="<?php echo base_url(); ?>Pegawai/ajukan_cuti"><i class="fa fa-circle-o"></i> Ajukan Cuti</a></li>
          <li id="datacuti"><a href="<?php echo base_url(); ?>Pegawai/data_cuti"><i class="fa fa-circle-o"></i> Data Pengajuan Cuti </a></li>
        </ul>
      </li>
      <?php
        }
      ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
