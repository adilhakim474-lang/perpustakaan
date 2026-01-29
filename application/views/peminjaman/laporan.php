<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-file-earmark-text me-2"></i><?= $title ?></h2>
            <p class="text-muted">Laporan transaksi peminjaman buku</p>
        </div>
        <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<!-- Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form action="<?= base_url('peminjaman/laporan') ?>" method="get">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="<?= $tanggal_awal ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?= $tanggal_akhir ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label d-block">&nbsp;</label>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-2"></i>Filter
                    </button>
                    <a href="<?= base_url('peminjaman/laporan') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                    </a>
                    <button type="button" onclick="window.print()" class="btn btn-success">
                        <i class="bi bi-printer me-2"></i>Cetak
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Laporan -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tgl Kembali</th>
                        <th>Tgl Pengembalian</th>
                        <th>Denda</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    $total_denda = 0;
                    foreach($peminjaman as $p): 
                        $total_denda += $p->denda;
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p->kode_peminjaman ?></td>
                        <td><?= date('d/m/Y', strtotime($p->tanggal_pinjam)) ?></td>
                        <td><?= $p->nama_anggota ?></td>
                        <td><?= $p->judul_buku ?></td>
                        <td><?= date('d/m/Y', strtotime($p->tanggal_kembali)) ?></td>
                        <td>
                            <?php if($p->tanggal_pengembalian): ?>
                                <?= date('d/m/Y', strtotime($p->tanggal_pengembalian)) ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td class="text-end">
                            <?php if($p->denda > 0): ?>
                                Rp <?= number_format($p->denda, 0, ',', '.') ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= $p->status ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="7" class="text-end">Total Denda:</th>
                        <th class="text-end">Rp <?= number_format($total_denda, 0, ',', '.') ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>