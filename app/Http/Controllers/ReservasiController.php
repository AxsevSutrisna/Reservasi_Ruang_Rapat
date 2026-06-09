<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasi = Reservation::with(['room', 'user'])->get();
        $user = Auth::user();
        return view('dashboard', compact('reservasi', 'user'));
    }

    public function create()
    {
        $currentHour = now()->format('H');

        if ($currentHour < 8 || $currentHour >= 17) {
            return redirect()->route('dashboard')
                ->with('error', 'Maaf, reservasi hanya bisa dibuat pada jam kerja (08:00 - 17:00).');
        }

        $rooms = Room::all();
        return view('create-reservasi', compact('rooms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_berakhir' => 'required',
            'tujuan' => 'required|string',
        ]);

        if ($data['waktu_mulai'] < '08:00' || $data['waktu_berakhir'] > '17:00') {
            return back()->with('error', 'Reservasi hanya diizinkan antara pukul 08:00 hingga 17:00.');
        }

        if ($data['waktu_mulai'] >= $data['waktu_berakhir']) {
            return back()->with('error', 'Waktu mulai harus lebih kecil dari waktu berakhir.');
        }

        $data['user_id'] = Auth::id();
        $exists = Reservation::where('room_id', $data['room_id'])
            ->where('tanggal', $data['tanggal'])
            ->where(function($query) use ($data) {
                $query->whereBetween('waktu_mulai', [$data['waktu_mulai'], $data['waktu_berakhir']])
                      ->orWhereBetween('waktu_berakhir', [$data['waktu_mulai'], $data['waktu_berakhir']])
                      ->orWhere(function($q) use ($data) {
                        $q->where('waktu_mulai', '<=', $data['waktu_mulai'])
                          ->where('waktu_berakhir', '>=', $data['waktu_berakhir']);
                      });
            })
            ->exists();

        if ($exists) {
            return back()->with('error', 'Maaf, ruangan sudah dipesan pada waktu tersebut.');
        }

        Reservation::create($data);

        return redirect()->route('dashboard')->with('success', 'Reservasi berhasil ditambahkan!');
    }

    public function riwayat()
    {
        $reservasi = Reservation::with('room')
            ->where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('riwayat-reservasi', compact('reservasi'));
    }

    public function batal($id)
    {
        $reservasi = Reservation::findOrFail($id);

        if ($reservasi->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Aksi tidak diizinkan.');
        }

        if ($reservasi->tanggal < now()->toDateString()) {
            return redirect()->back()->with('error', 'Tidak bisa membatalkan reservasi yang sudah lewat.');
        }

        $reservasi->delete();

        return redirect()->route('reservasi.riwayat')->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
