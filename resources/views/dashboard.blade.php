@extends('layout')

@section('title', 'Dashboard')

@section('content')
    <div class="card-header">
        <h2>Selamat datang kembali, {{ auth()->user()->name }}! 👋</h2>
        <p>Berikut adalah ringkasan informasi ruang rapat dan reservasi terbaru.</p>
    </div>

    @if(session('error'))
        <div class="alert alert-error">
            <i class="ph ph-warning-circle" style="font-size: 20px;"></i>
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success">
            <i class="ph ph-check-circle" style="font-size: 20px;"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="info-grid">
        <div class="info-box">
            <h3><i class="ph ph-info" style="color: var(--primary); font-size: 20px;"></i> Info Operasional</h3>
            <p>Seluruh ruangan tersedia mulai pukul <strong>08:00</strong> sampai <strong>17:00</strong> pada setiap hari kerja. Pastikan memesan tepat waktu.</p>
        </div>
        
        <div class="info-box secondary">
            <h3><i class="ph ph-door" style="color: var(--secondary); font-size: 20px;"></i> Daftar Ruangan</h3>
            <ul style="list-style: none; padding: 0; color: var(--text-muted); font-size: 14px; margin-top: 8px;">
                <li style="margin-bottom: 4px; display: flex; align-items: center; gap: 6px;"><i class="ph ph-check-circle" style="color: #10b981;"></i> Conversation Hall</li>
                <li style="margin-bottom: 4px; display: flex; align-items: center; gap: 6px;"><i class="ph ph-check-circle" style="color: #10b981;"></i> Ruang Serba Guna</li>
                <li style="display: flex; align-items: center; gap: 6px;"><i class="ph ph-check-circle" style="color: #10b981;"></i> Lab Komputer Lantai 3</li>
            </ul>
        </div>
    </div>

    <div class="content-card">
        <div class="card-header" style="margin-bottom: 20px;">
            <h2>Reservasi Terbaru</h2>
            <p>Daftar reservasi ruangan yang baru saja dibuat.</p>
        </div>

        <div class="table-container">
            <table class="elegant-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Ruangan</th>
                        <th>Tgl Booking</th>
                        <th>Tgl Reservasi</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($reservasi)
                        @forelse ($reservasi as $r)
                        <tr>
                            <td data-label="No">{{ $loop->iteration }}</td>
                            <td data-label="Nama Pemesan">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 28px; height: 28px; border-radius: 50%; background: #e0e7ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600;">
                                        {{ strtoupper(substr($r->user->name, 0, 1)) }}
                                    </div>
                                    {{ $r->user->name }}
                                </div>
                            </td>
                            <td data-label="Ruangan">
                                <span style="background: #f1f5f9; padding: 4px 10px; border-radius: 6px; font-size: 13px; border: 1px solid #e2e8f0; font-weight: 500;">
                                    {{ $r->room->nama }}
                                </span>
                            </td>
                            <td data-label="Tgl Booking">{{ \Carbon\Carbon::parse($r->created_at)->setTimezone('Asia/Jakarta')->format('d M Y') }}</td>
                            <td data-label="Tgl Reservasi">
                                <strong>{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</strong>
                            </td>
                            <td data-label="Waktu">
                                <span style="color: #6366f1; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                    <i class="ph ph-clock"></i>
                                    {{ \Carbon\Carbon::parse($r->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($r->waktu_berakhir)->format('H:i') }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px; color: #94a3b8;">
                                <i class="ph ph-calendar-blank" style="font-size: 32px; margin-bottom: 8px;"></i>
                                <p>Belum ada data reservasi terbaru.</p>
                            </td>
                        </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
@endsection