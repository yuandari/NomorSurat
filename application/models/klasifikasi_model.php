<?php

class klasifikasi_model extends CI_Model
{
    public function get_data()
    {
        return $this->db->get('kode_klasifikasi')->result();
    }

    public function insert($data)
    {
        $this->db->insert('kode_klasifikasi', $data);
    }

    public function update_kl($data, $where)
    {
        $this->db->update('kode_klasifikasi', $data, $where);
    }

    public function delete_kl($where)
    {
        $this->db->where($where);
        $this->db->delete('kode_klasifikasi');
    }
}
