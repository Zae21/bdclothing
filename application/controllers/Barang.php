<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Barang_model');
        $this->load->model('Kategori_barang_model');
    }

    function index()
    {
        $data['result'] = $this->Barang_model->read("","id DESC");
        $data['view'] = "barang/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $data['view'] = "barang/create";
        $data['dataKategoriBarang'] = $this->Kategori_barang_model->read("","id DESC");
        $data['kode_barang'] = $this->Barang_model->kode_barang();
        $this->load->view('index', $data);
    }

    function store()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|is_unique[barang.nama_barang]');
        $this->form_validation->set_rules('kategori_barang_id', 'Kategori Barang', 'required');
        $this->form_validation->set_rules('harga_jual_satuan', 'Harga Jual', 'required');
        $this->form_validation->set_rules('harga_produk_satuan', 'Harga Beli', 'required');
            
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>', '</li></div>');
        if ($this->form_validation->run() == TRUE){
            $dataStore = array(
                'id' => $this->Barang_model->kode_barang(),
                'nama_barang' => $this->input->post('nama_barang'),
                'kategori_barang_id' => $this->input->post('kategori_barang_id'),
                'harga_jual_satuan' => $this->input->post('harga_jual_satuan'),
                'harga_produk_satuan' => $this->input->post('harga_produk_satuan'),
                'is_popular' => $this->input->post('is_popular'),
                'stok'  => 0,

            );
            $this->session->set_flashdata('error_msg', 'Data gagal disimpan.');
            redirect('barang');
        }else{
            $this->session->set_flashdata('success_msg', 'Data berhasil disimpan.');
            redirect('create');
        }
        
    }

    function edit($id)
    {
        $result = $this->Barang_model->read("barang.id = '$id'");
        $data['barang'] = $result[0];
        $data['view'] = "barang/edit";
        $data['dataKategoriBarang'] = $this->Kategori_barang_model->read("","id DESC");
        $this->load->view('index', $data);
    }

    function update($id)
    {

        $dataStore = array(
            'nama_barang' => $this->input->post('nama_barang'),
            'kategori_barang_id' => $this->input->post('kategori_barang_id'),
            'harga_jual_satuan' => $this->input->post('harga_jual_satuan'),
            'harga_produk_satuan' => $this->input->post('harga_produk_satuan'),
            'is_popular' => $this->input->post('is_popular')
        );

        $this->Barang_model->update("id = '$id'", $dataStore);
        return redirect('barang');
    }

    function delete($id)
    {
        $this->Barang_model->delete("barang.id = '$id'");

        redirect("barang");
    }
}

?>