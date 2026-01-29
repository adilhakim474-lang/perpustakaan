<?php
/*
NAMA FILE: Buku_model.php
LOKASI: application/models/Buku_model.php
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {

    private $table = 'buku';

    // Ambil semua data buku
    public function get_all()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }

    // Ambil data buku berdasarkan ID
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id_buku' => $id])->row();
    }

    // Ambil buku yang tersedia (stok > 0)
    public function get_tersedia()
    {
        $this->db->where('stok_tersedia >', 0);
        $this->db->order_by('judul_buku', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Ambil buku dengan stok rendah
    public function get_low_stock($limit = 5)
    {
        $this->db->where('stok_tersedia <', 3);
        $this->db->order_by('stok_tersedia', 'ASC');
        $this->db->limit($limit);
        return $this->db->get($this->table)->result();
    }

    // Hitung total buku
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    // Insert buku baru
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update buku
    public function update($id, $data)
    {
        $this->db->where('id_buku', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete buku
    public function delete($id)
    {
        $this->db->where('id_buku', $id);
        return $this->db->delete($this->table);
    }

    // Kurangi stok buku
    public function kurangi_stok($id)
    {
        $this->db->set('stok_tersedia', 'stok_tersedia - 1', FALSE);
        $this->db->where('id_buku', $id);
        return $this->db->update($this->table);
    }

    // Tambah stok buku
    public function tambah_stok($id)
    {
        $this->db->set('stok_tersedia', 'stok_tersedia + 1', FALSE);
        $this->db->where('id_buku', $id);
        return $this->db->update($this->table);
    }
}