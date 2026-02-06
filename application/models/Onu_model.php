<?php
class Onu_model extends CI_Model {

    public function getAll(){
        $this->db->select('onu.*, olt.description as olt_name, olt.group_name');
        $this->db->from('onu');
        $this->db->join('olt','olt.id = onu.olt_id','left');
        return $this->db->get()->result();
    }

    public function getById($id){
        return $this->db->get_where('onu',['id'=>$id])->row();
    }

    public function insert($data){
        return $this->db->insert('onu',$data);
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('onu',$data);
    }

    public function delete($id){
        $this->db->where('id',$id);
        return $this->db->delete('onu');
    }

    public function getLimit($limit,$offset){
        return $this->db
            ->select('onu.*, olt.description as olt_name')
            ->join('olt','olt.id=onu.olt_id','left')
            ->limit($limit,$offset)
            ->get('onu')
            ->result();
    }

    public function countAll(){
        return $this->db->count_all('onu');
    }

    public function countStatus($status){
        return $this->db->where('status',$status)->count_all_results('onu');
    }

    public function updateByOnu($onu_id,$data){
        $this->db->where('onu_id',$onu_id);
        return $this->db->update('onu_detail',$data);
    }

public function getDetail($id){
    $this->db->select('
        onu.*,
        olt.description as olt_name,
        olt.status as olt_status,
        onu_detail.wifi_name,
        onu_detail.wifi_password,
        onu_detail.ip_address,
        onu_detail.gateway,
        onu_detail.dns,
        onu_detail.cpu_usage,
        onu_detail.memory_usage,
        onu_detail.wireless_clients,
        onu_detail.wired_clients
    ');
    $this->db->from('onu');
    $this->db->join('olt','olt.id=onu.olt_id','left');
    $this->db->join('onu_detail','onu_detail.onu_id=onu.id','left');
    $this->db->where('onu.id',$id);
    return $this->db->get()->row();
}

}
