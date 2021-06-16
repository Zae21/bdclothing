<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriBarang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Kategori_barang_model');
    }

    function index()
    {
        $data['result'] = $this->Kategori_barang_model->read("","id DESC");
        $data['view'] = "kategori_barang/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $data['view'] = "kategori_barang/create";
        $data['kode_kategori_barang'] = $this->Kategori_barang_model->kode_kategori_barang();
        $this->load->view('index', $data);
    }

    function store()
    {

        $this->Kategori_barang_model->create();

        redirect('kategoribarang');
        
    }

    function edit($id)
    {
        $result = $this->Kategori_barang_model->read("id = '$id'");
        $data['kategoriBarang'] = $result[0];
        $data['kode_kategori_barang'] = $this->Kategori_barang_model->kode_kategori_barang();
        $data['view'] = "kategori_barang/edit";
        $this->load->view('index', $data);
    }

    function update($id)
    {

        $this->Kategori_barang_model->update("id = '$id'");
        return redirect('kategoribarang');
    }

    function delete($id)
    {
        $this->Kategori_barang_model->delete("kategori_barang.id = '$id'");

        redirect("kategoribarang");
    }
}

?>