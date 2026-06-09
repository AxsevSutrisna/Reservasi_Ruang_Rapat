@extends('layout')

@section('title', 'Buat Reservasi')

@section('content')
<div class="content-card">
    <div class="card-header">
        <h2><i class="ph ph-calendar-plus" style="color: var(--primary);"></i> Form Reservasi</h2>
        <p>Silakan lengkapi formulir di bawah ini untuk memesan ruang rapat.</p>
    </div>

    @if(session('error'))
        <div class="alert alert-error">
            <i class="ph ph-warning-circle" style="font-size: 20px;"></i>
            {{ session('error') }}
        </div>
    @endif

    <form action="/reservasi/store" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Pemesan</label>
            <input type="text" name="nama" class="form-control" value="{{ auth()->user()->name }}" readonly>
            <small class="form-hint">Otomatis terisi berdasarkan akun yang sedang login</small>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Ruangan <span>*</span></label>
                <select name="room_id" class="form-control" required>
                    <option value="">-- Pilih Ruangan --</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal <span>*</span></label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Waktu Mulai <span>*</span></label>
                <input type="time" name="waktu_mulai" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Waktu Berakhir <span>*</span></label>
                <input type="time" name="waktu_berakhir" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label>Tujuan / Keterangan Tambahan <span>*</span></label>
            <textarea name="tujuan" class="form-control" placeholder="Contoh: Rapat evaluasi bulanan tim IT..." required></textarea>
        </div>

        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        <div style="margin-top: 30px;">
            <button type="submit" class="btn-submit">
                <i class="ph ph-paper-plane-tilt"></i> Kirim Permintaan Reservasi
            </button>
        </div>
    </form>
</div>
@endsection