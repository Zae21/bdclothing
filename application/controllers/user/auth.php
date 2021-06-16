<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('form_validation');
		$this->load->model('Pelanggan_model');
	}

	public function login()
	{
        // $data['view'] = 'user/login';
		$this->load->view('user/login');
	}

	function do_login()
    {
        //ambil data dari v_login
		$username		= $this->input->post("username");
		$password		= $this->input->post("password");

		//ambil data berdasarkan where
		$where	= array(
			"username"		=> $username,
			"password"		=> $password
        );
        
		$result	= $this->Pelanggan_model->read($where);

		if(count($result) != 0) {
			$this->session->set_userdata("username",$username);
			$id_user	= $result[0]->id;
			$this->session->set_userdata("id_user",$id_user);
			$level	= $result[0]->level;
			$this->session->set_userdata("level",$level);
			redirect("user/home");

		} else {
			//feedback jika gagal
			$this->session->set_flashdata("error","username atau password salah");
			//$this->session->set_flashdata("required","Username atau Password harus di isi");
			redirect("user/auth/login");
		}
    }


    function do_register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[pelanggan.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		// $this->form_validation->set_rules('password_confirmation', 'Confirm Password', 'trim|required|matches[password]' , array('matches' => 'Password does not match.'));
	
        if ($this->form_validation->run() == false) {
            // $data['view'] = 'use/register';
            $this->load->view('user/login');
        } else {
            $dataStore  = array(
			    'id' => $this->Pelanggan_model->kode_pelanggan(),
                'nama' => $this->input->post('nama'),
                'nomor_telepon' => $this->input->post('nomor_telepon'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'level'		=> 5
            );

            $this->Pelanggan_model->create($dataStore);
            $this->session->set_flashdata('success', 'Your Account Successfull Added!');
		    redirect('user/auth/login');
        }
        
    }

    function logout()
	{
		$this->session->sess_destroy();
		redirect("user/home");
	}
}
