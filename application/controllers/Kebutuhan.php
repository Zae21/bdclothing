<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kebutuhan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Kebutuhan_model');
        $this->load->model('Barang_model');
        $this->load->model('Bahan_baku_model');
        $this->load->model('Pembelian_model');
    }

    function index()
    {
        $data['dataPengadaan'] = $this->Kebutuhan_model->readKebutuhan();
        $data['view'] = "kebutuhan/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $id = $this->Kebutuhan_model->kode_pengadaan();
        $data['view'] = "kebutuhan/create";
        $data['kode_pengadaan'] = $id;
        $data['dataDetail'] = $this->Kebutuhan_model->readDetailKebutuhan($id);
        $data['dataBahanBaku'] = $this->Bahan_baku_model->read();
        $data['dataBarang'] = $this->Barang_model->read();
        $this->load->view('index', $data);

    }

    function store()
    {
        $dataStore = array(
            'id' => $this->Kebutuhan_model->kode_pengadaan(),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon')
        );
        $this->Kebutuhan_model->create($dataStore);

        redirect('kebutuhan');
        
    }
    function generatePembelian($idtr){
        $dataset = array('is_created' => 2,
        			'status' => 1 );
        $this->db->where('id_transaksi',$idtr);
        $this->db->set($dataset);
        $this->db->update('pengadaan_barang');

        redirect('kebutuhan');
    }
    function hitungKebutuhan($idtr){
        $data['view'] = "kebutuhan/show";
        $data['dataKebutuhan'] = $this->Kebutuhan_model->hitungKebutuhan($idtr);
        $data['dataDetail'] = $this->Kebutuhan_model->readDetailKebutuhan($idtr);
        $data['pengadaan'] = $this->Kebutuhan_model->read("id_transaksi = '$idtr'")[0];
        $this->load->view('index', $data);

    }

    function edit($id)
    {
        $result = $this->Kebutuhan_model->read("id = '$id'");
        $data['kebutuhan'] = $result[0];
        $data['view'] = "pembelian/edit";
        $this->load->view('index', $data);
    }

    function show($id) 
    {
        $data['view'] = "kebutuhan/show";
        $data['dataKebutuhan'] = $this->Kebutuhan_model->hitungKebutuhan($id);
        $data['dataDetail'] = $this->Kebutuhan_model->readDetailKebutuhan($id);
        $data['pengadaan'] = $this->Kebutuhan_model->read("id_transaksi = '$id'")[0];
        $this->load->view('index', $data);
    }
    function update($id)
    {
        $dataStore = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon')
        );

        $this->Pembelian_model->update("id = '$id'", $dataStore);
        return redirect('pembelian');
    }

    function deleteitem($id,$idbr)
    {
        $this->db->from('detail_pengadaan');
        $this->db->where(array('id_transaksi' => $id, 'id_barang' => $idbr ));
        $this->db->delete();

        redirect('kebutuhan/create');
    }

    function simpanbarang()
    {
        $this->Kebutuhan_model->InsertDetail();
        redirect('kebutuhan/create');
    }

    function pembelianselesai()
    {
        $id= $this->input->post('id');
		$this->Pembelian_model->selesaiPembelian($id, $this->input->post('pemasok_id'));
        $save = array('status'=>3);
        $this->db->where('id', $id);
        $this->db->update('pembelian',$save);
	
		redirect('pembelian');
    }

    function updatestatus($id)
    {
        $this->Pembelian_model->update("id = '$id'", array('status' => 4));
        redirect('pembelian');
    }
}

?>