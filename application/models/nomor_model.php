<?php

class nomor_model extends CI_Model
{
    public function get_data()
    {
        $this->db->select('
          nomor_surat.*, user.id_user AS id_user, user.nama,
          nomor_surat.*, kode_klasifikasi.id_klasifikasi AS id_klasifikasi, kode_klasifikasi.jenis_arsip, kode_klasifikasi.kode_klasifikasi, kode_klasifikasi.persetujuan,
          nomor_surat.*, pejabat.id_pejabat AS id_pejabat, pejabat.nama_pejabat, pejabat.nip, pejabat.jabatan,
        ');
        $this->db->join('user', 'nomor_surat.id_user = user.id_user');
        $this->db->join('kode_klasifikasi', 'nomor_surat.id_klasifikasi = kode_klasifikasi.id_klasifikasi');
        $this->db->join('pejabat', 'nomor_surat.id_pejabat = pejabat.id_pejabat');
        $this->db->order_by('created_at', 'desc');
        return $this->db->get('nomor_surat')->result();
    }

    public function getDatatkhir()
    {
        $this->db->order_by('timestamp', 'desc');
        $query = $this->db->get('nomor_surat', 1);
        return $query->result();
    }

    public function insert($data)
    {
        return $this->db->insert('nomor_surat', $data);
    }

    public function detail($where)
    {
        $this->db->where($where);
        $this->db->select('
          nomor_surat.*, user.id_user AS id_user, user.nama,
          nomor_surat.*, kode_klasifikasi.id_klasifikasi AS id_klasifikasi, kode_klasifikasi.jenis_arsip, kode_klasifikasi.kode_klasifikasi, kode_klasifikasi.persetujuan,
          nomor_surat.*, pejabat.id_pejabat AS id_pejabat, pejabat.nama_pejabat, pejabat.jabatan,
        ');
        $this->db->join('user', 'nomor_surat.id_user = user.id_user');
        $this->db->join('kode_klasifikasi', 'nomor_surat.id_klasifikasi = kode_klasifikasi.id_klasifikasi');
        $this->db->join('pejabat', 'nomor_surat.id_pejabat = pejabat.id_pejabat');
        $this->db->from('nomor_surat');
        $query = $this->db->get();
        return $query->result();
    }

    public function edit_no($data, $where)
    {
        $this->db->update('nomor_surat', $data, $where);
    }

    public function upload($data, $where)
    {
        $this->db->update('nomor_surat', $data, $where);
    }
    public function getKlasifikasi()
    {
        $query = $this->db->get('kode_klasifikasi');
        return $query->result->result_array();
    }

    public function auto_code($id)
    {

        $query = $this->db->query("SELECT MAX(nomor) as max_code FROM nomor_surat WHERE id_klasifikasi='$id'");
        return $query->row_array();
    }

    public function get_jenis($id)
    {
        $query = $this->db->get_where('kode_klasifikasi', ['id_klasifikasi' => $id]);
        return $query->row_array();
    }

    public function savePdf($data)
    {
        $this->db->insert('nomor_surat', $data);
    }


    public function save_filee($file_name)
    {
        $data = array(
            'file_surat' => $file_name
        );

        $this->db->insert('nomor_surat', $data);
    }

    public function get_file($id_nomor)
    {
        $this->db->select('file_surat');
        $this->db->where('id_nomor', $id_nomor);
        $query = $this->db->get('nomor_surat');

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }

        return null;
    }

    public function save_file($file_name)
    {
        $data = array(
            'file_surat' => $file_name
        );

        $this->db->insert('nomor_surat', $data);
    }
    public function update_st($data, $where)
    {
        $this->db->update('nomor_surat', $data, $where);
    }

    public function get_keyword($keyword)
    {
        $this->db->select('
          nomor_surat.*, user.id_user AS id_user, user.nama,
          nomor_surat.*, kode_klasifikasi.id_klasifikasi AS id_klasifikasi, kode_klasifikasi.jenis_arsip, kode_klasifikasi.kode_klasifikasi, kode_klasifikasi.persetujuan,
          nomor_surat.*, pejabat.id_pejabat AS id_pejabat, pejabat.nama_pejabat, pejabat.jabatan,
        ');
        $this->db->join('user', 'nomor_surat.id_user = user.id_user');
        $this->db->join('kode_klasifikasi', 'nomor_surat.id_klasifikasi = kode_klasifikasi.id_klasifikasi');
        $this->db->join('pejabat', 'nomor_surat.id_pejabat = pejabat.id_pejabat');
        $this->db->from('nomor_surat');
        $this->db->like('nomor', $keyword);
        $this->db->or_like('sifat', $keyword);
        $this->db->or_like('tujuan_surat', $keyword);
        $this->db->or_like('perihal', $keyword);
        $this->db->or_like('tanggal_surat', $keyword);
        $this->db->or_like('status_verifikasi', $keyword);
        $this->db->or_like('id_user', $keyword);
        $this->db->or_like('id_klasifikasi', $keyword);
        $this->db->or_like('id_pejabat', $keyword);
        return $this->db->get()->result();
    }
}
