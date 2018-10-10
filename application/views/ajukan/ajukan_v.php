<link href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<div id="respon1"></div>
<div class="row">
    <div id="dt_ajukan" class="col-md-12"><?php $this->load->view('ajukan/ajukan_dt_v') ?></div>
</div>
<script type="text/javascript">

function bersih()
{
    $("input[type=text]").val('');
    $("input[type=hidden]").val('');
}

//Active Sidebar
$("#cuti").addClass('active');
$("#datacuti").addClass('active');

//JS SAVE

function load_cuti(kd,e){
    var btn = $('#'+e);
    $.ajax({
        type: "POST",cache: false, data: 'id=' + kd,
        url: "<?php echo base_url(); ?>Pegawai/load_datacuti",
        beforeSend: function() {btn.button('loading')},
        success: function(msg){
            $('#dt_ajukan').html(msg);
        },
        complete: function() {btn.button('reset')}
    })
}

</script>