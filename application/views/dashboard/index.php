
<div class="page-header">
    <h2><i class="bi bi-speedometer2 me-2"></i><?= $title ?></h2>
    <p class="text-muted">Selamat datang di Sistem Perpustakaan Mini</p>
</div>

<!-- Statistik Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2">Total Buku</h6>
                        <h3><?= $total_buku ?></h3>
                    </div>
                    <div>
                        <i class="bi bi-book" style="font-size: 3rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2">Total Anggota</h6>
                        <h3><?= $total_anggota ?></h3>
                    </div>
                    <div>
                        <i class="bi bi-people" style="font-size: 3rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2">Sedang Dipinjam</h6>
                        <h3><?= $total_dipinjam ?></h3>
                    </div>
                    <div>
                        <i class="bi bi-arrow-right-circle" style="font-size: 3rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <div class="card-body text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-white-50 mb-2">Sudah Dikembalikan</h6>
                        <h3><?= $total_dikembalikan ?></h3>
                    </div>
                    <div>
                        <i class="bi bi-check-circle" style="font-size: 3rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Peminjaman Terbaru & Buku Stok Rendah -->
<div class="row">
    <!-- Peminjaman Terbaru -->
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Peminjaman Terbaru</h5>
            </div>
            <div class="card-body">
                <?php if(count($peminjaman_terbaru) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($peminjaman_terbaru as $p): ?>
                            <tr>
                                <td><span class="badge bg-primary"><?= $p->kode_peminjaman ?></span></td>
                                <td><?= $p->nama_anggota ?></td>
                                <td><?= $p->judul_buku ?></td>
                                <td><?= date('d/m/Y', strtotime($p->tanggal_pinjam)) ?></td>
                                <td>
                                    <?php if($p->status == 'Dipinjam'): ?>
                                        <span class="badge bg-warning">Dipinjam</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Dikembalikan</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a href="<?= base_url('peminjaman') ?>" class="btn btn-sm btn-outline-primary">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
                <?php else: ?>
                <p class="text-muted text-center mb-0">Belum ada data peminjaman</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Buku Stok Rendah -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-exclamation-triangle me-2"></i>Stok Buku Rendah</h5>
            </div>
            <div class="card-body">
                <?php if(count($buku_stok_rendah) > 0): ?>
                <div class="list-group list-group-flush">
                    <?php foreach($buku_stok_rendah as $b): ?>
                    <div class="list-group-item px-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1"><?= $b->judul_buku ?></h6>
                                <small class="text-muted"><?= $b->kode_buku ?></small>
                            </div>
                            <span class="badge <?= $b->stok_tersedia == 0 ? 'bg-danger' : 'bg-warning' ?> rounded-pill">
                                <?= $b->stok_tersedia ?> buku
                            </span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?= base_url('buku') ?>" class="btn btn-sm btn-outline-primary mt-3">
                    Kelola Buku <i class="bi bi-arrow-right"></i>
                </a>
                <?php else: ?>
                <p class="text-muted text-center mb-0">Semua buku stoknya aman</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Menu Cepat</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center mb-3">
                <a href="<?= base_url('buku/tambah') ?>" class="btn btn-primary btn-lg w-100">
                    <i class="bi bi-plus-circle d-block mb-2" style="font-size: 2rem;"></i>
                    Tambah Buku
                </a>
            </div>
            <div class="col-md-3 text-center mb-3">
                <a href="<?= base_url('anggota/tambah') ?>" class="btn btn-info btn-lg w-100 text-white">
                    <i class="bi bi-person-plus d-block mb-2" style="font-size: 2rem;"></i>
                    Tambah Anggota
                </a>
            </div>
            <div class="col-md-3 text-center mb-3">
                <a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-success btn-lg w-100">
                    <i class="bi bi-arrow-right-circle d-block mb-2" style="font-size: 2rem;"></i>
                    Pinjam Buku
                </a>
            </div>
            <div class="col-md-3 text-center mb-3">
                <a href="<?= base_url('peminjaman/laporan') ?>" class="btn btn-warning btn-lg w-100">
                    <i class="bi bi-file-earmark-text d-block mb-2" style="font-size: 2rem;"></i>
                    Laporan
                </a>
            </div>
        </div>
    </div>
</div>