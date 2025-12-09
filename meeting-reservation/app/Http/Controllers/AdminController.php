<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Reservation::with(['user', 'room'])->orderBy('tanggal', 'desc');

        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->where('tanggal', $request->tanggal);
        }

        if ($request->has('room_id') && $request->room_id != '') {
            $query->where('room_id', $request->room_id);
        }

        $reservasi = $query->get();
        $rooms = Room::all();

        $total = Reservation::count();
        $pending = Reservation::where('status', 'Pending')->count();
        $approved = Reservation::where('status', 'Disetujui')->count();
        $rejected = Reservation::where('status', 'Ditolak')->count();

        return view('admin.dashboard', compact('reservasi', 'rooms', 'total', 'pending', 'approved', 'rejected'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;
        $reservation->save();

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui!');
    }

    public function index() {
        $reservasi = Reservation::with(['user', 'room'])->get();
        $rooms = Room::all();
        return view('dashboard', compact('reservasi', 'rooms'));
    }

    public function approve($id) {
        $res = Reservation::findOrFail($id);
        $res->status = 'Disetujui';
        $res->save();
        return back()->with('success', 'Reservasi disetujui');
    }

    public function reject($id) {
        $res = Reservation::findOrFail($id);
        $res->status = 'Ditolak';
        $res->save();
        return back()->with('success', 'Reservasi ditolak');
    }
}