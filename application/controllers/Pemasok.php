<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Pemasok_model');
    }

    function index()
    {
        $data['result'] = $this->Pemasok_model->read("","id DESC");
        $data['view'] = "pemasok/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $data['view'] = "pemasok/create";
        $data['kode_pemasok'] = $this->Pemasok_model->kode_pemasok();
        $this->load->view('index', $data);
    }

    function store()
    {
        $dataStore = array(
            'id' => $this->Pemasok_model->kode_pemasok(),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon')
        );
        $this->Pemasok_model->create($dataStore);

        redirect('pemasok');
        
    }

    function edit($id)
    {
        $result = $this->Pemasok_model->read("id = '$id'");
        $data['pemasok'] = $result[0];
        $data['view'] = "pemasok/edit";
        $this->load->view('index', $data);
    }

    function update($id)
    {
        $dataStore = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon')
        );

        $this->Pemasok_model->update("id = '$id'", $dataStore);
        return redirect('pemasok');
    }

    function delete($id)
    {
        $this->Pemasok_model->delete("pemasok.id = '$id'");

        redirect("pemasok");
    }
}

?>