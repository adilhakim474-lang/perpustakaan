<?php
class User_model extends CI_Model {

    public function getUser($username) {
        return $this->db->get_where('users', ['username'=>$username])->row();
    }
}
