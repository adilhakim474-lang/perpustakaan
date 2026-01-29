<?php
/*
NAMA FILE: Peminjaman.php
LOKASI: application/controllers/Peminjaman.php
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Peminjaman_model');
        $this->load->model('Buku_model');
        $this->load->model('Anggota_model');
    }

    // Menampilkan daftar peminjaman
    public function index()
    {
        $data['title'] = 'Data Peminjaman';
        $data['peminjaman'] = $this->Peminjaman_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('peminjaman/index', $data);
        $this->load->view('templates/footer');
    }

    // Form tambah peminjaman
    public function tambah()
    {
        $data['title'] = 'Tambah Peminjaman';
        $data['anggota'] = $this->Anggota_model->get_aktif();
        $data['buku'] = $this->Buku_model->get_tersedia();
        
        $this->load->view('templates/header', $data);
        $this->load->view('peminjaman/tambah', $data);
        $this->load->view('templates/footer');
    }

    // Proses simpan peminjaman baru
    public function simpan()
    {
        // Validasi input
        $this->form_validation->set_rules('kode_peminjaman', 'Kode Peminjaman', 'required|trim|is_unique[peminjaman.kode_peminjaman]', [
            'required' => 'Kode peminjaman harus diisi',
            'is_unique' => 'Kode peminjaman sudah digunakan'
        ]);
        $this->form_validation->set_rules('id_anggota', 'Anggota', 'required', [
            'required' => 'Anggota harus dipilih'
        ]);
        $this->form_validation->set_rules('id_buku', 'Buku', 'required', [
            'required' => 'Buku harus dipilih'
        ]);
        $this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required', [
            'required' => 'Tanggal pinjam harus diisi'
        ]);
        $this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required', [
            'required' => 'Tanggal kembali harus diisi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('peminjaman/tambah');
        } else {
            $id_buku = $this->input->post('id_buku');
            
            // Cek stok buku
            $buku = $this->Buku_model->get_by_id($id_buku);
            if ($buku->stok_tersedia <= 0) {
                $this->session->set_flashdata('error', 'Stok buku tidak tersedia');
                redirect('peminjaman/tambah');
            }

            $data = array(
                'kode_peminjaman' => $this->input->post('kode_peminjaman'),
                'id_anggota' => $this->input->post('id_anggota'),
                'id_buku' => $id_buku,
                'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
                'tanggal_kembali' => $this->input->post('tanggal_kembali'),
                'status' => 'Dipinjam'
            );

            // Simpan peminjaman
            $simpan = $this->Peminjaman_model->insert($data);

            if ($simpan) {
                // Kurangi stok buku
                $this->Buku_model->kurangi_stok($id_buku);
                $this->session->set_flashdata('success', 'Peminjaman berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan peminjaman');
            }
            
            redirect('peminjaman');
        }
    }

    // Form pengembalian buku
    public function pengembalian($id)
    {
        $data['title'] = 'Pengembalian Buku';
        $data['peminjaman'] = $this->Peminjaman_model->get_by_id($id);
        
        if (!$data['peminjaman']) {
            $this->session->set_flashdata('error', 'Data peminjaman tidak ditemukan');
            redirect('peminjaman');
        }

        if ($data['peminjaman']->status == 'Dikembalikan') {
            $this->session->set_flashdata('error', 'Buku sudah dikembalikan');
            redirect('peminjaman');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('peminjaman/pengembalian', $data);
        $this->load->view('templates/footer');
    }

    // Proses pengembalian buku
    public function proses_pengembalian()
    {
        $id = $this->input->post('id_peminjaman');
        $tanggal_pengembalian = $this->input->post('tanggal_pengembalian');
        
        $peminjaman = $this->Peminjaman_model->get_by_id($id);
        
        // Hitung denda (Rp 1000 per hari keterlambatan)
        $tanggal_kembali = new DateTime($peminjaman->tanggal_kembali);
        $tanggal_actual = new DateTime($tanggal_pengembalian);
        $denda = 0;
        
        if ($tanggal_actual > $tanggal_kembali) {
            $selisih = $tanggal_actual->diff($tanggal_kembali);
            $hari_telat = $selisih->days;
            $denda = $hari_telat * 1000; // Denda Rp 1000 per hari
        }

        $data = array(
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'denda' => $denda,
            'status' => 'Dikembalikan'
        );

        $update = $this->Peminjaman_model->update($id, $data);

        if ($update) {
            // Tambah stok buku
            $this->Buku_model->tambah_stok($peminjaman->id_buku);
            
            if ($denda > 0) {
                $this->session->set_flashdata('success', 'Buku berhasil dikembalikan. Denda: Rp ' . number_format($denda, 0, ',', '.'));
            } else {
                $this->session->set_flashdata('success', 'Buku berhasil dikembalikan');
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal memproses pengembalian');
        }
        
        redirect('peminjaman');
    }

    // Detail peminjaman
    public function detail($id)
    {
        $data['title'] = 'Detail Peminjaman';
        $data['peminjaman'] = $this->Peminjaman_model->get_by_id($id);
        
        if (!$data['peminjaman']) {
            $this->session->set_flashdata('error', 'Data peminjaman tidak ditemukan');
            redirect('peminjaman');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('peminjaman/detail', $data);
        $this->load->view('templates/footer');
    }

    // Hapus peminjaman (hanya untuk data yang belum dikembalikan)
    public function hapus($id)
    {
        $peminjaman = $this->Peminjaman_model->get_by_id($id);
        
        if (!$peminjaman) {
            $this->session->set_flashdata('error', 'Data peminjaman tidak ditemukan');
            redirect('peminjaman');
        }

        if ($peminjaman->status == 'Dipinjam') {
            // Kembalikan stok buku
            $this->Buku_model->tambah_stok($peminjaman->id_buku);
        }

        $hapus = $this->Peminjaman_model->delete($id);

        if ($hapus) {
            $this->session->set_flashdata('success', 'Data peminjaman berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data peminjaman');
        }
        
        redirect('peminjaman');
    }

    // Laporan peminjaman
    public function laporan()
    {
        $data['title'] = 'Laporan Peminjaman';
        
        // Filter berdasarkan tanggal jika ada
        $tanggal_awal = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        
        if ($tanggal_awal && $tanggal_akhir) {
            $data['peminjaman'] = $this->Peminjaman_model->get_by_date_range($tanggal_awal, $tanggal_akhir);
            $data['tanggal_awal'] = $tanggal_awal;
            $data['tanggal_akhir'] = $tanggal_akhir;
        } else {
            $data['peminjaman'] = $this->Peminjaman_model->get_all();
            $data['tanggal_awal'] = '';
            $data['tanggal_akhir'] = '';
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('peminjaman/laporan', $data);
        $this->load->view('templates/footer');
    }
}