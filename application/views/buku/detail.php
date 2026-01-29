<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-eye me-2"></i><?= $title ?></h2>
        </div>
        <div>
            <a href="<?= base_url('buku/edit/'.$buku->id_buku) ?>" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Edit
            </a>
            <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Kode Buku</th>
                        <td><span class="badge bg-primary"><?= $buku->kode_buku ?></span></td>
                    </tr>
                    <tr>
                        <th>Judul Buku</th>
                        <td><strong><?= $buku->judul_buku ?></strong></td>
                    </tr>
                    <tr>
                        <th>Pengarang</th>
                        <td><?= $buku->pengarang ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td><?= $buku->penerbit ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Tahun Terbit</th>
                        <td><?= $buku->tahun_terbit ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Buku</th>
                        <td><span class="badge bg-info"><?= $buku->jumlah_buku ?> buku</span></td>
                    </tr>
                    <tr>
                        <th>Stok Tersedia</th>
                        <td>
                            <?php if($buku->stok_tersedia == 0): ?>
                                <span class="badge bg-danger"><?= $buku->stok_tersedia ?> buku</span>
                            <?php elseif($buku->stok_tersedia < 3): ?>
                                <span class="badge bg-warning"><?= $buku->stok_tersedia ?> buku</span>
                            <?php else: ?>
                                <span class="badge bg-success"><?= $buku->stok_tersedia ?> buku</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Ditambahkan</th>
                        <td><?= date('d F Y, H:i', strtotime($buku->created_at)) ?> WIB</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>