@extends('admin-layout')

@section('title', 'Tambah Ruangan')

@section('content')
<div class="content-card">
    <h2 style="margin-bottom:15px;">Tambah Ruangan</h2>

    @if ($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf
        <div class="form-group" style="margin-bottom:15px;">
            <label>Nama Ruangan</label>
            <input type="text" name="nama" class="form-control" required style="width:100%; padding:8px; border-radius:5px; border:1px solid #ccc;">
        </div>

        <div class="form-group" style="margin-bottom:15px;">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" required min="1" style="width:100%; padding:8px; border-radius:5px; border:1px solid #ccc;">
        </div>

        <div class="form-group" style="margin-bottom:15px;">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required style="width:100%; padding:8px; border-radius:5px; border:1px solid #ccc;">
        </div>

        <div class="form-group" style="margin-bottom:15px;">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" style="width:100%; padding:8px; border-radius:5px; border:1px solid #ccc;"></textarea>
        </div>

        <button href="{{ route('admin.dashboard') }}" type="submit" style="padding:8px 15px; background:#2fa4e7; color:white; border:none; border-radius:5px;">Tambah Ruangan</button>
    </form>
</div>
@endsection