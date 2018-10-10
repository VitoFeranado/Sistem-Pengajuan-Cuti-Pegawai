<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-bars fa-fw"></i>
    <h3 class="box-title">List Data</h3>
  </div>
  <div class="box-body">
    <div class="mailbox-messages table-responsive">
      <table class="table table-bordered table-striped" id="view">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Jenis Kelamin</th>
                <th>Bagian</th>
                <th>Jabatan</th>
                <th>No.Telp</th>
                <th>Jenis Cuti</th>
                <th>Mulai Cuti</th>
                <th>Selesai Cuti</th>
            </tr>
        </thead>
          <?php
            if($data_cuti){
              $no=0;
              foreach($data_cuti->result() as $r){
                $no++;       
                 $jk = " <span style='font-size:10;' class='label label-success'>Laki-Laki</span>";
                    if($r->jenisk=='P')$jk = "<span style='font-size:10;' class='label label-info'>Perempuan</span>";         
          ?>
           <tr>
              <td><?php echo $no ?></td>
              <td><?php echo $r->idpeg ?></td>
              <td><?php echo $r->namapeg ?></td>
              <td><?php echo $jk ?></td>
              <td><?php echo $r->bagian ?></td>
              <td><?php echo $r->jabatan ?></td>
              <td><?php echo $r->telp ?></td>
              <td><?php echo $r->nama_cuti ?></td>
              <td><?php echo tgl_indo($r->tgl_mulaicuti) ?></td>
              <td><?php echo tgl_indo($r->tgl_akhircuti) ?></td>
           </tr> 
          <?php
              }
            }else{
              echo "No Data Found";
            }
          ?>
        <tbody>
        
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.box-body -->
</div>

<script type="text/javascript">
  

    $(document).ready(function() {
         $('.box_tabel').hide();

       

    });
  function tampildata() {
    dataString = $("#form").serialize();
    $.ajax({
        type:"POST",
        url:"<?php echo base_url(); ?>Pimpinan/filter",
        data:dataString,
        
        success:function(x){
            $("#view_dt").html(x);
            $('.box_tabel').show();
           
            return false;
        },
    });
    event.preventDefault();
}
</script>