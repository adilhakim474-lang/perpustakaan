<?php
/*
NAMA FILE: Dashboard.php
LOKASI: application/controllers/Dashboard.php
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // LOAD MODEL
        $this->load->model('Buku_model');
        $this->load->model('Anggota_model');
        $this->load->model('Peminjaman_model');

        // LOAD SESSION
        $this->load->library('session');

        // 🔐 CEK LOGIN
        if (!$this->session->userdata('login')) {
            redirect('auth/login'); // arahkan ke halaman login
        }
    }

    public function index()
    {
        // Judul halaman
        $data['title'] = 'Dashboard';

        // Statistik
        $data['total_buku']        = $this->Buku_model->count_all();
        $data['total_anggota']     = $this->Anggota_model->count_all();
        $data['total_dipinjam']    = $this->Peminjaman_model->count_dipinjam();
        $data['total_dikembalikan']= $this->Peminjaman_model->count_dikembalikan();

        // Data peminjaman terbaru
        $data['peminjaman_terbaru'] = $this->Peminjaman_model->get_latest(5);

        // Data buku stok rendah
        $data['buku_stok_rendah'] = $this->Buku_model->get_low_stock(5);

        // Load view
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}
