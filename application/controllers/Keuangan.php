<?php
	class keuangan extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Keuangan_model');
			$this->load->model('Barang_model');
		}
		function jurnal(){
		$data['jurnal'] = $this->Keuangan_model->GetDataJurnal();
		$data['view'] = "laporan/jurnal_umum";
        $this->load->view('index', $data);
		}
		function lapPemb(){
		$data['result'] = $this->Keuangan_model->getLapPemb();
		$data['view'] = "laporan/laporan_pembelian";
        $this->load->view('index', $data);
		}
		function lapPenj(){
		$data['result'] = $this->Keuangan_model->getLapPenj();
		$data['view'] = "laporan/laporan_penjualan";
        $this->load->view('index', $data);
		}

		function buku_besar(){
			if(isset($_POST['kode_akun']) ){
			  $kode_akun = $_POST['kode_akun'];
			}else{
			  $kode_akun = '111';
			}
			if(isset($_POST['bulan']) ){
			  $bulan = $_POST['bulan'];
			}else{
			  $bulan = date('m');
			}
			if(isset($_POST['tahun']) ){
			  $tahun = $_POST['tahun'];
			}else{
			  $tahun = date('Y');
			}
			
		
		
			// $data['result'] = $this->m_transaksi_pnj->GetDataPenjualan($this->uri->segment(3), $config["per_page"]);
			// $this->template->load('blank', 'Penjualan/view_pnj', $data);
		
			$data['akun'] = $this->Keuangan_model->GetDataAkun(array('kode_akun >' =>100)); 
			$data['dataakun'] = $this->Keuangan_model->GetSaldoAkun($kode_akun);
			$data['jurnal'] = $this->Keuangan_model->GetDataBukuBesar($kode_akun,$bulan,$tahun,$this->uri->segment(3)); 
			$data['tahun'] = $tahun;
			$data['bulan'] = $bulan; 
			$data['debit'] = $this->Keuangan_model->getSaldoDebit($kode_akun,$bulan,$tahun); 
			$data['kredit'] = $this->Keuangan_model->getSaldoKredit($kode_akun,$bulan,$tahun); 
			$data['view'] = "laporan/buku_besar";
	        $this->load->view('index', $data);
			error_reporting(0);
		  }

		  function laba_rugi(){
		  	$data['pendapatan']	= $this->Keuangan_model->GetDataAkun(array('kode_akun >' =>400, 'kode_akun <'=>500));
		  	$data['beban']	= $this->Keuangan_model->GetDataAkun(array('kode_akun >' =>500, 'kode_akun <'=>600));
		  	$data['jurnal'] = $this->Keuangan_model->GetDataJurnal();
			$data['title'] = "Laporan Laba Rugi";
			$data['view'] = "laporan/laba_rugi";
	        $this->load->view('index', $data);

		  }
		  function perubahan_modal(){

		  	if(isset($_POST['bulan']) ){
			  $bulan = $_POST['bulan'];
			}else{
			  $bulan = date('m');
			}

			if(isset($_POST['tahun']) ){
			  $tahun = $_POST['tahun'];
			}else{
			  $tahun = date('Y');
			}
			$tgl = $tahun."-".$bulan."-01";
			
			$data['akun'] = $this->Keuangan_model->GetDataAkun(array('kode_akun >' =>100));
			$data['tahun'] = $tahun;
			$data['bulan'] = $bulan; 
			$data['debit'] = $this->Keuangan_model->getSaldoDebits(array('kode_akun' =>311, 'tgl_transaksi <'=>$tgl));
			$data['kredit'] = $this->Keuangan_model->getSaldoKredits(array('kode_akun' =>311, 'tgl_transaksi <'=>$tgl)); 
			$data['permodal'] = $this->Keuangan_model->getSaldoDebits(array('kode_akun' =>311, 'MONTH(tgl_transaksi)'=>$bulan))->saldo_awal_debit + $this->Keuangan_model->getSaldoKredits(array('kode_akun' =>311, 'MONTH(tgl_transaksi) '=>$bulan))->saldo_awal_kredit; 
			$data['prive'] = $this->Keuangan_model->getSaldoDebits(array('kode_akun' =>312, 'MONTH(tgl_transaksi)'=>$bulan))->saldo_awal_debit - $this->Keuangan_model->getSaldoKredits(array('kode_akun' =>312, 'MONTH(tgl_transaksi) '=>$bulan))->saldo_awal_kredit; 
			$data['laba'] = $this->Keuangan_model->getSaldoLaba($bulan,$tahun); 
			$data['title'] = "Laporan Perubahan Modal";
			$data['view'] = "laporan/perubahan_modal";
	        $this->load->view('index', $data);
			error_reporting(0);
		  
		  }

		  
		public function kartuStok(){
			if(isset($_POST['id_barang']) ){
			  $id_barang = $_POST['id_barang'];
			}else{
			  $id_barang = 'BR001';
			}
			
			$data['barang']	= $this->Barang_model->read("","");;
			$data['kartuStok']	= $this->Keuangan_model->getKartuStok($id_barang);
			$data['title']		= 'Kartu Stok';
			$data['view'] = "laporan/kartu_stok";
	        $this->load->view('index', $data);
			error_reporting(0);

		}
	}
?>