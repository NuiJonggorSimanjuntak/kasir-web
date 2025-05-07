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
            <?php if (in_groups(['owner', 'admin'])) : ?>
                <form action="<?= base_url('tambahBarang'); ?>" method="get" class="d-inline">
                    <button type="submit" class="btn btn-outline-primary btn-sm mb-3">
                        <span><i class="fas fa-plus"></i> Tambah Barang</span>
                    </button>
                </form>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Gambar Barang</th>
                            <th style="width: 20%;">Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Harga Beli</th>
                            <?php if (in_groups(['owner', 'karyawan'])) : ?>
                                <th>Stok</th>
                            <?php endif; ?>
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
                                <td style="text-align: center; width: 10%; height: auto;"><img src="<?= base_url('img/' . $b['gambar']); ?>" alt="Image" class="img-fluid"></td>
                                <td><?= esc($b['nama_barang_edit']); ?></td>
                                <td><?= $b['harga_jual_edit'] == 0 ? '-' : 'Rp ' . number_format($b['harga_jual_edit'], 0, ',', '.') . ',00' ?></td>
                                <td><?= $b['harga_beli_edit'] == 0 ? '-' : 'Rp ' . number_format($b['harga_beli_edit'], 0, ',', '.') . ',00' ?></td>
                                <?php if (in_groups(['owner', 'karyawan'])) : ?>
                                    <td><?= $b['stok']; ?></td>
                                <?php endif; ?>
                                <?php if (in_groups(['owner', 'admin'])) : ?>
                                    <td>
                                        <a class="btn btn-outline-warning btn-sm" style="font-size: 1em;" href="<?= base_url('editBarang/' . $b['id']); ?>"><i class="fas fa-edit"></i>Edit</a>
                                        <form action="<?= base_url('hapusBarang/' . $b['id']); ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('apakah anda yakin')" style="font-size: 1em;"><span><i class="fas fa-trash-alt"></i>Hapus</span></button>
                                        </form>
                                    </td>
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