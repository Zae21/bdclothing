<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Kategori_barang_model extends CI_Model 
    {

        public $gmbr = "";
        function create() 
        {   
            
            $post = $this->input->post();
            $this->gmbr = $this->_uploadImage();
            $dataStore = array(
                'id' => $this->kode_kategori_barang(),
                'nama' => $this->input->post('nama'),
                'gambar'    => $this->gmbr
            );
            $this->db->insert("kategori_barang", $dataStore);
        }

        function read($where = "", $order = "") 
        {
            if(!empty($where)) $this->db->where($where);
            if(!empty($order)) $this->db->order_by($order);

            $query = $this->db->get("kategori_barang");

            if($query AND $query->num_rows() != 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        function update($id)
        {
            if(!empty($_FILES["gambar"]["name"])){
                $image = $this->_uploadImage();
            }else{
                $image = $post["old_image"];
            }

            $dataStore = array('nama' => $this->input->post('nama'),
                            'gambar' => $image);
            $this->db->where($id);
            $this->db->update("kategori_barang", $dataStore);
        }

        function delete($id)
        {
            $this->db->where($id);
            $this->db->delete("kategori_barang");
        }

        public function kode_kategori_barang()
	    {
	    	$this->db->select('RIGHT(kategori_barang.id,3) as kode', FALSE);
	        $this->db->order_by('id','DESC');
	        $this->db->limit(1);

	        $query=$this->db->get('kategori_barang');

	        if ($query->num_rows()!=0) {
	           $data=$query->row();
	           $kode=intval($data->kode)+1;
	        } 
	        else {
	            $kode = 1;
	        }
	        $kode_max=str_pad($kode,3,"0",STR_PAD_LEFT);
	        $fix_code="KB".$kode_max;
	        return $fix_code;
	    }
        private function _uploadImage()
        {
            $config['upload_path']          = './upload/KatBarang/';
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