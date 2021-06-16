<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pemb_modal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Pemb_modal_model');
        $this->load->model('Keuangan_model');
    }

    function index()
    {
        $data['dataModal'] = $this->Pemb_modal_model->readData();
        $data['view'] = "per_modal/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $id = $this->Pemb_modal_model->kode();
        $data['view'] = "per_modal/create";
        $data['kode_modal'] = $id;
        $this->load->view('index', $data);

    }

    function store()
    {
        $id = $this->input->post('id_modal');
        $nominal = $this->input->post('total_transaksi');
        $ket = $this->input->post('keterangan');
        $dataStore = array(
            'id_modal' => $id,
            'tgl_transaksi' => date('Y-m-d'),
            'total_transaksi' => $nominal,
            'keterangan'    => $ket
        );
        $this->Pemb_modal_model->create($dataStore);

        $data = array(
            'id'                => $id,
            'tanggal_transaksi' => date('Y-m-d'),
            'total_transaksi'   => $nominal
        );
        $this->Pemb_modal_model->setTransaksi($data);

        $no_akun = $this->Pemb_modal_model->setNoAkun($ket);
        //generate jurnal
        if ($no_akun == 311) {
            $this->Keuangan_model->generateJurnal('111', $id, 'debet', $nominal);
            $this->Keuangan_model->generateJurnal($no_akun, $id, 'kredit', $nominal);
        }elseif ($no_akun == 312) {
            $this->Keuangan_model->generateJurnal($no_akun, $id, 'debet', $nominal);
            $this->Keuangan_model->generateJurnal('111', $id, 'kredit', $nominal);
        }

        $this->session->set_flashdata('success_msg', 'Data Berhasil Disimpan.');
        redirect('Pemb_modal');
        
    }
}

?>