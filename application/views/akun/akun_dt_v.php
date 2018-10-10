<a onclick="add()" class="btn btn-primary btn-xs xtooltip"><i class="fa fa-plus fa-fw"></i> <strong><i>Tambah Akun</i></strong></a>

<div class="box box-info">
  <div class="box-header">
    <i class="fa fa-hdd-o fa-fw"></i>
    <h3 class="box-title">Data Akun Pengguna</h3>
  </div>
  <div class="box-body">
    <div class="mailbox-messages table-responsive">
      <table class="table table-bordered table-striped" id="tb_jabatan">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Level User</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 0;
            foreach($akun->result() as $r1){
                $no++;
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $r1->nama ?></td>
                <td><?php echo $r1->username ?></td>
                <td><?php echo $r1->level ?></td>
                <td>
                    <a title="Edit" href="javascript:;" data-toggle="modal" data-target="#akun_peg" onclick="edittl('<?php echo $r1->nama ?>','<?php echo $r1->username ?>','<?php echo $r1->level ?>')" class="btn btn-default btn-xs xtooltip"><i class="fa fa-pencil"></i> Ubah</a>
                    <a title="Hapus" href="javascript:;" onclick="akun_hapus('<?php echo $r1->username ?>')" class="btn btn-default btn-xs xtooltip"><i class="fa fa-trash"></i> Hapus</a>
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

function edittl(nm,usr,lev){
  $("#nm_").val(nm);
  $('#usr_').val(usr);
  $('#lev_').val('admin');
}

function add(){
  $('#akun_add').modal('show');
  $('#level_').val('admin');
}

function resik()
{   
    $("#akun_add").modal('hide');
    $("input[type=text]").val('');
    $("input[type=password]").val('');
    $("input[type=hidden]").val('');
}
</script>