<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2><i class="bi bi-arrow-left me-2"></i><?= $title ?></h2>
        </div>
        <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Detail Peminjaman</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="160">Kode Peminjaman</th>
                        <td><span class="badge bg-primary"><?= $peminjaman->kode_peminjaman ?></span></td>
                    </tr>
                    <tr>
                        <th>Anggota</th>
                        <td>
                            <strong><?= $peminjaman->nama_anggota ?></strong><br>
                            <small class="text-muted"><?= $peminjaman->no_anggota ?></small>
                        </td>
                    </tr>
                    <tr>
                        <th>Buku</th>
                        <td>
                            <strong><?= $peminjaman->judul_buku ?></strong><br>
                            <small class="text-muted"><?= $peminjaman->kode_buku ?></small>
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
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-success">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-check-circle me-2"></i>Form Pengembalian</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('peminjaman/proses_pengembalian') ?>" method="post" id="formPengembalian">
                    <input type="hidden" name="id_peminjaman" value="<?= $peminjaman->id_peminjaman ?>">
                    
                    <div class="mb-3">
                        <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" value="<?= date('Y-m-d') ?>" required>
                    </div>

                    <div id="dendaInfo" class="alert alert-info">
                        <strong>Menghitung denda...</strong>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-check-circle me-2"></i>Proses Pengembalian
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('tanggal_pengembalian').addEventListener('change', function() {
    var tglKembali = new Date('<?= $peminjaman->tanggal_kembali ?>');
    var tglPengembalian = new Date(this.value);
    var dendaInfo = document.getElementById('dendaInfo');
    
    if (tglPengembalian > tglKembali) {
        var selisihHari = Math.ceil((tglPengembalian - tglKembali) / (1000 * 60 * 60 * 24));
        var denda = selisihHari * 1000;
        
        dendaInfo.className = 'alert alert-danger';
        dendaInfo.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i><strong>Terlambat!</strong><br>' +
                             'Keterlambatan: ' + selisihHari + ' hari<br>' +
                             'Denda: <strong>Rp ' + denda.toLocaleString('id-ID') + '</strong>';
    } else {
        dendaInfo.className = 'alert alert-success';
        dendaInfo.innerHTML = '<i class="bi bi-check-circle me-2"></i><strong>Tepat Waktu!</strong><br>' +
                             'Tidak ada denda';
    }
});

// Trigger saat halaman load
document.getElementById('tanggal_pengembalian').dispatchEvent(new Event('change'));
</script>