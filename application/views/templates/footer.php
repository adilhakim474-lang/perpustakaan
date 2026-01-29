</div> <!-- End Content Wrapper -->
            </main>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Initialize DataTables
        $(document).ready(function() {
            $('.table-datatable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                "pageLength": 10,
                "ordering": true,
                "searching": true
            });
        });

        // Konfirmasi Hapus dengan SweetAlert
        function confirmDelete(url, nama) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah Anda yakin ingin menghapus data: " + nama + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        // Flash Message
        <?php if($this->session->flashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= $this->session->flashdata('success') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '<?= $this->session->flashdata('error') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>

        // Auto-generate kode
        function generateKode(prefix) {
            var timestamp = Date.now().toString().slice(-6);
            return prefix + timestamp;
        }

        // Format Rupiah
        function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp ' + rupiah;
        }

        // Hitung Denda
        function hitungDenda(tanggalKembali, tanggalPengembalian, dendaPerHari = 1000) {
            var tglKembali = new Date(tanggalKembali);
            var tglPengembalian = new Date(tanggalPengembalian);
            
            if (tglPengembalian > tglKembali) {
                var selisihHari = Math.ceil((tglPengembalian - tglKembali) / (1000 * 60 * 60 * 24));
                return selisihHari * dendaPerHari;
            }
            return 0;
        }
    </script>
</body>
</html>
