<?php

class Pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('klasifikasi_model');
    }

    public function index()
    {
        $nama['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $nama['user']['nama'];
        $data['title'] = "Dashboard";
        $users = $this->db->query("SELECT * FROM user");
        $klasifikasi = $this->db->query("SELECT * FROM kode_klasifikasi");
        $nomor = $this->db->query("SELECT * FROM nomor_surat");
        $pejabat = $this->db->query("SELECT * FROM pejabat");
        $data['users'] = $users->num_rows();
        $data['klasifikasi'] = $klasifikasi->num_rows();
        $data['nomor'] = $nomor->num_rows();
        $data['pejabat'] = $pejabat->num_rows();
        $this->load->model('nomor_model');
        $data['nomorr'] = $this->nomor_model->get_data();
        $data['userss'] = $this->users_model->get_data();
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar', $nama);
        $this->load->view('pegawai/Dashboard', $data);
        $this->load->view('templates_pegawai/footer');
    }


    //Profile
    public function Profile()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Profile Saya";
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar', $data);
        $this->load->view('pegawai/Profile', $data);
        $this->load->view('templates_pegawai/footer');
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
            $this->load->view('templates_pegawai/header', $data);
            $this->load->view('templates_pegawai/sidebar', $data);
            $this->load->view('pegawai/edit_profile', $data);
            $this->load->view('templates_pegawai/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $jabatan = $this->input->post('jabatan');


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
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal.. gambar tidak memenuhi ketentuan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    redirect('Pegawai/Profile');
                }
            }

            $this->db->set('nama', $name);
            $this->db->set('jabatan', $jabatan);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profile berhasil diedit!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            redirect('Pegawai/Profile');
        }
    }


    // Ganti Password
    public function ganti_password()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Ganti Password";

        //eror
        $this->form_validation->set_rules('password_sekarang', 'Password Sekarang', 'required|trim', [
            'required' => 'Bagian Password Saat Ini wajib di isi.'
        ]);

        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[4]', [
            'required' => 'Bagian Password Baru wajib di isi.',
            'min_length' => 'Password terlalu pendek!'
        ]);

        $this->form_validation->set_rules('password_baru2', 'Ulangi Password', 'required|trim|min_length[4]|matches[password_baru1]', [
            'required' => 'Bagian Ulangi Password wajib di isi.',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_pegawai/header', $data);
            $this->load->view('templates_pegawai/sidebar', $data);
            $this->load->view('pegawai/GantiPassword', $data);
            $this->load->view('templates_pegawai/footer');
        } else {
            //lolos
            $password_sekarang = $this->input->post('password_sekarang');
            $password_baru = $this->input->post('password_baru1');
            if (!password_verify($password_sekarang, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password Saat Ini Salah!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                redirect('Pegawai/ganti_password');
            } else {
                if ($password_sekarang == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Baru tidak boleh sama dengan password Saat Ini!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    redirect('Pegawai/ganti_password');
                } else {
                    //password ok
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    redirect('Pegawai/ganti_password');
                }
            }
        }
    }


    //Kode Klasifikasi
    public function DataKlasifikasi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Kode Klasifikasi Surat";
        $data['klasifikasi'] = $this->klasifikasi_model->get_data();
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar', $data);
        $this->load->view('pegawai/DataKlasifikasi', $data);
        $this->load->view('templates_pegawai/footer');
    }

    //Data Pejabat
    public function DataPejabat()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Pejabat penandatangan";
        $data['pejabat'] = $this->pejabat_model->get_data();
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar', $data);
        $this->load->view('pegawai/DataPejabat', $data);
        $this->load->view('templates_pegawai/footer');
    }

    //Nomor Surat
    public function Nomor()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Nomor Surat";
        $this->load->model('nomor_model');
        $data['nomor'] = $this->nomor_model->get_data();
        $data['users'] = $this->users_model->get_data();
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar', $data);
        $this->load->view('pegawai/NomorSurat', $data);
        $this->load->view('templates_pegawai/footer');
    }

    public function detailNomor($id)
    {
        $where = array('id_nomor' => $id);
        $data['nomor'] = $this->db->query("SELECT * FROM nomor_surat WHERE id_nomor='$id'")->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Detail Surat";
        $data['nomor'] = $this->nomor_model->detail($where);
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar', $data);
        $this->load->view('pegawai/DetailNomorSurat', $data);
        $this->load->view('templates_pegawai/footer');
    }

    public function tambah_nmr()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Silahkan pilih jenis arsip surat";
        $data['klasifikasi'] = $this->klasifikasi_model->get_data();
        $data['pejabat'] = $this->pejabat_model->get_data();
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar', $data);
        $this->load->view('pegawai/PilihKlasifikasi', $data);
        $this->load->view('templates_pegawai/footer');
    }

    public function form()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Pengajuan Nomor Surat";

        $data['klasifikasi'] = $this->klasifikasi_model->get_data();
        $data['pejabat'] = $this->pejabat_model->get_data();
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar', $data);

        $this->load->model('nomor_model');
        $id = $_POST['nomor'];
        $data = [
            'jenis' => $this->nomor_model->get_jenis($id),
            'kode' => $this->nomor_model->auto_code($id)
        ];
        $this->load->view('pegawai/tambah_nomor', $data);
        $this->load->view('templates_pegawai/footer');
    }

    public function tambah_aksiNmr()
    {

        $this->form_validation->set_rules('sifat', 'Sifat', 'required|trim', [
            'required' => 'Bagian Sifat surat wajib di isi.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->form();
        } else {
            $nomor                  = $this->input->post('nomor');
            $sifat                  = $this->input->post('sifat');
            $tujuan_surat           = $this->input->post('tujuan_surat');
            $perihal                = $this->input->post('perihal');
            $tanggal_surat          = $this->input->post('tanggal_surat');
            $id_pejabat             = $this->input->post('id_pejabat');
            $id_user                = $this->input->post('id_user');
            $id_klasifikasi         = $this->input->post('id_klasifikasi');
            $status_verifikasi      = $this->input->post('status_verifikasi');

            $data = array(
                'nomor'             => $nomor,
                'sifat'             => $sifat,
                'tujuan_surat'      => $tujuan_surat,
                'perihal'           => $perihal,
                'tanggal_surat'     => $tanggal_surat,
                'id_pejabat'        => $id_pejabat,
                'id_user'           => $id_user,
                'id_klasifikasi'    => $id_klasifikasi,
                'status_verifikasi' => $status_verifikasi

            );

            $this->nomor_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Nomor Surat berhasil diajukan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            // Setelah berhasil kembali ke Nomor
            redirect('Pegawai/index');
        }
    }
    public function uploadSurat($id)
    {
        $where = array('id_nomor' => $id);
        $data['nomor'] = $this->db->query("SELECT * FROM nomor_surat WHERE id_nomor='$id'")->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Upload File Surat";
        $data['nomor'] = $this->nomor_model->detail($where);
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar', $data);
        $this->load->view('pegawai/UploadSurat', $data);
        $this->load->view('templates_pegawai/footer');
    }

    public function aksiUploadSurat()
    {
        $nomor = $this->input->post('nomor');

        //cek jika ada file
        $upload_file = $_FILES['file']['name'];

        if ($upload_file) {
            $config['allowed_types'] = 'pdf';
            $config['max_size']     = 5000;
            $config['upload_path'] = './assets/file/';
            $config['file_name'] = substr(md5(date('Y-m-d H:i:s')), 1, 20);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                // $file_ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $new_file = $this->upload->data('file_name');
                $this->db->set('file_surat', $new_file);
            } else {
                echo $this->upload->display_errors();
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal.. File tidak memenuhi ketentuan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                redirect('Pegawai/Nomor');
            }
        }
        $this->db->where('nomor', $nomor);
        $this->db->update('nomor_surat');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    File berhasil diunggah !<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
        redirect('Pegawai/Nomor');
    }

    public function editNomor($id)
    {
        $where = array('id_nomor' => $id);
        $data['nomor'] = $this->db->query("SELECT * FROM nomor_surat WHERE id_nomor='$id'")->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Edit Nomor Surat";
        $data['nomor'] = $this->nomor_model->detail($where);
        $data['pejabat'] = $this->pejabat_model->get_data();
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar', $data);
        $this->load->view('pegawai/edit_nomor', $data);
        $this->load->view('templates_pegawai/footer');
    }

    public function update_aksiNomor()
    {
        $nomor          = $this->input->post('nomor');
        $sifat          = $this->input->post('sifat');
        $tujuan_surat   = $this->input->post('tujuan_surat');
        $perihal        = $this->input->post('perihal');
        $tanggal_surat  = $this->input->post('tanggal_surat');
        $id_pejabat     = $this->input->post('id_pejabat');


        //cek jika ada file
        $upload_file = $_FILES['file']['name'];

        if ($upload_file) {
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['max_size']     = '4800';
            $config['upload_path'] = './assets/file/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                // Mendapatkan data file lama
                $data_lama = $this->nomor_model->get_file($id_nomor);
                $file_lama = $data_lama['file_surat'];

                // Hapus file lama jika ada
                if ($file_lama != '') {
                    $file_path = './assets/file/' . $file_lama;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }

                $new_file = $this->upload->data('file_name');
                $this->db->set('file_surat', $new_file);
            } else {
                echo $this->upload->display_errors();
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal.. File tidak memenuhi ketentuan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                redirect('Pegawai/Nomor');
            }
        }

        $this->db->set('sifat', $sifat);
        $this->db->set('tujuan_surat', $tujuan_surat);
        $this->db->set('perihal', $perihal);
        $this->db->set('tanggal_surat', $tanggal_surat);
        $this->db->set('id_pejabat', $id_pejabat);
        $this->db->where('nomor', $nomor);
        $this->db->update('nomor_surat');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Detail Nomor Surat Berhasil diupdate!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
        redirect('Pegawai/Nomor');
    }

    // public function update_aksiNomor()
    // {

    //     $this->form_validation->set_rules('sifat', 'Sifat', 'required|trim', [
    //         'required' => 'Bagian Sifat Surat wajib di isi.'
    //     ]);
    //     $this->form_validation->set_rules('tujuan_surat', 'Tujuan Surat', 'required|trim', [
    //         'required' => 'Bagian Tujuan Surat wajib di isi.'
    //     ]);
    //     $this->form_validation->set_rules('perihal', 'Perihal', 'required|trim', [
    //         'required' => 'Bagian Perihal wajib di isi.'
    //     ]);

    //     if ($this->form_validation->run() == false) {
    //         $this->editNomor();
    //     } else {
    //         $nomor     = $this->input->post('nomor');
    //         $sifat     = $this->input->post('sifat');
    //         $tujuan_surat   = $this->input->post('tujuan_surat');
    //         $perihal        = $this->input->post('perihal');
    //         $tanggal_surat  = $this->input->post('tanggal_surat');
    //         $pejabat_penandatangan = $this->input->post('pejabat_penandatangan');
    //         $id_user = $this->input->post('id_user');
    //         $id_klasifikasi = $this->input->post('id_klasifikasi');

    //         //cek jika ada file
    //         $upload_file = $_FILES['file_surat']['name'];

    //         if ($upload_file) {
    //             $config['allowed_types'] = 'pdf';
    //             $config['max_size']     = 0;
    //             $config['upload_path'] = './assets/file/';

    //             $this->load->library('upload', $config);

    //             if ($this->upload->do_upload('file_surat')) {
    //                 $old_file = $data['nomor_surat']['file_surat'];
    //                 if ($old_file != ['file_surat']) {
    //                     unlink(FCPATH . '/assets/file/' . $old_file);
    //                 }

    //                 $new_file = $this->upload->data('file_name');
    //                 $this->db->set('file_surat', $new_file);
    //             } else {
    //                 echo $this->upload->display_errors();
    //             }
    //         }
    //         $data = array(
    //             'nomor'        => $nomor,
    //             'sifat'        => $sifat,
    //             'tujuan_surat'      => $tujuan_surat,
    //             'perihal'           => $perihal,
    //             'tanggal_surat'     => $tanggal_surat,
    //             'pejabat_penandatangan' => $pejabat_penandatangan,
    //             'id_user' => $id_user,
    //             'id_klasifikasi' => $id_klasifikasi,
    //         );
    //         $where = array(
    //             'id_nomor' => $id
    //         );

    //         $this->nomor_model->edit_no($data, $where);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //                 Detail Surat berhasil diedit!
    //                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
    //         // Setelah berhasil kembali ke DataKlasifikasi
    //         redirect('Pegawai/Nomor');
    //     }
    // }
}
