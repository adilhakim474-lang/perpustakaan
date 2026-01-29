<?php
/*
NAMA FILE: Anggota.php
LOKASI: application/controllers/Anggota.php
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model');
    }

    // Menampilkan daftar anggota
    public function index()
    {
        $data['title'] = 'Data Anggota';
        $data['anggota'] = $this->Anggota_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('anggota/index', $data);
        $this->load->view('templates/footer');
    }

    // Form tambah anggota
    public function tambah()
    {
        $data['title'] = 'Tambah Anggota';
        
        $this->load->view('templates/header', $data);
        $this->load->view('anggota/tambah');
        $this->load->view('templates/footer');
    }

    // Proses simpan anggota baru
    public function simpan()
    {
        // Validasi input
        $this->form_validation->set_rules('no_anggota', 'No Anggota', 'required|trim|is_unique[anggota.no_anggota]', [
            'required' => 'No anggota harus diisi',
            'is_unique' => 'No anggota sudah digunakan'
        ]);
        $this->form_validation->set_rules('nama_anggota', 'Nama Anggota', 'required|trim', [
            'required' => 'Nama anggota harus diisi'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', [
            'required' => 'Jenis kelamin harus dipilih'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat harus diisi'
        ]);
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|trim|numeric|min_length[10]|max_length[15]', [
            'required' => 'No telepon harus diisi',
            'numeric' => 'No telepon harus berupa angka',
            'min_length' => 'No telepon minimal 10 digit',
            'max_length' => 'No telepon maksimal 15 digit'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email', [
            'valid_email' => 'Format email tidak valid'
        ]);
        $this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required', [
            'required' => 'Tanggal daftar harus diisi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('anggota/tambah');
        } else {
            $data = array(
                'no_anggota' => $this->input->post('no_anggota'),
                'nama_anggota' => $this->input->post('nama_anggota'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'email' => $this->input->post('email'),
                'tanggal_daftar' => $this->input->post('tanggal_daftar'),
                'status' => 'Aktif'
            );

            $simpan = $this->Anggota_model->insert($data);

            if ($simpan) {
                $this->session->set_flashdata('success', 'Data anggota berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data anggota');
            }
            
            redirect('anggota');
        }
    }

    // Form edit anggota
    public function edit($id)
    {
        $data['title'] = 'Edit Anggota';
        $data['anggota'] = $this->Anggota_model->get_by_id($id);
        
        if (!$data['anggota']) {
            $this->session->set_flashdata('error', 'Data anggota tidak ditemukan');
            redirect('anggota');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('anggota/edit', $data);
        $this->load->view('templates/footer');
    }

    // Proses update anggota
    public function update()
    {
        $id = $this->input->post('id_anggota');
        
        // Validasi input
        $this->form_validation->set_rules('nama_anggota', 'Nama Anggota', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|trim|numeric|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('anggota/edit/' . $id);
        } else {
            $data = array(
                'nama_anggota' => $this->input->post('nama_anggota'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'no_telp' => $this->input->post('no_telp'),
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status')
            );

            $update = $this->Anggota_model->update($id, $data);

            if ($update) {
                $this->session->set_flashdata('success', 'Data anggota berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data anggota');
            }
            
            redirect('anggota');
        }
    }

    // Hapus anggota
    public function hapus($id)
    {
        $anggota = $this->Anggota_model->get_by_id($id);
        
        if (!$anggota) {
            $this->session->set_flashdata('error', 'Data anggota tidak ditemukan');
            redirect('anggota');
        }

        $hapus = $this->Anggota_model->delete($id);

        if ($hapus) {
            $this->session->set_flashdata('success', 'Data anggota berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data anggota');
        }
        
        redirect('anggota');
    }

    // Detail anggota
    public function detail($id)
    {
        $data['title'] = 'Detail Anggota';
        $data['anggota'] = $this->Anggota_model->get_by_id($id);
        
        if (!$data['anggota']) {
            $this->session->set_flashdata('error', 'Data anggota tidak ditemukan');
            redirect('anggota');
        }

        // Ambil riwayat peminjaman anggota
        $this->load->model('Peminjaman_model');
        $data['riwayat'] = $this->Peminjaman_model->get_by_anggota($id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('anggota/detail', $data);
        $this->load->view('templates/footer');
    }
}