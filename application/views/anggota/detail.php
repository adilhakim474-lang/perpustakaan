<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-person me-2"></i><?= $title ?></h2>
        </div>
        <div>
            <a href="<?= base_url('anggota/edit/'.$anggota->id_anggota) ?>" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="<?= base_url('anggota') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Anggota</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="180">No Anggota</th>
                        <td><span class="badge bg-primary"><?= $anggota->no_anggota ?></span></td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td><strong><?= $anggota->nama_anggota ?></strong></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?= $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= $anggota->alamat ?></td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td><?= $anggota->no_telp ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $anggota->email ?: '-' ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Daftar</th>
                        <td><?= date('d F Y', strtotime($anggota->tanggal_daftar)) ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php if($anggota->status == 'Aktif'): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Peminjaman</h5>
            </div>
            <div class="card-body">
                <?php if(count($riwayat) > 0): ?>
                <div class="list-group">
                    <?php foreach($riwayat as $r): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1"><?= $r->judul_buku ?></h6>
                                <small class="text-muted">
                                    <i class="bi bi-calendar"></i> <?= date('d/m/Y', strtotime($r->tanggal_pinjam)) ?>
                                    s/d <?= date('d/m/Y', strtotime($r->tanggal_kembali)) ?>
                                </small>
                            </div>
                            <span class="badge <?= $r->status == 'Dipinjam' ? 'bg-warning' : 'bg-success' ?>">
                                <?= $r->status ?>
                            </span>
                        </div>
                        <?php if($r->denda > 0): ?>
                        <div class="mt-2">
                            <small class="text-danger">
                                <i class="bi bi-exclamation-triangle"></i> 
                                Denda: Rp <?= number_format($r->denda, 0, ',', '.') ?>
                            </small>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-muted text-center mb-0">Belum ada riwayat peminjaman</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>