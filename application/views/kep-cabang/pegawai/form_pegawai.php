<div class="modal-dialog modal-default" style="z-index:20000;">
    <div class="modal-content">
        <form id="form-pegawai" action="javascript:simpan();">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus fa-fw"></i> Form Tambah Data Pegawai</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Pegawai</label>
                    <input type="text" name="id_pegawai" class="form-control" placeholder="ID Pegawai" required autofocus>
                </div>
                <div class="form-group">
                    <label>Nama Pegawai</label>
                    <input type="text" name="nm_pegawai" class="form-control" placeholder="Nama Pegawai" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jk" class="form-control" required>
                        <option value="">-Jenis Kelamin-</option>
                        <option value="L">Laki - Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat" required></textarea>
                </div>
                <div class="form-group">
                    <label>No. Telp</label>
                    <input type="text" name="telp" class="form-control" placeholder="No Telp" required>
                </div>
                <div class="form-group">
                    <label>Bagian</label>
                    <select name="bagian" class="form-control" required>
                        <option value="">-Bagian-</option>
                        <?php
                            foreach($bagian->result() as $b){
                                echo "<option value='$b->id_bagian'>$b->bagian</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <select name="jabatan" class="form-control" required>
                        <option value="">-Jabatan-</option>
                        <?php
                            foreach($jabatan->result() as $j){
                                echo "<option value='$j->id_jabatan'>$j->jabatan</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status Kepegawaian</label>
                    <select name="status_kepeg" class="form-control" required>
                        <option value="">-Status Kepegawaian-</option>
                        <option value="TETAP">TETAP</option>
                        <option value="KONTRAK">KONTRAK</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>NPP</label>
                    <input type="text" name="npp" class="form-control" placeholder="NPP">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pw" class="form-control" placeholder="Password" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-sm" onclick="bersih()" type="button"><i class="fa fa-close fa-fw"></i> Close</button>
                <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-save fa-fw"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>