<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bom extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        if(!$this->session->userdata("username")) redirect("login");

        $this->load->model('Bom_model');
        $this->load->model('Bahan_baku_model');
        $this->load->model('Barang_model');
        $this->load->model('Detail_bom_model');
    }

    function index()
    {
        $data['result'] = $this->Bom_model->read("","id DESC");
        $data['view'] = "bom/index";
        $this->load->view('index', $data);
    }

    function create()
    {
        $data['view'] = "bom/create";
        $data['dataBahanBaku'] = $this->Bahan_baku_model->read("","id DESC");
        $data['kode_bom'] = $this->Bom_model->kode_bom();
        $data['dataBarang'] = $this->Barang_model->read("","id DESC");
        $this->load->view('index', $data);
    }

    function store()
    {
        // $query = $this->db->get_where('bom', array('barang_id' => $this->input->post('barang_id')))->row;
        $this->db->where('barang_id', $this->input->post('barang_id'));
        $num = $this->db->count_all_results('bom');
        if ($num == 0) {
            $kodeBom = $this->Bom_model->kode_bom();
            $dataStore = array(
                'id' => $kodeBom,
                'barang_id' => $this->input->post('barang_id'),
            );
            
            $this->Bom_model->create($dataStore);

            for($i = 0; $i < count($this->input->post('bahan_baku_id')); $i++) {
                $datadetailBom = array(
                    'bom_id' => $kodeBom,
                    'bahan_baku_id' => $this->input->post('bahan_baku_id')[$i],
                    'satuan' => $this->input->post('satuan')[$i],
                    'komposisi' => $this->input->post('komposisi')[$i],
                    'keterangan' => $this->input->post('keterangan')[$i]
                );
                
                $this->Detail_bom_model->create($datadetailBom);
            }

            redirect('bom');
        }else{
            $this->session->set_flashdata('error_msg', 'BOM untuk barang '.$this->input->post('barang_id').' sudah ada di database!');
            redirect('bom/create');
        }
        
    }

    function edit($id)
    {
        $result = $this->Bom_model->read("bom.id = '$id'");
        $data['bom'] = $result[0];
        $data['dataBahanBaku'] = $this->Bahan_baku_model->read("","id DESC");
        $data['dataDetailBom'] = $this->Detail_bom_model->read("bom_id = '$id'");
        $data['dataBarang'] = $this->Barang_model->read("","id DESC");
        $data['view'] = "bom/edit";
        $this->load->view('index', $data);
    }

    function update($id)
    {
        $this->Detail_bom_model->delete("bom_id = '$id'");
        for($i = 0; $i < count($this->input->post('bahan_baku_id')); $i++) {
            if(!empty($this->input->post('bahan_baku_id')[$i]) && !empty($this->input->post('satuan')[$i]) && !empty($this->input->post('komposisi')[$i])) {
                $datadetailBom = array(
                    'bom_id' => $id,
                    'bahan_baku_id' => $this->input->post('bahan_baku_id')[$i],
                    'satuan' => $this->input->post('satuan')[$i],
                    'komposisi' => $this->input->post('komposisi')[$i],
                    'keterangan' => $this->input->post('keterangan')[$i]
                );
                
                $this->Detail_bom_model->create($datadetailBom);
            }
        }
        return redirect('bom');
    }

    function delete($id)
    {
        $this->Bom_model->delete("bom.id = '$id'");

        redirect("bom");
    }
}

?>