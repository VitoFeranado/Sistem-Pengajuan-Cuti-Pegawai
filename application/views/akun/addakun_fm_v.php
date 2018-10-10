<div class="modal-dialog modal-default" style="z-index:20000;">
    <div class="modal-content">
        <form id="form-tambah" action="javascript:tambahin();">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit fa-fw"></i> Form Manajemen Akun</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nm" id="nm_" class="form-control" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="usr" id="usr_" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label>Level User</label>
                    <input type="text" name="lev" id="level_" class="form-control" placeholder="Level User" readonly>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pw" class="form-control" placeholder="Password" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-sm" onclick="resik()" type="button"><i class="fa fa-close fa-fw"></i> Close</button>
                <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-save fa-fw"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>