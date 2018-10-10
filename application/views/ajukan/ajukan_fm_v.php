<?php $tujuhhari = strtotime("+7 day", time());
$tgltujuh = date('d-m-Y', $tujuhhari);
?>

<div class="row">
  <div class="col-md-12">
    <div id="msg"></div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Form Pengajuan Cuti</h3>
      </div>
      <div class="box-body">
      <form id="form-cuti" method="POST">
        <div class="form-group">
        <?php
          foreach($pegawai->result() as $peg){
            $id = $peg->idpeg;
            $nm = $peg->namapeg;
          }
        ?>
          <label>ID Pegawai :</label>
          
          <input type="text" id="id_pegawai_" name="id_pegawai" value="<?php echo $id ?>" readonly class="form-control">
        </div>
        <div class="form-group">
          <label>Nama Pegawai</label>
          <input type="text" name="nm_pegawai" id="nm_pegawai_" class="form-control" placeholder="Nama Pegawai" value="<?php echo $nm ?>" readonly>
        </div>
        <div class="form-group">
          <label>Jenis Cuti :</label>
          <select name="jenis_cuti" class="form-control">
            <option value="">Pilih Jenis Cuti</option>
            <?php
              foreach($jeniscuti->result() as $c){
                echo "<option value='$c->id_jeniscuti'>$c->nama_cuti</option>";
              }
            ?>
          </select>
        </div>
        <!-- <div class="form-group">
          <label>Jumlah Cuti <i>(yang diambil dalam Hari)</i> :</label>
          <input type="text" name="jml" class="form-control" placeholder="Jumlah Cuti Yang Diambil" required onkeypress="return event.charCode >=48 && event.charCode <=57">
        </div> -->
        <div class="form-group">
          <label>Tanggal Mulai Cuti :</label>
          <input type="text" name="tgl_mulai" id="tgl_mulai_" class="form-control datepicker" placeholder="Tanggal Mulai Cuti" required onkeypress="return event.charCode >=48 && event.charCode <=57" readonly value="<?php echo $tgltujuh ?>">
        </div>
		
        <div class="form-group">
          <label>Tanggal Selesai Cuti :</label>
          <input type="text" name="tgl_selesai" id="tgl_selesai_" class="form-control datepicker" placeholder="Tanggal Selesai Cuti" required onkeypress="return event.charCode >=48 && event.charCode <=57" readonly>
        </div>
        <div class="form-group">
          <label>Alamat Selama Cuti :</label>
          <textarea name="alamat" class="form-control"></textarea>
        </div>

        <button type="button" id="btnSave" onclick="simpan()" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
        <button type="reset" id="reset" class="btn btn-default"><i class="fa fa-refresh fa-fw"></i> Reset</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $("#cuti").addClass('active');
  $("#ajukan").addClass('active');

  $('#tgl_mulai_').datepicker({
      format: "dd-mm-yyyy",
      
      autoclose : true,
	  startDate: '+7d',
    //weekStart: '1',
    daysOfWeekDisabled:'0',
    //maxView: '2',
    //minView:'1',
  });
  
    $('#tgl_selesai_').datepicker({
      format: "dd-mm-yyyy",
      
      autoclose : true,
	  startDate: '+7d',
    //weekStart: '1',
    daysOfWeekDisabled:'0',
    //maxView: '2',
    //minView:'1',
  });

  function simpan() {
    dataString = $("#form-cuti").serialize();
    $.ajax({
        type:"POST",
        url:"<?php echo base_url(); ?>Pegawai/pengajuan_simpan",
        data:dataString,
        beforeSend:function(){
            $("#msg").html('<img src="<?=base_url();?>ajax-loader.gif"/><span>harap tunggu...</span>');
        },
        success:function(x){
            $("#msg").html(x);
            $('#reset').click();
            return false;
        },
    });
    event.preventDefault();
  }

</script>