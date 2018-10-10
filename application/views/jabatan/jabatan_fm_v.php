<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title">Form Jabatan</h3>
  </div>
  <div class="box-body">
  <form id="form-jabatan" action="javascript:inc();">
    <div class="form-group">
      <label>Nama Jabatan :</label>
      <input type="text" name="nm_jabatan" id="nm_jabatan_" class="form-control" placeholder="Nama Jabatan" required>
      <input type="hidden" id="id_jabatan_" name="id_jabatan">
      <input type="hidden" id="action" name="action">
    </div>
    <button type="submit" id="btnSave" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
    <button type="button" onclick="bersih()" id="reset" class="btn btn-default"><i class="fa fa-refresh fa-fw"></i></button>
  </div>
  </form>
</div>