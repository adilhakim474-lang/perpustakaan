<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-arrow-left-right me-2"></i><?= $title ?></h2>
            <p class="text-muted">Kelola transaksi peminjaman buku</p>
        </div>
        <div>
            <a href="<?= base_url('peminjaman/laporan') ?>" class="btn btn-warning">
                <i class="bi bi-file-earmark-text me-2"></i>Laporan
            </a>
            <a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Pinjam Buku
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-datatable">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Tgl Pengembalian</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($peminjaman as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><span class="badge bg-primary"><?= $p->kode_peminjaman ?></span></td>
                        <td>
                            <strong><?= $p->nama_anggota ?></strong><br>
                            <small class="text-muted"><?= $p->no_anggota ?></small>
                        </td>
                        <td>
                            <strong><?= $p->judul_buku ?></strong><br>
                            <small class="text-muted"><?= $p->kode_buku ?></small>
                        </td>
                        <td><?= date('d/m/Y', strtotime($p->tanggal_pinjam)) ?></td>
                        <td><?= date('d/m/Y', strtotime($p->tanggal_kembali)) ?></td>
                        <td>
                            <?php if($p->tanggal_pengembalian): ?>
                                <?= date('d/m/Y', strtotime($p->tanggal_pengembalian)) ?>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($p->denda > 0): ?>
                                <span class="text-danger">Rp <?= number_format($p->denda, 0, ',', '.') ?></span>
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($p->status == 'Dipinjam'): ?>
                                <?php 
                                $tgl_kembali = new DateTime($p->tanggal_kembali);
                                $tgl_sekarang = new DateTime();
                                $telat = $tgl_sekarang > $tgl_kembali;
                                ?>
                                <?php if($telat): ?>
                                    <span class="badge bg-danger">Terlambat</span>
                                <?php else: ?>
                                    <span class="badge bg-warning">Dipinjam</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="badge bg-success">Dikembalikan</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('peminjaman/detail/'.$p->id_peminjaman) ?>" class="btn btn-sm btn-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <?php if($p->status == 'Dipinjam'): ?>
                            <a href="<?= base_url('peminjaman/pengembalian/'.$p->id_peminjaman) ?>" class="btn btn-sm btn-success" title="Kembalikan">
                                <i class="bi bi-arrow-left"></i>
                            </a>
                            <?php endif; ?>
                            <a href="#" onclick="confirmDelete('<?= base_url('peminjaman/hapus/'.$p->id_peminjaman) ?>', '<?= $p->kode_peminjaman ?>')" class="btn btn-sm btn-danger" title="Hapus">
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