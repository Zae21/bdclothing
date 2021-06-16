<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
		
        $this->load->model("Login_model");
    }

    function index()
    {
        $this->load->view("login/index");
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
		$this->load->model("Login_model");
		$result	= $this->Login_model->read($where);

		if(count($result) != 0) {
			$this->session->set_userdata("username",$username);
			$id_user	= $result[0]->id;
			$this->session->set_userdata("id_user",$id_user);

			$level	= $result[0]->level;
			$this->session->set_userdata("level",$level);

			redirect("dashboard");

		} else {
			//feedback jika gagal
			$this->session->set_flashdata("error","username atau password salah");
			//$this->session->set_flashdata("required","Username atau Password harus di isi");
			redirect("login");
		}
    }

    function logout()
	{
		$this->session->sess_destroy();
		redirect("login");
	}
}
?>