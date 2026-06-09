<!DOCTYPE html>
<html lang="id">

<head>
  <link rel="icon" type="image/png" href="{{ asset('logo.png') }}?v={{ time() }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AlmairyExpress — @yield('title', 'Transportation Management')</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background: #f3f4f6;
      color: #111827;
      font-size: 13px;
    }

    .app {
      display: flex;
      height: 100vh;
      min-height: 600px;
    }

    .sidebar {
      width: 200px;
      background: #fff;
      border-right: 1px solid #e5e7eb;
      display: flex;
      flex-direction: column;
      flex-shrink: 0;
    }

    .main {
      flex: 1;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .topbar {
      background: #fff;
      border-bottom: 1px solid #e5e7eb;
      padding: 0 16px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-shrink: 0;
    }

    .content {
      flex: 1;
      overflow-y: auto;
      padding: 16px;
    }

    /* Sidebar */
    .logo {
      padding: 14px 16px;
      border-bottom: 1px solid #e5e7eb;
    }

    .logo-title {
      font-size: 13px;
      font-weight: 700;
      color: #1e3a5f;
      letter-spacing: .3px;
    }

    .logo-sub {
      font-size: 10px;
      color: #6b7280;
      margin-top: 2px;
    }

    .nav-section {
      padding: 10px 0;
    }

    .nav-label {
      font-size: 10px;
      color: #9ca3af;
      padding: 4px 16px 2px;
      font-weight: 600;
      letter-spacing: .6px;
      text-transform: uppercase;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 7px 16px;
      cursor: pointer;
      font-size: 12px;
      color: #6b7280;
      transition: background .15s;
      border-left: 2px solid transparent;
      text-decoration: none;
    }

    .nav-item:hover {
      background: #f9fafb;
      color: #111827;
    }

    .nav-item.active {
      background: #eff6ff;
      color: #2563eb;
      border-left-color: #2563eb;
      font-weight: 500;
    }

    .nav-icon {
      width: 14px;
      height: 14px;
      opacity: .7;
      flex-shrink: 0;
    }

    .badge {
      background: #fee2e2;
      color: #dc2626;
      font-size: 9px;
      padding: 1px 5px;
      border-radius: 8px;
      margin-left: auto;
      font-weight: 600;
    }

    /* Topbar */
    .page-title {
      font-size: 14px;
      font-weight: 600;
    }

    .topbar-actions {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    /* Buttons */
    .btn {
      padding: 5px 12px;
      border-radius: 8px;
      border: 1px solid #d1d5db;
      background: #fff;
      color: #374151;
      cursor: pointer;
      font-size: 12px;
      font-family: inherit;
      transition: all .15s;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      text-decoration: none;
    }

    .btn:hover {
      background: #f9fafb;
    }

    .btn-primary {
      background: #2563eb;
      color: #fff;
      border-color: #2563eb;
      font-weight: 500;
    }

    .btn-primary:hover {
      background: #1d4ed8;
    }

    .btn-danger {
      background: #fee2e2;
      color: #dc2626;
      border-color: #fca5a5;
    }

    .btn-danger:hover {
      background: #fecaca;
    }

    .btn-success {
      background: #dcfce7;
      color: #16a34a;
      border-color: #86efac;
    }

    .btn-success:hover {
      background: #bbf7d0;
    }

    .btn-warn {
      background: #fef3c7;
      color: #d97706;
      border-color: #fcd34d;
    }

    .btn-warn:hover {
      background: #fde68a;
    }

    .btn-sm {
      padding: 3px 8px;
      font-size: 11px;
    }

    .btn-xs {
      padding: 2px 6px;
      font-size: 10px;
    }

    /* Cards */
    .card {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 14px 16px;
      margin-bottom: 12px;
    }

    .card-title {
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 12px;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: .4px;
    }

    /* Stat cards */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
      margin-bottom: 12px;
    }

    .stat-card {
      background: #f9fafb;
      border-radius: 10px;
      padding: 12px;
      border: 1px solid #f3f4f6;
    }

    .stat-label {
      font-size: 11px;
      color: #6b7280;
      margin-bottom: 4px;
    }

    .stat-value {
      font-size: 22px;
      font-weight: 700;
      line-height: 1;
      color: #111827;
    }

    .stat-change {
      font-size: 10px;
      margin-top: 4px;
    }

    .stat-up {
      color: #16a34a;
    }

    .stat-down {
      color: #dc2626;
    }

    /* Table */
    .table-wrap {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 12px;
    }

    th {
      text-align: left;
      padding: 8px 10px;
      background: #f9fafb;
      color: #6b7280;
      font-weight: 600;
      border-bottom: 1px solid #e5e7eb;
      white-space: nowrap;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: .3px;
    }

    td {
      padding: 8px 10px;
      border-bottom: 1px solid #f3f4f6;
      vertical-align: middle;
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr:hover td {
      background: #f9fafb;
    }

    /* Status badges */
    .status {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 2px 8px;
      border-radius: 99px;
      font-size: 10px;
      font-weight: 600;
      white-space: nowrap;
    }

    .s-pending {
      background: #fef3c7;
      color: #92400e;
    }

    .s-transit {
      background: #dbeafe;
      color: #1e40af;
    }

    .s-delivered {
      background: #dcfce7;
      color: #14532d;
    }

    .s-problem {
      background: #fee2e2;
      color: #991b1b;
    }

    .s-gudang {
      background: #f3f4f6;
      color: #374151;
      border: 1px solid #d1d5db;
    }

    .s-aktif {
      background: #dcfce7;
      color: #14532d;
    }

    .s-standby {
      background: #f3f4f6;
      color: #374151;
      border: 1px solid #d1d5db;
    }

    .s-servis {
      background: #fef3c7;
      color: #92400e;
    }

    .s-libur {
      background: #f3f4f6;
      color: #374151;
    }

    .s-lunas {
      background: #dcfce7;
      color: #14532d;
    }

    .s-overdue {
      background: #fee2e2;
      color: #991b1b;
    }

    .s-nonaktif {
      background: #f1f5f9;
      color: #64748b;
    }

    /* Alert */
    .alert {
      padding: 10px 14px;
      border-radius: 8px;
      font-size: 12px;
      margin-bottom: 12px;
      border: 1px solid;
    }

    .alert-sukses {
      background: #dcfce7;
      color: #14532d;
      border-color: #86efac;
    }

    .alert-error {
      background: #fee2e2;
      color: #991b1b;
      border-color: #fca5a5;
    }

    /* Form */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .form-group.full {
      grid-column: 1/-1;
    }

    label {
      font-size: 11px;
      color: #374151;
      font-weight: 600;
    }

    input,
    select,
    textarea {
      padding: 7px 10px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      background: #fff;
      color: #111827;
      font-size: 12px;
      font-family: inherit;
      outline: none;
      width: 100%;
    }

    input:focus,
    select:focus,
    textarea:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, .1);
    }

    textarea {
      resize: vertical;
      min-height: 60px;
    }

    input[readonly] {
      background: #f9fafb;
      color: #6b7280;
    }

    /* Modal */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .5);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1000;
    }

    .modal-overlay.hidden {
      display: none;
    }

    .modal {
      background: #fff;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
      width: 540px;
      max-height: 88vh;
      overflow-y: auto;
      padding: 20px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, .15);
    }

    .modal-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
      padding-bottom: 12px;
      border-bottom: 1px solid #f3f4f6;
    }

    .modal-title {
      font-size: 14px;
      font-weight: 700;
    }

    .modal-close {
      cursor: pointer;
      font-size: 20px;
      color: #9ca3af;
      line-height: 1;
      background: none;
      border: none;
      transition: color .15s;
    }

    .modal-close:hover {
      color: #111827;
    }

    .modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 8px;
      margin-top: 16px;
      padding-top: 12px;
      border-top: 1px solid #f3f4f6;
    }

    /* Tabs */
    .tabs {
      display: flex;
      gap: 2px;
      margin-bottom: 14px;
      border-bottom: 1px solid #e5e7eb;
    }

    .tab {
      padding: 7px 14px;
      cursor: pointer;
      font-size: 12px;
      color: #6b7280;
      border-bottom: 2px solid transparent;
      transition: .15s;
      margin-bottom: -1px;
    }

    .tab:hover {
      color: #111827;
    }

    .tab.active {
      color: #2563eb;
      border-bottom-color: #2563eb;
      font-weight: 600;
    }

    /* Timeline */
    .timeline {
      position: relative;
      padding-left: 20px;
    }

    .tl-item {
      position: relative;
      padding-bottom: 16px;
    }

    .tl-item:last-child {
      padding-bottom: 0;
    }

    .tl-dot {
      position: absolute;
      left: -20px;
      top: 3px;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: #d1d5db;
      border: 2px solid #fff;
      box-shadow: 0 0 0 1px #d1d5db;
    }

    .tl-dot.done {
      background: #16a34a;
      box-shadow: 0 0 0 1px #16a34a;
    }

    .tl-dot.current {
      background: #2563eb;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, .2);
    }

    .tl-line {
      position: absolute;
      left: -16px;
      top: 13px;
      bottom: -4px;
      width: 1px;
      background: #e5e7eb;
    }

    .tl-time {
      font-size: 10px;
      color: #9ca3af;
    }

    .tl-text {
      font-size: 12px;
      margin-top: 2px;
    }

    .tl-loc {
      font-size: 11px;
      color: #6b7280;
      margin-top: 1px;
    }

    /* Route progress bar */
    .route-bar {
      height: 6px;
      background: #f3f4f6;
      border-radius: 3px;
      overflow: hidden;
      margin: 6px 0;
    }

    .route-fill {
      height: 100%;
      background: #2563eb;
      border-radius: 3px;
      transition: width .3s;
    }

    /* Chart bars */
    .mini-bars {
      display: flex;
      align-items: flex-end;
      height: 160px;
      gap: 8px;
    }

    .bar {
      flex: 1;
      background: linear-gradient(180deg, #60a5fa, #2563eb);
      border-radius: 6px;

      height: 0;
      animation: growBar 0.8s ease forwards;
    }

    /* animasi naik */
    @keyframes growBar {
      from {
        height: 0;
      }

      to {
        height: calc(var(--h) * 1%);
      }
    }

    /* hover efek */
    .bar:hover {
      opacity: 0.8;
      transform: translateY(-3px);
    }

    .bar-lbl {
      display: flex;
      justify-content: space-between;
      gap: 12px;
      margin-top: 12px;
      font-size: 12px;
      color: #6b7280;
    }

    /* Map placeholder */
    .map-ph {
      background: #f9fafb;
      border-radius: 10px;
      height: 160px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #9ca3af;
      font-size: 12px;
      border: 1px dashed #d1d5db;
    }

    /* Chip */
    .chip {
      display: inline-block;
      padding: 1px 8px;
      border-radius: 99px;
      font-size: 10px;
      background: #f3f4f6;
      color: #374151;
      border: 1px solid #e5e7eb;
    }

    /* Utilities */
    .hidden {
      display: none !important;
    }

    .flex {
      display: flex;
    }

    .gap8 {
      gap: 8px;
    }

    .gap4 {
      gap: 4px;
    }

    .align-center {
      align-items: center;
    }

    .justify-between {
      justify-content: space-between;
    }

    .mt8 {
      margin-top: 8px;
    }

    .mt4 {
      margin-top: 4px;
    }

    .mb0 {
      margin-bottom: 0 !important;
    }

    .text-muted {
      color: #6b7280;
    }

    .text-sm {
      font-size: 11px;
    }

    .text-xs {
      font-size: 10px;
    }

    .fw600 {
      font-weight: 600;
    }

    .fw500 {
      font-weight: 500;
    }

    .divider {
      border: none;
      border-top: 1px solid #f3f4f6;
      margin: 12px 0;
    }

    .text-danger {
      color: #dc2626;
    }

    .text-success {
      color: #16a34a;
    }

    .text-info {
      color: #2563eb;
    }

    .text-warn {
      color: #d97706;
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
      width: 5px;
      height: 5px;
    }

    ::-webkit-scrollbar-thumb {
      background: #d1d5db;
      border-radius: 3px;
    }

    ::-webkit-scrollbar-track {
      background: transparent;
    }

    /* Pagination */
    .pagination {
      display: flex;
      gap: 4px;
      margin-top: 12px;
    }

    .pagination .page-link {
      padding: 4px 10px;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      font-size: 12px;
      color: #374151;
      text-decoration: none;
      background: #fff;
    }

    .pagination .page-link:hover {
      background: #f3f4f6;
    }

    .pagination .page-item.active .page-link {
      background: #2563eb;
      color: #fff;
      border-color: #2563eb;
    }

    .pagination .page-item.disabled .page-link {
      color: #d1d5db;
      cursor: not-allowed;
    }

    .top-kota {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .top-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 12px;
      border-radius: 8px;
      background: #f8f9fb;
      border: 1px solid #eee;
    }

    .rank {
      font-weight: bold;
      color: #4f46e5;
      width: 40px;
    }

    .kota {
      flex: 1;
      font-weight: 500;
    }

    .total {
      font-weight: bold;
      color: #111;
    }
  </style>
</head>

<body>
  <div class="app">

    {{-- SIDEBAR --}}
    <div class="sidebar">
      <div class="logo">
        <div class="logo-title">🚚 AlmairyExpress</div>
        <div class="logo-sub">Transportation Management System</div>
      </div>

      {{-- ROLE --}}
      @php
      $role = auth()->user()->role->nama ?? '';
      @endphp

      @if(in_array($role, ['Admin','Kepala Toko','Operasional']))
      {{-- ================= UTAMA ================= --}}
      <div class="nav-section">

        <div class="nav-label">Utama</div>

        <a href="{{ route('dashboard') }}"
          class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">

          <svg class="nav-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect x="1" y="1" width="6" height="6" rx="1" />
            <rect x="9" y="1" width="6" height="6" rx="1" />
            <rect x="1" y="9" width="6" height="6" rx="1" />
            <rect x="9" y="9" width="6" height="6" rx="1" />
          </svg>

          Beranda
        </a>

        <a href="{{ route('pengiriman.index') }}"
          class="nav-item {{ request()->routeIs('pengiriman.*') ? 'active' : '' }}">

          <svg class="nav-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect x="1" y="4" width="14" height="9" rx="1.5" />
            <path d="M5 4V3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1" />
            <path d="M1 8h14" />
          </svg>

          Pengiriman

          @php
          $aktifCount =
          \App\Models\Pengiriman::where('is_deleted',false)
          ->where('status','problem')
          ->count()
          @endphp

          @if($aktifCount > 0)
          <span class="badge">{{ $aktifCount }}</span>
          @endif
        </a>

        <a href="{{ route('tracking.index') }}"
          class="nav-item {{ request()->routeIs('tracking.*') ? 'active' : '' }}">

          <svg class="nav-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="8" cy="7" r="3" />
            <path d="M8 1a6 6 0 0 1 6 6c0 4-6 8-6 8S2 11 2 7a6 6 0 0 1 6-6z" />
          </svg>

          Live Tracking
        </a>

      </div>

      {{-- ================= KEUANGAN ================= --}}
      <div class="nav-section">

        <div class="nav-label">Keuangan</div>

        {{-- ADMIN + OPERASIONAL + KEPALA TOKO --}}
        <a href="{{ route('invoice.index') }}"
          class="nav-item {{ request()->routeIs('invoice.*') ? 'active' : '' }}">

          <svg class="nav-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect x="2" y="1" width="12" height="14" rx="1.5" />
            <path d="M5 5h6M5 8h6M5 11h4" />
          </svg>

          Invoice
        </a>

        {{-- ADMIN + KEPALA TOKO --}}
        @if(in_array($role, ['Admin','Kepala Toko']))
        <a href="{{ route('laporan.index') }}"
          class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">

          <svg class="nav-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M2 12V4l4 4 3-3 4 3v4H2z" />
          </svg>

          Laporan
        </a>
        @endif

        {{-- ADMIN + OPERASIONAL + KEPALA TOKO --}}
        @if(in_array($role, ['Admin','Operasional','Kepala Toko']))
        <a href="{{ route('harga.index') }}"
          class="nav-item {{ request()->routeIs('harga.*') ? 'active' : '' }}">

          <svg class="nav-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M3 5h10M3 8h10M3 11h6" />
            <rect x="2" y="2" width="12" height="12" rx="1.5" />
          </svg>

          Daftar Harga
        </a>
        @endif

      </div>

      {{-- ================= SISTEM ================= --}}
      <div class="nav-section">

        <div class="nav-label">Sistem</div>

        {{-- ADMIN + OPERASIONAL --}}
        @if(in_array($role, ['Admin','Operasional']))
        <a href="{{ route('pelanggan.index') }}"
          class="nav-item {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">

          <svg class="nav-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M2 14c0-2.2 2.7-4 6-4s6 1.8 6 4" />
            <circle cx="8" cy="6" r="3" />
          </svg>

          Pelanggan
        </a>
        @endif

      </div>

      {{-- LOGOUT --}}
      <div style="margin-top:auto; padding-top:20px; border-top:1px solid #eee;">

        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <button type="submit" style="
            width:100%;
            padding:10px 12px;
            border:none;
            border-radius:8px;
            background:#ef4444;
            color:white;
            cursor:pointer;
            font-size:14px;
            font-weight:500;
        ">
            Logout
          </button>

        </form>

      </div>
      @endif
    </div>

    {{-- MAIN --}}
    <div class="main">
      <div class="topbar">
        <div class="page-title">@yield('page-title', 'Dashboard')</div>
        <div class="topbar-actions">
          <span class="text-muted text-sm">Admin &middot; <span id="current-time"></span></span>
          @yield('topbar-actions')
        </div>
      </div>
      <div class="content">
        @if(session('sukses'))
        <div class="alert alert-sukses">✓ {{ session('sukses') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">✕ {{ session('error') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-error">
          @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
        </div>
        @endif
        @yield('content')
      </div>
    </div>
  </div>

  @yield('modals')

  <script>
    function updateTime() {
      document.getElementById('current-time').textContent =
        new Date().toLocaleTimeString('id-ID', {
          hour: '2-digit',
          minute: '2-digit'
        });
    }
    updateTime();
    setInterval(updateTime, 60000);

    function openModal(id) {
      document.getElementById('modal-' + id)?.classList.remove('hidden');
    }

    function closeModal(id) {
      document.getElementById('modal-' + id)?.classList.add('hidden');
    }

    // CSRF
    const csrfToken = document.querySelector('meta[name=csrf-token]')?.content;

    /* =========================
       INVOICE ACTIONS (FIXED)
    ========================= */

    function sendReminder(id) {
      fetch(`/invoice/${id}/reminder`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          }
        })
        .then(r => r.json())
        .then(d => alert(d.message))
        .catch(err => console.log(err));
    }

    function confirmVoid(id) {
      if (!confirm('Void invoice ini?')) return;

      fetch(`/invoice/${id}/void`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          }
        })
        .then(r => r.json())
        .then(d => {
          alert(d.message);
          location.reload();
        })
        .catch(err => console.log(err));
    }

    function markLunas(id) {
      fetch(`/invoice/${id}/bayar`, {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          }
        })
        .then(r => r.json())
        .then(d => {
          alert(d.message);
          location.reload();
        })
        .catch(err => console.log(err));
    }
  </script>
  @yield('scripts')
  <script>
    function confirmDelete(id) {
      if (confirm('Yakin mau hapus data ini?')) {
        document.getElementById(id).submit();
      }
    }
  </script>
</body>

</html>