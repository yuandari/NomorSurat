<?php

class pejabat_model extends CI_Model
{
    public function get_data()
    {
        return $this->db->get('pejabat')->result();
    }

    public function insert($data)
    {
        $this->db->insert('pejabat', $data);
    }

    public function update_pj($data, $where)
    {
        $this->db->update('pejabat', $data, $where);
    }

    public function delete_kl($where)
    {
        $this->db->where($where);
        $this->db->delete('pejabat');
    }
}
