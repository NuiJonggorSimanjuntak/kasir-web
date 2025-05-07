<?= $this->extend('templates/index2'); ?>

<?= $this->section('page-content'); ?>

<div class="container mt-5">
    <form method="post" action="<?= base_url('beli'); ?>">
        <?php if (session()->getFlashdata('warning')) : ?>
            <div class="alert alert-warning" role="alert">
                <?= session()->getFlashdata('warning') ?>
            </div>
        <?php endif; ?>
        <div class="card p-3">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Pilih</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th style="width: 10%;">Jumlah</th>
                            <th>Total</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($barang as $b) : ?>
                            <tr>
                                <td style="text-align: center;">
                                    <input type="hidden" name="rowid<?= $i; ?>" value="<?= $b['rowid']; ?>">
                                    <input type="checkbox" name="active<?= $i; ?>" class="custom-control-input user-switch" id="userSwitch<?= $b['id']; ?>" data-id="<?= $b['id']; ?>" checked>
                                </td>
                                <td>
                                    <img src="<?= base_url('img/' . $b['image']); ?>" alt="img"
                                        class="rounded-circle img-fluid"
                                        style="max-width: 60px; height: auto;">
                                </td>
                                <td><?= $b['name']; ?></td>
                                <td class="text-start">
                                    <strong><?= 'Rp ' . number_format($b['price'], 0, ',', '.') . ',00'; ?></strong>
                                </td>
                                <td>
                                    <input type="number"
                                        name="quantity<?= $i; ?>"
                                        class="form-control text-center quantity-amount"
                                        value="<?= $b['qty']; ?>"
                                        id="quantity<?= $i; ?>"
                                        oninput="calculateAmount(<?= $i; ?>)"
                                        disabled>
                                </td>
                                <td>
                                    <input type="text"
                                        name="amount<?= $i; ?>"
                                        class="form-control text-center"
                                        data-price="<?= $b['subtotal']; ?>"
                                        id="amount<?= $i; ?>"
                                        value="<?= 'Rp ' . number_format($b['subtotal'], 0, ',', '.') . ',00'; ?>"
                                        readonly>
                                </td>
                                <td>
                                    <a href="<?= base_url('hapus_keranjang/' . $b['rowid']); ?>" class="text-danger fw-bold">X</a>
                                </td>
                            </tr>
                            <input type="hidden" name="name<?= $i; ?>" value="<?= $b['name']; ?>">
                            <input type="hidden" name="idBarang<?= $i; ?>" value="<?= $b['id']; ?>">
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-3">
                <button class="btn btn-outline-dark">🛒 Beli</button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>