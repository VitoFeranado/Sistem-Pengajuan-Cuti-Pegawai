<div class="callout callout-info">
    <p><strong>Catatan : </strong> Cetak Dokumen cuti akan berlaku jika pengajuan cuti Anda telah disetujui oleh pimpinan !</p>
</div>

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
                <th>Jenis Cuti</th>
                <th>Cuti Diambil</th>
                <th>Mulai Cuti</th>
                <th>Selesai Cuti</th>
                <th>Alamat Selama Cuti</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 0;
            foreach($cuti->result() as $r1){
                $no++;
                 
                    if($r1->validasi_pimpinan1=='none' || $r1->validasi_pimpinan2=='none'){
                      $st = "<span style='font-size:10;' class='label label-warning'>Dalam Proses</span>";
                    }else if($r1->validasi_pimpinan1=='false' || $r1->validasi_pimpinan2=='false'){
                      $st = "<span style='font-size:10;' class='label label-danger'>Cuti Tidak Disetujui</span>";
                    }else if($r1->validasi_pimpinan1=='true' && $r1->validasi_pimpinan2=='true'){
                      $st = " <span style='font-size:10;' class='label label-success'>Cuti Disetujui</span>";
                    }
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r1->nama_cuti ?></td>
                <td><?php echo $r1->jml_diambil ?></td>
                <td><?php echo tgl_indo($r1->tgl_mulaicuti) ?></td>
                <td><?php echo tgl_indo($r1->tgl_akhircuti) ?></td>
                <td><?php echo $r1->alamat_selamacuti ?></td>
                <td><?php echo $st ?></td>
                <td>
                  <form target="_blank" method="POST" action="<?php echo base_url() ?>Pegawai/cetak">
                    <input type="hidden" value="<?php echo $r1->id_ambilcuti ?>" name="idcuti">
                    <input type="hidden" value="<?php echo $r1->idpeg ?>" name="idpeg">
                    <input type="hidden" value="<?php echo $r1->nama_cuti ?>" name="jencut">
                    <?php
                      if($r1->validasi_pimpinan1=='none' && $r1->validasi_pimpinan2=='none'){
                        echo '<button type="button" onClick="batalkan('."'$r1->id_ambilcuti'".')" class="btn btn-danger btn-xs btn-block"><i class="fa fa-fw fa-close"></i> Batal</button>';
                      }else if($r1->validasi_pimpinan1=='true' && $r1->validasi_pimpinan2=='true'){
                        echo '<button type="submit" class="btn btn-primary btn-xs btn-block"><i class="fa fa-fw fa-print"></i> Cetak</button>';
                      }else{
                        echo "";
                      }
                    ?>
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

function edit(id,nm){
  $("#id_jabatan_").val(id);
  $("#nm_jabatan_").val(nm);
  $('#action').val('edit');
}

function batalkan(id) {
    Lobibox.confirm({
        msg: "Apakah pengajuan cuti akan dibatalkan?",
        callback: function ($this, type) {

            //Your code goes here

            if (type == 'yes') {
                $.ajax({
                    url: "<?php echo base_url()?>Pegawai/batalkan/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        //if success reload ajax table
                        //$('#modal_form').modal('hide');
      
                        Lobibox.notify('success', {

                            msg: 'Berhasil Hapus Data'
                        });
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        Lobibox.notify('error', {
                            /*size: 'mini',*/
                            msg: 'Gagal Hapus Data'
                        });
                    }
                });
            }
            else {
                return false;
            }

        }
    });
}
</script>