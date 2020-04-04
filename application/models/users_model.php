<?php
class Users_model extends CI_Model
{
    public function __construct()
    {
        parent :: __construct();
    }

    public function get_user($user)
    {
        $query = $this->db->get_where('users', $user);
        if($query){
            return $query->row();
        } else {
            return false;
        }
    }
}


?>