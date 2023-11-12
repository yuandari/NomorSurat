<?php

class kodeSurat_model extends CI_Model
{
    public function get_data()
    {
        return $this->db->get('kode_surat')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('kode_surat', $data);
    }

    public function update_kd($data, $where)
    {
        $this->db->update('kode_surat', $data, $where);
    }

    public function delete_kodeSurat($where)
    {
        $this->db->where($where);
        $this->db->delete('kode_surat');
    }
}
