<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Hak Akses</th>
                            <?php if (in_groups(['owner', 'admin'])) : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data as $b) : ?>
                            <tr>
                                <td><?= $no++; ?>.</td>
                                <td><?= esc($b['email']); ?></td>
                                <td><?= esc($b['username']); ?></td>
                                <td></td>
                                <td><?= $b['role']; ?></td>
                                <?php if (in_groups(['owner', 'admin'])) : ?>
                                    <td></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>