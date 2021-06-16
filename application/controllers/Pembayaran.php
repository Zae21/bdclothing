<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Pembayaran_model');
        $this->load->model('Kategori_beban_model');
        $this->load->model('Barang_model');
        $this->load->model('Keuangan_model');
    }

    function index()
    {
        $data['dataPembayaran'] = $this->Pembayaran_model->readData();
        $data['view'] = "pembayaran/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $id = $this->Pembayaran_model->kode();
        $data['view'] = "pembayaran/create";
        $data['kode_pembayaran'] = $id;
        $data['dataKategori'] = $this->Kategori_beban_model->read("","id DESC");
        $this->load->view('index', $data);

    }

    function store()
    {
        $id = $this->input->post('id_pembayaran');
        $nominal = $this->input->post('total_transaksi');
        $kategori = $this->input->post('id_kategori_beban');
        $no_akun = $this->Pembayaran_model->getNoAkun($kategori);
        $dataStore = array(
            'id_pembayaran' => $id,
            'tgl_transaksi' => date('Y-m-d'),
            'id_kategori_beban' => $kategori,
            'total_transaksi' => $nominal
        );
        $this->Pembayaran_model->create($dataStore);

        $data = array(
            'id'                => $id,
            'tanggal_transaksi' => date('Y-m-d'),
            'total_transaksi'   => $nominal
        );
        $this->Pembayaran_model->setTransaksi($data);

        //generate jurnal
        $this->Keuangan_model->generateJurnal($no_akun, $id, 'debet', $nominal);
        $this->Keuangan_model->generateJurnal('111', $id, 'kredit', $nominal);

        redirect('pembayaran');
        
    }
}

?>