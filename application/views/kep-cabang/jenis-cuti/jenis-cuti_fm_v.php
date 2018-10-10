<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title">Form Jenis Cuti</h3>
  </div>
  <div class="box-body">
  <form id="form-jcuti" action="javascript:inc();">
    <div class="form-group">
      <label>Jenis Cuti :</label>
      <input type="text" name="nm_jeniscuti" id="nm_jeniscuti_" class="form-control" placeholder="Jenis Cuti" required readonly>
      <input type="hidden" id="id_jeniscuti_" name="id_jeniscuti">
      <input type="hidden" id="action" name="action">
    </div>
    <div class="form-group">
      <label>Banyak nya <i>(dalam hari)</i> :</label>
      <input type="number" name="jml" id="jml_" class="form-control" placeholder="Banyak nya" readonly>
    </div>
    <button type="submit" id="btnSave" class="btn btn-primary" disabled><i class="fa fa-save fa-fw"></i> Simpan</button>
    <button type="button" onclick="bersih()" id="reset" class="btn btn-default"><i class="fa fa-refresh fa-fw"></i></button>
  </div>
  </form>
</div>