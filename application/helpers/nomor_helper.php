<?php

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('Login');
    } else {
        $role = $ci->session->userdata('role');
    }
}

function NmrSurat()
{
    $ci = get_instance();
    $query = select('
    nomor_surat.*, kode_surat.id_kode AS id_kode, kode_surat.kode,
    nomor_surat.*, kode_klasifikasi.id_klasifikasi AS id_klasifikasi, kode_klasifikasi.kode_klasifikasi');
    $data = $ci->db->query($query)->row_array();
    $kode = $data[''];
}
