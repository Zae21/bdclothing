<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');


        $this->load->model('Kategori_barang_model');
        $this->load->model('Barang_model');
        $this->load->model('Cart_model');
    }

    function index()
    {
        $where = array('is_popular' => 1);
        $data['kategori'] = $this->Kategori_barang_model->read("","id DESC");
        $data['produk'] = $this->Barang_model->read($where,"id DESC");
        $data['produk_cart'] = $this->Cart_model->read(array("pelanggan_id" => $this->session->userdata('id_user'))
            ,"cart.id DESC");
        $data['cart'] = $this->Cart_model->countCart(array("pelanggan_id" => $this->session->userdata('id_user')),"cart.id DESC");
        // $data['view'] = "user/home";
        $this->load->view('user/home',$data);
    }
    function product(){
        // $where = array('is_popular' => 1);
        $data['kategori'] = $this->Kategori_barang_model->read("","id DESC");
        $data['produk'] = $this->Barang_model->read("","id DESC");
        $where = array('pelanggan_id' => $this->session->userdata("id_user"));
        $data['produk_cart'] = $this->Cart_model->read($where,"cart.id DESC");
        $data['cart'] = $this->Cart_model->countCart($where,"cart.id DESC");
        // $data['view'] = "user/home";
        $this->load->view('user/product',$data);
    }
    function product_kat($id){
        $where = array('kategori_barang_id' => $id);
        $data['kategori'] = $this->Kategori_barang_model->read("","id DESC");
        $data['produk'] = $this->Barang_model->read($where,"id DESC");
        // $data['view'] = "user/home";
        $this->load->view('user/product',$data);
    }
    function detail_product($id){ 
        $where = array('barang.id' => $id);
        $result = $this->Barang_model->read($where);
        $data['kategori'] = $this->Kategori_barang_model->read("","id DESC");
        $data['produk'] = $result[0];
        $this->load->view('user/detail_product',$data);

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