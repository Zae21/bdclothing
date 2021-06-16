<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Akun_model extends CI_Model 
    {
        function create($data) 
        {
            $this->db->insert("akun", $data);
        }

        function count()
        {
            return $this->db->get("akun")->num_rows();
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($where)) $this->db->order_by($order);

            $query = $this->db->get("akun");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function update($id, $data)
        {
            $this->db->where($id);
            $this->db->update("akun", $data);
        }

        function delete($id)
        {
            $this->db->where($id);
            $this->db->delete("akun");
        }
    }
?>