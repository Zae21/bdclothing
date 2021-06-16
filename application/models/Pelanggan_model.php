<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Pelanggan_model extends CI_Model 
    {
        function create($data) 
        {
            $this->db->insert("pelanggan", $data);
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $query = $this->db->get("pelanggan");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function update($id, $data)
        {
            $this->db->where($id);
            $this->db->update("pelanggan", $data);
        }

        function delete($id)
        {
            $this->db->where($id);
            $this->db->delete("pelanggan");
        }

        public function kode_pelanggan()
	    {
	    	$this->db->select('RIGHT(pelanggan.id,3) as kode', FALSE);
	        $this->db->order_by('id','DESC');
	        $this->db->limit(1);

	        $query=$this->db->get('pelanggan');

	        if ($query->num_rows()!=0) {
	           $data=$query->row();
	           $kode=intval($data->kode)+1;
	        } 
	        else {
	            $kode = 1;
	        }
	        $kode_max=str_pad($kode,3,"0",STR_PAD_LEFT);
	        $fix_code="PL".$kode_max;
	        return $fix_code;
	    }
    }
?>