
<div id="respon1"></div>

<div class="row">
    <div class="col-md-12">
    <div class="box box-info">
    <div class="box-header">
        <i class="fa fa-filter fa-fw"></i>
        <h3 class="box-title">Filter</h3>
    </div>
    <div class="box-body">
     <form id="form" method="post" target="_blank" action="<?php echo base_url() ?>Pimpinan/cetak_laporan">
        <div class="col-md-3">
            <div class="form-group">

                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>

                    <select class="form-control" name="bagian">
                        <option disabled>-Pilih Bagian-</option>
                        <?php
                            foreach($bagian->result() as $b){
                                echo "<option value='$b->id_bagian'>$b->bagian</option>";
                            }
                        ?>
                    </select>
                </div>
                <p class="help-block" id="error_tingkatan"></p>

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">

                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>

                    <select class="form-control" name="tahun" id="tahun_"></select>
                </div>
                <p class="help-block" id="error_tingkatan"></p>

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">

                <button id="btnrefresh" onclick="tampildata()" name="btnrefresh" type="button" class="btn btn-success"><i
                            class="fa fa-search"></i>
                    Preview
                </button>

                <button id="btncetak" type="submit" class="btn btn-success"><i
                            class="fa fa-print"></i>
                    Cetak
                </button>
            </div>
        </div>
    <!--End Filter-->
    </form>
    </div>
    </div>
    </div>
    <div id="view_dt" class="col-md-12 box_tabel"><?php $this->load->view('lap-cuti/laporan_dt_v') ?></div>
</div>

<script type="text/javascript">
    $("#lap").addClass('active');

    var start = 2017;
    var end = new Date().getFullYear();
    var options = "";
    options += "<option disabled>"+ "-Pilih Tahun-" +"</option>";
    for(var year = start ; year <=end; year++){
    options += "<option>"+ year +"</option>";
    }
  document.getElementById("tahun_").innerHTML = options;
</script>