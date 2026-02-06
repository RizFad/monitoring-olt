<?php
class Onu_detail_model extends CI_Model {

    public function insert($data){
        return $this->db->insert('onu_detail',$data);
    }

    public function update($onu_id,$data){
        $this->db->where('onu_id',$onu_id);
        return $this->db->update('onu_detail',$data);
    }

    public function getByOnu($onu_id){
        return $this->db->get_where('onu_detail',['onu_id'=>$onu_id])->row();
    }
}
