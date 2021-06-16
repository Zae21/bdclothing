<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Pembelian_model extends CI_Model 
    {
        function create($data) 
        {
            $this->db->insert("pembelian", $data);
        }

        function readPembelian()
        {
            $this->db->select('pembelian.id, pemasok.id as pemasok_id, pemasok.nama, pembelian.tanggal_transaksi, pembelian.status, pembelian.total_transaksi');
			$this->db->from('pembelian');
			$this->db->join('pemasok', 'pemasok.id = pembelian.pemasok_id');
			$this->db->order_by('tanggal_transaksi', 'desc');
			return $this->db->get()->result();
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $query = $this->db->get("pembelian");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function update($id, $data)
        {
            $this->db->where($id);
            $this->db->update("pembelian", $data);
        }

        function delete($id)
        {
            $this->db->where($id);
            $this->db->delete("pembelian");
        }
        public function createFromPengadaan($data){
            $this->db->insert("detail_pembelian", $data);
        }

        public function kode_pembelian(){
			//kode transaksi otomatis
			$this->db->where('status', 1);
			$query = $this->db->get('pembelian');
			if($query->num_rows() == 0){
				$this->db->select('RIGHT(pembelian.id,2) as id', FALSE);
				$this->db->order_by('id','DESC');    
				$this->db->limit(1);
				$query = $this->db->get('pembelian');  //cek dulu apakah ada sudah ada kode di tabel.    
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
				   $id_pesanan = "PM".$tgl.$batas;
	
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
				$this->db->insert('pembelian', $input);
			} else {
				 $id_pesanan = $query->row()->id;
			}
			return $id_pesanan;
        }
        
        public function InsertDetail()
        {
			//mengambil harga satuan
			$this->db->where('id', $_POST['bahan_baku_id']);
			$harga = $this->db->get('bahan_baku')->row()->harga_satuan;
			
			//insert ke pembelian_detail
			$this->db->where(array('pembelian_id' => $_POST['id'], 'bahan_baku_id' => $_POST['bahan_baku_id']));
			$query = $this->db->get('detail_pembelian');
			if($query->num_rows() == 0){
				$_POST['harga_satuan'] = $harga;
				$_POST['sub_total'] = ($_POST['jumlah_pembelian']) * $harga;
				$data = [
					'pembelian_id'	=> $_POST['id'],
					'bahan_baku_id'		=> $_POST['bahan_baku_id'],
					'jumlah_pembelian'	=> $_POST['jumlah_pembelian'],
					'harga_satuan'	=> $_POST['harga_satuan'],
					'sub_total'		=> $_POST['sub_total']
				];
				$this->db->insert('detail_pembelian', $data);
			}else{
				$this->db->set('jumlah_pembelian', "jumlah_pembelian + ".$_POST['jumlah_pembelian']."", FALSE);
				$this->db->set('sub_total', "sub_total + ".$_POST['jumlah_pembelian']*$_POST['harga_satuan']."", FALSE);
				$this->db->where(array('pembelian_id' => $_POST['id'], 'bahan_baku_id' => $_POST['bahan_baku_id']));
				$this->db->update('detail_pembelian');
			}
        }
        
        public function readDetailPembelian($id)
        {
			//mengambil data deatail transaksi/ daftar belanja
			$this->db->select('*,detail_pembelian.id as id , bahan_baku.nama_bahan_baku, bahan_baku.id as id_bahan_baku');
			$this->db->from('detail_pembelian');
			$this->db->join('bahan_baku', 'bahan_baku.id = detail_pembelian.bahan_baku_id');
			$this->db->where('pembelian_id', $id);
			$query = $this->db->get();	
			return $query->result();
        }

        public function getTotalTransaksi($id){
			//mengambil total transaksi
			$this->db->where('pembelian_id', $id);
			$this->db->select_sum('sub_total');
			return $this->db->get('detail_pembelian')->row()->sub_total;
		}
        
        public function selesaiPembelian($id,$plg,$idpg){
			//mengambil total transaksi
			$total_transaksi = $this->Pembelian_model->getTotalTransaksi($id);
			
			//update data transaksi
			$this->db->set('tanggal_transaksi', date('y-m-d'));
			$this->db->set('total_transaksi', $total_transaksi);
			$this->db->set('pengadaan_id', $idpg);
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
    }
?>