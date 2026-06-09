@extends('admin-layout')

@section('title', 'Edit Ruangan')

@section('content')
<div class="content-card">
    <h2 style="margin-bottom:15px;">Edit Ruangan</h2>

    @if ($errors->any())
        <div style="color:red; margin-bottom:15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group" style="margin-bottom:15px;">
            <label>Nama Ruangan</label>
            <input type="text" name="nama" class="form-control" value="{{ $room->nama }}" required style="width:100%; padding:8px; border-radius:5px; border:1px solid #ccc;">
        </div>

        <div class="form-group" style="margin-bottom:15px;">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" value="{{ $room->kapasitas }}" required min="1" style="width:100%; padding:8px; border-radius:5px; border:1px solid #ccc;">
        </div>

        <div class="form-group" style="margin-bottom:15px;">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ $room->lokasi }}" required style="width:100%; padding:8px; border-radius:5px; border:1px solid #ccc;">
        </div>

        <div class="form-group" style="margin-bottom:15px;">
            <label>Deskripsi</label>
            <input value="{{ $room->deskripsi }}" type="text" name="deskripsi" class="form-control" rows="3" style="width:100%; padding:8px; border-radius:5px; border:1px solid #ccc;"></inp>
        </div>

        <button type="submit" style="padding:8px 15px; background:#ffc107; color:white; border:none; border-radius:5px;">Update Ruangan</button>
    </form>
</div>
@endsection