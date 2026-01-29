<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-person-plus me-2"></i><?= $title ?></h2>
        </div>
        <a href="<?= base_url('anggota') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('anggota/simpan') ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="no_anggota" class="form-label">No Anggota <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="no_anggota" name="no_anggota" placeholder="Contoh: A001" required>
                    <div class="form-text">No anggota harus unik</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nama_anggota" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="no_telp" class="form-label">No Telepon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="08xxxxxxxxxx" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tanggal_daftar" class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar" value="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan
                </button>
                <a href="<?= base_url('anggota') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>