<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }


    //Dashboard
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['nomor_surat'] = $this->db->get_where('nomor_surat', ['nomor' => $this->session->userdata('nomor')])->row_array();
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
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/Dashboard', $data);
        $this->load->view('templates_admin/footer');
    }

    //Profile
    public function Profile()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Profile Saya";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/Profile', $data);
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
            $this->load->view('admin/edit_profile', $data);
            $this->load->view('templates_admin/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $jabatan = $this->input->post('jabatan');


            //cek jika ada gambar
            $upload_photo = $_FILES['photo']['name'];

            if ($upload_photo) {
                $config['allowed_types'] = 'jpg|jpeg|png';
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
                    Gagal... gambar tidak memenuhi ketentuan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
                    redirect('Admin/Profile');
                }
            }

            $this->db->set('nama', $name);
            $this->db->set('jabatan', $jabatan);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profile berhasil diedit!</div>');
            redirect('Admin/Profile');
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
            $this->load->view('admin/GantiPassword', $data);
            $this->load->view('templates_admin/footer');
        } else {
            //lolos
            $password_sekarang = $this->input->post('password_sekarang');
            $password_baru = $this->input->post('password_baru1');
            if (!password_verify($password_sekarang, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password Saat Ini Salah!</div>');
                redirect('Admin/ganti_password');
            } else {
                if ($password_sekarang == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Baru tidak boleh sama dengan password Saat Ini!</div>');
                    redirect('Admin/ganti_password');
                } else {
                    //password ok
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password berhasil diubah!</div>');
                    redirect('Admin/ganti_password');
                }
            }
        }
    }


    //Kode Klasifikasi
    public function dataKlasifikasi()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Klasifikasi Surat";
        $data['klasifikasi'] = $this->klasifikasi_model->get_data();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/DataKlasifikasi', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_datakl()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Tambah Kode Klasifikasi";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/tambah_dataklasifikasi', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_aksikl()
    {
        $this->form_validation->set_rules('kode_klasifikasi', 'Kode Klasifikasi', 'required|trim|is_unique[kode_klasifikasi.kode_klasifikasi]', [
            'required' => 'Bagian Kode Klasifikasi wajib di isi.',
            'is_unique' => 'Kode Klasifikasi sudah ada!'
        ]);
        $this->form_validation->set_rules('jenis_arsip', 'Jenis Arsip', 'required|trim', [
            'required' => 'Bagian Jenis Arsip wajib di isi.'
        ]);
        $this->form_validation->set_rules('persetujuan', 'Persetujuan', 'required|trim', [
            'required' => 'Silahkan pilih persetujuan.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->tambah_datakl();
        } else {
            $kode_klasifikasi   = $this->input->post('kode_klasifikasi');
            $jenis_arsip        = $this->input->post('jenis_arsip');
            $id_user            = $this->input->post('id_user');
            $persetujuan        = $this->input->post('persetujuan');

            $data = array(
                'kode_klasifikasi'  => $kode_klasifikasi,
                'jenis_arsip'       => $jenis_arsip,
                'id_user'           => $id_user,
                'persetujuan'       => $persetujuan
            );

            $this->klasifikasi_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Kode Klasifikasi berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            // Setelah berhasil kembali ke DataKlasifikasi
            redirect('Admin/DataKlasifikasi');
        }
    }

    public function update_datakl($id)
    {
        $where = array('id_klasifikasi' => $id);
        $data['kode_klasifikasi'] = $this->db->query("SELECT * FROM kode_klasifikasi WHERE id_klasifikasi='$id'")->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Edit Kode Klasifikasi";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/edit_dataKlasifikasi', $data);
        $this->load->view('templates_admin/footer');
    }

    public function update_aksikl()
    {
        $this->form_validation->set_rules('jenis_arsip', 'Jenis Arsip', 'required|trim', [
            'required' => 'Bagian Jenis Arsip wajib di isi.'
        ]);
        $this->form_validation->set_rules('persetujuan', 'Persetujuan', 'required|trim', [
            'required' => 'Bagian Jenis Arsip wajib di isi.'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->update_datakl();
        } else {
            $id                 = $this->input->post('id_klasifikasi');
            $kode_klasifikasi   = $this->input->post('kode_klasifikasi');
            $jenis_arsip        = $this->input->post('jenis_arsip');
            $persetujuan        = $this->input->post('persetujuan');

            $data = array(
                'kode_klasifikasi' => $kode_klasifikasi,
                'jenis_arsip' => $jenis_arsip,
                'persetujuan' => $persetujuan,
            );

            $where = array(
                'id_klasifikasi' => $id
            );

            $this->klasifikasi_model->update_kl($data, $where);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Kode Klasifikasi berhasil diedit!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            // Setelah berhasil kembali ke DataKlasifikasi
            redirect('Admin/DataKlasifikasi');
        }
    }

    public function deletekl($id)
    {
        $where = array('id_klasifikasi' => $id);
        $this->klasifikasi_model->delete_kl($where);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Kode Klasifikasi berhasil dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
        // Setelah berhasil kembali ke DataKlasifikasi
        redirect('Admin/DataKlasifikasi');
    }

    //Data pejabat penandatangan
    public function dataPejabat()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Data Pejabat Penandatangan";
        $data['pejabat'] = $this->pejabat_model->get_data();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/DataPejabat', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_datapj()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Tambah Data Pejabat Penandatangan";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/tambah_datapejabat', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_aksipj()
    {
        $this->form_validation->set_rules('nama_pejabat', 'Nama Pejabat', 'required|trim', [
            'required' => 'Bagian Nama Pejabat wajib di isi.'
        ]);
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|min_length[18]|max_length[18]|is_unique[pejabat.nip]', [
            'required' => 'Bagian NIP wajib di isi',
            'numeric' => 'Bagian NIP wajib di isi dengan angka',
            'min_length' => 'Bagian NIP di isi minimal 18 angka',
            'max_length' => 'Bagian NIP isi maksimal 18 angka',
            'is_unique' => 'NIP sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim|is_unique[pejabat.jabatan]', [
            'required' => 'Bagian Jabatan wajib di isi.',
            'is_unique' => 'Jabatan sudah tersedia!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->tambah_datapj();
        } else {
            $nama_pejabat   = $this->input->post('nama_pejabat');
            $nip            = $this->input->post('nip');
            $jabatan        = $this->input->post('jabatan');

            $data = array(
                'nama_pejabat'  => $nama_pejabat,
                'nip'           => $nip,
                'jabatan'       => $jabatan
            );

            $this->pejabat_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Data Pejabat Penandatangan berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            // Setelah berhasil kembali ke Data Pejabat
            redirect('Admin/dataPejabat');
        }
    }

    public function updatePejabat($id)
    {
        $where = array('id_pejabat' => $id);
        $data['pejabatt'] = $this->db->query("SELECT * FROM pejabat WHERE id_pejabat='$id'")->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Edit Data Pejabat";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/edit_dataPejabat', $data);
        $this->load->view('templates_admin/footer');
    }

    public function update_aksiPejabat()
    {
        //tampilan rules
        $this->form_validation->set_rules('nama_pejabat', 'Nama Pejabat', 'required|trim', [
            'required' => 'Bagian Nama Pejabat wajib diisi'
        ]);
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|min_length[18]|max_length[18]|is_unique[pejabat.nip]', [
            'required' => 'Bagian NIP wajib di isi',
            'numeric' => 'Bagian NIP wajib di isi dengan angka',
            'min_length' => 'Bagian NIP di isi minimal 18 angka',
            'max_length' => 'Bagian NIP isi maksimal 18 angka',
            'is_unique' => 'NIP sudah terdaftar!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            // $this->updatePejabat();
            // echo $this->upload->display_errors();
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Data tidak memenuhi ketentuan !<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            redirect('Admin/dataPejabat');
        } else {
            $id            = $this->input->post('id_pejabat');
            $nama_pejabat  = $this->input->post('nama_pejabat');
            $nip           = $this->input->post('nip');
            $jabatan       = $this->input->post('jabatan');

            $data = array(
                'nama_pejabat' => $nama_pejabat,
                'nip' => $nip,
                'jabatan' => $jabatan
            );

            $where = array(
                'id_pejabat' => $id
            );

            $this->pejabat_model->update_pj($data, $where);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data Pejabat berhasil diedit!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            // Setelah berhasil kembali ke dataUser
            redirect('Admin/dataPejabat');
        }
    }

    //Data User
    public function dataUser()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Data User";
        $data['users'] = $this->users_model->get_data();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/DataUser', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_dataUsers()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Tambah User";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/tambah_users', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_aksiUsers()
    {
        //rules
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Bagian Nama Lengkap wajib di isi.'
        ]);
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|numeric|min_length[18]|max_length[18]|is_unique[user.nip]', [
            'required' => 'Bagian NIP wajib di isi',
            'numeric' => 'Bagian NIP wajib di isi dengan angka',
            'min_length' => 'Bagian NIP di isi minimal 18 angka',
            'max_length' => 'Bagian NIP isi maksimal 18 angka',
            'is_unique' => 'NIP sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim', [
            'required' => 'Bagian Jabatan wajib di isi'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Bagian Email wajib di isi',
            'valid_email' => 'Email tidak valid!',
            'is_unique' => 'Email sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]', [
            'required' => 'Bagian Password wajib di isi',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[4]|matches[password1]', [
            'required' => 'Bagian Ulangi Password wajib di isi',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => 'Silahkan pilih Role !'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->tambah_dataUsers();
        } else {
            $nama       = $this->input->post('nama');
            $nip        = $this->input->post('nip');
            $jabatan    = $this->input->post('jabatan');
            $email      = $this->input->post('email');
            $password   = $this->input->post('password');
            $role       = $this->input->post('role');
            $aktivasi   = $this->input->post('aktivasi');

            $data = array(
                'nama'      => $nama,
                'nip'       => $nip,
                'jabatan'   => $jabatan,
                'email'     => $email,
                'password'  => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'photo'     => 'default.jpg',
                'role'      => $role,
                'aktivasi'  => "Aktif"
            );

            $this->users_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    User berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            // Setelah berhasil kembali ke dataUser
            redirect('Admin/dataUser');
        }
    }

    public function updateUsers($id)
    {
        $where = array('id_user' => $id);
        $data['users'] = $this->db->query("SELECT * FROM user WHERE id_user='$id'")->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Edit Status Aktivasi User";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/edit_dataUsers', $data);
        $this->load->view('templates_admin/footer');
    }

    public function update_aksiUsers()
    {
        //tampilan rules
        $this->form_validation->set_rules('aktivasi', 'Aktivasi', 'required|trim', [
            'required' => 'Bagian Aktivasi wajib di pilih.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->updateUsers();
        } else {
            $id         = $this->input->post('id_user');
            $nama       = $this->input->post('nama');
            $nip        = $this->input->post('nip');
            $jabatan    = $this->input->post('jabatan');
            $email      = $this->input->post('email');
            $role       = $this->input->post('role');
            $photo      = $this->input->post('photo');
            $aktivasi   = $this->input->post('aktivasi');

            $data = array(
                'nama' => $nama,
                'nip' => $nip,
                'jabatan' => $jabatan,
                'email' => $email,
                'role' => $role,
                'aktivasi' => $aktivasi,
            );

            $where = array(
                'id_user' => $id
            );

            $this->users_model->update_users($data, $where);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Status Aktivasi User berhasil diedit!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            // Setelah berhasil kembali ke dataUser
            redirect('Admin/dataUser');
        }
    }

    public function deleteUsers($id)
    {
        $where = array('id_user' => $id);
        $this->users_model->delete_users($where);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    User berhasil dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
        // Setelah berhasil kembali ke dataUser
        redirect('Admin/dataUser');
    }


    //Nomor Surat
    public function Nomor()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Nomor Surat";
        $data['nomor'] = $this->nomor_model->get_data();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/NomorSurat', $data);
        $this->load->view('templates_admin/footer');
    }

    public function detailNomor($id)
    {
        $where = array('id_nomor' => $id);
        $data['nomor'] = $this->db->query("SELECT * FROM nomor_surat WHERE id_nomor='$id'")->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Detail Surat";
        $data['nomor'] = $this->nomor_model->detail($where);
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/DetailNomorSurat', $data);
        $this->load->view('templates_admin/footer');
    }

    public function Setujui($id)
    {
        $where = array('id_nomor' => $id);
        $data['nomor'] = $this->db->query("SELECT * FROM nomor_surat WHERE id_nomor='$id'")->result();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user']['nama'];
        $data['title'] = "Detail Surat";
        $data['nomor'] = $this->nomor_model->detail($where);
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/setujui_nomor', $data);
        $this->load->view('templates_admin/footer');
    }

    public function aksiSetujui()
    {
        $this->form_validation->set_rules('status_verifikasi', 'Status Verifikasi', 'required|trim', [
            'required' => 'Bagian Jenis Arsip wajib di isi.'
        ]);
        if ($this->form_validation->run() == FALSE) {
            $this->Setujui();
        } else {
            $id                 = $this->input->post('id_nomor');
            $status_verifikasi   = $this->input->post('status_verifikasi');

            $data = array(
                'status_verifikasi' => $status_verifikasi
            );

            $where = array(
                'id_nomor' => $id
            );

            $this->nomor_model->update_st($data, $where);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                   Status Verifikasi berhasil diubah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
            // Setelah berhasil kembali ke Nomor
            redirect('Admin/Nomor');
        }
    }

    // public function editNomor($id)
    // {
    //     $where = array('id_nomor' => $id);
    //     $data['nomor'] = $this->db->query("SELECT * FROM nomor_surat WHERE id_nomor='$id'")->result();
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['user']['nama'];
    //     $data['title'] = "Edit Nomor Surat";
    //     $data['nomor'] = $this->nomor_model->detail($where);
    //     $this->load->view('templates_admin/header', $data);
    //     $this->load->view('templates_admin/sidebar', $data);
    //     $this->load->view('admin/edit_nomor', $data);
    //     $this->load->view('templates_admin/footer');
    // }

    // public function update_aksiNomor()
    // {
    //     //tampilan rules
    //     $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required|trim', [
    //         'required' => 'Bagian Jenis Surat wajib di isi.'
    //     ]);

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->editNomor();
    //     } else {
    //         $id                     = $this->input->post('id_nomor');
    //         $nomor                  = $this->input->post('nomor');
    //         $tipe_surat             = $this->input->post('tipe_surat');
    //         $tujuan_surat           = $this->input->post('tujuan_surat');
    //         $perihal                = $this->input->post('perihal');
    //         $tanggal_surat          = $this->input->post('tanggal_surat');
    //         $pejabat_penandatangan  = $this->input->post('pejabat_penandatangan');
    //         $status_verifikasi      = $this->input->post('status_verifikasi');
    //         $id_user                = $this->input->post('id_user');
    //         $id_kode         = $this->input->post('id_kode');
    //         $id_klasifikasi                = $this->input->post('id_klasifikasi');

    //         $data = array(
    //             'nomor'             => $nomor,
    //             'tipe_surat'        => $tipe_surat,
    //             'tujuan_surat'      => $tujuan_surat,
    //             'perihal'           => $perihal,
    //             'tanggal_surat'     => $tanggal_surat,
    //             'pejabat_penandatangan' => $pejabat_penandatangan,
    //             'status_verifikasi' => $status_verifikasi,
    //             'id_user'    => $id_user,
    //             'id_kode'           => $id_kode,
    //             'id_klasifikasi'           => $id_klasifikasi,
    //         );

    //         $where = array(
    //             'id_nomor' => $id
    //         );

    //         $this->nomor_model->edit_no($data, $where);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //             Nomor Surat berhasil diedit!
    //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div>');
    //         // Setelah berhasil kembali ke Nomor
    //         redirect('Admin/Nomor');
    //     }
    // }

    //Search
    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data['nomorsrt'] = $this->nomor_model->get_keyword($keyword);
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/NomorSurat', $data);
        $this->load->view('templates_admin/footer');
    }

    public function print()
    {
        $data['print'] = $this->nomor_model->get_data();
        $this->load->view('Admin/print_nomor', $data);
    }

    // public function print()
    // {
    //     $data['nomor'] = $this->nomor_model->get_data();
    //     require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
    //     require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

    //     $object = new PHPExcel();
    //     $object->getProperties()->setCreator("Balai Besar Wilayah Sungai Mesuji Sekampung");
    //     $object->getProperties()->setLastModifiedBy("Balai Besar Wilayah Sungai Mesuji Sekampung");
    //     $object->getProperties()->setTitle("Data Nomor Surat");

    //     $object->setActiveSheetIndex(0);
    //     $object->getActiveSheet()->setCellValue('A1', 'No');
    //     $object->getActiveSheet()->setCellValue('B1', 'Tipe Surat');
    //     $object->getActiveSheet()->setCellValue('C1', 'Nomor Surat');
    //     $object->getActiveSheet()->setCellValue('D1', 'Tujuan Surat');
    //     $object->getActiveSheet()->setCellValue('E1', 'Perihal');
    //     $object->getActiveSheet()->setCellValue('F1', 'Tanggal Surat');
    //     $object->getActiveSheet()->setCellValue('G1', 'Jenis Surat');
    //     $object->getActiveSheet()->setCellValue('H1', 'Pejabat Penandatangan');
    //     $object->getActiveSheet()->setCellValue('I1', 'Petugas Input');
    //     $object->getActiveSheet()->setCellValue('J1', 'Tanggal Pengajuan');

    //     $baris = 2;
    //     $no = 1;

    //     foreach ($data['nomor'] as $p) {
    //         $object->getActiveSheet()->setCellValue('A' . $baris, $no++);
    //         $object->getActiveSheet()->setCellValue('B' . $baris, $p->tipe_surat);
    //         $object->getActiveSheet()->setCellValue('C' . $baris, $p->nomor);
    //         $object->getActiveSheet()->setCellValue('D' . $baris, $p->tujuan_surat);
    //         $object->getActiveSheet()->setCellValue('E' . $baris, $p->perihal);
    //         $object->getActiveSheet()->setCellValue('F' . $baris, $p->tanggal_surat);
    //         $object->getActiveSheet()->setCellValue('G' . $baris, $p->jenis_arsip);
    //         $object->getActiveSheet()->setCellValue('H' . $baris, $p->jabatan);
    //         $object->getActiveSheet()->setCellValue('I' . $baris, $p->nama);
    //         $object->getActiveSheet()->setCellValue('J' . $baris, $p->created_at);

    //         $baris++;
    //     }

    //     $filename = "Data_Nomor_Surat" . '.xlsx';
    //     $object->getActiveSheet()->setTitle("Data Nomor Surat");
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="' . $filename . '"');
    //     header('Cache-Control: max-age=0');

    //     $writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
    //     ob_end_clean();
    //     $writer->save('php://output');

    //     exit;
    // }
}
