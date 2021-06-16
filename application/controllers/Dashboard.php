<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if(!$this->session->userdata("username")) redirect("login");
    }
    
    function index()
    {
        $data['view'] = "dashboard/index";
        $this->load->view('index', $data);
    }
}

?>