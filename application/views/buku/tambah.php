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