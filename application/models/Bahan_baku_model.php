<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Bahan_baku_model extends CI_Model 
    {
        function create($data) 
        {
            $this->db->insert("bahan_baku", $data);
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $query = $this->db->get("bahan_baku");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function update($id, $data)
        {
            $this->db->where($id);
            $this->db->update("bahan_baku", $data);
        }

        function delete($id)
        {
            $this->db->where($id);
            $this->db->delete("bahan_baku");
        }

        public function kode_bahan_baku()
	    {
	    	$this->db->select('RIGHT(bahan_baku.id,3) as kode', FALSE);
	        $this->db->order_by('id','DESC');
	        $this->db->limit(1);

	        $query=$this->db->get('bahan_baku');

	        if ($query->num_rows()!=0) {
	           $data = $query->row();
	           $kode = intval($data->kode)+1;
	        } 
	        else {
	            $kode = 1;
	        }
	        $kode_max= str_pad($kode,3,"0",STR_PAD_LEFT);
	        $fix_code= "BB".$kode_max;
	        return $fix_code;
	    }
    }
?>