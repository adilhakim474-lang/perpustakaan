<?php
/*
NAMA FILE: Buku.php
LOKASI: application/controllers/Buku.php
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Buku_model');
    }

    // Menampilkan daftar buku
    public function index()
    {
        $data['title'] = 'Data Buku';
        $data['buku'] = $this->Buku_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('buku/index', $data);
        $this->load->view('templates/footer');
    }

    // Form tambah buku
    public function tambah()
    {
        $data['title'] = 'Tambah Buku';
        
        $this->load->view('templates/header', $data);
        $this->load->view('buku/tambah');
        $this->load->view('templates/footer');
    }

    // Proses simpan buku baru
    public function simpan()
    {
        // Validasi input
        $this->form_validation->set_rules('kode_buku', 'Kode Buku', 'required|trim|is_unique[buku.kode_buku]', [
            'required' => 'Kode buku harus diisi',
            'is_unique' => 'Kode buku sudah digunakan'
        ]);
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|trim', [
            'required' => 'Judul buku harus diisi'
        ]);
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'required|trim', [
            'required' => 'Pengarang harus diisi'
        ]);
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|trim', [
            'required' => 'Penerbit harus diisi'
        ]);
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|numeric|min_length[4]|max_length[4]', [
            'required' => 'Tahun terbit harus diisi',
            'numeric' => 'Tahun terbit harus berupa angka',
            'min_length' => 'Tahun terbit harus 4 digit',
            'max_length' => 'Tahun terbit harus 4 digit'
        ]);
        $this->form_validation->set_rules('jumlah_buku', 'Jumlah Buku', 'required|numeric', [
            'required' => 'Jumlah buku harus diisi',
            'numeric' => 'Jumlah buku harus berupa angka'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('buku/tambah');
        } else {
            $jumlah = $this->input->post('jumlah_buku');
            
            $data = array(
                'kode_buku' => $this->input->post('kode_buku'),
                'judul_buku' => $this->input->post('judul_buku'),
                'pengarang' => $this->input->post('pengarang'),
                'penerbit' => $this->input->post('penerbit'),
                'tahun_terbit' => $this->input->post('tahun_terbit'),
                'jumlah_buku' => $jumlah,
                'stok_tersedia' => $jumlah // Stok awal sama dengan jumlah buku
            );

            $simpan = $this->Buku_model->insert($data);

            if ($simpan) {
                $this->session->set_flashdata('success', 'Data buku berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data buku');
            }
            
            redirect('buku');
        }
    }

    // Form edit buku
    public function edit($id)
    {
        $data['title'] = 'Edit Buku';
        $data['buku'] = $this->Buku_model->get_by_id($id);
        
        if (!$data['buku']) {
            $this->session->set_flashdata('error', 'Data buku tidak ditemukan');
            redirect('buku');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('buku/edit', $data);
        $this->load->view('templates/footer');
    }

    // Proses update buku
    public function update()
    {
        $id = $this->input->post('id_buku');
        
        // Validasi input
        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|trim');
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'required|trim');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|trim');
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|numeric|min_length[4]|max_length[4]');
        $this->form_validation->set_rules('jumlah_buku', 'Jumlah Buku', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('buku/edit/' . $id);
        } else {
            $buku_lama = $this->Buku_model->get_by_id($id);
            $jumlah_baru = $this->input->post('jumlah_buku');
            $selisih = $jumlah_baru - $buku_lama->jumlah_buku;
            
            $data = array(
                'judul_buku' => $this->input->post('judul_buku'),
                'pengarang' => $this->input->post('pengarang'),
                'penerbit' => $this->input->post('penerbit'),
                'tahun_terbit' => $this->input->post('tahun_terbit'),
                'jumlah_buku' => $jumlah_baru,
                'stok_tersedia' => $buku_lama->stok_tersedia + $selisih
            );

            $update = $this->Buku_model->update($id, $data);

            if ($update) {
                $this->session->set_flashdata('success', 'Data buku berhasil diupdate');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate data buku');
            }
            
            redirect('buku');
        }
    }

    // Hapus buku
    public function hapus($id)
    {
        $buku = $this->Buku_model->get_by_id($id);
        
        if (!$buku) {
            $this->session->set_flashdata('error', 'Data buku tidak ditemukan');
            redirect('buku');
        }

        $hapus = $this->Buku_model->delete($id);

        if ($hapus) {
            $this->session->set_flashdata('success', 'Data buku berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data buku');
        }
        
        redirect('buku');
    }

    // Detail buku
    public function detail($id)
    {
        $data['title'] = 'Detail Buku';
        $data['buku'] = $this->Buku_model->get_by_id($id);
        
        if (!$data['buku']) {
            $this->session->set_flashdata('error', 'Data buku tidak ditemukan');
            redirect('buku');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('buku/detail', $data);
        $this->load->view('templates/footer');
    }
}