<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-eye me-2"></i><?= $title ?></h2>
        </div>
        <div>
            <?php if($peminjaman->status == 'Dipinjam'): ?>
            <a href="<?= base_url('peminjaman/pengembalian/'.$peminjaman->id_peminjaman) ?>" class="btn btn-success">
                <i class="bi bi-arrow-left me-2"></i>Kembalikan
            </a>
            <?php endif; ?>
            <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i>Informasi Peminjaman</h5>
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Kode Peminjaman</th>
                        <td><span class="badge bg-primary"><?= $peminjaman->kode_peminjaman ?></span></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php if($peminjaman->status == 'Dipinjam'): ?>
                                <span class="badge bg-warning">Dipinjam</span>
                            <?php else: ?>
                                <span class="badge bg-success">Dikembalikan</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <td><?= date('d F Y', strtotime($peminjaman->tanggal_pinjam)) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali</th>
                        <td><?= date('d F Y', strtotime($peminjaman->tanggal_kembali)) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengembalian</th>
                        <td>
                            <?php if($peminjaman->tanggal_pengembalian): ?>
                                <?= date('d F Y', strtotime($peminjaman->tanggal_pengembalian)) ?>
                            <?php else: ?>
                                <span class="text-muted">Belum dikembalikan</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Denda</th>
                        <td>
                            <?php if($peminjaman->denda > 0): ?>
                                <span class="text-danger"><strong>Rp <?= number_format($peminjaman->denda, 0, ',', '.') ?></strong></span>
                            <?php else: ?>
                                <span class="text-success">Tidak ada denda</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="col-md-6">
                <h5 class="mb-3"><i class="bi bi-person me-2"></i>Data Anggota</h5>
                <table class="table table-borderless">
                    <tr>
                        <th width="200">No Anggota</th>
                        <td><span class="badge bg-primary"><?= $peminjaman->no_anggota ?></span></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td><strong><?= $peminjaman->nama_anggota ?></strong></td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td><?= $peminjaman->no_telp ?></td>
                    </tr>
                </table>

                <h5 class="mb-3 mt-4"><i class="bi bi-book me-2"></i>Data Buku</h5>
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Kode Buku</th>
                        <td><span class="badge bg-primary"><?= $peminjaman->kode_buku ?></span></td>
                    </tr>
                    <tr>
                        <th>Judul</th>
                        <td><strong><?= $peminjaman->judul_buku ?></strong></td>
                    </tr>
                    <tr>
                        <th>Pengarang</th>
                        <td><?= $peminjaman->pengarang ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>