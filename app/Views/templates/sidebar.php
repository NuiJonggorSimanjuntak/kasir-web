<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <br>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink" style="font-size: 3rem;"></i> -->
        </div>
        <!-- <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> -->
        Selamat Datang <?= user()->username; ?>
    </a>
    <br>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <?php
    $modelMenu = new \App\Models\ModelMenu();
    $menuQuery = $modelMenu->getMenu()->findAll();
    ?>
    <?php foreach ($menuQuery as $m): ?>
        <?php if (in_groups('admin')) : ?>
            <li class="nav-item" id="menuItem<?= $m['id']; ?>" style="display: <?= ($m['status'] === '1') ? 'block' : 'none'; ?>">
                <a class="nav-link" href="<?= base_url($m['name']); ?>">
                    <i class="fas fa-fw fa-<?= $m['icon'] ?>"></i>
                    <span><?= $m['description']; ?></span>
                </a>
            </li>
        <?php elseif (in_groups('owner')) : ?>
            <?php if ($m['name'] !== 'dataKaryawan' && $m['name'] !== 'dataPelanggan'): ?>
                <li class="nav-item" id="menuItem<?= $m['id']; ?>" style="display: <?= ($m['status'] === '1') ? 'block' : 'none'; ?>">
                    <a class="nav-link" href="<?= base_url($m['name']); ?>">
                        <i class="fas fa-fw fa-<?= $m['icon'] ?>"></i>
                        <span><?= $m['description']; ?></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php elseif (in_groups('karyawan')) : ?>
            <?php if ($m['name'] !== 'dataKaryawan'): ?>
                <li class="nav-item" id="menuItem<?= $m['id']; ?>" style="display: <?= ($m['status'] === '1') ? 'block' : 'none'; ?>">
                    <a class="nav-link" href="<?= base_url($m['name']); ?>">
                        <i class="fas fa-fw fa-<?= $m['icon'] ?>"></i>
                        <span><?= $m['description']; ?></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>



    <?php if (in_groups('admin')) : ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Pengaturan Sistem</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola:</h6>
                    <a class="collapse-item" href="buttons.html">Manajemen Akses</a>
                    <a class="collapse-item" href="<?= base_url('dataMenu'); ?>">Managemen Menu</a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <hr class="sidebar-divider">
    <br>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>