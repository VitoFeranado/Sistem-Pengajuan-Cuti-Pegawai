<div class="row">
        <div class="col-md-6 col-md-offset-3">
        <div class="box box-solid">
          <div class="box-body">
              <div class="row">
                  <div class="col-sm-12">
                      <div class="callout callout-warning">
                            <p>Ubah Password anda dengan benar, untuk menjaga keamanan data anda!</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    
                    <form class="form-horizontal" id="reg_form" action="javascript:ubahpw();">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="col-sm-12">
                            Nama :
                            <input type="text" value="<?php echo $this->session->userdata('nama'); ?>" class="form-control" readonly name="reg_name">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                            Username :
                            <input name="reg_uname" value="<?php echo $this->session->userdata('username'); ?>" type="text" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12" data-toggle="tooltip" data-original-title="Tips : kombinasikan password dengan huruf dan angka. minimal 8 karakter!">
                            Password :
                            <input name="reg_password" type="password" class="form-control" placeholder="Masukkan Password" required autofocus>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                            Ulang Password :
                            <input name="reg_repassword" type="password" class="form-control" placeholder="Masukkan Password" required>
                        </div>
                      </div>
                    </div>
                    <input name="reg_hdnimg" id="reg_hdnimg" type="hidden"/>
                  
                </div>
          </div>
            <div class="box-footer bg-aqua">
              <div class="pull-right">
                  <button type="reset" class="btn btn-md btn-default btn-flat">Reset</button>
                    <button data-loading-text="<i class='fa fa-refresh fa-spin'></i> Memproses..." class="btn btn-md btn-danger btn-flat" type="submit">Simpan</button>
                </div>
                <!--a class="btn btn-flat bg-aqua"><i class="fa fa-question-circle"></i> bantuan</a-->
            </div>
            </form>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      
    function ubahpw() {
    /*validasi();*/
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable
    var url;

    url = "<?php echo site_url('Admin/ubahpassword')?>";
    

    // ajax adding data to database

    var formData = new FormData($('#reg_form')[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {

            if (data.status==1) //if success close modal and reload ajax table
            {
                Lobibox.notify('error', {
                    /*size: 'mini',*/
                    msg: 'Password Tidak Sama'
                });
                $("input[type=password]").val('');
            }
            else if (data.status==2) //if success close modal and reload ajax table
            {
                Lobibox.notify('success', {
                    /*size: 'mini',*/
                    msg: 'Berhasil Merubah Password'
                });
                $("input[type=password]").val('');
            }
            
            else {
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('#' + data.komponen_error[i] + '').text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled', false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.status);
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled', false); //set button enable

        }
    });
}
    </script>