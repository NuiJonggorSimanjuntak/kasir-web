<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form action="<?= base_url('simpanBarang') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="nama_barang_edit" class="form-label"><b>Nama Barang :</b></label>
                    <input type="text" class="form-control <?php if (session('errors.nama_barang_edit')) : ?>is-invalid<?php endif ?>" id="nama_barang_edit" name="nama_barang_edit" placeholder="Masukkan Nama Barang" value="<?= old('nama_barang_edit'); ?>" autofocus>
                    <div class="invalid-feedback">
                        <?= session('errors.nama_barang_edit'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="harga_jual_edit" class="form-label"><b>Harga Barang :</b></label>
                    <input type="number" class="form-control <?php if (session('errors.harga_jual_edit')) : ?>is-invalid<?php endif ?>" id="harga_jual_edit" name="harga_jual_edit" placeholder="Masukkan Harga Barang" value="<?= old('harga_jual_edit'); ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.harga_jual_edit'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="harga_beli_edit" class="form-label"><b>Harga Beli :</b></label>
                    <input type="number" class="form-control <?php if (session('errors.harga_beli_edit')) : ?>is-invalid<?php endif ?>" id="harga_beli_edit" name="harga_beli_edit" placeholder="Masukkan Harga Beli" value="<?= old('harga_beli_edit'); ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.harga_beli_edit'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label"><b>Upload Gambar</b></label>
                    <input type="file" class="form-control <?= session('errors.gambar') ? 'is-invalid' : '' ?>" id="gambar" name="gambar" onchange="previewImage()">
                    <div class="invalid-feedback">
                        <?= session('errors.gambar'); ?>
                    </div>
                    <img src="/img/default.jpeg" class="img-thumbnail mt-2 img-preview" id="img-preview" style="width: 20%;">
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label"><b>Stok Barang :</b></label>
                    <input type="number" class="form-control <?php if (session('errors.stok')) : ?>is-invalid<?php endif ?>" id="stok" name="stok" placeholder="Masukkan Stok Barang" value="<?= old('stok'); ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.stok'); ?>
                    </div>
                </div>
                <script>
                    function previewImage() {
                        const image = document.querySelector('#gambar');
                        const imgPreview = document.querySelector('#img-preview');

                        const fileReader = new FileReader();
                        fileReader.readAsDataURL(image.files[0]);

                        fileReader.onload = function(e) {
                            imgPreview.src = e.target.result;
                        }
                    }
                </script>
                <button type="submit" value="Simpan" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Simpan
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>