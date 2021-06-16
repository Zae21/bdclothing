<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Keuangan_model extends CI_Model 
    {
    	public function GenerateJurnal ($kode_akun, $id_transaksi, $posisi_dr_cr, $nominal)
		{
			$jurnal = array(
				'kode_akun'		=> $kode_akun,
				'id_transaksi'	=> $id_transaksi,
				'tgl_transaksi'	=> date('Y-m-d'),
				'posisi_dr_cr'	=> $posisi_dr_cr,
				'nominal'		=> $nominal,
				);
				$this->db->insert('jurnal',$jurnal);	
		}

		public function GetDataJurnal()
		{
			if(isset($_POST['tgl_awal'], $_POST ['tgl_akhir']))
			{
				$this->db->where('tgl_transaksi>=', $_POST['tgl_awal']);
				$this->db->where('tgl_transaksi <=', $_POST['tgl_akhir']);
			}
			$this->db->select('b.kode_akun, tgl_transaksi, nama_akun, a.posisi_dr_cr, nominal,id_transaksi');
			$this->db->from('jurnal a');
			$this->db->join('akun b', 'b.kode_akun = a.kode_akun');                                              
			$this->db->order_by('id_transaksi');                                            
			$this->db->order_by('posisi_dr_cr', 'asc');                                            
			$query = $this->db->get();
			return $query->result_array();	
		}
		public function getLapPemb(){
			$sql = "SELECT a.*,MONTHNAME(a.tanggal_transaksi) as bulan, YEAR(a.tanggal_transaksi) as tahun,sum(
						total_transaksi) as total 
					FROM pembelian a 
					GROUP BY MONTH(tanggal_transaksi), YEAR(tanggal_transaksi)";
			$query = $this->db->query($sql);
			return $query->result();
		}
		public function getLapPenj(){
			$sql = "SELECT a.*,MONTHNAME(a.tanggal_transaksi) as bulan, YEAR(a.tanggal_transaksi) as tahun,sum(
						total_transaksi) as total 
					FROM penjualan a 
					GROUP BY MONTH(tanggal_transaksi), YEAR(tanggal_transaksi)";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function GetSaldoAkun($kode_akun){
		//mengambil data saldo akun
			$this->db->where('kode_akun', $kode_akun);
			return $this->db->get('akun')->row_array();
		 }
		 public function getSaldoDebit($kode_akun,$bln,$thn){
			if(isset($_POST['bulan'])){
				$this->db->where('month(tgl_transaksi) <', $_POST['bulan']);
			 }
	 
			 if(isset($_POST['tahun'])){
				$this->db->where('year(tgl_transaksi) <=', $_POST['tahun']);
			 }
			 $this->db->where('a.kode_akun', $kode_akun);
			 $this->db->where('a.posisi_dr_cr', 'd');
			$this->db->select('sum(nominal) as saldo_awal_debit');
			$this->db->from('jurnal a');
			$query = $this->db->get(); 
			return $query->row();
		 }
		 public function getSaldoKredit($kode_akun,$bln,$thn){
			if(isset($_POST['bulan'])){
				$this->db->where('month(tgl_transaksi) <', $_POST['bulan']);
			 }
	 
			 if(isset($_POST['tahun'])){
				$this->db->where('year(tgl_transaksi) <=', $_POST['tahun']);
			 }
			 $this->db->where('a.kode_akun', $kode_akun);
			 $this->db->where('a.posisi_dr_cr', 'k');
			$this->db->select('sum(nominal) as saldo_awal_kredit');
			$this->db->from('jurnal a');
			$query = $this->db->get(); 
			return $query->row();
		 }

	public function HitungJumlahBaris(){
		return $this->db->get('jurnal')->num_rows();

	   }

	
	public function GetDataAkun($where = "", $order = ""){
        if(!empty($where)) $this->db->where($where);
        if(!empty($order)) $this->db->order_by($order);
		return $this->db->get('akun')->result_array();
	 }

		 public function GetDataBukuBesar($kode_akun,$bln,$thn){
	 
		 if(isset($_POST['bulan'])){
			   $this->db->where('month(tgl_transaksi)=', $_POST['bulan']);
			}

			if(isset($_POST['tahun'])){
			   $this->db->where('year(tgl_transaksi)=', $_POST['tahun']);
			}
			$this->db->where('a.kode_akun', $kode_akun);
			$this->db->select('a.kode_akun, tgl_transaksi, nama_akun, a.posisi_dr_cr, nominal');
			$this->db->from('jurnal a');
			$this->db->join('akun b', 'b.kode_akun = a.kode_akun');
			$this->db->order_by('tgl_transaksi');
			$query = $this->db->get(); 
			return $query->result_array();
		 }

		 public function getSaldoDebits($where = "", $order = ""){

	        if(!empty($where)) $this->db->where($where);
	        if(!empty($order)) $this->db->order_by($order);
			$this->db->where('a.posisi_dr_cr', 'debet');
			$this->db->select('sum(nominal) as saldo_awal_debit');
			$this->db->from('jurnal a');
			$query = $this->db->get(); 
			return $query->row();
		 }


		 public function getSaldoKredits($where = "", $order = ""){

	        if(!empty($where)) $this->db->where($where);
	        if(!empty($order)) $this->db->order_by($order);
			 $this->db->where('a.posisi_dr_cr', 'kredit');
			$this->db->select('sum(nominal) as saldo_awal_kredit');
			$this->db->from('jurnal a');
			$query = $this->db->get(); 
			return $query->row();
		 }
		 public function getSaldoLaba($bulan,$tahun){		 	
            $this->db->where('MONTH(tgl_transaksi)', $bulan)
                    ->where('YEAR(tgl_transaksi)', $tahun)
                    ->where('header_akun', 4)
                    ->where('posisi_dr_cr', 'debet')
                    ->select('sum(nominal) as saldo_debet')
                    ->from('jurnal')
                    ->join('akun','jurnal.kode_akun=akun.kode_akun')
                    ->group_by('header_akun');
            $query = $this->db->get(); 
            $saldo_pendapatan_debet =  $query->row_array()['saldo_debet'];
            $this->db->where('MONTH(tgl_transaksi)', $bulan)
                    ->where('YEAR(tgl_transaksi)', $tahun)
                    ->where('header_akun', 4)
                    ->where('posisi_dr_cr', 'kredit')
                    ->select('sum(nominal) as saldo_kredit')
                    ->from('jurnal')
                    ->join('akun','jurnal.kode_akun=akun.kode_akun')
                    ->group_by('header_akun');
            $query = $this->db->get(); 
            $saldo_pendapatan_kredit =  $query->row_array()['saldo_kredit'];		 	
            $this->db->where('MONTH(tgl_transaksi)', $bulan)
                    ->where('YEAR(tgl_transaksi)', $tahun)
                    ->where('header_akun', 5)
                    ->where('posisi_dr_cr', 'debet')
                    ->select('sum(nominal) as saldo_debet')
                    ->from('jurnal')
                    ->join('akun','jurnal.kode_akun=akun.kode_akun')
                    ->group_by('header_akun');
            $query = $this->db->get(); 
            $saldo_beban_debet =  $query->row_array()['saldo_debet'];
            $this->db->where('MONTH(tgl_transaksi)', $bulan)
                    ->where('YEAR(tgl_transaksi)', $tahun)
                    ->where('header_akun', 5)
                    ->where('posisi_dr_cr', 'kredit')
                    ->select('sum(nominal) as saldo_kredit')
                    ->from('jurnal')
                    ->join('akun','jurnal.kode_akun=akun.kode_akun')
                    ->group_by('header_akun');
            $query = $this->db->get(); 
            $saldo_beban_kredit =  $query->row_array()['saldo_kredit'];
            $saldo = ($saldo_pendapatan_debet+$saldo_pendapatan_kredit) - ($saldo_beban_debet-$saldo_beban_kredit);
            return $saldo;
		 }


	    public function getStokLast($id_barang){
	    	$this->db->where('id_barang',$id_barang)
	    			->order_by('id','DESC')
	               ->limit(1);
	    	return $this->db->get('kartu_stok')->row();
	    }


		public function getKartuStok($idbrg){
			$where = array('kartu_stok.id_barang' => $idbrg,
							// 'MONTH(tanggal)' => $bulan,
							// 'YEAR(tanggal)' => $tahun
							 );
		    $this->db->select('*')
		            ->join('barang', 'barang.id = kartu_stok.id_barang')
		            ->where($where);
		    return $this->db->get('kartu_stok')->result_array();
		}
		
    }
?>