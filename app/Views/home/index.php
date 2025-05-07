<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container-fluid" style="background: url('<?= base_url('img/default.jpeg'); ?>') center center / cover no-repeat fixed; min-height: 100vh;">

    <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
    <div class="card card-body">
        <!-- Konten lainnya di sini -->
        <h3>Isi Konten Card</h3>
        <p>Ini adalah contoh isi di dalam card.</p>
    </div>

</div>

<?= $this->endSection(); ?>