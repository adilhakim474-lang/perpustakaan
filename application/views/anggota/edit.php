<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-pencil me-2"></i><?= $title ?></h2>
        </div>
        <a href="<?= base_url('anggota') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('anggota/update') ?>" method="post">
            <input type="hidden" name="id_anggota" value="<?= $anggota->id_anggota ?>">
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="no_anggota" class="form-label">No Anggota</label>
                    <input type="text" class="form-control" value="<?= $anggota->no_anggota ?>" disabled>
                    <div class="form-text">No anggota tidak dapat diubah</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nama_anggota" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="<?= $anggota->nama_anggota ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="L" <?= $anggota->jenis_kelamin == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= $anggota->jenis_kelamin == 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="no_telp" class="form-label">No Telepon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $anggota->no_telp ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $anggota->email ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Aktif" <?= $anggota->status == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="Tidak Aktif" <?= $anggota->status == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $anggota->alamat ?></textarea>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save me-2"></i>Update
                </button>
                <a href="<?= base_url('anggota') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>