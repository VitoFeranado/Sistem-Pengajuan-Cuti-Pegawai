<link href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<?php echo $this->session->flashdata('msg'); ?>
<div class="row">
    <div id="dt_pengajuan" class="col-md-12">
        <div class="box box-info">
          <div class="box-header">
            <i class="fa fa-hdd-o fa-fw"></i>
            <h3 class="box-title">Data Pengajuan Cuti</h3>
          </div>
          <div class="box-body">
            <div class="mailbox-messages table-responsive">
              <table class="table table-bordered table-striped" id="tb_pengajuan">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>ID Pegawai</th>
                        <th>Nama Pegawai</th>
                        <th>Jenis Cuti</th>
                        <th>Cuti Diambil</th>
                        <th>Mulai Cuti</th>
                        <th>Selesai Cuti</th>
                        <th>Alamat Selama Cuti</th>
                        <th width="8%">Validasi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 0;
                    foreach($cuti->result() as $r1){
                        $no++;
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $r1->idpeg ?></td>
                        <td><?php echo $r1->namapeg ?></td>
                        <td><?php echo $r1->nama_cuti ?></td>
                        <td><?php echo $r1->jml_diambil ?></td>
                        <td><?php echo tgl_indo($r1->tgl_mulaicuti) ?></td>
                        <td><?php echo tgl_indo($r1->tgl_akhircuti) ?></td>
                        <td><?php echo $r1->alamat_selamacuti ?></td>
                        <td>
                        <form id="form-validasi_unit" method="POST" action="<?php echo base_url() ?>Pimpinan/validasi_cabang">
                            <input type="hidden" name="idcuti" value="<?php echo $r1->id_ambilcuti ?>">
                            <button type="submit" name="btnSetuju" class="btn btn-primary btn-xs" title="Setuju"><i class="fa fa-fw fa-check"></i></button>
                            <button type="submit" name="btnTolak" class="btn btn-danger btn-xs" title="Tidak Setuju"><i class="fa fa-fw fa-close"></i></button>
                        </form>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
    </div>
</div>
<script type="text/javascript">

$(function () {
    $("#tb_pengajuan").dataTable({
      "iDisplayLength": 10,
      "processing": true,
          "serverSide": true,
    });
    
    $(".grdttbl_addmenu").append('<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" onClick="load_cuti(this.id)" title="Muat ulang data" class="btn btn-default btn-sm xtooltip"><i class="fa fa-refresh"></i></button>');  
    
    $('.xtooltip').tooltip(); 
  });


function bersih()
{
    $("input[type=text]").val('');
    $("input[type=hidden]").val('');
}

//Active Sidebar
$("#vali2").addClass('active');

//JS SAVE

</script>