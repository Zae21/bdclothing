<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BahanBaku extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Bahan_baku_model');
    }

    function index()
    {
        $data['result'] = $this->Bahan_baku_model->read("","id DESC");
        $data['view'] = "bahan_baku/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $data['view'] = "bahan_baku/create";
        $data['kode_bahan_baku'] = $this->Bahan_baku_model->kode_bahan_baku();
        $this->load->view('index', $data);
    }

    function store()
    {
        $dataStore = array(
            'id' => $this->Bahan_baku_model->kode_bahan_baku(),
            'nama_bahan_baku' => $this->input->post('nama_bahan_baku'),
            'satuan' => $this->input->post('satuan'),
            'harga_satuan' => $this->input->post('harga_satuan')
        );
        $this->Bahan_baku_model->create($dataStore);

        redirect('bahanbaku');
        
    }

    function edit($id)
    {
        $result = $this->Bahan_baku_model->read("id = '$id'");
        $data['bahanbaku'] = $result[0];
        $data['view'] = "bahan_baku/edit";
        $this->load->view('index', $data);
    }

    function update($id)
    {
        $dataStore = array(
            'nama_bahan_baku' => $this->input->post('nama_bahan_baku'),
            'satuan' => $this->input->post('satuan'),
            'harga_satuan' => $this->input->post('harga_satuan')
        );

        $this->Bahan_baku_model->update("id = '$id'", $dataStore);
        return redirect('bahanbaku');
    }

    function delete($id)
    {
        $this->Bahan_baku_model->delete("bahan_baku.id = '$id'");

        redirect("bahanbaku");
    }
}

?>