<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 10%;">Pembeli</th>
                            <th style="width: 20%;">Nama Barang</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                            <th>Sub Pembelian</th>
                            <th style="text-align: center;">Sub Pembelian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($dataTransaksi as $b) : ?>
                            <tr>
                                <td><?= $no++; ?>.</td>
                                <td><?= esc($b['username']); ?></td>
                                <td>
                                    <?php foreach ($b['barang'] as $barang): ?>
                                        <?= esc($barang['nama_barang_edit']) ?><br>
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    <?php foreach ($b['barang'] as $barang): ?>
                                        <?= $barang['kuantitas'] ?> x Rp<?= number_format($barang['harga_jual_edit'], 0, ',', '.') ?>,-<br>
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    <?php foreach ($b['barang'] as $barang): ?>
                                        Rp<?= number_format($barang['kuantitas'] * $barang['harga_jual_edit'], 0, ',', '.') ?>,-<br>
                                    <?php endforeach ?>
                                </td>
                                <td>
                                    <?php
                                    $total = 0;
                                    foreach ($b['barang'] as $barang) {
                                        $total += $barang['harga_jual_edit'] * $barang['kuantitas'];
                                    }
                                    echo '<strong>Rp ' . number_format($total, 0, ',', '.') . ',-<strong>';
                                    ?>
                                </td>
                                <style>
                                    .btn-custom {
                                        width: 40%;
                                        padding: 10px;
                                    }
                                </style>
                                <td style="text-align: center;">
                                    <?php if ($b['status'] == 'proses'): ?>
                                        <button id="prosesButton_<?= $b['transaksi_id'] ?>"
                                            class="btn btn-warning statusButton btn-custom"
                                            data-id="<?= $b['transaksi_id'] ?>">
                                            Proses
                                        </button>
                                    <?php elseif ($b['status'] == 'sukses'): ?>
                                        <button class="btn btn-success btn-custom">Sukses</button>
                                    <?php endif; ?>

                                    <?php if ($b['status'] == 'batal'): ?>
                                        <button class="btn btn-danger btn-custom">Batal</button>
                                    <?php elseif ($b['status'] == 'proses'): ?>
                                        <button class="btn btn-danger batalButton btn-custom"
                                            data-id="<?= $b['transaksi_id'] ?>">
                                            Batal
                                        </button>
                                    <?php endif; ?>
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