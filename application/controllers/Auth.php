<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }
    public function index()
    {
        if ($this->session->userdata('login') == 1 && $this->session->userdata('jabatan') == 'SuperAdmin') {
            redirect(base_url('welcome'));
        } else if ($this->session->userdata('login') == 1 && $this->session->userdata('jabatan') == 'Admin') {
            redirect(base_url('Admin'));
        } else if ($this->session->userdata('login') == 1 && $this->session->userdata('jabatan') == 'Pabrik') {
            redirect(base_url('pabrikqc'));
        } else if ($this->session->userdata('login') == 1 && $this->session->userdata('jabatan') == 'Keuangan') {
            redirect(base_url('keuangan'));
        }
        $this->load->library('session');
        $this->load->view('auth/login');
    }

    public function masuk()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        if (($username == "") || ($password == "")) {
            $this->session->set_flashdata("pesan", "<div class='alert alert-danger' role='alert' fade>Isi Semua Data</div>");
            redirect(base_url('/auth'));
        } else {
            $where = array(
                'username' => $username,
                'password' => $password
            );
            $cek = $this->Auth_model->GetDataLogin('user', $where);
            if (count($cek) > 0) {
                foreach ($cek as $cek) {
                    $data_session = array(
                        'login' => TRUE,
                        'id' => $cek->id,
                        'id_pabrik' => $cek->id_pabrik,
                        'nama' => $cek->nama,
                        'username' => $cek->username,
                        'jabatan' => $cek->jabatan,
                        'tgl' => date('Y-m-d')
                    );
                }
                $this->session->set_userdata($data_session);
                if ($this->session->userdata('jabatan') == 'SuperAdmin') {
                    redirect(base_url('/welcome'));
                } else if ($this->session->userdata('jabatan') == 'Admin') {
                    redirect(base_url('/spk'));
                } else if ($this->session->userdata('jabatan') == 'Pabrik') {
                    redirect(base_url('/pabrikqc'));
                } else if ($this->session->userdata('jabatan') == 'Keuangan') {
                    redirect(base_url('/keuangan'));
                } else if ($this->session->userdata('jabatan') == 'Bahan') {
                    redirect(base_url('/bahan'));
                } else if ($this->session->userdata('jabatan') == 'Pembagi PO') {
                    redirect(base_url('/po'));
                }
            } else {
                $this->session->set_flashdata("pesan", "<div class='alert alert-danger' role='alert' fade>Username atau Password anda salah</div>");
                redirect(base_url('/auth'));
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('/auth'));
    }
}
