<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form action="<?= base_url('simpanKaryawan/') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="email" class="form-label"><b>Email :</b></label>
                    <input type="text" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="email" name="email" placeholder="Masukkan Email" value="<?= old('email'); ?>" autofocus>
                    <div class="invalid-feedback">
                        <?= session('errors.email'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label"><b>Username :</b></label>
                    <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" id="username" name="username" placeholder="Masukkan Username" value="<?= old('username'); ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.username'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password"><?= lang('Auth.password') ?></label>
                    <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label"><b>Nama Lengkap :</b></label>
                    <input type="text" class="form-control <?php if (session('errors.nama_lengkap')) : ?>is-invalid<?php endif ?>" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" value="<?= old('nama_lengkap'); ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.nama_lengkap'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jenis_Kelamin" class="form-label"><b>Jenis Kelamin :</b></label>
                    <select class="form-control <?php if (session('errors.jenis_Kelamin')) : ?>is-invalid<?php endif ?>" id="jenis_Kelamin" name="jenis_Kelamin">
                        <option value="L" <?= old('jenis_Kelamin') == 'L' ? 'selected' : '' ?>>Laki-Laki</option>
                        <option value="P" <?= old('jenis_Kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.jenis_Kelamin'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label"><b>Nomor Handphone :</b></label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+62</span>
                        <input type="text" class="form-control <?php if (session('errors.no_hp')) : ?>is-invalid<?php endif ?>"
                            id="no_hp" name="no_hp" placeholder="Masukkan Nomor Handphone"
                            value="<?= old('no_hp'); ?>"
                            oninput="formatPhoneNumber(this)">
                    </div>
                    <div class="invalid-feedback">
                        <?= session('errors.no_hp'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label"><b>Tanggal Lahir :</b></label>
                    <input type="date" class="form-control <?php if (session('errors.tanggal_lahir')) : ?>is-invalid<?php endif ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?= old('tanggal_lahir'); ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.tanggal_lahir'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label"><b>Alamat :</b></label>
                    <textarea class="form-control <?php if (session('errors.alamat')) : ?>is-invalid<?php endif ?>"
                        id="alamat" name="alamat" placeholder="Masukkan Alamat"
                        rows="4"><?= old('alamat'); ?></textarea>
                    <div class="invalid-feedback">
                        <?= session('errors.alamat'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="pendidikan_terakhir" class="form-label"><b>Pendidikan Terakhir :</b></label>
                    <input type="text" class="form-control <?php if (session('errors.pendidikan_terakhir')) : ?>is-invalid<?php endif ?>" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="Masukkan Pendidikan Terakhir" value="<?= old('pendidikan_terakhir'); ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.pendidikan_terakhir'); ?>
                    </div>
                </div>

                <script>
                    function formatPhoneNumber(input) {
                        input.value = input.value.replace(/\D/g, '');
                    }
                </script>

                <button type="submit" value="Simpan" class="btn btn-outline-primary btn-sm"><i class="fas fa-save"></i> Simpan
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>