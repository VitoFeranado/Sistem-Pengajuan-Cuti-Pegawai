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
<?php
    foreach($pegawai->result() as $p){
        $nama = $p->namapeg;
        $jabatan = $p->jabatan;
        $bagian = $p->bagian;
        $npp = $p->npp;
        $nohp = $p->telp;
    }

    foreach($ambilcuti->result() as $c){
        $jeniscuti = $c->nama_cuti;
        $jmlam = $c->jml_diambil;
        $almt_cuti = $c->alamat_selamacuti;
        $daritgl = $c->tgl_mulaicuti;
        $selesaitgl = $c->tgl_akhircuti;
        $dari = date('d',strtotime($daritgl));
        $thn_skrng = date('Y',strtotime($daritgl));
    }

    //Tahun Ini
    /*foreach($tahun_ini->result() as $i){
        $sisa_thn_ini = $i->batas - $i->jml_diambil;
    }*/
    //$tgl2 = date('Y-m-d', strtotime('+6 days', strtotime($tgl1)));
?>
<table width="100%" border="0">
    <tbody>
    <tr>
        <td width="30%">&nbsp;</td>
        <td width="30%">&nbsp;</td>
        <td>
            <span>Bandar Lampung, <?php echo tgl_indo(date('Y-m-d')) ?></span><br>
            <p>Kepada Yth :</p><br>
            <p>Bapak Kepala</p><br>
            <p>Perum Jamkrindo</p><br>
            <p>Kantor Cabang Bandar Lampung</p><br>
            <p>di -</p><br>
            <p>&nbsp;&nbsp;Tempat</p><br>

        </td>
    </tr>
    </tbody>
</table>
<br>
<table width="100%" border="0">
    <tbody>
        <tr>
            <td width="40%">Yang bertanda tangan di bawah ini, </td>
            <td></td>
        </tr>
        <tr>
            <td width="40%">Nama</td>
            <td>: <?php echo $nama ?></td>
        </tr>
        <tr>
            <td width="40%">Unit Kerja</td>
            <td>: <?php echo "Perum Jamkrindo Cabang Bandar Lampung" ?></td>
        </tr>
    </tbody>
</table>
<br><br>
<table width="100%" border="0">
    <tbody>
        <tr>
            <td>
            <span style="text-align: justify;">Dengan ini mengajukan permohonan <?php echo $jeniscuti ?> <?php echo $jmlam ?> (<?php echo terbilang($jmlam) ?>) hari yaitu tanggal <?php echo $dari ?> sampai dengan <?php echo tgl_indo($selesaitgl) ?> (<?php echo $jmlam ?> (<?php echo terbilang($jmlam) ?>) hari kerja).<br> Alamat saya selama cuti adalah di <?php echo $almt_cuti ?>. Nomor HP : <?php echo $nohp ?>. Sehingga dapat dihubungi sewaktu-waktu dan memberikan keterangan atau datang ke kantor apabila diperlukan.</span>
            </td>
            <br>
        </tr>
        <tr>
            <td>
            <span>Demikian disampaikan. Atas perhatian dan perkenaan Bapak diucapkan terima kasih.</span>
            </td>
        </tr>
    </tbody>
</table>
<br>
<table width="100%" border="0">
    <tbody>
        <tr>
            <td width="80%" style="text-align: center">&nbsp;</td>
            <td>
                <span>Hormat Saya,</span><br><br><br>
                <p><strong><u><?php echo $nama ?></u></strong></p>
            </td>
        </tr>
    </tbody>
</table>
<br><br>
<table width="100%" style="border: 1px solid #FFFFFF;">
<tbody>
    <tr>
        <td style="border-bottom:hidden;" width="45%">
            <p>CATATAN PEJABAT BAGIAN</p><br>
            <p><?php echo strtoupper($bagian) ?></p><br>
            <p>Cuti yang telah diambil dalam tahun Bersangkutan :</p><br>
            <p>&nbsp;</p>
        </td>
        <td style="border-bottom:hidden;"></td>
        <td style="border-bottom:hidden;" width="45%">
            <p align="center">PERTIMBANGAN ATASAN LANGSUNG :</p><br>
            <p align="center"><?php echo $valstuju1 ?>SETUJU<?php echo $valstuju2 ?> / <?php echo $valstdktuju1 ?>TIDAK SETUJU<?php echo $valstdktuju2 ?> *)</p>
        </td>
    </tr>
