<?php
/*
NAMA FILE: Peminjaman_model.php
LOKASI: application/models/Peminjaman_model.php
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {

    private $table = 'peminjaman';

    // Ambil semua data peminjaman dengan join
    public function get_all()
    {
        $this->db->select('peminjaman.*, anggota.nama_anggota, anggota.no_anggota, buku.judul_buku, buku.kode_buku');
        $this->db->from($this->table);
        $this->db->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota');
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $this->db->order_by('peminjaman.created_at', 'DESC');
        return $this->db->get()->result();
    }

    // Ambil data peminjaman berdasarkan ID
    public function get_by_id($id)
    {
        $this->db->select('peminjaman.*, anggota.nama_anggota, anggota.no_anggota, anggota.no_telp, buku.judul_buku, buku.kode_buku, buku.pengarang');
        $this->db->from($this->table);
        $this->db->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota');
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $this->db->where('peminjaman.id_peminjaman', $id);
        return $this->db->get()->row();
    }

    // Ambil peminjaman berdasarkan anggota
    public function get_by_anggota($id_anggota)
    {
        $this->db->select('peminjaman.*, buku.judul_buku, buku.kode_buku');
        $this->db->from($this->table);
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $this->db->where('peminjaman.id_anggota', $id_anggota);
        $this->db->order_by('peminjaman.created_at', 'DESC');
        return $this->db->get()->result();
    }

    // Ambil peminjaman terbaru
    public function get_latest($limit = 5)
    {
        $this->db->select('peminjaman.*, anggota.nama_anggota, buku.judul_buku');
        $this->db->from($this->table);
        $this->db->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota');
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $this->db->order_by('peminjaman.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    // Ambil peminjaman berdasarkan range tanggal
    public function get_by_date_range($tanggal_awal, $tanggal_akhir)
    {
        $this->db->select('peminjaman.*, anggota.nama_anggota, anggota.no_anggota, buku.judul_buku, buku.kode_buku');
        $this->db->from($this->table);
        $this->db->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota');
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $this->db->where('peminjaman.tanggal_pinjam >=', $tanggal_awal);
        $this->db->where('peminjaman.tanggal_pinjam <=', $tanggal_akhir);
        $this->db->order_by('peminjaman.tanggal_pinjam', 'DESC');
        return $this->db->get()->result();
    }

    // Hitung total peminjaman yang sedang dipinjam
    public function count_dipinjam()
    {
        $this->db->where('status', 'Dipinjam');
        return $this->db->count_all_results($this->table);
    }

    // Hitung total peminjaman yang sudah dikembalikan
    public function count_dikembalikan()
    {
        $this->db->where('status', 'Dikembalikan');
        return $this->db->count_all_results($this->table);
    }

    // Insert peminjaman baru
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update peminjaman
    public function update($id, $data)
    {
        $this->db->where('id_peminjaman', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete peminjaman
    public function delete($id)
    {
        $this->db->where('id_peminjaman', $id);
        return $this->db->delete($this->table);
    }
}