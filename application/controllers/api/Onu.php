<?php
class Onu extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if(!$this->session->userdata('login')){
            echo json_encode(['error'=>'Unauthorized']);
            exit;
        }

        $this->load->model('Onu_model');
        $this->load->model('Onu_detail_model');
    }

    public function index(){

        $page  = $this->input->get('page') ?? 1;
        $limit = $this->input->get('limit') ?? 5;
        $offset = ($page-1)*$limit;

        $data = $this->Onu_model->getLimit($limit,$offset);
        $total = $this->Onu_model->countAll();

        $tr069 = $this->db->where('status','TR-069')->count_all_results('onu');
        $omci  = $this->db->where('status','OMCI')->count_all_results('onu');

        echo json_encode([
            'data'=>$data,
            'total'=>$total,
            'tr069'=>$tr069,
            'omci'=>$omci,
            'pages'=>ceil($total/$limit)
        ]);
    }

    public function show($id){
    echo json_encode($this->Onu_model->getDetail($id));
}


    public function store()
{
    $onu = [
        'olt_id'=>$this->input->post('olt_id'),
        'description'=>$this->input->post('description'),
        'sn'=>$this->input->post('sn'),
        'mac'=>$this->input->post('mac'),
        'ip'=>$this->input->post('ip'),
        'vendor_model'=>$this->input->post('vendor_model'),
        'firmware'=>$this->input->post('firmware'),
        'reason'=>$this->input->post('reason'),
        'status'=>$this->input->post('status'),
        'rx'=>$this->input->post('rx'),
        'tx'=>$this->input->post('tx'),
        'last_up_time'=>$this->input->post('last_up_time')
    ];

    $this->Onu_model->insert($onu);
    $onu_id = $this->db->insert_id();

    /* ONU DETAIL */
    $detail = [
        'onu_id'=>$onu_id,
        'wifi_name'=>$this->input->post('wifi_name'),
        'wifi_password'=>$this->input->post('wifi_password'),
        'ip_address'=>$this->input->post('ip'),
        'gateway'=>$this->input->post('gateway'),
        'dns'=>$this->input->post('dns'),
        'cpu_usage'=>$this->input->post('cpu_usage'),
        'memory_usage'=>$this->input->post('memory_usage'),
        'wireless_clients'=>$this->input->post('wireless_clients'),
        'wired_clients'=>$this->input->post('wired_clients')
    ];

    $this->Onu_detail_model->insert($detail);

    echo json_encode(['status'=>'created']);
}


public function update($id)
{
    /* update ONU */
    $onu = [
        'olt_id'=>$this->input->post('olt_id'),
        'description'=>$this->input->post('description'),
        'sn'=>$this->input->post('sn'),
        'mac'=>$this->input->post('mac'),
        'ip'=>$this->input->post('ip'),
        'vendor_model'=>$this->input->post('vendor_model'),
        'firmware'=>$this->input->post('firmware'),
        'reason'=>$this->input->post('reason'),
        'status'=>$this->input->post('status'),
        'rx'=>$this->input->post('rx'),
        'tx'=>$this->input->post('tx'),
        'last_up_time'=>$this->input->post('last_up_time')
    ];

    $this->Onu_model->update($id,$onu);

    /* ONU DETAIL UPSERT */
    $detail = [
        'onu_id'=>$id,
        'wifi_name'=>$this->input->post('wifi_name'),
        'wifi_password'=>$this->input->post('wifi_password'),
        'ip_address'=>$this->input->post('ip'),
        'gateway'=>$this->input->post('gateway'),
        'dns'=>$this->input->post('dns'),
        'cpu_usage'=>$this->input->post('cpu_usage'),
        'memory_usage'=>$this->input->post('memory_usage'),
        'wireless_clients'=>$this->input->post('wireless_clients'),
        'wired_clients'=>$this->input->post('wired_clients')
    ];

    $exist = $this->Onu_detail_model->getByOnu($id);

    if($exist){
        $this->Onu_detail_model->update($id,$detail);
    }else{
        $this->Onu_detail_model->insert($detail);
    }

    echo json_encode(['status'=>'updated']);
}



    public function delete($id){
        $this->Onu_model->delete($id);
        echo json_encode(['status'=>'deleted']);
    }

    public function toggle_status($id)
    {
        $onu = $this->Onu_model->getById($id);
        $olt = $this->db->get_where('olt',['id'=>$onu->olt_id])->row();
        $new_onu = ($onu->status == 'TR-069') ? 'OMCI' : 'TR-069';
        $new_olt = ($new_onu == 'TR-069') ? 'online' : 'offline';
        $this->db->where('id',$id);
        $this->db->update('onu',['status'=>$new_onu]);
        $this->db->where('id',$onu->olt_id);
        $this->db->update('olt',['status'=>$new_olt]);

        echo json_encode([
            'status'=>$new_onu,
            'olt_status'=>$new_olt
        ]);
    }

}
