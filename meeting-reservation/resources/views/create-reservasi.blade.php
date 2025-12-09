@extends('layout')

@section('title', 'Buat Reservasi')

@section('content')
<div class="content-card">
    <h2 style="margin-bottom: 10px; color: #2c3e50;">Form Reservasi</h2>
    <p style="color: #6c757d; margin-bottom: 30px;">Isi form di bawah untuk membuat reservasi ruang rapat</p>
    @if(session('error'))
        <div style="color:red; margin-bottom:15px;">{{ session('error') }}</div>
    @endif

    <form action="/reservasi/store" method="POST">
        @csrf

        <!-- Nama Pemesan (otomatis dari user login) -->
        <div class="form-group" style="margin-bottom: 15px;">
            <label>Nama Pemesan</label>
            <input type="text" name="nama" class="form-control" value="{{ auth()->user()->name }}" readonly style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
        </div>

        <!-- Ruangan -->
        <div class="form-group">
            <label><span class="form-icon"></span> Ruangan <span>*</span></label>
            <select name="room_id" class="form-control" required>
                <option value="">-- Pilih Ruangan --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal -->
        <div class="form-group">
            <label><span class="form-icon"></span> Tanggal <span>*</span></label>
            <input type="date" name="tanggal" class="form-control" required>
            <small class="form-hint">Pilih tanggal reservasi yang diinginkan</small>
        </div>

        <!-- Waktu Mulai & Berakhir (2 kolom) -->
        <div class="form-row">
            <div class="form-group">
                <label><span class="form-icon"></span> Waktu Mulai <span>*</span></label>
                <input type="time" name="waktu_mulai" class="form-control" required>
            </div>

            <div class="form-group">
                <label><span class="form-icon"></span> Waktu Berakhir <span>*</span></label>
                <input type="time" name="waktu_berakhir" class="form-control" required>
            </div>
        </div>

        <!-- Tujuan -->
        <div class="form-group" style="margin-bottom: 15px;">
            <label>Tujuan</label>
            <input type="text" name="tujuan" class="form-control" required style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
        </div>


        <!-- Hidden User ID -->
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        <!-- Submit Button -->
        <button type="submit" class="btn-submit">
            ✓ Kirim Reservasi
        </button>
    </form>
</div>
@endsection