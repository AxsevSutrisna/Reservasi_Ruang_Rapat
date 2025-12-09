@extends('admin-layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="content-card">
    <h2 style="margin-bottom: 15px; color: #2c3e50;">Daftar Reservasi</h2>
    <p style="color: #6c757d;">Admin dapat melihat semua reservasi dan mengubah status.</p>

    <div class="table-container">
        <table class="elegant-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>Ruangan</th>
                    <th>Tanggal</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Berakhir</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1; @endphp
                @foreach($reservasi as $r)
                <tr>
                    <td data-label="No">{{ $no++ }}</td>
                    <td data-label="Nama Pemesan">{{ $r->user->name }}</td>
                    <td data-label="Ruangan">{{ $r->room->nama }}</td>
                    <td data-label="Tanggal">{{ $r->tanggal }}</td>
                    <td data-label="Waktu Mulai">{{ $r->waktu_mulai }}</td>
                    <td data-label="Waktu Berakhir">{{ $r->waktu_berakhir }}</td>
                    <td data-label="Status">
                        @if($r->status == 'Disetujui')
                            <span class="status-badge status-approved">{{ $r->status }}</span>
                        @elseif($r->status == 'Pending')
                            <span class="status-badge status-pending">{{ $r->status }}</span>
                        @else
                            <span class="status-badge status-rejected">{{ $r->status }}</span>
                        @endif
                    </td>
                    <td data-label="Aksi">
                        @if($r->status == 'Pending')
                            <form action="{{ route('reservasi.approve', $r->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="padding:5px 10px; margin-right:5px; background:#28a745; color:white; border:none; border-radius:5px;">Setujui</button>
                            </form>
                            <form action="{{ route('reservasi.reject', $r->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="padding:5px 10px; background:#dc3545; color:white; border:none; border-radius:5px;">Tolak</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Manajemen Ruangan -->
<div class="content-card" style="margin-top:40px;">
    <h2 style="margin-bottom: 15px; color: #2c3e50;">Manajemen Ruangan</h2>
    <p style="color: #6c757d;">Tambah, edit, atau hapus ruangan.</p>

    <a href="{{ route('rooms.create') }}" style="display:inline-block; margin-bottom:15px; padding:8px 15px; background:#2fa4e7; color:white; border-radius:5px;">Tambah Ruangan</a>

    <div class="table-container">
        <table class="elegant-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Kapasitas</th>
                    <th>Lokasi</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no=1; @endphp
                @foreach($rooms as $room)
                <tr>
                    <td data-label="No">{{ $no++ }}</td>
                    <td data-label="Nama Ruangan">{{ $room->nama }}</td>
                    <td data-label="Kapasitas">{{ $room->kapasitas }}</td>
                    <td data-label="Lokasi">{{ $room->lokasi }}</td>
                    <td data-label="Deskripsi">{{ $room->deskripsi }}</td>
                    <td data-label="Aksi">
                        <a href="{{ route('rooms.edit', $room->id) }}" style="padding:5px 10px; background:#ffc107; color:white; border-radius:5px; text-decoration:none; margin-right:5px;">Edit</a>
                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="padding:5px 10px; background:#dc3545; color:white; border:none; border-radius:5px;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection