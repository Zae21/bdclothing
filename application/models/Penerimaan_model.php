<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Penerimaan_model extends CI_Model 
    {
        function create($data) 
        {
            $this->db->insert("pembelian", $data);
        }

        function readPenerimaan()
        {
            $this->db->select('*');
			$this->db->from('penerimaan');
			$this->db->order_by('tanggal_transaksi', 'desc');
			return $this->db->get()->result();
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $query = $this->db->get("penerimaan");

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

        public function kode_penerimaan(){
			//kode transaksi otomatis
			$this->db->where('status', 1);
			$query = $this->db->get('penerimaan');
			if($query->num_rows() == 0){
				$this->db->select('RIGHT(penerimaan.id_penerimaan,2) as id', FALSE);
				$this->db->order_by('id','DESC');    
				$this->db->limit(1);
				$query = $this->db->get('penerimaan');  //cek dulu apakah ada sudah ada kode di tabel.    
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
				   $id_pesanan = "PNR".$tgl.$batas;
	
				// $input1 = array(
				// 	 'id_penerimaan' => $id_pesanan,
				// 	 'tanggal_transaksi' => '0000-00-00',
				// 	 'total' => 0
				//  );
				// $this->db->insert('transaksi', $input1);
	
				$input = array(
					 'id_penerimaan' => $id_pesanan,
					 'tanggal_transaksi' => '0000-00-00',
					 'total' => 0,
					 'status' => 1
				 );
				$this->db->insert('penerimaan', $input);
			} else {
				 $id_pesanan = $query->row()->id_penerimaan;
			}
			return $id_pesanan;
        }
        function createDetail($data) 
        {
            $this->db->insert("detail_penerimaan", $data);
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
        
        public function readDetailPenerimaan($id)
        {
			//mengambil data deatail transaksi/ daftar belanja
        	$this->db->select('*,detail_penerimaan.id_penerimaan as id , barang.nama_barang as nama_barang, barang.id as id_barang');
			$this->db->from('detail_penerimaan');
			$this->db->join('barang', 'barang.id = detail_penerimaan.id_barang');
			$this->db->where('id_penerimaan', $id);
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