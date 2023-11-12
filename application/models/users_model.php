<?php

class users_model extends CI_Model
{
    public function get_data()
    {
        return $this->db->get('user')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('user', $data);
    }

    public function update_users($data, $where)
    {
        $this->db->update('user', $data, $where);
    }

    public function delete_users($where)
    {
        $this->db->where($where);
        $this->db->delete('user');
    }
}
