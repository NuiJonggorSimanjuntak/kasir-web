<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4 col-4">
        <div class="card-body">
            <form action="<?= base_url('simpanMenu') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="name" class="form-label"><b>Url Menu :</b></label>
                    <input
                        type="text"
                        class="form-control <?php if (session('errors.name')) : ?>is-invalid<?php endif ?>"
                        id="name"
                        name="name"
                        placeholder="Masukkan url Menu"
                        value="<?= old('name'); ?>"
                        autocomplete="off">
                    <div class="invalid-feedback">
                        <?= session('errors.name'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label"><b>Nama Menu :</b></label>
                    <input type="text" class="form-control <?php if (session('errors.description')) : ?>is-invalid<?php endif ?>" id="description" name="description" placeholder="Masukkan Nama Menu" value="<?= old('description'); ?>" autofocus>
                    <div class="invalid-feedback">
                        <?= session('errors.description'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label"><b>Nama Menu :</b></label>
                    <input
                        type="text"
                        class="form-control <?php if (session('errors.icon')) : ?>is-invalid<?php endif ?>"
                        id="icon"
                        name="icon"
                        placeholder="Masukkan icon Menu (fontawesome)"
                        value="<?= old('icon'); ?>"
                        autocomplete="off">
                    <div class="invalid-feedback">
                        <?= session('errors.icon'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label"><b>Status Menu:</b></label>
                    <div class="custom-control custom-switch custom-switch-on-success custom-switch-off-danger">
                        <input type="checkbox"
                            class="custom-control-input"
                            id="active"
                            name="active"
                            value="1"
                            <?= old('active', '1') == '1' ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="active"></label>
                    </div>
                </div>

                <script>
                    function preventSpaces(inputId) {
                        const input = document.getElementById(inputId);
                        input.addEventListener('keydown', function(e) {
                            if (e.key === ' ') {
                                e.preventDefault();
                            }
                        });
                        input.addEventListener('paste', function(e) {
                            const pasted = (e.clipboardData || window.clipboardData).getData('text');
                            if (pasted.includes(' ')) {
                                e.preventDefault();
                                alert('Input tidak boleh mengandung spasi.');
                            }
                        });
                    }

                    preventSpaces('name');
                    preventSpaces('icon');
                </script>
                <button type="submit" value="Simpan" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Simpan
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>