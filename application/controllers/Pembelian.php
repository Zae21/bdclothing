<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Pembelian_model');
        $this->load->model('Pemasok_model');
        $this->load->model('Bahan_baku_model');
        $this->load->model('Kebutuhan_model');
    }
    private $idpg;
    function index()
    {
        $data['dataPembelian'] = $this->Pembelian_model->readPembelian();
        $data['view'] = "pembelian/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $idPesanan = $this->input->get('pengadaan_id', TRUE);
        if($idPesanan) {
            $data['dataDetailPengadaan'] = $this->Kebutuhan_model->readDetailKebutuhan($idPesanan);
            $data['pengadaan'] = $this->Kebutuhan_model->read("id_transaksi = '$idPesanan'")[0];
            $data['dataKebutuhan'] = $this->Kebutuhan_model->hitungKebutuhanBeli($idPesanan);
        } else {
            $data['dataDetailPengadaan'] = null;
            $data['pengadaan'] = null;
            $data['dataKebutuhan'] = null;
        }

        $data['dataPengadaan'] = $this->Kebutuhan_model->readPengadaan("pengadaan_barang.status = 1");
        $id = $this->Pembelian_model->kode_pembelian();
        $data['view'] = "pembelian/create";
        $data['kode_pembelian'] = $id;
        $data['dataDetail'] = $this->Pembelian_model->readDetailPembelian($id);
        $data['dataBahanBaku'] = $this->Bahan_baku_model->read();
        $data['dataPemasok'] = $this->Pemasok_model->read();
        $this->load->view('index', $data);

    }

    function store()
    {
        $dataStore = array(
            'id' => $this->Pembelian_model->kode_pembelian(),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'nomor_telepon' => $this->input->post('nomor_telepon')
        );
        $this->Pembelian_model->create($dataStore);

        redirect('pembelian');
        
    }

    function edit($id)
    {
        $result = $this->Pembelian_model->read("id = '$id'");
        $data['pembelian'] = $result[0];
        $data['view'] = "pembelian/edit";
        $this->load->view('index', $data);
    }

    function show($id) 
    {
        $data['dataDetail'] = $this->Pembelian_model->readDetailPembelian($id);
        $data['pembelian'] = $this->Pembelian_model->read("id = '$id'")[0];
        $data['view'] = "pembelian/show";
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

    function deleteitem($id)
    {
        $this->db->from('detail_pembelian');
        $this->db->where("id = '$id'");
        $this->db->delete();

        redirect('pembelian/create');
    }

    function simpanbarang()
    {
        $this->Pembelian_model->InsertDetail();
        redirect('pembelian/create');
    }

    function pembelianselesai($idpg)
    {
        $id = $this->Pembelian_model->kode_pembelian();
        $bb = $this->Kebutuhan_model->hitungKebutuhanBeli($idpg);
         foreach($bb as $a) {
                $datadetailBom = array(
                    'pembelian_id' => $id,
                    'bahan_baku_id' => $a->id_bahan,
                    'harga_satuan' => $a->harga_satuan,
                    'jumlah_pembelian' => $a->jumlah_kebutuhan,
                    'sub_total' => $a->harga_satuan*$a->jumlah_kebutuhan
                );
                
                $this->Pembelian_model->createFromPengadaan($datadetailBom);
            }

		$this->Pembelian_model->selesaiPembelian($id, $this->input->post('pemasok_id'),$idpg);
        $save = array('status'=>3);
        $this->db->where('id', $id);
        $this->db->update('pembelian',$save);

        $save = array('status'=>2);
        $this->db->where('id_transaksi', $idpg);
        $this->db->update('pengadaan_barang',$save);


        $nominal = $this->Pembelian_model->getTotalTransaksi($id);
        // $this->Keuangan_model->generateJurnal('112', $id, 'debet', $nominal);
        // $this->Keuangan_model->generateJurnal('111', $id, 'kredit', $nominal);
	
		redirect('pembelian');
    }

    function updatestatus($id)
    {
        $this->Pembelian_model->update("id = '$id'", array('status' => 4));
        redirect('pembelian');
    }
}

?>