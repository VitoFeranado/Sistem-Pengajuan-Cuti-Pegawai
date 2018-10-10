<link href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<div id="respon1"></div>
<div class="row">
    <div id="dt_jeniscuti" class="col-md-8"><?php $this->load->view('jenis-cuti/jenis-cuti_dt_v') ?></div>
    <div id="fm_jeniscuti" class="col-md-4"><?php $this->load->view('jenis-cuti/jenis-cuti_fm_v') ?></div>
</div>
<script type="text/javascript">

function bersih()
{
    $("input[type=text]").val('');
    $("input[type=hidden]").val('');
    $("input[type=number]").val('');
}

//Active Sidebar
$("#master").addClass('active');
$("#jcuti").addClass('active');

//JS SAVE
function inc() {
    /*validasi();*/
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable
    var url;

    url = "<?php echo site_url('Admin/jeniscuti_save')?>";
    

    // ajax adding data to database

    var formData = new FormData($('#form-jcuti')[0]);
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
                load_jcuti();
                Lobibox.notify('success', {
                    /*size: 'mini',*/
                    msg: 'Berhasil Merubah Data'
                });
                bersih();                

            }
            else if(data.status==2){
                load_jcuti();
                Lobibox.notify('success', {
                    /*size: 'mini',*/
                    msg: 'Berhasil Tambah Data'
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

function delete_jcuti(id) {
    Lobibox.confirm({
        msg: "Apakah data ini akan dihapus?",
        callback: function ($this, type) {

            //Your code goes here

            if (type == 'yes') {
                $.ajax({
                    url: "<?php echo base_url()?>Admin/jeniscuti_delete/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function (data) {
                        //if success reload ajax table
                        //$('#modal_form').modal('hide');
                        load_jcuti();
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

function load_jcuti(kd,e){
    var btn = $('#'+e);
    $.ajax({
        type: "POST",cache: false, data: 'id=' + kd,
        url: "<?php echo base_url(); ?>Admin/load_jeniscuti",
        beforeSend: function() {btn.button('loading')},
        success: function(msg){
            $('#dt_jeniscuti').html(msg);
        },
        complete: function() {btn.button('reset')}
    })
}

</script>