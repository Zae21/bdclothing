<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class order extends CI_Controller
{
    private $url = "https://api.rajaongkir.com/starter/province";
    private $apiKey ="06f733d57836ad591770ec596340cf7f";
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('Kategori_barang_model');
        $this->load->model('Barang_model');
        $this->load->model('Cart_model');
        $this->load->model('order_model');

        if(!$this->session->userdata("username")) redirect("user/auth/login");
        if($this->session->userdata("level") != 5) {
            $this->session->sess_destroy();
            redirect("user/auth/login");
        }
    }

    function index()
    {
        // $where = array('pelanggan_id' => $this->session->userdata("id_user"), 'status'=>3);
        $data['kategori'] = $this->Kategori_barang_model->read("","id DESC");
        $data['produk'] = $this->Cart_model->readlog(array('pelanggan_id' => $this->session->userdata("id_user"), 'status'=>3),"logcart.id DESC");
        $data['cart'] = $this->Cart_model->countCart(array('pelanggan_id' => $this->session->userdata("id_user")),"cart.id DESC");
        $data['order'] = $this->order_model->read(array('id_pelanggan' => $this->session->userdata("id_user")),"penjualan_online.id DESC");
        // $data['view'] = "user/home";
        $this->load->view('user/myorder',$data);
    }
    function addcart($id_brg){
        // $where = array('is_popular' => 1);
        $dataStore = array('pelanggan_id' => $this->session->userdata("id_user"),
                            'barang_id' => $id_brg,
                            'jumlah'    => 1 );
        $this->db->where(array('pelanggan_id' => $this->session->userdata("id_user"), 'barang_id' => $id_brg));
            $query = $this->db->get('cart');
            if($query->num_rows() == 0){
             $this->Cart_model->create($dataStore);
            }else{
             $this->db->where(array('pelanggan_id' => $this->session->userdata("id_user"), 'barang_id' => $id_brg));
             $this->db->set('jumlah', "jumlah + 1", FALSE);
             $this->db->update('cart');
            }
        // $data['view'] = "user/home";
        redirect('user/home');
    }
    function update(){
        if(isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id'])){
           $field = $_POST['field'];
           $value = $_POST['value'];
           $editid = $_POST['id'];

           $this->db->where('id',$editid);
           $this->db->set($field,$value);
           $this->db->update('cart');

           echo 1;
        }else{
           echo 0;
        }
    }

    function checkout(){
        $where = array('pelanggan_id' => $this->session->userdata("id_user"));
        $data['kategori'] = $this->Kategori_barang_model->read("","id DESC");
        $cart = $this->Cart_model->read($where,"cart.id DESC");
        $data['produk'] = $this->Cart_model->readlog($where,"logcart.id DESC");
        $data['idtr'] = $this->Cart_model->kode_penjualan();
        $data['cart'] = $this->Cart_model->countCart($where,"cart.id DESC");
        foreach ($cart as $datas) {            
            $this->db->where(array('id_cart' => $datas->id));
            $query = $this->db->get('logcart');
            if($query->num_rows() == 0){
            $insert = [
                    'id_cart' => $datas->id,
                    'pelanggan_id' => $datas->pelanggan_id,
                    'barang_id' => $datas->barang_id,
                    'jumlah' => $datas->jumlah,
                    'status' => 2
                ];
            $this->db->insert('logcart',$insert);
            }
        }
        // $data['view'] = "user/home";
        $this->load->view('user/checkout',$data);
    }
    function do_checkout(){
        $where = array('pelanggan_id' => $this->session->userdata("id_user"), 'status'=>2);
        $produk = $this->Cart_model->readlog($where,"logcart.id DESC");
        // $data['cart'] = $this->Cart_model->countCart($where,"cart.id DESC");

        foreach ($produk as $datas) {            
            $this->db->where(array('id' => $datas->id_cart));
            $this->db->delete('cart'); 

            $this->db->where(array('id' => $datas->id));
            $this->db->set('status',3);
            $this->db->update('logcart');
        }

        $store = array('tanggal_transaksi' => $this->input->post('tanggal_transaksi') ,
                        'id_pelanggan' => $this->input->post('id_pelanggan'),
                        'nama_penerima' => $this->input->post('nama_penerima'),
                        'total_transaksi' => $this->input->post('total_transaksi'),
                        'jenis_ekspedisi' => $this->input->post('nama_expedisi')." - ".$this->input->post('nama_paket'),
                        'alamat'    => $this->input->post('alamat'),
                        'kota'      => $this->input->post('nama_kota'),
                        'ongkir'      => $this->input->post('ongkir'),
                        'email'      => $this->input->post('email'),
                        'notelp'      => $this->input->post('notelp'),
                        'status'      => 2,
                         );
        $this->db->where('id_transaksi', $this->input->post('id_transaksi'));
        $this->db->set($store);
        $this->db->update('penjualan_online');

        redirect('user/home');
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


    function hapus($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('cart');

        redirect("user/cart");
    }
    function hapuslog($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('logcart');

        redirect("user/cart/checkout");
    }
     function rajaongkirprovince(){
       $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: $this->apiKey"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response,true);
            $province = $array_response['rajaongkir']['results'];
            echo "<option value=''> Pilih Provinsi* </option>";
            foreach ($province as $p) {
            echo "<option value='".$p['province_id']."' id_province='".$p['province_id']."' > ".$p['province']." </option>";
            }
        }
    }
    function rajaongkirCity(){
        $province_id_selected= $this->input->post('id_province');
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$province_id_selected,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: $this->apiKey"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response,true);
            $city = $array_response['rajaongkir']['results'];
            echo "<option value=''> Pilih Kota* </option>";
            foreach ($city as $p) {
            echo "<option value='".$p['city_id']."' id_city='".$p['city_id']."' nama_kota='".$p['city_name']."'> ".$p['city_name']." </option>";
            }
        }
    }
    function rajaongkirExpedisi(){
        echo "<option value=''> Pilih Expedisi* </option>";
        echo "<option value='jne'> JNE </option>";
        echo "<option value='tiki'> TIKI </option>";
        echo "<option value='pos'> Pos Indonesia </option>";

    }
    function rajaongkirPaket(){
        $expedisi = $this->input->post('expedisi');
        $city = $this->input->post('id_city');
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=22&destination=".$city."&weight=1700&courier=".$expedisi."",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: $this->apiKey"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $array_response = json_decode($response,true);
            $paket = $array_response['rajaongkir']['results'][0]['costs'];
            echo "<option value=''> Pilih Paket* </option>";
            foreach ($paket as $p) {
            echo "<option value='".$p['service']."' ongkir=".$p['cost'][0]['value']." nama_paket=".$p['service']."> ".$p['service']." | Rp.".$p['cost'][0]['value']." | ".$p['cost'][0]['etd']." hari </option>";
            }
        }
    }
}

?>