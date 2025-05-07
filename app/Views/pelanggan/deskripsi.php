<?= $this->extend('templates/index2'); ?>

<?= $this->section('page-content'); ?>

<div class="container d-flex justify-content-center align-items-center ">

    <style>
        .custom-alert {
            position: fixed;
            top: 30px;
            right: 30px;
            background-color: #fff3cd;
            color: #856404;
            padding: 15px 20px;
            border-radius: 8px;
            border: 1px solid #ffeeba;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.5s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .custom-alert.show {
            opacity: 1;
            transform: translateX(0);
        }
    </style>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const alertBox = document.getElementById('flashAlert');
            if (alertBox) {
                // Tampilkan alert
                alertBox.classList.add('show');

                // Sembunyikan setelah 5 detik
                setTimeout(() => {
                    alertBox.classList.remove('show');
                }, 5000);
            }
        });
    </script>

    <form action="<?= base_url('keranjang/' . $barang['id']) ?>" method="post" enctype="multipart/form-data">
        <div class="row align-items-center">
            <div class="col-md-6 product-image text-center">
                <img src="<?= base_url('img/' . $barang['gambar']); ?>" alt="produk">
            </div>

            <div class="col-md-6">
                <h3 class="fw-bold"><?= $barang['nama_barang_edit']; ?></h3>
                <p class="price"><?= 'Rp. ' . number_format($barang['harga_jual_edit'], 0, ',', '.') . ',00' ?></p>

                <p class="product-label">Masukan jumlah beli:</p>

                <div class="d-flex align-items-center">
                    <input type="number" id="qtyInput" name="qty" class="form-control w-25 me-2" value="1" min="1" data-stok="<?= $barang['stok'] ?>">
                    <button type="submit" id="submitBtn" class="btn btn-outline-dark">
                        🛒 Masukkan Keranjang
                    </button>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const qtyInput = document.getElementById('qtyInput');
                        const submitBtn = document.getElementById('submitBtn');
                        const stokTersedia = parseInt(qtyInput.getAttribute('data-stok'));

                        const showAlert = (message) => {
                            let alertBox = document.getElementById('flashAlert');
                            if (!alertBox) {
                                alertBox = document.createElement('div');
                                alertBox.id = 'flashAlert';
                                alertBox.className = 'custom-alert';
                                document.body.appendChild(alertBox);
                            }

                            alertBox.innerText = message;
                            alertBox.classList.add('show');

                            setTimeout(() => {
                                alertBox.classList.remove('show');
                            }, 5000);
                        };

                        submitBtn.addEventListener('click', (e) => {
                            const qty = parseInt(qtyInput.value);
                            if (qty > stokTersedia) {
                                e.preventDefault();
                                showAlert("Stok tidak mencukupi");
                            }
                        });
                    });
                </script>

            </div>

        </div>
    </form>
</div>

<?= $this->endSection(); ?>