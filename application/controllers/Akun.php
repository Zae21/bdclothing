<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("username")) redirect("login");
		$this->load->model('Akun_model');
	}

	public function index()
	{
		$data['dataAkun'] = $this->Akun_model->read();
        $data['view'] = 'akun/index';
        $this->load->view('index', $data);
	}

	public function create()
	{
        $data['view'] = 'akun/create';
        $data['dataAkun'] = $this->Akun_model->read();
 		$this->load->view('index', $data);
	}

	public function store()
	{
		$dataStore = array(
			'kode_akun' => $this->input->post('kode_akun'),
			'nama_akun' => $this->input->post('nama_akun'),
			'header_akun' => $this->input->post('header_akun'),
		);
		$this->Akun_model->create($dataStore);

		redirect('akun');
	}

	public function edit($id)
	{
		$data['view'] = 'akun/edit';
        $data['akun'] = $this->Akun_model->read("kode_akun = '$id'")[0];
        $data['dataAkun'] = $this->Akun_model->read();
		$this->load->view('index', $data);
	}

	public function update($id)
	{	
		$dataStore = array(
			'nama_akun' => $this->input->post('nama_akun'),
			'header_akun' => $this->input->post('header_akun'),
		);
        $this->Akun_model->update("kode_akun = '$id'", $dataStore);
        
        redirect('akun');
    }
    
    public function delete($id)
    {
        $this->Akun_model->delete("id = '$id'");
        redirect('akun');
    }

	
}
