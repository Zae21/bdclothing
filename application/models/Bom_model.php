<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Bom_model extends CI_Model 
    {
        function create($data) 
        {
            $this->db->insert("bom", $data);
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $this->db->select("bom.*, barang.nama_barang");
            $this->db->join('barang', 'barang.id = bom.barang_id');

            $query = $this->db->get("bom");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function update($id, $data)
        {
            $this->db->where($id);
            $this->db->update("bom", $data);
        }
        
        function lastInsertId()
        {
            return $this->db->insert_id();
        }

        function delete($id)
        {
            $this->db->where($id);
            $this->db->delete("bom");
        }

        public function kode_bom()
	    {
	    	$this->db->select('RIGHT(bom.id,3) as kode', FALSE);
	        $this->db->order_by('id','DESC');
	        $this->db->limit(1);

	        $query=$this->db->get('bom');

	        if ($query->num_rows()!=0) {
	           $data = $query->row();
	           $kode = intval($data->kode)+1;
	        } 
	        else {
	            $kode = 1;
	        }
	        $kode_max= str_pad($kode,3,"0",STR_PAD_LEFT);
	        $fix_code= "BM".$kode_max;
	        return $fix_code;
	    }
    }
?>