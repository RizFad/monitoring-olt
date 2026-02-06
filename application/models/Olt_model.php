<?php
class Olt_model extends CI_Model {

    public function getAll(){
        return $this->db->get('olt')->result();
    }

    public function getById($id){
        return $this->db->get_where('olt',['id'=>$id])->row();
    }

    public function insert($data){
        return $this->db->insert('olt',$data);
    }

    public function update($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('olt',$data);
    }

    public function delete($id){
        $this->db->where('id',$id);
        return $this->db->delete('olt');
    }

    public function getPaging($limit,$offset){
        return $this->db->limit($limit,$offset)->get('olt')->result();
    }

    public function countAll(){
        return $this->db->count_all('olt');
    }

    public function countStatus($status){
        return $this->db->where('status',$status)->count_all_results('olt');
    }

}
