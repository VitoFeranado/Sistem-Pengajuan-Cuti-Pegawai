<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan extends CI_Controller {

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

	public function pengajuan_cuti()
	{
		$usr = $this->session->userdata('idpeg');
		$cek = $this->db->query("SELECT * FROM vdetail_pegawai WHERE idpeg='$usr' ");
		foreach($cek->result() as $ck){
			$bag = $ck->bagian;
		}
		if($bag=='OPERASIONAL'){
			$data = array(
				'title' => 'Data Pengajuan Cuti Pegawai | Sistem Informasi Cuti Pegawai',
				'cuti' => $this->db->query("SELECT * FROM vdetail_cuti WHERE bagian='$bag' OR bagian='KKWT OPERASIONAL' AND validasi_pimpinan1='none' AND validasi_pimpinan2='none' AND jenis_karyawan='KONTRAK' "),
				'content' => 'pengajuan-cuti/pengajuan_cuti_v',
			);
		}else{
			$data = array(
				'title' => 'Data Pengajuan Cuti Pegawai | Sistem Informasi Cuti Pegawai',
				'cuti' => $this->db->query("SELECT * FROM vdetail_cuti WHERE bagian='$bag' AND validasi_pimpinan1='none' AND validasi_pimpinan2='none' AND jenis_karyawan='KONTRAK' "),
				'content' => 'pengajuan-cuti/pengajuan_cuti_v',
			);
		}
		$this->load->view('layouts/main',$data);
	}

	public function validasi_unit()
	{
		if(isset($_POST['btnSetuju'])){
			$where1['id_ambilcuti'] = $this->input->post("idcuti");
			$data1['validasi_pimpinan1'] = 'true';
			$data1['validasi_pimpinan2'] = 'true';
			$this->Allmodel->updateDataMultiField('tb_ambilcuti',$data1,$where1);
			$this->session->set_flashdata("msg","
				<div class='alert alert-success fade in'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong>Berhasil!</strong> Data berhasil divalidasi !
				</div>");
			redirect('Pimpinan/pengajuan_cuti');
		}else if(isset($_POST['btnTolak'])){
			$where2['id_ambilcuti'] = $this->input->post("idcuti");
			$data2['validasi_pimpinan1'] = 'false';
			$data1['validasi_pimpinan2'] = 'false';
			$this->Allmodel->updateDataMultiField('tb_ambilcuti',$data2,$where2);
			$this->session->set_flashdata("msg","
				<div class='alert alert-success fade in'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong>Berhasil!</strong> Data berhasil divalidasi !
				</div>");
			redirect('Pimpinan/pengajuan_cuti');
		}else{
			$this->error();
		}

	}

	public function load_cuti()
    {
    	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    		$usr = $this->session->userdata('idpeg');
			$cek = $this->db->query("SELECT * FROM vdetail_pegawai WHERE idpeg='$usr' ");
			foreach($cek->result() as $ck){
				$bag = $ck->bagian;
			}
			$data['cuti'] = $this->db->query("SELECT * FROM vdetail_cuti WHERE bagian='$bag' AND validasi_pimpinan1='none' AND validasi_pimpinan2='none' AND jenis_karyawan='KONTRAK' ");
			$this->load->view("pengajuan-cuti/pengajuan_cuti_v",$data);
		}else $this->error();
    }

	public function laporan_cuti()
	{
		$usr = $this->session->userdata('idpeg');
		$query = $this->db->query("SELECT * FROM vdetail_pegawai WHERE idpeg='$usr' ");
		foreach($query->result() as $q){
			$jabatan = $q->jabatan;
			$bagian = $q->bagian;
		}
		if($bagian=='OPERASIONAL' && $jabatan=='KEPALA UNIT'){
			$data = array(
					'title' => 'Laporan Cuti Pegawai | Sistem Informasi Cuti Pegawai',
					'bagian' => $this->db->query("SELECT * FROM tb_bagian WHERE bagian='$bagian' OR bagian='KKWT OPERASIONAL' "),
					'data_cuti' => false,
					'content' => 'lap-cuti/laporan_v',
				);
		}else if($jabatan=='KEPALA UNIT'){
			$data = array(
					'title' => 'Laporan Cuti Pegawai | Sistem Informasi Cuti Pegawai',
					'bagian' => $this->db->query("SELECT * FROM tb_bagian WHERE bagian='$bagian' "),
					'data_cuti' => false,
					'content' => 'lap-cuti/laporan_v',
				);
		}else{
			$data = array(
					'title' => 'Laporan Cuti Pegawai | Sistem Informasi Cuti Pegawai',
					'bagian' => $this->Allmodel->getAllData('tb_bagian'),
					'data_cuti' => false,
					'content' => 'lap-cuti/laporan_v',
				);
		}
		$this->load->view('layouts/main',$data);
	}

	public function filter()
	{
		if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$thn = $this->input->post('tahun');
			$bagian = $this->input->post('bagian');

			$data['data_cuti'] = $this->db->query("SELECT * FROM vdetail_cuti WHERE validasi_pimpinan1='true' AND validasi_pimpinan2='true' AND id_bagian='$bagian' AND YEAR(tgl_mulaicuti)='$thn' ");
			$this->load->view('lap-cuti/laporan_dt_v',$data);
		}else $this->error();
	}

	public function cetak_laporan()
    {   
        $this->load->library('Dompdf_gen');
        $thn = $this->input->post('tahun');
		$bagian = $this->input->post('bagian');
		$cek = $this->db->query("SELECT * FROM tb_bagian WHERE id_bagian='$bagian' ");
		foreach($cek->result() as $b){
			$nmbag = $b->bagian;
		}
        $data['title'] = 'Laporan Cuti Pegawai Tahun '.$thn;
        $data['tahun'] = $thn;
        $data['bagian'] = $nmbag;
        $judulpdf = 'LAPORAN CUTI PEGAWAI TAHUN' . $thn . 'BAGIAN' .$nmbag.  '.pdf';
        set_time_limit(1000);
        if(isset($thn)){
            $data['data_cuti'] = $this->db->query("SELECT * FROM vdetail_cuti WHERE validasi_pimpinan1='true' AND validasi_pimpinan2='true' AND id_bagian='$bagian' AND YEAR(tgl_mulaicuti)='$thn'");
        }else{
            $data['data_cuti'] = $this->db->query("SELECT * FROM vdetail_cuti WHERE validasi_pimpinan1='' AND validasi_pimpinan2='' ");
        }
        $data['kepalacabang'] = $this->db->query("SELECT * FROM vdetail_pegawai WHERE jabatan='KEPALA CABANG' ");
        $this->load->view('lap-cuti/report',$data);
        $paper_size = 'A4'; //paper size
        $orientation = 'landscape'; //tipe format kertas
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

    public function pengajuan_all()
	{
		$usr = $this->session->userdata('idpeg');
		$cek = $this->db->query("SELECT * FROM vdetail_pegawai WHERE idpeg='$usr' ");
		foreach($cek->result() as $ck){
			$bag = $ck->bagian;
		}
		$data = array(
				'title' => 'Data Pengajuan Cuti Pegawai | Sistem Informasi Cuti Pegawai',
				'cuti' => $this->db->query("SELECT * FROM vdetail_cuti WHERE validasi_pimpinan1='none' AND validasi_pimpinan2='none' AND jenis_karyawan='TETAP' "),
				'content' => 'pengajuan-cuti/pengajuan_cuti_v2',
			);
		$this->load->view('layouts/main',$data);
	}

	public function validasi_cabang()
	{
		if(isset($_POST['btnSetuju'])){
			$where1['id_ambilcuti'] = $this->input->post("idcuti");
			$data1['validasi_pimpinan1'] = 'true';
			$data1['validasi_pimpinan2'] = 'true';
			$this->Allmodel->updateDataMultiField('tb_ambilcuti',$data1,$where1);
			$this->session->set_flashdata("msg","
				<div class='alert alert-success fade in'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong>Berhasil!</strong> Data berhasil divalidasi !
				</div>");
			redirect('Pimpinan/pengajuan_all');
		}else if(isset($_POST['btnTolak'])){
			$where2['id_ambilcuti'] = $this->input->post("idcuti");
			$data2['validasi_pimpinan1'] = 'false';
			$data2['validasi_pimpinan2'] = 'false';
			$this->Allmodel->updateDataMultiField('tb_ambilcuti',$data2,$where2);
			$this->session->set_flashdata("msg","
				<div class='alert alert-success fade in'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
					<strong>Berhasil!</strong> Data berhasil divalidasi !
				</div>");
			redirect('Pimpinan/pengajuan_all');
		}else{
			$this->error();
		}

	}

	public function bagian()
	{
		$data = array(
				'title' => 'Data Bagian | Sistem Informasi Cuti Pegawai',
				'bagian' => $this->Allmodel->getAllData('tb_bagian'),
				'content' => 'kep-cabang/bagian/bagian_v',
			);
		$this->load->view('layouts/main',$data);
	}

	public function bagian_save()
	{
		if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $act = $this->input->post('action');

            if($act=='edit'){
                $where['id_bagian'] = $this->input->post('id_bagian');
                $data = array(
                    'bagian' => $this->input->post('nm_bagian'),
                );
                $this->Allmodel->updateDataMultiField('tb_bagian',$data,$where);
                echo json_encode(array("status" => 1));
            }else{
                $data = array(
                    'bagian' => $this->input->post('nm_bagian'),
                );

                $this->Allmodel->insertData('tb_bagian',$data);
                echo json_encode(array("status" => 2));
            }
        }else{
            $this->error();
        }
	}

    public function load_bagian()
    {
    	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$data['bagian'] = $this->Allmodel->getAllData('tb_bagian');
			$this->load->view("kep-cabang/bagian/bagian_dt_v",$data);
		}else $this->error();
    }

    //Controller Jabatan -START

    public function jabatan()
	{
		$data = array(
				'title' => 'Data Jabatan | Sistem Informasi Cuti Pegawai',
				'jabatan' => $this->Allmodel->getAllData('tb_jabatan'),
				'content' => 'kep-cabang/jabatan/jabatan_v',
			);
		$this->load->view('layouts/main',$data);
	}

	public function jabatan_save()
	{
		if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $act = $this->input->post('action');

            if($act=='edit'){
                $where['id_jabatan'] = $this->input->post('id_jabatan');
                $data = array(
                    'jabatan' => $this->input->post('nm_jabatan'),
                );
                $this->Allmodel->updateDataMultiField('tb_jabatan',$data,$where);
                echo json_encode(array("status" => 1));
            }else{
                $data = array(
                    'jabatan' => $this->input->post('nm_jabatan'),
                );

                $this->Allmodel->insertData('tb_jabatan',$data);
                echo json_encode(array("status" => 2));
            }
        }else{
            $this->error();
        }
	}

    public function load_jabatan()
    {
    	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$data['jabatan'] = $this->Allmodel->getAllData('tb_jabatan');
			$this->load->view("kep-cabang/jabatan/jabatan_dt_v",$data);
		}else $this->error();
    }

    //Controller Jenis CUTI
    public function jenis_cuti()
	{
		$data = array(
				'title' => 'Data Jenis Cuti | Sistem Informasi Cuti Pegawai',
				'jeniscuti' => $this->Allmodel->getAllData('tb_jeniscuti'),
				'content' => 'kep-cabang/jenis-cuti/jenis-cuti_v',
			);
		$this->load->view('layouts/main',$data);
	}

	public function load_jeniscuti()
    {
    	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$data['jeniscuti'] = $this->Allmodel->getAllData('tb_jeniscuti');
			$this->load->view("kep-cabang/jenis-cuti/jenis-cuti_dt_v",$data);
		}else $this->error();
    }

    public function jeniscuti_save()
	{
		if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $act = $this->input->post('action');

            if($act=='edit'){
                $where['id_jeniscuti'] = $this->input->post('id_jeniscuti');
                $data = array(
                    'nama_cuti' => $this->input->post('nm_jeniscuti'),
                    'batas' => $this->input->post('jml'),
                );
                $this->Allmodel->updateDataMultiField('tb_jeniscuti',$data,$where);
                echo json_encode(array("status" => 1));
            }else{
                $data = array(
                    'nama_cuti' => $this->input->post('nm_jeniscuti'),
                    'batas' => $this->input->post('jml'),
                );

                $this->Allmodel->insertData('tb_jeniscuti',$data);
                echo json_encode(array("status" => 2));
            }
        }else{
            $this->error();
        }
	}

    //Controller PEGAWAI START
    public function pegawai()
	{
		$data = array(
				'title' => 'Data Pegawai | Sistem Informasi Cuti Pegawai',
				'pegawai' => $this->db->query("SELECT * FROM vdetail_pegawai ORDER BY idpeg ASC"),
				'jabatan' => $this->Allmodel->getAllData('tb_jabatan'),
				'bagian' => $this->Allmodel->getAllData('tb_bagian'),
				'content' => 'kep-cabang/pegawai/pegawai_v',
			);
		$this->load->view('layouts/main',$data);
	}

	public function load_pegawai()
    {
    	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$data['pegawai'] = $this->db->query("SELECT * FROM vdetail_pegawai ORDER BY idpeg ASC");
			$this->load->view("kep-cabang/pegawai/pegawai_dt_v",$data);
		}else $this->error();
    }

	public function pegawai_edit()
	{
		if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$where['idpeg'] = $this->input->post('id_pegawai');
            $data = array(
                'namapeg' => $this->input->post('nm_pegawai'),
                'jenisk' => $this->input->post('jk'),
                'alamat' => $this->input->post('alamat'),
                'telp' => $this->input->post('telp'),
                'id_jabatan' => $this->input->post('jabatan'),
                'id_bagian' => $this->input->post('bagian'),
                'npp' => $this->input->post('npp'),
                'jenis_karyawan' => $this->input->post('status_kepeg'),
                'golongan_gaji' => $this->input->post('golongan'),
            );

            $this->Allmodel->updateDataMultiField('tb_pegawai',$data,$where);
            echo json_encode(array("status" => TRUE));
            
        }else{
            $this->error();
        }
	}
}