</tbody>
</table>
<table width="100%" style="border: 1px solid #FFFFFF;">
<tbody>
    <tr>
        <td style="border-top:hidden;" width="45%">1. Cuti Tahunan (<?php echo $thn_skrng ?>)</td>
        <td style="border-top:hidden;">: <?php echo $jml ?> hari</td>
        <td style="border-top:hidden;" width="45%">&nbsp;</td>
    </tr>
    <tr>
        <td style="border-top:hidden;" width="45%">2. Cuti Besar</td>
        <td style="border-top:hidden;">: <?php echo $besar ?> hari</td>
        <td style="border-top:hidden;" width="45%">&nbsp;</td>
    </tr>
   <!-- <tr>
        <td style="border-top:hidden;" width="45%">3. Cuti Sakit</td>
        <td style="border-top:hidden;">: <?php //echo $sakit ?> hari</td>
        <td align="center" style="border-top:hidden;" width="45%"></td>
    </tr>
	-->
    <tr>
        <td style="border-top:hidden;" width="45%">3. Cuti Bersalin</td>
        <td style="border-top:hidden;">: <?php echo $bersalin ?> hari</td>
        <td align="center" style="border-top:hidden;" width="45%"><strong><u><?php echo $atasan2 ?></u></strong></td>
    </tr>
    <tr>
        <td style="border-top:hidden;" width="45%">4. Cuti Khusus</td>
        <td style="border-top:hidden;">: <?php echo $khusus ?> hari</td>
        <td align="center" style="border-top:hidden;" width="45%"><?php echo ucwords($posisi2) ?></td>
    </tr>
    <tr>
        <td style="border-top:hidden;" width="45%">5. Cuti diluar tanggungan Perusahaan</td>
        <td style="border-top:hidden;">: <?php echo $luar ?> hari</td>
        <td style="border-top:hidden;" width="45%">&nbsp;</td>
    </tr>
    <tr>
        <td style="border-top:hidden;" width="45%">6. Keterangan Lain-lain</td>
        <td style="border-top:hidden;">: <?php echo $lain ?> hari</td>
        <td align="center" style="border-top:hidden;" width="45%">&nbsp;</td>
    </tr>
    <tr>
        <td style="border-top:hidden;" width="45%">7. Sisa Cuti Tahun <?php echo $thn_skrng ?></td>
        <td style="border-top:hidden;">: <?php echo $sisa_thn_ini ?> hari</td>
        <td align="center" width="45%">&nbsp;</td>
    </tr>
    <tr>
        <td style="border-top:hidden;" width="45%">8. Sisa Cuti Tahun <?php echo $tahunkem ?></td>
        <td style="border-top:hidden;">: <?php echo $sisa_thn_kemarin ?> hari</td>
        <td align="center" style="border-top:hidden;" width="45%">MENGETAHUI,</td>
    </tr>
    <tr>
        <td style="border-top:hidden;" width="45%">9. Sisa Cuti Tahun <?php echo $tahun_kemarinnya ?></td>
        <td style="border-top:hidden;" >: <?php echo $sisa_thn_kemarinnya ?> hari</td>
        <td style="border-top:hidden;" width="45%">&nbsp;</td>
    </tr>
    <tr>
        <td style="border-top:hidden;" width="45%">10. Cuti <?php echo $thn_skrng ?> yang sudah diambil</td>
        <td style="border-top:hidden;" >: <?php if(($yg_udah_diambil - $jml)<=0){echo "..";}else{ echo $yg_udah_diambil - $jml; } ?> hari</td>
        <td style="border-top:hidden;" width="45%">&nbsp;</td>
    </tr>
    <tr>
        <td width="45%" style="border-top:hidden;">
            <table border="0" width="100%" style="border: hidden">
                <tbody>
                    <tr>
                        <td style="border:hidden" width="30%">Tanggal</td>
                        <td style="border:hidden">: <?php echo tgl_indo(date('Y-m-d')) ?></td>
                    </tr>
                    <tr>
                        <td style="border:hidden">&nbsp;</td>
                        <td style="border:hidden">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="border:hidden">&nbsp;</td>
                        <td style="border:hidden">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2" style="border:hidden"><u><?php echo $nm_opr ?></u></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2" style="border:hidden"><?php echo ucwords($bag_opr) ?></td>
                    </tr>
                </tbody>
            </table>
        </td>
        <td style="border-top:hidden;">&nbsp;</td>
        <td style="border-top:hidden;" width="45%"><br><br><br>
            <table border="0" width="100%" style="border: hidden">
                <tbody>
                    <tr>
                        <td align="center" style="border:hidden">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" style="border:hidden"><strong><u><?php echo $atasan1 ?></u></strong></td>
                    </tr>
                    <tr>
                        <td align="center" style="border:hidden"><?php echo ucwords($posisi1) ?></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</tbody>
</table>
</body>
</html>