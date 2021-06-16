<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Pelanggan_model');
    }

    function index()
    {
        $data['result'] = $this->Pelanggan_model->read("","id DESC");
        $data['view'] = "pelanggan/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $data['view'] = "pelanggan/create";
        $data['kode_pelanggan'] = $this->Pelanggan_model->kode_pelanggan();
        $this->load->view('index', $data);
    }

    function store()
    {
        $dataStore = array(
            'id' => $this->Pelanggan_model->kode_pelanggan(),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon')
        );
        $this->Pelanggan_model->create($dataStore);

        redirect('pelanggan');
        
    }

    function edit($id)
    {
        $result = $this->Pelanggan_model->read("id = '$id'");
        $data['pelanggan'] = $result[0];
        $data['view'] = "pelanggan/edit";
        $this->load->view('index', $data);
    }

    function update($id)
    {
        $dataStore = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon')
        );

        $this->Pelanggan_model->update("id = '$id'", $dataStore);
        return redirect('pelanggan');
    }

    function delete($id)
    {
        $this->Pelanggan_model->delete("pelanggan.id = '$id'");

        redirect("pelanggan");
    }
}

?>