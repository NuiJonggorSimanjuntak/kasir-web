<nav class="navbar navbar-expand-md navbar-light bg-light mb-4 shadow-sm">
    <div class="container">
        <!-- Navbar Brand dengan Tombol Back -->
        <a class="navbar-brand fw-bold d-flex align-items-center gap-3">
            <button type="button" class="btn btn-dark btn-sm d-flex align-items-center gap-2 shadow-lg border-0 rounded-pill" onclick="history.back()">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>
            </button>
            <p></p><p></p>Selamat Datang Di Permata Garden
        </a>

        <!-- Toggler untuk mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Isi navbar -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <ul class="navbar-nav ms-auto align-items-center gap-3">
                <?php if (in_groups('customer') && logged_in()) : ?>

                    <!-- Tombol HOME -->
                    <button class="btn btn-outline-dark btn-sm d-flex align-items-center gap-2 shadow-sm position-relative border-0 rounded-pill" type="button" onclick="window.location.href='<?= base_url('/'); ?>'">
                        <span class="fw-semibold">HOME</span>
                    </button>
                    
                    <li class="nav-item">
                        <form class="d-flex" action="<?= base_url('lihat_keranjang'); ?>">
                            <button class="btn btn-outline-dark d-flex align-items-center gap-1 position-relative border-0 rounded-pill" type="submit">
                                <i class="bi bi-cart-fill"></i>
                                <span class="fw-semibold">S.O</span>
                                <span class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle p-1">
                                    <?= count(\Config\Services::cart()->contents()); ?>
                                </span>
                            </button>
                        </form>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <?php if (logged_in()) : ?>
                        <a href="<?= base_url('logout'); ?>" class="btn btn-outline-danger rounded-pill px-3 py-2">Logout</a>
                    <?php else : ?>
                        <a href="<?= base_url('login'); ?>" class="btn btn-outline-primary rounded-pill px-3 py-2">Login</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
