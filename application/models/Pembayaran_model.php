<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Pembayaran_model extends CI_Model 
    {
    	private $table = 'pembayaran_beban';
        function create($data) 
        {
            $this->db->insert($this->table, $data);
        }

        function readData()
        {
            $this->db->select('*');
			$this->db->from($this->table);
			$this->db->join('kategori_beban', $this->table.'.id_kategori_beban = kategori_beban.id');
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
        function getNoAkun($id){
            $this->db->select('no_akun');
            $this->db->from('kategori_beban');
            $this->db->where('id', $id);
            return $this->db->get()->row()->no_akun;
        }
        public function kode()
	    {
	    	$this->db->select('RIGHT('.$this->table.'.id_pembayaran,3) as kode', FALSE);
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
			$fix_code = "PYMNT-".$tgl.$batas;
	        return $fix_code;
	    }
        
    }
?>