<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/*
	  @author : thonie
	*/
class Login_m extends CI_Model {

	public function log($usr,$psw)
	{
		$u = $usr;
        $p = md5($psw);
		$q_cek_login = $this->db->get_where('tb_admin', array('username' => $u));
		$q_cek_loginpeg = $this->db->get_where('tb_pegawai', array('username' => $u));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
				$pw=$qck->password;
				if($qck->username==$u && $pw==$p)
				{
					if ($qck->level=='admin') {
						$qcek = $this->db->get_where('tb_admin', array('username' => $u ));
						foreach ($qcek->result() as $sess) {
							$sess_data['logged_in'] = 'admin ok';
							$sess_data['username'] = $sess->username;
							$sess_data['nama'] = $sess->nama;
							$sess_data['level'] = $sess->level;
							$this->session->set_userdata($sess_data);
						}
						header('location:'.base_url().'Admin');
					}
					else
					{
						$this->session->set_flashdata("notif","
							<div class='alert alert-warning fade in'>
								<a href='#' class='close' data-dismiss='alert'>&times;</a>
								<strong>Failed!</strong> Username atau Password Salah !
							</div>");
						header('location:'.base_url().'Login');
					}
                }else
				{
					$this->session->set_flashdata("notif","
							<div class='alert alert-warning fade in'>
								<a href='#' class='close' data-dismiss='alert'>&times;</a>
								<strong>Failed!</strong> Username atau Password Salah !
							</div>");
					header('location:'.base_url().'Login');
				}
			}
		}
		
		elseif(count($q_cek_loginpeg->result())>0)
		{
			foreach($q_cek_loginpeg->result() as $qck1)
			{
				$pw=$qck1->password;
				if($qck1->username==$u && $pw==$p)
				{
					$qcek1 = $this->db->get_where('vdetail_pegawai', array('username' => $u ));
					foreach ($qcek1->result() as $sess1) {
						$sess_data['logged_in'] = 'pegawai ok';
						$sess_data['nama'] = $sess1->namapeg;
						$sess_data['username'] = $sess1->username;
						$sess_data['idpeg'] = $sess1->idpeg;
						$sess_data['level'] = $sess1->jabatan;
						$this->session->set_userdata($sess_data);
					}
					header('location:'.site_url('Admin'));
                }else
				{
					$this->session->set_flashdata("msg","
							<div class='alert alert-warning fade in'>
								<a href='#' class='close' data-dismiss='alert'>&times;</a>
								<strong>Failed!</strong> Username atau Password Salah !
							</div>");
					header('location:'.base_url('Login'));
				}
			}
		}
		else
		{
			$this->session->set_flashdata("notif","
					<div class='alert alert-warning fade in'>
						<a href='#' class='close' data-dismiss='alert'>&times;</a>
						<strong>Failed!</strong> Username atau Password Salah !
					</div>");
			header('location:'.base_url().'Login');
		}
	}

}