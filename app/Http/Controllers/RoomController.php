<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('dashboard', compact('rooms')); 
    }

    public function create()
    {
        return view('rooms.create-room'); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Room::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    public function edit(Room $room)
    {
        return view('rooms.edit-room', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $room->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Ruangan berhasil diperbarui!');
    }

    // Hapus ruangan
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Ruangan berhasil dihapus!');
    }
}