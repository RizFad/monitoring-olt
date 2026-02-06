<?php
class Olt extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if(!$this->session->userdata('login')){
            redirect('auth');
        }
    }

    public function index(){
        $this->load->view('olt_list');
    }
}

// class Olt extends CI_Controller {

//     public function __construct(){
//         parent::__construct();
//         $this->load->model('Olt_model');
//     }

//     public function index(){
//         $data['olt'] = $this->Olt_model->getAll();
//         $this->load->view('olt_list',$data);
//     }

//     public function create(){
//         $this->load->view('olt_form');
//     }

//     public function store(){
//         $data = $this->input->post();
//         $this->Olt_model->insert($data);
//         redirect('olt');
//     }

//     public function edit($id){
//         $data['olt'] = $this->Olt_model->getById($id);
//         $this->load->view('olt_form',$data);
//     }

//     public function update($id){
//         $data = $this->input->post();
//         $this->Olt_model->update($id,$data);
//         redirect('olt');
//     }

//     public function delete($id){
//         $this->Olt_model->delete($id);
//         redirect('olt');
//     }
// }
