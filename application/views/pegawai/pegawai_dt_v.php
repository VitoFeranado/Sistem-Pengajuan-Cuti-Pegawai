<button data-toggle="modal" data-target="#add_peg" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> <strong><i>Tambah Pegawai</i></strong></button>
<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-hdd-o fa-fw"></i>
    <h3 class="box-title">Data Pegawai</h3>
  </div>
  <div class="box-body">
    <div class="mailbox-messages table-responsive">
      <table class="table table-bordered table-striped table-responsive" id="tb_pegawai">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>ID Pegawai</th>
                <th>NPP</th>
                <th>Nama Pegawai</th>
                <th>Jenis Kelamin</th>
                <!--th>Alamat</th-->
                <th>No Hp</th>
                <th>Jabatan</th>
                <th>Bagian</th>
                <TH>Karyawan</TH>
                <TH>Golongan</TH>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 0;
            foreach($pegawai->result() as $r1){
                $no++;
                $jk = " <span style='font-size:10;' class='label label-success'>Laki - Laki</span>";
                    if($r1->jenisk=='P')$jk = "<span style='font-size:10;' class='label label-info'>Perempuan</span>";
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r1->idpeg ?></td>
                <td><?php echo $r1->npp ?></td>
                <td><?php echo $r1->namapeg ?></td>
                <td><?php echo $jk ?></td>
                <!--td><?php //echo $r1->alamat ?></td-->
                <td><?php echo $r1->telp ?></td>
                <td><?php echo $r1->jabatan ?></td>
                <td><?php echo $r1->bagian ?></td>
                <td><?php echo $r1->jenis_karyawan ?></td>
                <td><?php echo $r1->golongan_gaji ?></td>
                <td>
                    <a title="Edit" href="javascript:;" onclick="edit('<?php echo $r1->idpeg ?>','<?php echo $r1->namapeg ?>','<?php echo $r1->jenisk ?>','<?php echo $r1->alamat ?>','<?php echo $r1->telp ?>','<?php echo $r1->id_jabatan ?>','<?php echo $r1->id_bagian ?>','<?php echo $r1->npp ?>','<?php echo $r1->jenis_karyawan ?>','<?php echo $r1->golongan_gaji ?>')" class="btn btn-default btn-xs xtooltip" data-toggle="modal" data-target="#edit_peg"><i class="fa fa-pencil"></i></a>
                    <a title="Hapus" href="javascript:;" onClick="delete_pegawai('<?php echo $r1->idpeg ?>')" class="btn btn-default btn-xs xtooltip" ><i class="fa fa-trash"></i></a>
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

<script type="text/javascript">
  $(function () {
    $("#tb_pegawai").dataTable({
      "iDisplayLength": 10,
      "processing": true,
          "serverSide": true,
    });
    
    $(".grdttbl_addmenu").append('<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" id="btn_reloaddtnegara" onClick="load_pegawai(this.id)" title="Muat ulang data" class="btn btn-default btn-sm xtooltip"><i class="fa fa-refresh"></i></button>');  
    
    $('.xtooltip').tooltip(); 
  });

function edit(id,nm,jk,almt,tlp,id_jab,id_bag,npp,kep,gl){
  $("#id_pegawai_").val(id);
  $("#nm_pegawai_").val(nm);
  $("#jk_").val(jk);
  $("#alamat_").val(almt);
  $("#telp_").val(tlp);
  $("#jabatan_").val(id_jab);
  $("#bagian_").val(id_bag);
  $("#npp_").val(npp);
  $("#kepeg_").val(kep);
  $("#golongan_").val(gl);
}

function check_int(evt) {
        var charCode = ( evt.which ) ? evt.which : event.keyCode;
        return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    }
</script>