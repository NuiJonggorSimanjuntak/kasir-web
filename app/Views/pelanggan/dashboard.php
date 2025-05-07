<?= $this->extend('templates/index2'); ?>

<?= $this->section('page-content'); ?>

<div class="container mt-5">
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">
        <?php $i = 0; ?>
        <?php foreach ($barang as $b) : ?>
            <div class="col <?= $i >= 15 ? 'd-none more-produk' : ''; ?>">
                <div class="product-card h-100">
                    <span class="badge-so">S.O</span>
                    <a class="product-item" href="<?= base_url('deskripsi/' . $b['id']); ?>">
                        <img src="<?= base_url('img/' . $b['gambar']); ?>" alt="produk">
                    </a>
                    <h6><?= $b['nama_barang_edit']; ?></h6>
                    <div class="mb-2">
                        <span class="star">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                    </div>
                    <p class="fw-bold">Rp <?= number_format($b['harga_jual_edit'], 0, ',', '.'); ?>,00</p>
                </div>
            </div>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>

    <?php if (count($barang) > 15) : ?>
        <div class="text-center mt-3 mb-3">
            <button id="toggleBtn" class="btn btn-primary">Lihat Selengkapnya</button>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>