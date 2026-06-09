@extends('layout')

@section('title', 'Riwayat Reservasi')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h2><i class="ph ph-clock-counter-clockwise" style="color: var(--primary);"></i> Riwayat Reservasi Saya</h2>
        <p>Daftar semua reservasi ruangan yang pernah Anda buat.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="ph ph-check-circle" style="font-size: 20px;"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table class="elegant-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Berakhir</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservasi as $r)
                    <tr>
                        <td data-label="No">{{ $loop->iteration }}</td>
                        <td data-label="Ruangan">
                            <span style="background: #f1f5f9; padding: 4px 10px; border-radius: 6px; font-size: 13px; border: 1px solid #e2e8f0; font-weight: 500;">
                                {{ $r->room->nama }}
                            </span>
                        </td>
                        <td data-label="Tanggal"><strong>{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</strong></td>
                        <td data-label="Waktu Mulai">
                            <span style="color: #6366f1; font-weight: 600;"><i class="ph ph-clock"></i> {{ \Carbon\Carbon::parse($r->waktu_mulai)->format('H:i') }}</span>
                        </td>
                        <td data-label="Waktu Berakhir">
                            <span style="color: #6366f1; font-weight: 600;"><i class="ph ph-clock"></i> {{ \Carbon\Carbon::parse($r->waktu_berakhir)->format('H:i') }}</span>
                        </td>
                        <td data-label="Aksi" style="text-align: center;">
                            @if(\Carbon\Carbon::parse($r->tanggal)->isFuture() || \Carbon\Carbon::parse($r->tanggal)->isToday())
                                <form action="{{ route('reservasi.batal', $r->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; padding: 6px 14px; border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; transition: all 0.2s;" onclick="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?')" onmouseover="this.style.background='#fca5a5';this.style.color='#991b1b';" onmouseout="this.style.background='#fee2e2';this.style.color='#dc2626';">
                                        <i class="ph ph-trash"></i> Batal
                                    </button>
                                </form>
                            @else
                                <span style="color: #94a3b8; font-style: italic; font-size: 13px;">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #94a3b8;">
                            <i class="ph ph-tray" style="font-size: 40px; margin-bottom: 10px;"></i>
                            <p>Anda belum pernah melakukan reservasi ruangan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection