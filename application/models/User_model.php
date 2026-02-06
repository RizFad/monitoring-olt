<?php
class User_model extends CI_Model {

    public function login($username,$password){
        return $this->db->get_where('users',[
            'username'=>$username,
            'password'=>md5($password)
        ])->row();
    }
}
