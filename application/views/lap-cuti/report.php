<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?></title>
    <style type="text/css">
        #outtable {
            padding: 20px;
            border: 1px solid #e3e3e3;
            width: 100%;
            border-radius: 5px;
        }

        .short {
            width: 25px;
        }

        .normal {
            width: 50px;
        }

        .lebar {
            width: 100px;
        }

        p {
            line-height: 0.5;
            font-family: Helvetica;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /*font-family: Arial Narrow;
			src: url('ARIALN.TTF');*/
            font-family: Helvetica;
            font-size: 10pt;
            color: #5E5B5C;
            /*margin: 0 auto;*/
        }

        table td {
            border: 1px solid #C3B8B8;
            padding: 3px;
            vertical-align: middle;
        }

        thead th {
            border: 1px solid #FFFFFF;
            padding: 3px;
            font-weight: bold;
            text-align: center;
            background-color: #525659;
            color: #FFFFFF;
        }

        tfoot td {
            border: 0px solid #FFFFFF;
            padding: 3px;
            vertical-align: middle;
        }

    </style>
</head>
<body>
<table width="100%" border="0">
    <tbody>
    <tr>
        <td width="75px"><img src="assets/dist/img/lg.png" width="75"> &nbsp;</td>
        <th align="center" valign="middle" style="font-family: 'Arial Narrow'; color: #000000;">
            <p align="center" style="font-size:18px">LAPORAN CUTI PEGAWAI</p>
            <p align="center" style="font-size:20px">PERUM JAMKRINDO CABANG BANDAR LAMPUNG</p>
            <p align="center">TAHUN <?php echo $tahun ?> BAGIAN <?php echo $bagian ?></p>
            <p align="center">Jl. Teuku Umar No. 10 EF, Penengahan, Tanjung Karang Pusat, Bandarlampung 35112</p>
        </th>
        <td width="75px">&nbsp;</td>
    </tr>
    </tbody>
</table>
<hr>
<br>
<table width="100%" align="center">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Pegawai</th>
            <th>Nama Pegawai</th>
            <th>Jenis Kelamin</th>
            <th>Bagian</th>
            <th>Jabatan</th>
            <th>No.Telp</th>
            <th>Jenis Cuti</th>
            <th>Mulai Cuti</th>
            <th>Selesai Cuti</th>
        </tr>
    </thead>
    <tbody>
      <?php
            if($data_cuti){
              $no=0;
              foreach($data_cuti->result() as $r){
                $no++;             
                 $jk = "Laki-Laki";
                    if($r->jenisk=='P')$jk = "Perempuan";   
          ?>
           <tr>
              <td align="center"><?php echo $no ?></td>
              <td><?php echo $r->idpeg ?></td>
              <td><?php echo $r->namapeg ?></td>
              <td><?php echo $jk ?></td>
              <td><?php echo $r->bagian ?></td>
              <td><?php echo $r->jabatan ?></td>
              <td><?php echo $r->telp ?></td>
              <td><?php echo $r->nama_cuti ?></td>
              <td><?php echo tgl_indo($r->tgl_mulaicuti) ?></td>
              <td><?php echo tgl_indo($r->tgl_akhircuti) ?></td>
           </tr> 
          <?php
              }
            }else{
              echo "No Data Found";
            }
          ?>
    </tbody>
    <tfoot>
    <?php
        foreach($kepalacabang->result() as $k){
            $jabatan = strtolower($k->jabatan);
            $nama = $k->namapeg;
            $npp = $k->npp;
        }
    ?>
        <tr>
            <td colspan="7">&nbsp;</td>
            <td colspan="3">
                <p>Bandarlampung, <?php echo tgl_indo(date('Y-m-d')); ?></p>
                <br>
                <p><?php echo ucwords($jabatan) ?></p>
                <br><br><br><br><br>
                <p><strong><u><?php echo $nama ?></u></strong></p>
                <p>NPP : <?php echo $npp ?></p>
            </td>
        </tr>
    </tfoot>
</table>

</body>
</html>