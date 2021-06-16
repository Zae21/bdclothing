<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Cart_model extends CI_Model 
    {
        function create($data) 
        {
            $this->db->insert("cart", $data);
        }

        function countCart($where = "", $order = ""){
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $query = $this->db->get("cart");
            return $query->num_rows();
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $this->db->select("barang.*, cart.*");
            $this->db->join('barang', 'barang.id = cart.barang_id');

            $query = $this->db->get("cart");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }
        function readlog($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $this->db->select("barang.*, logcart.*");
            $this->db->join('barang', 'barang.id = logcart.barang_id');

            $query = $this->db->get("logcart");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function update($id, $data)
        {
            if(!empty($_FILES["gambar"]["name"])){
                $image = $this->_uploadImage();
            }else{
                $image = $post["old_image"];
            }
            $data['gambar'] = $image;
            $this->db->where($id);
            $this->db->update("barang", $data);
        }

        function delete($id)
        {
            $this->db->where($id);
            $this->db->delete("barang");
        }

        public function kode_barang()
	    {
	    	$this->db->select('RIGHT(barang.id,3) as kode', FALSE);
	        $this->db->order_by('id','DESC');
	        $this->db->limit(1);

	        $query=$this->db->get('barang');

	        if ($query->num_rows()!=0) {
	           $data = $query->row();
	           $kode = intval($data->kode)+1;
	        } 
	        else {
	            $kode = 1;
	        }
	        $kode_max= str_pad($kode,3,"0",STR_PAD_LEFT);
	        $fix_code= "BR".$kode_max;
	        return $fix_code;
	    }
        private function _uploadImage()
        {
            $config['upload_path']          = './upload/Barang/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['file_name']            = uniqid();
            $config['overwrite']            = true;
            $config['max_size']             = 6000; // 1MB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                return $this->upload->data("file_name");
            }else{

            return "default.jpg";
            }
            
        }
        public function kode_penjualan(){
            //kode transaksi otomatis
            $this->db->where('status', 1);
            $query = $this->db->get('penjualan_online');
            if($query->num_rows() == 0){
                $this->db->select('RIGHT(penjualan_online.id_transaksi,2) as id_transaksi', FALSE);
                $this->db->order_by('id_transaksi','DESC');    
                $this->db->limit(1);
                $query = $this->db->get('penjualan_online');  //cek dulu apakah ada sudah ada kode di tabel.    
                if($query->num_rows() <> 0){      
                //cek kode jika telah tersedia    
                    $data = $query->row();      
                    $kode = intval($data->id_transaksi) + 1; 
                  }
                  else{      
                    $kode = 1;  //cek jika kode belum terdapat pada table
                   }
                   $tgl=date('dmy'); 
                   $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
                   $id_pesanan = "PNJOL-".$tgl.$batas;
                $input = array(
                     'id_transaksi' => $id_pesanan,
                     'tanggal_transaksi' => '0000-00-00',
                     'total_transaksi' => 0,
                     'status' => 1
                 );
                $this->db->insert('penjualan_online', $input);
            } else {
                 $id_pesanan = $query->row()->id_transaksi;
            }
            return $id_pesanan;
        }
    }
?>