<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Pemb_modal_model extends CI_Model 
    {
    	private $table = 'perubahan_modal';
        function create($data) 
        {
            $this->db->insert($this->table, $data);
        }

        function readData()
        {
            $this->db->select('*');
			$this->db->from($this->table);
			$this->db->order_by('tgl_transaksi', 'desc');
			return $this->db->get()->result();
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $query = $this->db->get($this->table);

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function setTransaksi($data){
        	$this->db->insert('transaksi', $data);
        }
        function setNoAkun($ket){
            if ($ket == 'Penambahan Modal') {
                return 311;
            }elseif ($ket == 'Penarikan Modal Untuk Kepentingan Pribadi') {
                return 312;
            }
        }
        public function kode()
	    {
	    	$this->db->select('RIGHT('.$this->table.'.id_modal,3) as kode', FALSE);
	        $this->db->order_by('kode','DESC');
	        $this->db->limit(1);

	        $query=$this->db->get($this->table);

	        if ($query->num_rows()!=0) {
	           $data=$query->row();
	           $kode=intval($data->kode)+1;
	        } 
	        else {
	            $kode = 1;
	        }
	        $tgl=date('dmy'); 
			$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
			$fix_code = "MD-".$tgl.$batas;
	        return $fix_code;
	    }
        
    }
?>