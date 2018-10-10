<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Allmodel');
        if($this->session->userdata('username')==""){
            redirect('Login');
        }
    }

	public function error()
	{
		$this->load->view('index.html');
	}

	public function data_cuti()
	{
    $usr = $this->session->userdata('idpeg');
		$data = array(
				'title' => 'Data Pengajuan Cuti Pegawai | Sistem Informasi Cuti Pegawai',
				//'cuti' => $this->Allmodel->getAllData('vdetail_cuti'),
        'cuti' => $this->db->query("SELECT * FROM vdetail_cuti WHERE idpeg='$usr' ORDER BY id_ambilcuti DESC"),
				'content' => 'ajukan/ajukan_v',
			);
		$this->load->view('layouts/main',$data);
	}

	public function ajukan_cuti()
	{
    error_reporting();
		$idpeg = $this->session->userdata('idpeg');
		$data = array(
				'title' => 'Form Pengajuan Cuti Pegawai | Sistem Informasi Cuti Pegawai',
				'jeniscuti' => $this->Allmodel->getAllData('tb_jeniscuti'),
				'pegawai' => $this->db->query("SELECT * FROM tb_pegawai WHERE idpeg='$idpeg' "),
				'content' => 'ajukan/ajukan_fm_v',
			);
		$this->load->view('layouts/main',$data);
	}

	public function pengajuan_simpan()
	{
		if(isset($_POST) ){
			$idpeg = $this->input->post('idpeg');
      $thn = date('Y');
			$cek = $this->db->query("SELECT * FROM tb_ambilcuti WHERE id_peg='$idpeg' AND validasi_pimpinan1='none' AND validasi_pimpinan2='none' ");
			if($cek->num_rows() > 0){
				echo "<div class='alert alert-warning fade in'>
                        <a href='#' class='close' data-dismiss='alert'>&times;</a>
                        <strong>Gagal!</strong> Tidak dapat memproses data, pengajuan cuti dalam proses!
                    </div>";
			}else{
				$mulai = $this->input->post('tgl_mulai');
				//$selesai = $this->input->post('tgl_selesai');
				$jencuti = $this->input->post('jenis_cuti');
				$ceklagi = $this->db->query("SELECT * FROM tb_jeniscuti WHERE id_jeniscuti='$jencuti' ");
				foreach($ceklagi->result() as $jc){
					$namacuti = $jc->nama_cuti;
          $bat = $jc->batas;
				}
				$idpeg = $this->input->post('id_pegawai');
				$cekpegawai = $this->db->query("SELECT * FROM tb_pegawai WHERE idpeg='$idpeg' ");
				foreach($cekpegawai->result() as $p){
					$jk = $p->jenisk;
					$status = $p->jenis_karyawan;
				}

				if($namacuti=='Cuti Bersalin' && $jk=='L'){
					echo "<div class='alert alert-warning fade in'>
                        <a href='#' class='close' data-dismiss='alert'>&times;</a>
                        <strong>Gagal!</strong> Anda seorang pria, tidak dapat mengambil cuti hamil!
                    </div>";
				}else{
          $cek_cutinya = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='$namacuti' GROUP BY tahun");
          if($cek_cutinya->num_rows()>0){
            foreach($cek_cutinya->result() as $ct){
                $jmlnya = $ct->jumlahambil;
            }
            if($bat<>0){
              if($jmlnya>$bat){
                echo "<div class='alert alert-warning fade in'>
                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
                            <strong>Gagal!</strong> jatah ".$namacuti." Telah Habis, silahkan ambil cuti lainnya!
                        </div>";
              }else{
                $idpeg = $this->input->post('id_pegawai');
                $jeniscuti = $this->input->post('jenis_cuti');
                $jml_diambil = $this->input->post('jml');
                $jm = $jml_diambil - 1;
                $tgl = date('Y-m-d',strtotime($mulai));
                $alamat = $this->input->post('alamat');

                //$this->Allmodel->insertData('tb_ambilcuti',$data);
                $this->db->query("INSERT INTO tb_ambilcuti (id_peg,id_jeniscuti,jml_diambil,tgl_mulaicuti,tgl_akhircuti,alamat_selamacuti) VALUES('$idpeg','$jeniscuti','$jml_diambil','$tgl','$tgl'+INTERVAL $jm DAY,'$alamat')  ");
                echo "<div class='alert alert-success fade in'>
                      <a href='#' class='close' data-dismiss='alert'>&times;</a>
                      <strong>Berhasil!</strong> Berhasil Mengisi Form Cuti!
                  </div>";
              }
            }else{
                $idpeg = $this->input->post('id_pegawai');
                $jeniscuti = $this->input->post('jenis_cuti');
                $jml_diambil = $this->input->post('jml');
                $jm = $jml_diambil - 1;
                $tgl = date('Y-m-d',strtotime($mulai));
                $alamat = $this->input->post('alamat');

                $this->db->query("INSERT INTO tb_ambilcuti (id_peg,id_jeniscuti,jml_diambil,tgl_mulaicuti,tgl_akhircuti,alamat_selamacuti) VALUES('$idpeg','$jeniscuti','$jml_diambil','$tgl','$tgl'+INTERVAL $jm DAY,'$alamat')  ");
                echo "<div class='alert alert-success fade in'>
                      <a href='#' class='close' data-dismiss='alert'>&times;</a>
                      <strong>Berhasil!</strong> Berhasil Mengisi Form Cuti!
                  </div>";
            }
          }else{   
              $jmlnya = 0;         
              if($bat<>0){
                if($jmlnya>$bat){
                  echo "<div class='alert alert-warning fade in'>
                              <a href='#' class='close' data-dismiss='alert'>&times;</a>
                              <strong>Gagal!</strong> jatah ".$namacuti." Telah Habis, silahkan ambil cuti lainnya!
                          </div>";
                }else{
			            $idpeg = $this->input->post('id_pegawai');
                  $jeniscuti = $this->input->post('jenis_cuti');
                  $jml_diambil = $this->input->post('jml');
                  $jm = $jml_diambil - 1;
                  $tgl = date('Y-m-d',strtotime($mulai));
                  $alamat = $this->input->post('alamat');

  		            //$this->Allmodel->insertData('tb_ambilcuti',$data);
                  $this->db->query("INSERT INTO tb_ambilcuti (id_peg,id_jeniscuti,jml_diambil,tgl_mulaicuti,tgl_akhircuti,alamat_selamacuti) VALUES('$idpeg','$jeniscuti','$jml_diambil','$tgl','$tgl'+INTERVAL $jm DAY,'$alamat')  ");
                  echo "<div class='alert alert-success fade in'>
                        <a href='#' class='close' data-dismiss='alert'>&times;</a>
                        <strong>Berhasil!</strong> Berhasil Mengisi Form Cuti!
                    </div>";
                }
              }else{
                  $idpeg = $this->input->post('id_pegawai');
                  $jeniscuti = $this->input->post('jenis_cuti');
                  $jml_diambil = $this->input->post('jml');
                  $jm = $jml_diambil - 1;
                  $tgl = date('Y-m-d',strtotime($mulai));
                  $alamat = $this->input->post('alamat');

                  $this->db->query("INSERT INTO tb_ambilcuti (id_peg,id_jeniscuti,jml_diambil,tgl_mulaicuti,tgl_akhircuti,alamat_selamacuti) VALUES('$idpeg','$jeniscuti','$jml_diambil','$tgl','$tgl'+INTERVAL $jm DAY,'$alamat')  ");
                  echo "<div class='alert alert-success fade in'>
                        <a href='#' class='close' data-dismiss='alert'>&times;</a>
                        <strong>Berhasil!</strong> Berhasil Mengisi Form Cuti!
                    </div>";
              }
          }//end cek_cutinya
	      }
      }
            
    }else{
        $this->error();
    }
	}

	public function load_datacuti()
    {
    	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$data['cuti'] = $this->Allmodel->getAllData('vdetail_cuti');
			$this->load->view("ajukan/ajukan_dt_v",$data);
		}else $this->error();
    }

    public function cetak()
    {   
    	$id = $this->input->post('idcuti');
    	$idpeg = $this->input->post('idpeg');
      $cut = $this->input->post('jencut');
        $this->load->library('Dompdf_gen');
        
        $judulpdf = 'SURAT CUTI PEGAWAI.pdf';
        set_time_limit(1000);
        $data['title'] = 'Cetak Surat Cuti Pegawai';
        $data['pegawai'] = $this->db->query("SELECT * FROM vdetail_pegawai WHERE idpeg='$idpeg' ");
        $data['ambilcuti'] = $this->db->query("SELECT * FROM vdetail_cuti WHERE id_ambilcuti='$id' ");
        $cekdata = $this->db->query("SELECT * FROM vdetail_cuti WHERE idpeg='$idpeg' AND nama_cuti='$cut' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' ORDER BY id_ambilcuti DESC LIMIT 1");
        $setuju = $this->db->query("SELECT * FROM vdetail_cuti WHERE id_ambilcuti='$id' ");
        foreach($setuju->result() as $stj){
        	$vali1 = $stj->validasi_pimpinan1;
        	$vali2 = $stj->validasi_pimpinan2;
        }
        if($vali1=='true' && $vali2=='true'){
        	$data['valstuju1'] = '';
        	$data['valstuju2'] = '';
        	$data['valstdktuju1'] = '<s>';
        	$data['valstdktuju2'] = '</s>';

        	$data['pvalstuju1'] = '';
        	$data['pvalstuju2'] = '';
        	$data['pvalstdktuju1'] = '<s>';
        	$data['pvalstdktuju2'] = '</s>';
        }else if($vali1=='true' && $vali2=='false'){
        	$data['valstuju1'] = '';
        	$data['valstuju2'] = '';
        	$data['valstdktuju1'] = '<s>';
        	$data['valstdktuju2'] = '</s>';

        	$data['pvalstuju1'] = '<s>';
        	$data['pvalstuju2'] = '</s>';
        	$data['pvalstdktuju1'] = '';
        	$data['pvalstdktuju2'] = '';
        }else if($vali1=='true' && $vali2=='none'){
        	$data['valstuju1'] = '';
        	$data['valstuju2'] = '';
        	$data['valstdktuju1'] = '<s>';
        	$data['valstdktuju2'] = '</s>';

        	$data['pvalstuju1'] = '<s>';
        	$data['pvalstuju2'] = '</s>';
        	$data['pvalstdktuju1'] = '';
        	$data['pvalstdktuju2'] = '';
        }else{
        	$data['valstuju1'] = '<s>';
        	$data['valstuju2'] = '</s>';
        	$data['valstdktuju1'] = '';
        	$data['valstdktuju2'] = '';

        	$data['pvalstuju1'] = '<s>';
        	$data['pvalstuju2'] = '</s>';
        	$data['pvalstdktuju1'] = '';
        	$data['pvalstdktuju2'] = '';
        }

        foreach($cekdata->result() as $ck){
        	$thn = date('Y',strtotime($ck->tgl_mulaicuti));
        	$jenis_kar = $ck->jenis_karyawan;
        	$bg = $ck->bagian;
          $jencutii = $ck->nama_cuti;
          $jmlahnyadiambil = $ck->jml_diambil;
        }

        if($jencutii=='Cuti Tahunan'){
          $data['jml'] = $jmlahnyadiambil;
        }else{
          $data['jml'] = '..';
        }
        
        //Cuti Tahunan
       	$thnkmren = $thn-1;
       	$thnkmrennya = $thn-2;
       	$data['tahunkem'] = $thnkmren;
       	$data['tahun_kemarinnya'] = $thnkmrennya;
       	//$data['tahun_ini'] = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Tahunan' GROUP BY tahun");

        $tahun_saiki = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Tahunan' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
        if($tahun_saiki->num_rows>0){
          foreach($tahun_saiki->result() as $saiki){
            $data['sisa_thn_ini'] = $saiki->batas - $saiki->jumlahambil;
          }
        }else{
          $data['sisa_thn_ini'] = '..';
        }

        $sekarang = $this->db->query("SELECT * FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Tahunan' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' ");
        $jumlahdata = $sekarang->num_rows();
        $jmdat = intval($jumlahdata)-1;
        $data['jmdat']=$jumlahdata;
        if($jmdat<=0){
          $sekarangini = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Tahunan' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
          $data['yg_udah_diambil'] = 0;
        }else{
          $sekarangini = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Tahunan' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun LIMIT $jmdat");
          if($sekarangini->num_rows()>0){
            foreach($sekarangini->result() as $skr){
              $data['yg_udah_diambil'] = $skr->jumlahambil;

            }
          }else{
            $data['yg_udah_diambil'] = 0;
          }
        }

        

       	$tahun_kemarin = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thnkmren' AND nama_cuti='Cuti Tahunan' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
       	if($tahun_kemarin->num_rows()>0){
       		foreach($tahun_kemarin->result() as $kem){
       			$data['sisa_thn_kemarin'] = $kem->batas - $kem->jumlahambil;
       		}
       	}else{
       		$data['sisa_thn_kemarin'] = '..';
       	}
       	$tahun_kemarinnya = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thnkmrennya' AND nama_cuti='Cuti Tahunan' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
       	if($tahun_kemarinnya->num_rows()>0){
       		foreach($tahun_kemarinnya->result() as $nya){
       			$data['sisa_thn_kemarinnya'] = $nya->batas - $nya->jumlahambil;
       		}
       	}else{
       		$data['sisa_thn_kemarinnya'] = '..';
       	}

       	//Cuti Besar
       	$besar = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Besar' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
       	if($besar->num_rows()>0){
       		foreach($besar->result() as $bes){
       			$data['besar'] = $bes->jumlahambil;
       		}
       	}else{
       		$data['besar'] = '..';
       	}

       	//Cuti Sakit
       	$sakit = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Sakit' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
       	if($sakit->num_rows()>0){
       		foreach($sakit->result() as $sak){
       			$data['sakit'] = $sak->jumlahambil;
       		}
       	}else{
       		$data['sakit'] = '..';
       	}

       	//Cuti Bersalin
       	$bersalin = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Bersalin' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
       	if($bersalin->num_rows()>0){
       		foreach($bersalin->result() as $bers){
       			$data['bersalin'] = $bers->jumlahambil;
       		}
       	}else{
       		$data['bersalin'] = '..';
       	}

       	//Cuti Khusus
       	$khusus = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Khusus' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
       	if($khusus->num_rows()>0){
       		foreach($khusus->result() as $kh){
       			$data['khusus'] = $kh->jumlahambil;
       		}
       	}else{
       		$data['khusus'] = '..';
       	}

       	//Cuti Luar
       	$luar = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti diluar tanggungan Perusahaan' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
       	if($luar->num_rows()>0){
       		foreach($luar->result() as $lu){
       			$data['luar'] = $lu->jumlahambil;
       		}
       	}else{
       		$data['luar'] = '..';
       	}

       	//Keterangan Lain - Lain
       	$lain = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Keterangan Lain-lain' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
       	if($lain->num_rows()>0){
       		foreach($lain->result() as $la){
       			$data['lain'] = $la->jumlahambil;
       		}
       	}else{
       		$data['lain'] = '..';
       	}

       	//Tetap dan tidak tetap -> perbedaan
       	if($jenis_kar=='TETAP'){
        	$atasan = $this->db->query("SELECT * FROM vdetail_pegawai WHERE jabatan='KEPALA CABANG' LIMIT 1 ");
        	foreach($atasan->result() as $ats){
        		$data['atasan1'] = $ats->namapeg;
        		$data['posisi1'] = strtolower($ats->jabatan);
        		$data['atasan2'] = $ats->namapeg;
        		$data['posisi2'] = strtolower($ats->jabatan);
        	}
          $this->load->view('cetak_tetap',$data);
        }else if($jenis_kar=='KONTRAK'){
        	$atasan = $this->db->query("SELECT * FROM vdetail_pegawai WHERE jabatan='KEPALA CABANG' LIMIT 1 ");
        	foreach($atasan->result() as $ats){
        		$data['atasan1'] = $ats->namapeg;
        		$data['posisi1'] = strtolower($ats->jabatan);
        	}
        	$atasan2 = $this->db->query("SELECT * FROM vdetail_pegawai WHERE jabatan='KEPALA UNIT' AND bagian='$bg' LIMIT 1 ");
        	foreach($atasan2->result() as $ats2){
        		$data['atasan2'] = $ats2->namapeg;
        		$data['posisi2'] = strtolower($ats2->jabatan);
        	}

          //Pejabat Operasional
          $operasional = $this->db->query("SELECT * FROM vdetail_pegawai WHERE jabatan='STAFF' AND bagian='OPERASIONAL' LIMIT 1 ");
          foreach($operasional->result() as $opr){
            $data['nm_opr'] = $opr->namapeg;
            $data['bag_opr'] = strtolower($opr->jabatan.' '.$opr->bagian);
          }
        $this->load->view('cetak_kontrak',$data);
        }

        //$data['all_cuti'] = $this->db->query("SELECT * FROM t")
        //$this->load->view('cetak_tetap',$data);
        $paper_size = 'A4'; //paper size
        $orientation = 'potrait'; //tipe format kertas
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $canvas = $this->dompdf->get_canvas();
        $font = Font_Metrics::get_font("helvetica", "italic");
        /*$canvas->page_text(16, 570, "Halaman: {PAGE_NUM} dari {PAGE_COUNT}", $font, 6, array(0, 0, 0));*/
        $this->dompdf->stream($judulpdf, array('Attachment' => 0));

    }

    public function batalkan($id)
    {
        $data['id_ambilcuti'] = $id;
        $this->Allmodel->deleteData('tb_ambilcuti',$data);
        echo json_encode(array("status" => TRUE));
    }
}