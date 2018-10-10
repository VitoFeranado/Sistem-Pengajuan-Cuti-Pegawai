<div class="row">
    <div class="col-md-5">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h1 class="text-center">
                    <i class="fa fa-clock-o"></i>
                    <?php
                    date_default_timezone_set("Asia/Jakarta");
                    echo date('h:i');
                    $a = date("H");
                    ?>
                </h1>
                <h5 class="text-center">
                    <?php
                    if (($a >= 6) && ($a <= 11)) {
                        echo "<b> Selamat Pagi</b>";
                    } else if (($a > 11) && ($a <= 15)) {
                        echo " Selamat Pagi";
                    } else if (($a > 15) && ($a <= 18)) {
                        echo "Selamat Siang";
                    } else {
                        echo "<b> Selamat Malam </b>";
                    }
                    echo '<br/>';
                    /* script menentukan hari */

                    $array_hr = array(1 => "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
                    $hr = $array_hr[date('N')];

                    /* script menentukan tanggal */
                    $tgl = date('j');
                    /* script menentukan bulan */
                    $array_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                    $bln = $array_bln[date('n')];
                    /* script menentukan tahun */
                    $thn = date('Y');
                    /* script perintah keluaran*/
                    echo '<i class="fa fa-calendar"></i> ' . $hr . ", " . $tgl . " " . $bln . " " . $thn;
                    ?>
                </h5>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-user"></i> User Login :</strong>
                <br/>
                <?php echo $this->session->userdata('username') ?>
                <br/><br/>
                <strong><i class="fa fa-level"></i>Level Login :</strong>
                <br/>
                <?php echo $this->session->userdata('level') ?>
                <br/><br/>
                <strong><i class="fa fa-info-circle"></i> Nama Aplikasi :</strong>
                <br/>
                <?php echo "SISTEM PENGAJUAN CUTI PEGAWAI" ?>
                <br/><br/>
                <strong><i class="fa fa-university"></i> Nama Perusahaan :</strong>
                <br/>
                <?php echo "PERUM JAMKRINDO CABANG BANDAR LAMPUNG" ?>
                <br/><br/>
                <strong><i class="fa fa-internet-explorer"></i>Info Akses </strong>
                <br/>
                <?php
                $ip_address = $_SERVER['REMOTE_ADDR'];
                $info = $_SERVER['HTTP_USER_AGENT'];
                echo '<strong>IP</strong> : ' . $ip_address . '<br/> <strong>Browser</strong> : ' . $info ?>;
                <br/>
            </div>
        </div>
    </div>

    <!--SEBELAH KANAN-->
    <div class="col-md-7">

        <div class="box box-warning">
            <div class="box-header with-border">
                <div class="box-body">
                <!--Pegawai-->
                    <div class="info-box bg-red">
                      <span class="info-box-icon"><i class="fa fa-user"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text"><strong>JUMLAH PEGAWAI</strong></span>
                        <span class="info-box-number"><i><?php echo $pegawai ?> (<?php echo terbilang($pegawai) ?>)</i></span>
                        <div class="progress">
                          <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                          &nbsp;
                        </span>
                      </div>
                    </div>

                <!--Jabatan-->
                    <div class="info-box bg-yellow">
                      <span class="info-box-icon"><i class="fa fa-recycle"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text"><strong>JUMLAH JABATAN</strong></span>
                        <span class="info-box-number"><i><?php echo $jabatan ?> (<?php echo terbilang($jabatan) ?>)</i></span>
                        <div class="progress">
                          <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                          &nbsp;
                        </span>
                      </div>
                    </div>

                <!--Bagian-->
                    <div class="info-box bg-green">
                      <span class="info-box-icon"><i class="fa fa-briefcase"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text"><strong>JUMLAH BAGIAN</strong></span>
                        <span class="info-box-number"><i><?php echo $bagian ?> (<?php echo terbilang($bagian) ?>)</i></span>
                        <div class="progress">
                          <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                          &nbsp;
                        </span>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $("#beranda").addClass('active');
</script>