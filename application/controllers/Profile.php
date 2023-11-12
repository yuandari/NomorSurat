<?php

class Profile extends CI_Controller
{
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Profile Saya";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('Profile', $data);
        $this->load->view('templates_admin/footer');
    }

    public function edit_profile()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Edit Profile";

        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim', [
            'required' => 'Bagian Nama Lengkap wajib di isi.'
        ]);
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
            'required' => 'Bagian Jabatan wajib di isi.'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar', $data);
            $this->load->view('Edit_profile', $data);
            $this->load->view('templates_admin/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');


            //cek jika ada gambar
            $upload_photo = $_FILES['photo']['name'];

            if ($upload_photo) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('photo')) {
                    $old_photo = $data['user']['photo'];
                    if ($old_photo != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_photo);
                    }

                    $new_photo = $this->upload->data('file_name');
                    $this->db->set('photo', $new_photo);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profile berhasil diedit!</div>');
            redirect('Profile');
        }
    }

    public function ganti_password()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Ganti Password";

        //eror
        $this->form_validation->set_rules('password_sekarang', 'Password Sekarang', 'required|trim', [
            'required' => 'Bagian Password Saat Ini wajib di isi.'
        ]);

        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[3]', [
            'required' => 'Bagian Password Baru wajib di isi.',
            'min_length' => 'Password terlalu pendek!'
        ]);

        $this->form_validation->set_rules('password_baru2', 'Ulangi Password', 'required|trim|min_length[3]|matches[password_baru1]', [
            'required' => 'Bagian Ulangi Password wajib di isi.',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar', $data);
            $this->load->view('Ganti_password', $data);
            $this->load->view('templates_admin/footer');
        } else {
            //lolos
            $password_sekarang = $this->input->post('password_sekarang');
            $password_baru = $this->input->post('password_baru1');
            if (!password_verify($password_sekarang, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password Saat Ini Salah!</div>');
                redirect('Profile/ganti_password');
            } else {
                if ($password_sekarang == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Baru tidak boleh sama dengan password Saat Ini!</div>');
                    redirect('Profile/ganti_password');
                } else {
                    //password ok
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password berhasil diubah!</div>');
                    redirect('Profile/ganti_password');
                }
            }
        }
    }
}
