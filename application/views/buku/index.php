<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-book me-2"></i><?= $title ?></h2>
            <p class="text-muted">Kelola data buku perpustakaan</p>
        </div>
        <a href="<?= base_url('buku/tambah') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Buku
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
                        <th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Stok Tersedia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($buku as $b): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><span class="badge bg-primary"><?= $b->kode_buku ?></span></td>
                        <td><strong><?= $b->judul_buku ?></strong></td>
                        <td><?= $b->pengarang ?></td>
                        <td><?= $b->penerbit ?></td>
                        <td><?= $b->tahun_terbit ?></td>
                        <td><span class="badge bg-info"><?= $b->jumlah_buku ?></span></td>
                        <td>
                            <?php if($b->stok_tersedia == 0): ?>
                                <span class="badge bg-danger"><?= $b->stok_tersedia ?></span>
                            <?php elseif($b->stok_tersedia < 3): ?>
                                <span class="badge bg-warning"><?= $b->stok_tersedia ?></span>
                            <?php else: ?>
                                <span class="badge bg-success"><?= $b->stok_tersedia ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('buku/detail/'.$b->id_buku) ?>" class="btn btn-sm btn-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?= base_url('buku/edit/'.$b->id_buku) ?>" class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" onclick="confirmDelete('<?= base_url('buku/hapus/'.$b->id_buku) ?>', '<?= $b->judul_buku ?>')" class="btn btn-sm btn-danger" title="Hapus">
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


/* =============================================
   FILE 2: tambah.php (Form Tambah Buku)
   LOKASI: application/views/buku/tambah.php
   ============================================= */

<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-plus-circle me-2"></i><?= $title ?></h2>
        </div>
        <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('buku/simpan') ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kode_buku" class="form-label">Kode Buku <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="kode_buku" name="kode_buku" placeholder="Contoh: BK001" required>
                    <div class="form-text">Kode buku harus unik</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="judul_buku" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" placeholder="Masukkan judul buku" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="pengarang" class="form-label">Pengarang <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="Nama pengarang" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="penerbit" class="form-label">Penerbit <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Nama penerbit" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="2024" min="1900" max="<?= date('Y') ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jumlah_buku" class="form-label">Jumlah Buku <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" placeholder="10" min="1" required>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan
                </button>
                <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>