<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
                background: #f5f7fa;
            }

            .sidebar {
                width: 260px;
                height: 100vh;
                background: linear-gradient(180deg, #0d2238 0%, #1a3a52 100%);
                color: white;
                position: fixed;
                top: 0;
                left: 0;
                padding: 0;
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
                z-index: 1000;
                transition: left 0.3s ease;
            }

            .sidebar-header {
                padding: 25px 20px;
                background: rgba(0,0,0,0.2);
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }

            .sidebar-header h3 {
                font-size: 18px;
                font-weight: 600;
                margin-bottom: 5px;
            }

            .sidebar-header p {
                font-size: 13px;
                color: rgba(255,255,255,0.7);
            }

            .sidebar-menu {
                padding: 20px 0;
            }

            .sidebar a {
                display: flex;
                align-items: center;
                padding: 14px 25px;
                color: rgba(255,255,255,0.85);
                text-decoration: none;
                font-size: 15px;
                transition: all 0.2s;
                border-left: 3px solid transparent;
            }

            .sidebar a:hover {
                background: rgba(255,255,255,0.1);
                color: white;
                border-left-color: #2fa4e7;
            }

            .sidebar a.active {
                background: rgba(47,164,231,0.15);
                color: white;
                border-left-color: #2fa4e7;
                font-weight: 500;
            }

            .main-content {
                margin-left: 260px;
                min-height: 100vh;
                transition: margin-left 0.3s ease;
            }

            .page-header {
                background: white;
                padding: 25px 30px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.08);
                display: flex;
                align-items: center;
                justify-content: space-between;
                position: sticky;
                top: 0;
                z-index: 999;
            }

            .header-left {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .menu-toggle {
                display: none;
                background: #2fa4e7;
                color: white;
                border: none;
                width: 40px;
                height: 40px;
                border-radius: 8px;
                cursor: pointer;
                font-size: 20px;
                transition: all 0.2s;
            }

            .menu-toggle:hover {
                background: #2589c7;
                transform: scale(1.05);
            }

            .page-title {
                font-size: 24px;
                font-weight: 600;
                color: #2c3e50;
            }

            .header-right {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .page-content {
                padding: 30px;
            }

            .content-card {
                background: white;
                border-radius: 12px;
                padding: 30px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 999;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .overlay.active {
                display: block;
                opacity: 1;
            }

            @media (max-width: 768px) {
                .sidebar {
                    left: -260px;
                }

                .sidebar.open {
                    left: 0;
                }

                .main-content {
                    margin-left: 0;
                }

                .menu-toggle {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .page-header {
                    padding: 20px;
                }

                .page-title {
                    font-size: 18px;
                }

                .page-content {
                    padding: 20px;
                }

                .content-card {
                    padding: 20px;
                }
            }

            @media (max-width: 480px) {
                .page-title {
                    font-size: 16px;
                }

                .page-header {
                    padding: 15px;
                }

                .page-content {
                    padding: 15px;
                }
            }

            .table-container {
                overflow-x: auto;
                margin-top: 25px;
                border-radius: 8px;
                border: 2px solid #e1e8ed;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            }

            .elegant-table {
                width: 100%;
                border-collapse: collapse;
                background: white;
                font-size: 14px;
            }

            .elegant-table thead {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .elegant-table th {
                padding: 16px 20px;
                text-align: left;
                font-weight: 600;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border-right: 1px solid rgba(255,255,255,0.2);
            }

            .elegant-table th:last-child {
                border-right: none;
            }

            .elegant-table tbody tr {
                border-bottom: 1px solid #dee2e6;
                transition: all 0.2s ease;
            }

            .elegant-table tbody tr:hover {
                background: #f8f9fe;
                transform: scale(1.01);
                box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
            }

            .elegant-table tbody tr:last-child {
                border-bottom: none;
            }

            .elegant-table td {
                padding: 16px 20px;
                color: #495057;
                border-right: 1px solid #e9ecef;
            }

            .elegant-table td:last-child {
                border-right: none;
            }

            .elegant-table td:first-child {
                font-weight: 600;
                color: #667eea;
            }

            /* Status Badge */
            .status-badge {
                display: inline-block;
                padding: 6px 14px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .status-approved {
                background: #d4edda;
                color: #155724;
            }

            .status-pending {
                background: #fff3cd;
                color: #856404;
            }

            .status-rejected {
                background: #f8d7da;
                color: #721c24;
            }

            /* Responsive Table */
            @media (max-width: 768px) {
                .elegant-table {
                    font-size: 13px;
                }

                .elegant-table th,
                .elegant-table td {
                    padding: 12px 10px;
                }

                .status-badge {
                    font-size: 11px;
                    padding: 5px 10px;
                }
            }

            @media (max-width: 576px) {
                .elegant-table thead {
                    display: none;
                }

                .elegant-table,
                .elegant-table tbody,
                .elegant-table tr,
                .elegant-table td {
                    display: block;
                    width: 100%;
                }

                .elegant-table tr {
                    margin-bottom: 15px;
                    border: 1px solid #e9ecef;
                    border-radius: 8px;
                    padding: 10px;
                    background: white;
                }

                .elegant-table td {
                    text-align: right;
                    padding: 10px;
                    position: relative;
                    padding-left: 50%;
                    border-bottom: 1px solid #f1f3f5;
                }

                .elegant-table td:last-child {
                    border-bottom: none;
                }

                .elegant-table td:before {
                    content: attr(data-label);
                    position: absolute;
                    left: 10px;
                    font-weight: 600;
                    color: #667eea;
                    text-transform: uppercase;
                    font-size: 11px;
                }
            }

            .user-info {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 8px 15px;
                background: #f8f9fa;
                border-radius: 8px;
            }

            .user-info span {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 120px;
            }

            @media (min-width: 1200px) {
                .user-info span {
                    max-width: 200px;
                }
            }
        </style>
    </head>
    <body>
        <div class="overlay" onclick="toggleSidebar()"></div>
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3>Selamat Datang!</h3>
                <p>Selamat Menggunakan!</p>
            </div>
            <nav class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="active">
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('reservasi.create') }}">
                    <span>Buat Reservasi</span>
                </a>
                <a href="/reservasi/riwayat">
                    <span>Reservasi Saya</span>
                </a>
                <a href="/">
                    <span>Logout</span>
                </a>
            </nav>
        </aside>

        <div class="main-content">
            <header class="page-header">
                <div class="header-left">
                    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
                    <h1 class="page-title">Sistem Reservasi Ruang Rapat</h1>
                </div>
                
                @if(auth()->check() && auth()->user()->email == "admin@gmail.com")
                <li>
                    <a href="/admin/dashboard" style="font-weight: bold; color: #007bff;">
                        🛠 Panel Admin
                    </a>
                </li>
                @endif

            </header>

            <main class="page-content">

                <div class="content-card">
                    <h2 style="margin-bottom: 15px; color: #2c3e50;">Dashboard</h2>
                    <h2 style="color:#2c3e50; margin-bottom:15px;">Halo, {{ auth()->user()->name }}!</h2>
                
                <div style="margin-bottom:25px; background:#f8f9fa; padding:15px; border-radius:8px;">
                    <h3 style="margin-bottom:10px; color:#2c3e50;">Info Ruangan</h3>
                    <p>Semua ruangan tersedia mulai pukul <strong>08:00</strong> sampai <strong>17:00</strong> setiap hari kerja.</p>
                    <br>

                    <h3 style="margin-bottom:10px; color:#2c3e50;">Ruangan Di Gedung Kami</h3>
                    <P>1. Conversation Hall</P>
                    <P>2. Ruang Serba Guna</P>
                    <P>3. Lab Komputer Lantai 3</P>
                </div>
                    <p style="color: #6c757d;">Reservasi Terbaru</p>
                    @if(session('error'))
                        <div style="color: red; margin-bottom: 15px;">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="table-container">
                        <table class="elegant-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Ruangan</th>
                                    <th>Tanggal Booking</th>
                                    <th>Tanggal Reservasi</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Berakhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($reservasi)
                                    @foreach ($reservasi as $r)
                                    <tr>
                                        <td data-label="No">{{ $loop->iteration }}</td>
                                        <td data-label="Nama Pemesan">{{ $r->user->name }}</td>
                                        <td data-label="Ruangan">{{ $r->room->nama }}</td>
                                        <td data-label="Tanggal Booking">{{ \Carbon\Carbon::parse($r->created_at)->setTimezone('Asia/Jakarta')->format('d M Y') }}</td>
                                        <td data-label="Tanggal Reservasi">{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</td>
                                        <td data-label="Waktu Mulai">{{ \Carbon\Carbon::parse($r->waktu_mulai)->format('H:i') }}</td>
                                        <td data-label="Waktu Berakhir">{{ \Carbon\Carbon::parse($r->waktu_berakhir)->format('H:i') }}</td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
        
        <script>
            function toggleSidebar() {
                const sidebar = document.querySelector(".sidebar");
                const overlay = document.querySelector(".overlay");
                
                sidebar.classList.toggle("open");
                overlay.classList.toggle("active");
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const sidebar = document.querySelector(".sidebar");
                const menuToggle = document.querySelector(".menu-toggle");
                
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                        sidebar.classList.remove("open");
                        document.querySelector(".overlay").classList.remove("active");
                    }
                }
            });
        </script>
    </body>
</html>