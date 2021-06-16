<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriBeban extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Kategori_beban_model');
    }

    function index()
    {
        $data['result'] = $this->Kategori_beban_model->read("","id DESC");
        $data['view'] = "kategori_beban/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $data['view'] = "kategori_beban/create";
        $data['kode_kategori_beban'] = $this->Kategori_beban_model->kode_kategori_beban();
        $this->load->view('index', $data);
    }

    function store()
    {
        $dataStore = array(
            'id' => $this->Kategori_beban_model->kode_kategori_beban(),
            'nama_kategori' => $this->input->post('nama_kategori')
        );
        $this->Kategori_beban_model->create($dataStore);

        redirect('kategoribeban');
        
    }

    function edit($id)
    {
        $result = $this->Kategori_beban_model->read("id = '$id'");
        $data['kategoriBeban'] = $result[0];
        $data['view'] = "kategori_beban/edit";
        $this->load->view('index', $data);
    }

    function update($id)
    {
        $dataStore = array('nama_kategori' => $this->input->post('nama_kategori'));

        $this->Kategori_beban_model->update("id = '$id'", $dataStore);
        return redirect('kategoribeban');
    }

    function delete($id)
    {
        $this->Kategori_beban_model->delete("kategori_beban.id = '$id'");

        redirect("kategoribeban");
    }
}

?>