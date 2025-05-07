<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-warning" role="alert">
                <?= session()->getFlashdata('errors') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('same')) : ?>
            <div class="alert alert-warning" role="alert">
                <?= session()->getFlashdata('same') ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <form action="<?= base_url('tambahMenu'); ?>" method="get" class="d-inline">
                <button type="submit" class="btn btn-outline-primary btn-sm mb-3">
                    <span><i class="fas fa-plus"></i> Tambah Menu</span>
                </button>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Url Menu</th>
                            <th style="width: 20%;">Nama Menu</th>
                            <th>Icon</th>
                            <th style="text-align: center;">Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                            <tr>
                                <td><?= $no++; ?>.</td>
                                <td><?= $m['name']; ?></td>
                                <td><?= $m['description']; ?></td>
                                <td><?= $m['icon']; ?></td>
                                <td style="text-align: center;">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox"
                                            class="custom-control-input active-switch"
                                            id="activeSwitch<?= $m['id']; ?>"
                                            data-id="<?= $m['id']; ?>"
                                            data-url="<?= base_url('active/' . $m['id']); ?>"
                                            <?= ($m['status'] == '1') ? 'checked' : ''; ?>>
                                        <label class="custom-control-label" for="activeSwitch<?= $m['id']; ?>"></label>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-outline-warning btn-sm" style="font-size: 1em;" href="<?= base_url('editMenu/' . $m['id']); ?>"><i class="fas fa-edit"></i>Edit</a>
                                    <form action="<?= base_url('hapusMenu/' . $m['id']); ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('apakah anda yakin')" style="font-size: 1em;"><span><i class="fas fa-trash-alt"></i>Hapus</span></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>