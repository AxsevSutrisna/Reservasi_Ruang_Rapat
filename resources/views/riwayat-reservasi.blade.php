@extends('layout')

@section('title', 'Riwayat Reservasi')

@section('content')
<div class="content-card">
    <h2 style="margin-bottom: 10px; color: #2c3e50;">Riwayat Reservasi</h2>
    <p style="color: #6c757d; margin-bottom: 24px;">Daftar semua reservasi yang pernah Anda buat</p>

    @if(session('success'))
        <div class="alert alert-success">
            <span class="alert-icon">✓</span>
            <span>{{ session('success') }}</span>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservasi as $r)
                    <tr>
                        <td data-label="No">{{ $loop->iteration }}</td>
                        <td data-label="Ruangan">{{ $r->room->nama }}</td>
                        <td data-label="Tanggal">{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</td>
                        <td data-label="Waktu Mulai">{{ \Carbon\Carbon::parse($r->waktu_mulai)->format('H:i') }}</td>
                        <td data-label="Waktu Berakhir">{{ \Carbon\Carbon::parse($r->waktu_berakhir)->format('H:i') }}</td>
                        <td data-label="Aksi">
                            @if(\Carbon\Carbon::parse($r->tanggal)->isFuture() || \Carbon\Carbon::parse($r->tanggal)->isToday())
                                <form action="{{ route('reservasi.batal', $r->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-cancel" onclick="return confirm('Yakin ingin membatalkan?')">
                                        Batalkan
                                    </button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-state-icon">📭</div>
                                <div class="empty-state-text">Belum ada riwayat reservasi</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection