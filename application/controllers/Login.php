<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        // if ($this->session->userdata('email')) {
        //     redirect('Profile');
        // }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Masukkan email',
            'valid_email' => 'Email tidak valid!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Masukkan password'
        ]);
        if ($this->form_validation->run() == false) {

            $data['title'] = "Login";
            $this->load->view('templates_login/header', $data);
            $this->load->view('Login');
            $this->load->view('templates_login/footer');
        } else {
            //validasi sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        //ambil data user, lalu query
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        //user ada
        if ($user) {
            //user aktif
            if ($user['aktivasi'] == "Aktif") {
                //user aktif
                if (password_verify($password, $user['password'])) {
                    //password benar
                    $data = [
                        'email' => $user['email'],
                        'role' => $user['role'],
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role'] == 'Admin') {
                        redirect('Admin');
                    } else {
                        redirect('Pegawai');
                    }
                } else {
                    //password salah
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password salah!</div>');
                    redirect('Login');
                }
            } else {
                //user tidak aktif
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email belum diaktivasi!</div>');
                redirect('Login');
            }
        } else {
            //user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email tidak terdaftar !</div>');
            redirect('Login');
        }
    }

    public function Daftar()
    {
        // if ($this->session->userdata('email')) {
        //     redirect('Profile');
        // }

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Bagian Nama Lengkap wajib di isi.'
        ]);
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[user.nip]', [
            'required' => 'Bagian NIP wajib di isi.',
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
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Bagian Password wajib di isi',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Daftar";
            $this->load->view('templates_login/header', $data);
            $this->load->view('Daftar');
            $this->load->view('templates_login/footer');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('name', true)),
                'nip' => htmlspecialchars($this->input->post('nip', true)),
                'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role' => "Pegawai",
                'photo' => 'default.jpg',
                'aktivasi' => "Tidak Aktif"
            ];

            $this->db->insert('user', $data);

            //kirim email aktivasi
            // $this->_sendEmail();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat! Akun anda berhasil dibuat.<br> Silahkan Login!</div>');
            redirect('Login');
        }
    }

    // private function _sendEmail()
    // {
    //     $config = [
    //         'protocol' => 'smtp',
    //         'smtp_host' => 'ssl:/smtp.gmail.com',
    //         'smtp_user' => 'nomorsuratbbws@gmail.com',
    //         'smtp_pass' => '@BBWS-MS 2023',
    //         'smtp_port' => '465',
    //         'mailtype' => 'html',
    //         'charset' => 'utf-8',
    //         'newline' => "\r\n",
    //     ];

    //     $this->load->library('email', $config);
    //     $this->email->initialize($config);

    //     $this->email->from('nomorsuratbbws@gmail.com', 'Nomor Surat BBWS-MS');
    //     $this->email->to('yuandari8@gmail.com');
    //     $this->email->subject('Testing');
    //     $this->email->message('Hello Wordl');

    //     if ($this->email->send()) {
    //         return true;
    //     } else {
    //         echo $email->ErrorInfo;
    //         die;
    //     };
    // }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('password');

        $this->session->set_flashdata('message', '<div class="alert alert-success" password="alert">
            Logout berhasil!</div>');
        redirect('Login');
    }
}
