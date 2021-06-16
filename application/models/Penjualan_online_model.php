<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Penjualan_online_model extends CI_Model 
    {
        function create($data) 
        {
            $this->db->insert("penjualan", $data);
        }

        function readPenjualan()
        {
            $this->db->select('*');
			$this->db->from('penjualan_online');
			$this->db->join('pelanggan', 'pelanggan.id = penjualan_online.id_pelanggan');
			$this->db->order_by('tanggal_transaksi', 'desc');
			return $this->db->get()->result();
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $query = $this->db->get("penjualan");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function update($id, $data)
        {
            $this->db->where($id);
            $this->db->update("penjualan", $data);
        }

        function delete($id)
        {
            $this->db->where($id);
            $this->db->delete("penjualan");
        }

        public function kode_penjualan(){
			//kode transaksi otomatis
			$this->db->where('status', 1);
			$query = $this->db->get('penjualan');
			if($query->num_rows() == 0){
				$this->db->select('RIGHT(penjualan.id,2) as id', FALSE);
				$this->db->order_by('id','DESC');    
				$this->db->limit(1);
				$query = $this->db->get('penjualan');  //cek dulu apakah ada sudah ada kode di tabel.    
				if($query->num_rows() <> 0){      
				//cek kode jika telah tersedia    
					$data = $query->row();      
					$kode = intval($data->id) + 1; 
				  }
				  else{      
					$kode = 1;  //cek jika kode belum terdapat pada table
				   }
				   $tgl=date('dmy'); 
				   $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
				   $id_pesanan = "PNJF-".$tgl.$batas;
	
				$input1 = array(
					 'id' => $id_pesanan,
					 'tanggal_transaksi' => '0000-00-00',
					 'total_transaksi' => 0
				 );
				$this->db->insert('transaksi', $input1);
	
				$input = array(
					 'id' => $id_pesanan,
					 'tanggal_transaksi' => '0000-00-00',
					 'total_transaksi' => 0,
					 'status' => 1
				 );
				$this->db->insert('penjualan', $input);
			} else {
				 $id_pesanan = $query->row()->id;
			}
			return $id_pesanan;
        }
        public function getStok($id){
        	$this->db->select('stok')
        			->from('barang')
        			->where('id',$id);
        	$qry = $this->db->get('');
        	return $qry->row_array()['stok'];
        }
        
        public function InsertDetail()
        {
			//mengambil harga satuan
			$this->db->where('id', $_POST['barang_id']);
			$harga = $this->db->get('barang')->row()->harga_jual_satuan;
			
			//insert ke penjualan_detail
			$this->db->where(array('penjualan_id' => $_POST['id'], 'barang_id' => $_POST['barang_id']));
			$query = $this->db->get('detail_penjualan');
			if($query->num_rows() == 0){
				$_POST['harga_satuan'] = $harga;
				$_POST['sub_total'] = ($_POST['jumlah_penjualan']) * $harga;
				$data = [
					'penjualan_id'	=> $_POST['id'],
					'barang_id'		=> $_POST['barang_id'],
					'jumlah_penjualan'	=> $_POST['jumlah_penjualan'],
					'harga_satuan'	=> $_POST['harga_satuan'],
					'sub_total'		=> $_POST['sub_total']
				];
				$this->db->insert('detail_penjualan', $data);
			}else{
				$this->db->set('jumlah_penjualan', "jumlah_penjualan + ".$_POST['jumlah_penjualan']."", FALSE);
				$this->db->set('sub_total', "sub_total + ".$_POST['jumlah_penjualan']*$harga."", FALSE);
				$this->db->where(array('penjualan_id' => $_POST['id'], 'barang_id' => $_POST['barang_id']));
				$this->db->update('detail_penjualan');
			}
        }
        
        public function readDetailPenjualan($id)
        {
			//mengambil data deatail transaksi/ daftar belanja
			$this->db->select('*,detail_penjualan.id as id , barang.nama_barang, barang.id as id_barang');
			$this->db->from('detail_penjualan');
			$this->db->join('barang', 'barang.id = detail_penjualan.barang_id');
			$this->db->where('penjualan_id', $id);
			$query = $this->db->get();	
			return $query->result();
        }

        public function getTotalTransaksi($id){
			//mengambil total transaksi
			$this->db->where('penjualan_id', $id);
			$this->db->select_sum('sub_total');
			return $this->db->get('detail_penjualan')->row()->sub_total;
		}

	    public function getHPP($id){
			$this->db->select('sum((a.jumlah_penjualan)*b.harga_produk_satuan) as nominal');
			$this->db->from('detail_penjualan a');
			$this->db->join('barang b', 'b.id = a.barang_id');
			$this->db->where('a.penjualan_id', $id);
			$this->db->group_by('a.id');
			$query = $this->db->get();
			return $query->row_array();
		}
        
        public function selesaiPenjualan($id,$plg){
			//mengambil total transaksi
			$total_transaksi = $this->Penjualan_model->getTotalTransaksi($id);
			
			//update data transaksi
			$this->db->set('tanggal_transaksi', date('y-m-d'));
			$this->db->set('total_transaksi', $total_transaksi);
			$this->db->set('pelanggan_id', $plg);
			$this->db->set('status', 2);
			$this->db->where('id', $id);
			$this->db->update('penjualan');
			
			//update data transaksi
			$this->db->set('tanggal_transaksi', date('y-m-d'));
			$this->db->set('total_transaksi', $total_transaksi);
			$this->db->where('id', $id);
			$this->db->update('transaksi');
		}
    }
?>