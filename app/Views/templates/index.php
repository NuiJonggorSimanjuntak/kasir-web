<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    <meta name="csrf-hash" content="<?= csrf_hash() ?>">
    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token-value" content="<?= csrf_hash() ?>">

    <title>Permata Garden</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?= $this->include('templates/sidebar'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?= $this->include('templates/topbar'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?= $this->renderSection('page-content'); ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?= $this->include('templates/footer'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>js/sb-admin-2.min.js"></script>

    <script src="<?= base_url(); ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>js/demo/datatables-demo.js"></script>

    <script>
        document.querySelectorAll('.active-switch').forEach(switchEl => {
            switchEl.addEventListener('change', function() {
                const id = this.getAttribute('data-id');
                const url = this.getAttribute('data-url');
                const status = this.checked ? '1' : '0';

                // Ambil CSRF token dan hash dari meta tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const csrfHash = document.querySelector('meta[name="csrf-hash"]').getAttribute('content');

                const formData = new URLSearchParams();
                formData.append(csrfToken, csrfHash);
                formData.append('active', status);

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData.toString()
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const menuItem = document.querySelector(`#menuItem${id}`);
                            if (menuItem) {
                                if (status === '1') {
                                    menuItem.style.display = 'block';
                                } else {
                                    menuItem.style.display = 'none';
                                }
                            }
                            console.log('Status berhasil diubah:', data.message);
                        }
                    })
                    .catch(err => console.error('Gagal:', err));
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function loadNotifications() {
            $.ajax({
                url: "/notifications",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    let html = '';
                    let count = data.length;

                    if (count > 0) {
                        data.forEach(item => {
                            html += `
                                <a class="dropdown-item d-flex align-items-start" href="#" onclick="showDetail(${item.id})">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="text-xs text-gray-500 mb-1"><strong>User:</strong> ${item.username} <span class="ml-2 text-muted">(ID: ${item.user_id})</span></div>
                                        <div class="font-weight-bold text-dark">Total: Rp ${Number(item.total_beli).toLocaleString('id-ID')},-</div>
                                    </div>
                                </a>`;
                        });
                        $('#notifCount').text(count);
                        $('#notifList').html('<h6 class="dropdown-header">Alerts Center</h6>' + html);
                    } else {
                        $('#notifCount').text('0');
                        $('#notifList').html('<h6 class="dropdown-header">Alerts Center</h6><span class="dropdown-item text-center text-gray-500 small">No new alerts</span>');
                    }
                }
            });
        }

        function showDetail(id) {
            $.get(`/notifications/detail/${id}`, function(data) {
                let html = `
        <p><strong>ID Transaksi:</strong> ${data.transaksi_id}</p>
        <p><strong>Pembeli:</strong> ${data.username}</p>
        <p><strong>Sub Total Beli:</strong> Rp ${data.total_beli} ,-</p>
        <p><strong>Status:</strong> ${data.is_read ? 'Sudah Dibaca' : 'Belum Dibaca'}</p>
        
        <!-- Tombol untuk Toggle Tabel -->
        <button class="btn btn-info" id="toggleBarangBtn">Tampilkan Detail Barang</button>

        <!-- Tabel Detail Barang (Awalnya disembunyikan) -->
        <div id="barangDetails" style="display: none; margin-top: 20px;">
            <h5>Detail Barang:</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>qty</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
    `;

                // Menambahkan detail barang ke dalam tabel
                data.barang.forEach(function(barang) {
                    const totalharga = barang.harga_jual_edit * barang.kuantitas;
                    html += `
            <tr>
                <td>${barang.nama_barang_edit}</td>
                <td>${barang.kuantitas}</td>
                <td>Rp ${Number(barang.harga_jual_edit).toLocaleString('id-ID')},-</td>
                <td>Rp ${Number(totalharga).toLocaleString('id-ID')},-</td>
            </tr>
        `;
                });

                // Menutup tag tabel
                html += `
                </tbody>
            </table>
        </div>
    `;

                // Menambahkan konten ke dalam modal
                $('#detailContent').html(html);

                // Menampilkan modal
                $('#detailModal').modal('show');

                // Menandai notifikasi sebagai sudah dibaca
                markAsRead(id);

                // Menambahkan event handler untuk tombol hide/show
                $('#toggleBarangBtn').click(function() {
                    $('#barangDetails').toggle(); // Menyembunyikan atau menampilkan tabel
                    const buttonText = $('#barangDetails').is(':visible') ? 'Sembunyikan Detail Barang' : 'Tampilkan Detail Barang';
                    $(this).text(buttonText); // Mengubah teks tombol
                });
            });


        }

        function markAsRead(id) {
            $.post(`/notifications/read/${id}`, function() {
                loadNotifications();
            });
        }

        $(document).ready(function() {
            loadNotifications();
            setInterval(loadNotifications, 5000); // polling setiap 5 detik
        });
    </script>

    <script>
        // Saat tombol Proses diklik
        $(document).on('click', '.statusButton', function() {
            const button = $(this);
            const transaksiId = button.data('id');

            let csrfName = $('meta[name="csrf-token-name"]').attr('content');
            let csrfHash = $('meta[name="csrf-token-value"]').attr('content');

            let data = {};
            data[csrfName] = csrfHash;
            data['status'] = 'sukses';

            $.ajax({
                url: '<?= base_url('update-status') ?>/' + transaksiId,
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.status === 'success') {
                        button.removeClass('btn-warning').addClass('btn-success');
                        button.text('Sukses');

                        // ✅ Sembunyikan tombol batal setelah sukses
                        $(`.batalButton[data-id="${transaksiId}"]`).hide();

                        // Update CSRF token
                        if (response.csrfToken) {
                            $('meta[name="csrf-token-value"]').attr('content', response.csrfToken);
                        }
                    } else {
                        alert('Gagal mengubah status: ' + response.message);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengirim permintaan.');
                }
            });
        });
    </script>

    <script>
        // Tombol "Batal"
        // Saat tombol Batal diklik
        $(document).on('click', '.batalButton', function() {
            const button = $(this);
            const transaksiId = button.data('id');

            let csrfName = $('meta[name="csrf-token-name"]').attr('content');
            let csrfHash = $('meta[name="csrf-token-value"]').attr('content');

            let data = {};
            data[csrfName] = csrfHash;
            data['status'] = 'batal';

            $.ajax({
                url: '<?= base_url('batal-status') ?>/' + transaksiId,
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.status === 'success') {
                        // ✅ Sembunyikan tombol proses setelah batal
                        $(`#prosesButton_${transaksiId}`).hide();

                        button.text('Batal')

                        // Update CSRF token
                        if (response.csrfToken) {
                            $('meta[name="csrf-token-value"]').attr('content', response.csrfToken);
                        }
                    } else {
                        alert('Gagal membatalkan transaksi: ' + response.message);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat membatalkan transaksi.');
                }
            });
        });
    </script>

</body>

</html>