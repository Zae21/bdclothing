<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Detail_bom_model extends CI_Model 
    {
        function create($data) 
        {
            $this->db->insert("detail_bom", $data);
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $query = $this->db->get("detail_bom");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function update($id, $data)
        {
            $this->db->where($id);
            $this->db->update("detail_bom", $data);
        }

        function delete($id)
        {
            $this->db->where($id);
            $this->db->delete("detail_bom");
        }

    }
?>