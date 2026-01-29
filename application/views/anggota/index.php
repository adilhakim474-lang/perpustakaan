<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-people me-2"></i><?= $title ?></h2>
            <p class="text-muted">Kelola data anggota perpustakaan</p>
        </div>
        <a href="<?= base_url('anggota/tambah') ?>" class="btn btn-primary">
            <i class="bi bi-person-plus me-2"></i>Tambah Anggota
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-datatable">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>No Anggota</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>No Telepon</th>
                        <th>Email</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($anggota as $a): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><span class="badge bg-primary"><?= $a->no_anggota ?></span></td>
                        <td><strong><?= $a->nama_anggota ?></strong></td>
                        <td><?= $a->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                        <td><?= $a->no_telp ?></td>
                        <td><?= $a->email ?: '-' ?></td>
                        <td><?= date('d/m/Y', strtotime($a->tanggal_daftar)) ?></td>
                        <td>
                            <?php if($a->status == 'Aktif'): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('anggota/detail/'.$a->id_anggota) ?>" class="btn btn-sm btn-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?= base_url('anggota/edit/'.$a->id_anggota) ?>" class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" onclick="confirmDelete('<?= base_url('anggota/hapus/'.$a->id_anggota) ?>', '<?= $a->nama_anggota ?>')" class="btn btn-sm btn-danger" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>