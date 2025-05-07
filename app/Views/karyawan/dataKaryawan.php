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
        <?php if (session()->getFlashdata('same')) : ?>
            <div class="alert alert-warning" role="alert">
                <?= session()->getFlashdata('same') ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <form action="<?= base_url('tambahKaryawan'); ?>" method="get" class="d-inline">
                <button type="submit" class="btn btn-outline-primary btn-sm mb-3">
                    <span><i class="fas fa-plus"></i> Tambah Karyawan</span>
                </button>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Nomor Handphone</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data as $b) : ?>
                            <tr>
                                <td><?= $no++; ?>.</td>
                                <td><?= esc($b['email']); ?></td>
                                <td><?= esc($b['nama_lengkap']); ?></td>
                                <td>
                                    <?= esc($b['jenis_Kelamin'] == 'P' ? 'Perempuan' : ($b['jenis_Kelamin'] == 'L' ? 'Laki-laki' : '')); ?>
                                </td>
                                <td><?= esc($b['no_hp']); ?></td>
                                <td><?= esc($b['tanggal_lahir']); ?></td>
                                <td><?= esc($b['alamat']); ?></td>
                                <td><?= esc($b['pendidikan_terakhir']); ?></td>
                                <td>
                                    <a class="btn btn-outline-warning btn-sm" style="font-size: 1em;" href="<?= base_url('editKaryawan/' . $b['id']); ?>"><i class="fas fa-edit"></i>Edit</a>
                                    <form action="<?= base_url('hapusKaryawan/' . $b['id']); ?>" method="post" class="d-inline">
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