<link href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<div id="respon1"></div>
<div class="row">
    <div id="dt_pegawai" class="col-md-12"><?php $this->load->view('kep-cabang/pegawai/pegawai_dt_v') ?></div>
    <!--div id="fm_jeniscuti" class="col-md-4"><?php //$this->load->view('jenis-cuti/jenis-cuti_fm_v') ?></div-->
</div>

<!--Modal Edit-->
<div class="modal fade" id="edit_peg" style="z-index:20000;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php $this->load->view('kep-cabang/pegawai/form_pegawai_edit'); ?>
</div>

<script type="text/javascript">

function bersih()
{
    $("#add_peg").modal('hide');
    $("input[type=text]").val('');
    $("input[type=hidden]").val('');
    $("input[type=number]").val('');
    $("select").val('');
    $("textarea").val('');
    $("password").val('');
}

//Active Sidebar
$("#master").addClass('active');
$("#pegawai").addClass('active');



//JS Edit
function editpegawai() {
    /*validasi();*/
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable
    var url;

    url = "<?php echo site_url('Pimpinan/pegawai_edit')?>";
    

    // ajax adding data to database

    var formData = new FormData($('#form-epegawai')[0]);
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
                $('#edit_peg').modal('hide');
                load_pegawai();
                Lobibox.notify('success', {
                    /*size: 'mini',*/
                    msg: 'Berhasil Merubah Data'
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


function load_pegawai(kd,e){
    var btn = $('#'+e);
    $.ajax({
        type: "POST",cache: false, data: 'id=' + kd,
        url: "<?php echo base_url(); ?>Pimpinan/load_pegawai",
        beforeSend: function() {btn.button('loading')},
        success: function(msg){
            $('#dt_pegawai').html(msg);
        },
        complete: function() {btn.button('reset')}
    })
}

</script>