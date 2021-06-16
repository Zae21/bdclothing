<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Barang_model extends CI_Model 
    {
        function create($data) 
        {
            $data['gambar'] = $this->_uploadImage();
            $this->db->insert("barang", $data);
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $this->db->select("barang.*, kategori_barang.nama, kategori_barang.gambar as gambar_kat");
            $this->db->join('kategori_barang', 'kategori_barang.id = barang.kategori_barang_id');

            $query = $this->db->get("barang");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function update($id, $data)
        {
            if(!empty($_FILES["gambar"]["name"])){
                $image = $this->_uploadImage();
            }else{
                $image = $post["old_image"];
            }
            $data['gambar'] = $image;
            $this->db->where($id);
            $this->db->update("barang", $data);
        }

        function delete($id)
        {
            $this->db->where($id);
            $this->db->delete("barang");
        }

        public function kode_barang()
	    {
	    	$this->db->select('RIGHT(barang.id,3) as kode', FALSE);
	        $this->db->order_by('id','DESC');
	        $this->db->limit(1);

	        $query=$this->db->get('barang');

	        if ($query->num_rows()!=0) {
	           $data = $query->row();
	           $kode = intval($data->kode)+1;
	        } 
	        else {
	            $kode = 1;
	        }
	        $kode_max= str_pad($kode,3,"0",STR_PAD_LEFT);
	        $fix_code= "BR".$kode_max;
	        return $fix_code;
	    }
        private function _uploadImage()
        {
            $config['upload_path']          = './upload/Barang/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['file_name']            = uniqid();
            $config['overwrite']            = true;
            $config['max_size']             = 6000; // 1MB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                return $this->upload->data("file_name");
            }else{

            return "default.jpg";
            }
            
        }
    }
?>