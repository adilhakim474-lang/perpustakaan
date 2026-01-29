<?php
/*
NAMA FILE: Anggota_model.php
LOKASI: application/models/Anggota_model.php
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_model extends CI_Model {

    private $table = 'anggota';

    // Ambil semua data anggota
    public function get_all()
    {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }

    // Ambil data anggota berdasarkan ID
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id_anggota' => $id])->row();
    }

    // Ambil anggota aktif
    public function get_aktif()
    {
        $this->db->where('status', 'Aktif');
        $this->db->order_by('nama_anggota', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Hitung total anggota
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    // Hitung anggota aktif
    public function count_aktif()
    {
        $this->db->where('status', 'Aktif');
        return $this->db->count_all_results($this->table);
    }

    // Insert anggota baru
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update anggota
    public function update($id, $data)
    {
        $this->db->where('id_anggota', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete anggota
    public function delete($id)
    {
        $this->db->where('id_anggota', $id);
        return $this->db->delete($this->table);
    }
}