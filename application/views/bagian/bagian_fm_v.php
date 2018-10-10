<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title">Form Bagian</h3>
  </div>
  <div class="box-body">
  <form id="form-bagian" action="javascript:inc();">
    <div class="form-group">
      <label>Nama Bagian :</label>
      <input type="text" name="nm_bagian" id="nm_bagian_" class="form-control" placeholder="Nama Bagian" required>
      <input type="hidden" id="id_bagian_" name="id_bagian">
      <input type="hidden" id="action" name="action">
    </div>
    <button type="submit" id="btnSave" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
    <button type="button" onclick="bersih()" id="reset" class="btn btn-default"><i class="fa fa-refresh fa-fw"></i></button>
  </div>
  </form>
</div>