<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-hdd-o fa-fw"></i>
    <h3 class="box-title">Data Bagian</h3>
  </div>
  <div class="box-body">
    <div class="mailbox-messages table-responsive">
      <table class="table table-bordered table-striped" id="tb_bagian">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Nama Bagian</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 0;
            foreach($bagian->result() as $r1){
                $no++;
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r1->bagian ?></td>
                <td>
                    <a title="Edit" href="javascript:;" onclick="edit('<?php echo $r1->id_bagian ?>','<?php echo $r1->bagian ?>')" class="btn btn-default btn-xs xtooltip"><i class="fa fa-edit"></i></a>
                    <a title="Hapus" href="javascript:;" onClick="delete_bagian('<?php echo $r1->id_bagian ?>')" class="btn btn-default btn-xs xtooltip" ><i class="fa fa-trash"></i></a>
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
    $("#tb_bagian").dataTable({
      "iDisplayLength": 10,
      "processing": true,
          "serverSide": true,
    });
    
    $(".grdttbl_addmenu").append('<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" id="btn_reloaddtnegara" onClick="load_bagian(this.id)" title="Muat ulang data" class="btn btn-default btn-sm xtooltip"><i class="fa fa-refresh"></i></button>');  
    
    $('.xtooltip').tooltip(); 
  });

function edit(id,nm){
  $("#id_bagian_").val(id);
  $("#nm_bagian_").val(nm);
  $('#action').val('edit');
}
</script>