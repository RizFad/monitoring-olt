<?php
class Olt extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('login')){
            echo json_encode(['error'=>'Unauthorized']);
            exit;
        }
        $this->load->model('Olt_model');
    }

    public function index(){

        $page = $this->input->get('page') ?? 1;
        $limit = $this->input->get('limit') ?? 5;
        $offset = ($page-1) * $limit;

        $data = $this->Olt_model->getPaging($limit,$offset);
        $total = $this->Olt_model->countAll();
        $online = $this->Olt_model->countStatus('online');
        $offline = $this->Olt_model->countStatus('offline');

        echo json_encode([
            'data'=>$data,
            'total'=>$total,
            'online'=>$online,
            'offline'=>$offline
        ]);
    }


    public function show($id){
        echo json_encode($this->Olt_model->getById($id));
    }

    public function store(){
        $this->Olt_model->insert($this->input->post());
        echo json_encode(['status'=>'success']);
    }

    public function update($id){
        $this->Olt_model->update($id,$this->input->post());
        echo json_encode(['status'=>'updated']);
    }

    public function delete($id){
        $this->Olt_model->delete($id);
        echo json_encode(['status'=>'deleted']);
    }

    public function dropdown(){
        echo json_encode($this->Olt_model->getAll());
    }
}