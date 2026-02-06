<?php
class Onu extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if(!$this->session->userdata('login')){
            redirect('auth');
        }
    }

    public function index(){
        $this->load->view('onu_list');
    }

    public function detail($id)
    {
        $data['id'] = $id;
        $this->load->view('onu_detail',$data);
    }
}

// class Onu extends CI_Controller {

//     public function __construct(){
//         parent::__construct();
//         $this->load->model('Onu_model');
//         $this->load->model('Olt_model');
//     }

//     public function index(){
//         $data['onu'] = $this->Onu_model->getAll();
//         $this->load->view('onu_list',$data);
//     }

//     public function create(){
//         $data['olt'] = $this->Olt_model->getAll();
//         $this->load->view('onu_form',$data);
//     }

//     public function store(){
//         $this->Onu_model->insert($this->input->post());
//         redirect('onu');
//     }

//     public function edit($id){
//         $data['onu'] = $this->Onu_model->getById($id);
//         $data['olt'] = $this->Olt_model->getAll();
//         $this->load->view('onu_form',$data);
//     }

//     public function update($id){
//         $this->Onu_model->update($id,$this->input->post());
//         redirect('onu');
//     }

//     public function delete($id){
//         $this->Onu_model->delete($id);
//         redirect('onu');
//     }
// }

