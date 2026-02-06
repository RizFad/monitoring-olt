<?php
class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('login')){
            redirect('auth');
        }
    }

    public function index(){
        redirect('olt'); // halaman utama
    }
}
