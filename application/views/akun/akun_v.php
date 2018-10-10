<link href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<div id="respon1"></div>
<div class="row">
    <div id="dt_akun" class="col-md-12"><?php $this->load->view('akun/akun_dt_v') ?></div>
</div>

<div class="modal fade" id="akun_peg" style="z-index:20000;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php $this->load->view('akun/akun_fm_v'); ?>
</div>

<div class="modal fade" id="akun_add" style="z-index:20000;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php $this->load->view('akun/addakun_fm_v'); ?>
</div>

<script type="text/javascript">

function bersih()
{   
    $("#akun_peg").modal('hide');
    $("input[type=text]").val('');
    $("input[type=password]").val('');
    $("input[type=hidden]").val('');
}

//Active Sidebar
$("#manage").addClass('active');

//JS SAVE
function ubah() {
    /*validasi();*/
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable
    var url;

    url = "<?php echo site_url('Admin/akun_ubah')?>";
    

    // ajax adding data to database

    var formData = new FormData($('#form-akunpeg')[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {

            if (data.status) //if success close modal and reload ajax table
            {
                load_akunpegawai();
                Lobibox.notify('success', {
                    /*size: 'mini',*/
                    msg: 'Berhasil Merubah Password'
                });
                bersih();                

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

function tambahin() {
    /*validasi();*/
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable
    var url;

    url = "<?php echo site_url('Admin/akun_tambah')?>";
    

    // ajax adding data to database

    var formData = new FormData($('#form-tambah')[0]);
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (data) {

            if (data.status) //if success close modal and reload ajax table
            {
                load_akunpegawai();
                Lobibox.notify('success', {
                    /*size: 'mini',*/
                    msg: 'Berhasil Manambah Pengguna'
                });
                resik();                

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

function load_akunpegawai(kd,e){
    var btn = $('#'+e);
    $.ajax({
        type: "POST",cache: false, data: 'id=' + kd,
        url: "<?php echo base_url(); ?>Admin/load_akun",
        beforeSend: function() {btn.button('loading')},
        success: function(msg){
            $('#dt_akun').html(msg);
        },
        complete: function() {btn.button('reset')}
    })
}

function akun_hapus(id) {
    Lobibox.confirm({
        msg: "Apakah data ini akan dihapus?",
        callback: function ($this, type) {

            //Your code goes here

            if (type == 'yes') {
                $.ajax({
                    url: "<?php echo base_url()?>Admin/akun_hapus/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        //if success reload ajax table
                        //$('#modal_form').modal('hide');
                        load_akunpegawai();
                        Lobibox.notify('success', {

                            msg: 'Berhasil Hapus Data'
                        });
                        //location.reload();
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