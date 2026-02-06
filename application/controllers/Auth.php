<?php
class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function index(){
        $this->load->view('login');
    }

    public function process(){

        $user = $this->User_model->login(
            $this->input->post('username'),
            $this->input->post('password')
        );

        if($user){
            $this->session->set_userdata([
                'login'=>true,
                'user_id'=>$user->id,
                'username'=>$user->username
            ]);
            redirect('dashboard');
        }else{
            $this->session->set_flashdata('error','Login gagal');
            redirect('auth');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }
}
