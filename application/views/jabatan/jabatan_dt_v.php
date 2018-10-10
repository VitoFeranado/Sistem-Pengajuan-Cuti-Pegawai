<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-hdd-o fa-fw"></i>
    <h3 class="box-title">Data Jabatan</h3>
  </div>
  <div class="box-body">
    <div class="mailbox-messages table-responsive">
      <table class="table table-bordered table-striped" id="tb_jabatan">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Nama Jabatan</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 0;
            foreach($jabatan->result() as $r1){
                $no++;
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r1->jabatan ?></td>
                <td>
                    <a title="Edit" href="javascript:;" onclick="edit('<?php echo $r1->id_jabatan ?>','<?php echo $r1->jabatan ?>')" class="btn btn-default btn-xs xtooltip"><i class="fa fa-edit"></i></a>
                    <a title="Hapus" href="javascript:;" onClick="delete_jabatan('<?php echo $r1->id_jabatan ?>')" class="btn btn-default btn-xs xtooltip" ><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php
            }
        ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.box-body -->
</div>

<script type="text/javascript">
  $(function () {
    $("#tb_jabatan").dataTable({
      "iDisplayLength": 10,
      "processing": true,
          "serverSide": true,
    });
    
    $(".grdttbl_addmenu").append('<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" id="btn_reloaddtnegara" onClick="load_jabatan(this.id)" title="Muat ulang data" class="btn btn-default btn-sm xtooltip"><i class="fa fa-refresh"></i></button>');  
    
    $('.xtooltip').tooltip(); 
  });

function edit(id,nm){
  $("#id_jabatan_").val(id);
  $("#nm_jabatan_").val(nm);
  $('#action').val('edit');
}
</script>