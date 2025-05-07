<!-- Notifikasi Dropdown -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <span id="notifCount" class="badge badge-danger badge-counter">0</span>
    </a>
    <div id="notifList" class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">Alerts Center</h6>
        <span class="dropdown-item text-center text-gray-500 small">Loading...</span>
    </div>
</li>

<!-- Modal Detail Notifikasi -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document"> <!-- Kelas modal-lg untuk memperlebar modal -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
      </div>
      <div class="modal-body" id="detailContent">Loading...</div>
    </div>
  </div>
</div>

