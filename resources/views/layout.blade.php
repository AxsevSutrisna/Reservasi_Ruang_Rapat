<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Reservasi Ruang Rapat')</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --secondary: #ec4899;
            --bg-color: #f3f4f6;
            --surface: rgba(255, 255, 255, 0.75);
            --surface-border: rgba(255, 255, 255, 0.5);
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: var(--text-main);
            min-height: 100vh;
        }

        /* Glassmorphism Utilities */
        .glass {
            background: var(--surface);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--surface-border);
            box-shadow: var(--glass-shadow);
        }

        /* ============ SIDEBAR ============ */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 24px;
            z-index: 1000;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255,255,255,0.6);
            box-shadow: 4px 0 24px rgba(0,0,0,0.02);
        }

        .sidebar-header {
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .sidebar-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 4px;
        }

        .sidebar-header p {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .sidebar a i {
            font-size: 20px;
            transition: transform 0.2s ease;
        }

        .sidebar a:hover {
            background: rgba(79, 70, 229, 0.08);
            color: var(--primary);
        }

        .sidebar a:hover i {
            transform: scale(1.1);
        }

        .sidebar a.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        .sidebar a.active i {
            color: white;
        }

        .logout-btn {
            margin-top: auto;
            color: #ef4444 !important;
        }
        
        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.1) !important;
        }

        /* ============ MAIN CONTENT ============ */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        /* ============ HEADER ============ */
        .page-header {
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 99;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.5);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .menu-toggle {
            display: none;
            background: white;
            color: var(--text-main);
            border: 1px solid rgba(0,0,0,0.1);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .menu-toggle:hover {
            background: var(--bg-color);
        }

        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.5px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: white;
            border-radius: 100px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .user-profile .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }
        
        .user-profile .name {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-main);
        }

        /* ============ PAGE CONTENT & CARDS ============ */
        .page-content {
            padding: 40px;
            flex: 1;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .content-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.03);
            margin-bottom: 24px;
        }
        
        .card-header {
            margin-bottom: 24px;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 4px;
        }
        
        .card-header p {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* ============ ELEGANT TABLE STYLES ============ */
        .table-container {
            overflow-x: auto;
            border-radius: 16px;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .elegant-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
        }

        .elegant-table thead {
            background: #f8fafc;
        }

        .elegant-table th {
            padding: 16px 24px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .elegant-table tbody tr {
            transition: all 0.2s ease;
        }

        .elegant-table tbody tr:hover {
            background: #f8fafc;
        }

        .elegant-table td {
            padding: 16px 24px;
            color: var(--text-main);
            border-bottom: 1px solid rgba(0,0,0,0.03);
            vertical-align: middle;
        }

        .elegant-table tbody tr:last-child td {
            border-bottom: none;
        }

        .elegant-table td:first-child {
            font-weight: 500;
            color: var(--primary);
        }

        /* ============ ELEGANT FORM STYLES ============ */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
            color: var(--text-main);
            font-weight: 600;
            font-size: 14px;
        }

        .form-group label span {
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            color: var(--text-main);
            background: white;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .form-control:hover {
            border-color: #cbd5e1;
        }

        .form-control[readonly] {
            background-color: #f8fafc;
            color: var(--text-muted);
            cursor: not-allowed;
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
            padding-right: 40px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 10px;
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(79, 70, 229, 0.35);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .form-hint {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
            display: block;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Info Boxes */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-box {
            background: white;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            transition: transform 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .info-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary);
        }

        .info-box.secondary::before { background: var(--secondary); }
        .info-box.success::before { background: #10b981; }

        .info-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.05);
        }
        
        .info-box h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-box p {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Alerts */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }
        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        /* ============ OVERLAY & RESPONSIVE ============ */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(4px);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .overlay.active {
            display: block;
            opacity: 1;
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
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
                padding: 16px 24px;
            }
            .page-content {
                padding: 24px;
            }
        }

        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .page-title {
                font-size: 18px;
            }
            .user-profile .name {
                display: none;
            }
            .content-card {
                padding: 20px;
            }
            .info-box {
                padding: 16px;
            }
            
            /* Responsive Table */
            .elegant-table thead {
                display: none;
            }
            .elegant-table, .elegant-table tbody, .elegant-table tr, .elegant-table td {
                display: block;
                width: 100%;
            }
            .elegant-table tr {
                margin-bottom: 16px;
                border: 1px solid rgba(0,0,0,0.05);
                border-radius: 12px;
                background: white;
                box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            }
            .elegant-table td {
                text-align: right;
                padding: 12px 16px;
                position: relative;
                padding-left: 50%;
                border-bottom: 1px solid rgba(0,0,0,0.03);
            }
            .elegant-table td:last-child {
                border-bottom: none;
            }
            .elegant-table td:before {
                content: attr(data-label);
                position: absolute;
                left: 16px;
                font-weight: 600;
                color: var(--text-muted);
                text-transform: uppercase;
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <!-- Overlay untuk Mobile -->
    <div class="overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h3>Reservasi.</h3>
            <p>Sistem Ruang Rapat</p>
        </div>
        <nav class="sidebar-menu">
            <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="ph ph-squares-four"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('reservasi.create') }}" class="{{ request()->is('reservasi/create') ? 'active' : '' }}">
                <i class="ph ph-calendar-plus"></i>
                <span>Buat Reservasi</span>
            </a>
            <a href="/reservasi/riwayat" class="{{ request()->is('reservasi/riwayat') ? 'active' : '' }}">
                <i class="ph ph-clock-counter-clockwise"></i>
                <span>Reservasi Saya</span>
            </a>
            
            @if(auth()->check() && auth()->user()->email == "admin@gmail.com")
            <a href="/admin/dashboard" style="margin-top: 10px; background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                <i class="ph ph-shield-check"></i>
                <span>Panel Admin</span>
            </a>
            @endif

            <a href="/logout" class="logout-btn">
                <i class="ph ph-sign-out"></i>
                <span>Logout</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="page-header">
            <div class="header-left">
                <button class="menu-toggle" onclick="toggleSidebar()">
                    <i class="ph ph-list"></i>
                </button>
                <h1 class="page-title">@yield('title', 'Dashboard')</h1>
            </div>
            
            @auth
            <div class="header-right">
                <div class="user-profile">
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="name">{{ auth()->user()->name }}</span>
                </div>
            </div>
            @endauth
        </header>

        <!-- Page Content -->
        <main class="page-content">
            @yield('content')
        </main>
    </div>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector(".sidebar");
            const overlay = document.querySelector(".overlay");
            
            sidebar.classList.toggle("open");
            overlay.classList.toggle("active");
        }

        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector(".sidebar");
            const menuToggle = document.querySelector(".menu-toggle");
            
            if (window.innerWidth <= 1024) {
                if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                    sidebar.classList.remove("open");
                    document.querySelector(".overlay").classList.remove("active");
                }
            }
        });
    </script>
</body>
</html>