<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-plus-circle me-2"></i><?= $title ?></h2>
        </div>
        <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('peminjaman/simpan') ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kode_peminjaman" class="form-label">Kode Peminjaman <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="kode_peminjaman" name="kode_peminjaman" placeholder="PJ001" required>
                        <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('kode_peminjaman').value = generateKode('PJ')">
                            <i class="bi bi-arrow-repeat"></i> Generate
                        </button>
                    </div>
                    <div class="form-text">Kode peminjaman harus unik</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="id_anggota" class="form-label">Pilih Anggota <span class="text-danger">*</span></label>
                    <select class="form-select" id="id_anggota" name="id_anggota" required>
                        <option value="">-- Pilih Anggota --</option>
                        <?php foreach($anggota as $a): ?>
                        <option value="<?= $a->id_anggota ?>">
                            <?= $a->no_anggota ?> - <?= $a->nama_anggota ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="id_buku" class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                    <select class="form-select" id="id_buku" name="id_buku" required>
                        <option value="">-- Pilih Buku --</option>
                        <?php foreach($buku as $b): ?>
                        <option value="<?= $b->id_buku ?>">
                            <?= $b->kode_buku ?> - <?= $b->judul_buku ?> (Stok: <?= $b->stok_tersedia ?>)
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="<?= date('Y-m-d', strtotime('+7 days')) ?>" required>
                    <div class="form-text">Durasi peminjaman: 7 hari</div>
                </div>
            </div>

            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Informasi:</strong> Denda keterlambatan adalah Rp 1.000 per hari
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan Peminjaman
                </button>
                <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>