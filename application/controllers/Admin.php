<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Allmodel');
        if($this->session->userdata('username')==""){
            redirect('Login');
        }
    }

	public function index()
	{
		$this->beranda();
	}

	public function beranda()
	{
        $level = $this->session->userdata('level');
        $idpeg = $this->session->userdata('idpeg');
        $thn = date('Y');
        $thnkmren = $thn-1;
        $thnkmrennya = $thn-2;
        $data['thn_ini'] = $thn;
        $data['thn_kmren'] = $thnkmren;
        $data['thn_kmrennya'] = $thnkmrennya;
        if($level<>'admin' && $level<>'KEPALA CABANG' && $level<>'KEPALA UNIT' ){
            //tahunan sekarang
            $jeniscuti = $this->db->query("SELECT * FROM tb_jeniscuti WHERE nama_cuti='Cuti Tahunan' ");
            foreach($jeniscuti->result() as $cok){
                $batas = $cok->batas;
            }

            $thnan = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Tahunan' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
            if($thnan->num_rows()>0){
                foreach($thnan->result() as $nan){
                    $data['sudahambil'] = $nan->jumlahambil;
                    $data['sisa_thn_ini'] = $batas - $nan->jumlahambil;
                }
            }else{
                $data['sudahambil'] = 0;
                $data['sisa_thn_ini'] = 0;
            }

            $thnankemarin = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thnkmren' AND nama_cuti='Cuti Tahunan' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
            if($thnankemarin->num_rows()>0){
                foreach($thnankemarin->result() as $kmr){
                    $data['sisa_thn_kmr'] = $batas - $kmr->jumlahambil;
                }
            }else{
                $data['sisa_thn_kmr'] = 0;
            }

            $thnankemarinnya = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thnkmrennya' AND nama_cuti='Cuti Tahunan' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
            if($thnankemarinnya->num_rows()>0){
                foreach($thnankemarinnya->result() as $kmrnya){
                    $data['sisa_thn_kmrnya'] = $batas - $kmrnya->jumlahambil;
                }
            }else{
                $data['sisa_thn_kmrnya'] = 0;
            }

            //Cuti Besar
            $besar = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Besar' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
            if($besar->num_rows()>0){
                foreach($besar->result() as $bes){
                    $data['besar'] = $bes->jumlahambil;
                }
            }else{
                $data['besar'] = 0;
            }

            //Cuti Sakit
            $sakit = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Sakit' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
            if($sakit->num_rows()>0){
                foreach($sakit->result() as $sak){
                    $data['sakit'] = $sak->jumlahambil;
                }
            }else{
                $data['sakit'] = 0;
            }

            //Cuti Bersalin
            $bersalin = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Bersalin' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
            if($bersalin->num_rows()>0){
                foreach($bersalin->result() as $bers){
                    $data['bersalin'] = $bers->jumlahambil;
                }
            }else{
                $data['bersalin'] = 0;
            }

            //Cuti Khusus
            $khusus = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti Khusus' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
            if($khusus->num_rows()>0){
                foreach($khusus->result() as $kh){
                    $data['khusus'] = $kh->jumlahambil;
                }
            }else{
                $data['khusus'] = 0;
            }

            //Cuti Luar
            $luar = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Cuti diluar tanggungan Perusahaan' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
            if($luar->num_rows()>0){
                foreach($luar->result() as $lu){
                    $data['luar'] = $lu->jumlahambil;
                }
            }else{
                $data['luar'] = 0;
            }

            //Keterangan Lain - Lain
            $lain = $this->db->query("SELECT vdetail_cuti.*, YEAR(vdetail_cuti.`tgl_mulaicuti`) AS tahun, SUM(jml_diambil) AS jumlahambil FROM vdetail_cuti WHERE idpeg='$idpeg' AND YEAR(tgl_mulaicuti)='$thn' AND nama_cuti='Keterangan Lain-lain' AND validasi_pimpinan1='true' AND validasi_pimpinan2='true' GROUP BY tahun");
            if($lain->num_rows()>0){
                foreach($lain->result() as $la){
                    $data['lain'] = $la->jumlahambil;
                }
            }else{
                $data['lain'] = 0;
            }

            $pegawai = $this->Allmodel->getAllData('tb_pegawai');
            $bagian = $this->Allmodel->getAllData('tb_bagian');
            $jabatan = $this->Allmodel->getAllData('tb_jabatan');
            $data['title'] = 'Sistem Informasi Cuti Pegawai';
                    $data['pegawai'] = $pegawai->num_rows();
                    $data['bagian'] = $bagian->num_rows();
                    $data['jabatan'] = $jabatan->num_rows();
                    $data['content'] = 'dashboard/dashboard_v';
        }else{
            $data[''] = '';
            $pegawai = $this->Allmodel->getAllData('tb_pegawai');
            $bagian = $this->Allmodel->getAllData('tb_bagian');
            $jabatan = $this->Allmodel->getAllData('tb_jabatan');
    				$data['title'] = 'Sistem Informasi Cuti Pegawai';
                    $data['pegawai'] = $pegawai->num_rows();
                    $data['bagian'] = $bagian->num_rows();
                    $data['jabatan'] = $jabatan->num_rows();
    				$data['content'] = 'dashboard/dashboard_v2';
        }
		$this->load->view('layouts/main',$data);
	}

	//Controller Bagian START

	public function bagian()
	{
		$data = array(
				'title' => 'Data Bagian | Sistem Informasi Cuti Pegawai',
				'bagian' => $this->Allmodel->getAllData('tb_bagian'),
				'content' => 'bagian/bagian_v',
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

	public function bagian_delete($id)
    {
        $data['id_bagian'] = $id;
        $this->Allmodel->deleteData('tb_bagian',$data);
        echo json_encode(array("status" => TRUE));
    }

    public function load_bagian()
    {
    	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$data['bagian'] = $this->Allmodel->getAllData('tb_bagian');
			$this->load->view("bagian/bagian_dt_v",$data);
		}else $this->error();
    }

    //Controller Jabatan -START

    public function jabatan()
	{
		$data = array(
				'title' => 'Data Jabatan | Sistem Informasi Cuti Pegawai',
				'jabatan' => $this->Allmodel->getAllData('tb_jabatan'),
				'content' => 'jabatan/jabatan_v',
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

	public function jabatan_delete($id)
    {
        $data['id_jabatan'] = $id;
        $this->Allmodel->deleteData('tb_jabatan',$data);
        echo json_encode(array("status" => TRUE));
    }

    public function load_jabatan()
    {
    	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$data['jabatan'] = $this->Allmodel->getAllData('tb_jabatan');
			$this->load->view("jabatan/jabatan_dt_v",$data);
		}else $this->error();
    }

    //Controller Jenis CUTI
    public function jenis_cuti()
	{
		$data = array(
				'title' => 'Data Jenis Cuti | Sistem Informasi Cuti Pegawai',
				'jeniscuti' => $this->Allmodel->getAllData('tb_jeniscuti'),
				'content' => 'jenis-cuti/jenis-cuti_v',
			);
		$this->load->view('layouts/main',$data);
	}

	public function load_jeniscuti()
    {
    	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$data['jeniscuti'] = $this->Allmodel->getAllData('tb_jeniscuti');
			$this->load->view("jenis-cuti/jenis-cuti_dt_v",$data);
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

	public function jeniscuti_delete($id)
    {
        $data['id_jeniscuti'] = $id;
        $this->Allmodel->deleteData('tb_jeniscuti',$data);
        echo json_encode(array("status" => TRUE));
    }

    //Controller PEGAWAI START
    public function pegawai()
	{
		$data = array(
				'title' => 'Data Pegawai | Sistem Informasi Cuti Pegawai',
				//'pegawai' => $this->Allmodel->getAllData('vdetail_pegawai'),
                'pegawai' => $this->db->query("SELECT * FROM vdetail_pegawai ORDER BY idpeg ASC"),
				'jabatan' => $this->Allmodel->getAllData('tb_jabatan'),
				'bagian' => $this->Allmodel->getAllData('tb_bagian'),
				'content' => 'pegawai/pegawai_v',
			);
		$this->load->view('layouts/main',$data);
	}

	public function load_pegawai()
    {
    	if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$data['pegawai'] = $this->db->query("SELECT * FROM vdetail_pegawai ORDER BY idpeg ASC");
			$this->load->view("pegawai/pegawai_dt_v",$data);
		}else $this->error();
    }

    public function pegawai_simpan()
	{
		if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $username = $this->input->post('usr');
            $data = array(
                'idpeg' => $this->input->post('id_pegawai'),
                'namapeg' => $this->input->post('nm_pegawai'),
                'jenisk' => $this->input->post('jk'),
                'alamat' => $this->input->post('alamat'),
                'telp' => $this->input->post('telp'),
                'id_jabatan' => $this->input->post('jabatan'),
                'id_bagian' => $this->input->post('bagian'),
                'npp' => $this->input->post('npp'),
                'password' => md5($this->input->post('pw')), 
                'jenis_karyawan' => $this->input->post('status_kepeg'),
                'golongan_gaji' => $this->input->post('golongan'),
                'username' => $username,
            );

            $cek = $this->db->query("SELECT * FROM tb_pegawai WHERE username='$username' ");
            if($cek->num_rows()>0){
                echo json_encode(array("status" => 1));
            }else{
                $this->Allmodel->insertData('tb_pegawai',$data);
                echo json_encode(array("status" => 2));
            }
        }else{
            $this->error();
        }
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

	public function pegawai_delete($id)
    {
        $data['idpeg'] = $id;
        $this->Allmodel->deleteData('tb_pegawai',$data);
        echo json_encode(array("status" => TRUE));
    }

    public function error()
    {
        $this->load->view('index.html');
    }

    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('Login');
    }

    public function akun_pengguna()
    {
        $data = array(
                'title' => 'Manajemen Akun Pengguna | Sistem Informasi Cuti Pegawai',
                'akun' => $this->Allmodel->getAllData('tb_admin'),
                'content' => 'akun/akun_v',
            );
        $this->load->view('layouts/main',$data);
    }

    public function load_akun()
    {
        if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $data['akun'] = $this->Allmodel->getAllData('tb_admin');
            $this->load->view("akun/akun_dt_v",$data);
        }else $this->error();
    }

    public function akun_ubah()
    {
        if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $where['username'] = $this->input->post('usr');
            $data = array(
                'nama' => $this->input->post('nm'),
                'password' => md5($this->input->post('pw')),
            );

            $this->Allmodel->updateDataMultiField('tb_admin',$data,$where);
            echo json_encode(array("status" => TRUE));
            
        }else{
            $this->error();
        }
    }

    public function akun_tambah()
    {
        if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $data = array(
                'nama' => $this->input->post('nm'),
                'username' => $this->input->post('usr'),
                'level' => $this->input->post('lev'),
                'password' => md5($this->input->post('pw')),
            );

            $this->Allmodel->insertData('tb_admin',$data);
            echo json_encode(array("status" => TRUE));
            
        }else{
            $this->error();
        }
    }

    public function akun_hapus($id)
    {
        $data['username'] = $id;
        $this->Allmodel->deleteData('tb_admin',$data);
        echo json_encode(array("status" => TRUE));
    }

    public function fm_ubahpw()
    {
        $data = array(
                'title' => 'Ubah Password Pengguna | Sistem Informasi Cuti Pegawai',
                'content' => 'profil',
            );
        $this->load->view('layouts/main',$data);
    }

    public function ubahpassword()
    {
        if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
            $level = $this->session->userdata('level');
            $pw1 = $this->input->post('reg_password');
            $pw2 = $this->input->post('reg_repassword');
            $where['username'] = $this->input->post('reg_uname');  
            if($pw1<>$pw2){
                echo json_encode(array("status" => 1));    
            }else{
                $data = array(
                    'password' => md5($pw1),
                );
                if($level=='admin'){  
                    $this->Allmodel->updateDataMultiField('tb_admin',$data,$where);     
                }else{
                    $this->Allmodel->updateDataMultiField('tb_pegawai',$data,$where);    
                }    
                echo json_encode(array("status" => 2));
            }           
            
        }else{
            $this->error();
        }
    }

}
