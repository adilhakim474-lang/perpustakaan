<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-pencil me-2"></i><?= $title ?></h2>
        </div>
        <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('buku/update') ?>" method="post">
            <input type="hidden" name="id_buku" value="<?= $buku->id_buku ?>">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kode_buku" class="form-label">Kode Buku</label>
                    <input type="text" class="form-control" value="<?= $buku->kode_buku ?>" disabled>
                    <div class="form-text">Kode buku tidak dapat diubah</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="judul_buku" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="<?= $buku->judul_buku ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="pengarang" class="form-label">Pengarang <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= $buku->pengarang ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="penerbit" class="form-label">Penerbit <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $buku->penerbit ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?= $buku->tahun_terbit ?>" min="1900" max="<?= date('Y') ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jumlah_buku" class="form-label">Jumlah Buku <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" value="<?= $buku->jumlah_buku ?>" min="1" required>
                    <div class="form-text">Stok tersedia akan disesuaikan otomatis</div>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save me-2"></i>Update
                </button>
                <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>