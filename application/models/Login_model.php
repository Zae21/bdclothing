<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Login_model extends CI_Model 
    {
        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $query = $this->db->get("user");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }
    }
?>