<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Kebutuhan_model extends CI_Model 
    {
        function create($data) 
        {
            $this->db->insert("pengadaan_barang", $data);
        }

        function readKebutuhan()
        {
            $this->db->select('*');
			$this->db->from('pengadaan_barang');
			$this->db->where('status > 0');
			$this->db->order_by('tanggal_transaksi', 'desc');
			return $this->db->get()->result();
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $query = $this->db->get("pengadaan_barang");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function update($id, $data)
        {
            $this->db->where($id);
            $this->db->update("pengadaan_barang", $data);
        }

        function delete($id)
        {
            $this->db->where($id);
            $this->db->delete("pengadaan_barang");
        }

        public function kode_pengadaan(){
			//kode transaksi otomatis
			$this->db->where('is_created', 1);
			$query = $this->db->get('pengadaan_barang');
			if($query->num_rows() == 0){
				$this->db->select('RIGHT(pengadaan_barang.id_transaksi,2) as id', FALSE);
				$this->db->order_by('id','DESC');    
				$this->db->limit(1);
				$query = $this->db->get('pengadaan_barang');  //cek dulu apakah ada sudah ada kode di tabel.    
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
				   $id_pesanan = "PG-".$tgl.$batas;
	
				$input1 = array(
					 'id' => $id_pesanan,
					 'tanggal_transaksi' => date('Y-m-d'),
					 'total_transaksi' => 0
				 );
				$this->db->insert('transaksi', $input1);
	
				$input = array(
					 'id_transaksi' => $id_pesanan,
					 'tanggal_transaksi' => date('Y-m-d'),
					 'total' => 0,
					 'is_created' => 1
				 );
				$this->db->insert('pengadaan_barang', $input);
			} else {
				 $id_pesanan = $query->row()->id_transaksi;
			}
			return $id_pesanan;
        }
        
        public function InsertDetail()
        {
			//mengambil harga satuan
			$this->db->where('id', $_POST['id_barang']);
			$harga = $this->db->get('barang')->row()->harga_produk_satuan;
			
			//insert ke pembelian_detail
			$this->db->where(array('id_transaksi' => $_POST['id'], 'id_barang' => $_POST['id_barang']));
			$query = $this->db->get('detail_pengadaan');
			if($query->num_rows() == 0){
				// $_POST['harga_satuan'] = $harga;
				// $_POST['sub_total'] = ($_POST['jumlah_pembelian']) * $harga;
				$data = [
					'id_transaksi'	=> $_POST['id'],
					'id_barang'		=> $_POST['id_barang'],
					'qty'	=> $_POST['qty']
				];
				$this->db->insert('detail_pengadaan', $data);
			}else{
				$this->db->set('qty', "qty + ".$_POST['qty']."", FALSE);
				// $this->db->set('sub_total', "sub_total + ".$_POST['jumlah_pembelian']*$_POST['harga_satuan']."", FALSE);
				$this->db->where(array('id_transaksi' => $_POST['id'], 'id_barang' => $_POST['id_barang']));
				$this->db->update('detail_pengadaan');
			}
        }

	    public function hitungKebutuhan($idtr){
	    	$this->db->select('*, (qty*komposisi) as jumlah_kebutuhan, bahan_baku.id as id_bahan')
	    			->from('detail_pengadaan')
	    			->join('bom', 'bom.barang_id=detail_pengadaan.id_barang')
	    			->join('detail_bom', 'detail_bom.bom_id=bom.id')
	    			->join('barang', 'bom.barang_id=barang.id')
	    			->join('bahan_baku', 'detail_bom.bahan_baku_id=bahan_baku.id')
	    			->where('id_transaksi',$idtr);
	    	$query = $this->db->get();	
			return $query->result();
	    }
	    public function hitungKebutuhanBeli($idtr){
	    	$this->db->select('*, sum(qty*komposisi) as jumlah_kebutuhan, bahan_baku.id as id_bahan')
	    			->from('detail_pengadaan')
	    			->join('bom', 'bom.barang_id=detail_pengadaan.id_barang')
	    			->join('detail_bom', 'detail_bom.bom_id=bom.id')
	    			->join('barang', 'bom.barang_id=barang.id')
	    			->join('bahan_baku', 'detail_bom.bahan_baku_id=bahan_baku.id')
	    			->where('id_transaksi',$idtr)
	    			->group_by('id_bahan');
	    	$query = $this->db->get();	
			return $query->result();
	    }
        
        public function readDetailKebutuhan($id)
        {
			//mengambil data deatail transaksi/ daftar belanja
			$this->db->select('*,detail_pengadaan.id_transaksi as id , barang.nama_barang, barang.id as id_barang');
			$this->db->from('detail_pengadaan');
			$this->db->join('barang', 'barang.id = detail_pengadaan.id_barang');
			$this->db->where('id_transaksi', $id);
			$query = $this->db->get();	
			return $query->result();
        }

        public function getTotalTransaksi($id){
			//mengambil total transaksi
			$this->db->where('pembelian_id', $id);
			$this->db->select_sum('sub_total');
			return $this->db->get('detail_pembelian')->row()->sub_total;
		}
        
        public function selesaiPembelian($id,$plg){
			//mengambil total transaksi
			$total_transaksi = $this->Pembelian_model->getTotalTransaksi($id);
			
			//update data transaksi
			$this->db->set('tanggal_transaksi', date('y-m-d'));
			$this->db->set('total_transaksi', $total_transaksi);
			$this->db->set('pemasok_id', $plg);
			$this->db->set('status', 2);
			$this->db->where('id', $id);
			$this->db->update('pembelian');
			
			//update data transaksi
			$this->db->set('tanggal_transaksi', date('y-m-d'));
			$this->db->set('total_transaksi', $total_transaksi);
			$this->db->where('id', $id);
			$this->db->update('transaksi');
		}


        function readPengadaan($where = "", $whereIn = array())
        {
            $this->db->select('*');
			$this->db->from('pengadaan_barang');
			if($whereIn) {
				$this->db->where_in("status", $whereIn);
			}
			$this->db->order_by('pengadaan_barang.id_transaksi', 'desc');
			if(!empty($where)) $this->db->where($where);
			
			return $this->db->get()->result();
        }
    }
?>