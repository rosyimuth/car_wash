<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Menampilkan semua data booking.
     * Endpoint: GET /api/booking
     */
    public function index()
    {
        // Memuat relasi user, schedule, dan service
        $bookings = Booking::with(['user', 'schedule', 'service'])->get();
        return response()->json($bookings, 200);
    }

    /**
     * Menyimpan data booking baru.
     * Endpoint: POST /api/booking
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plat_nomor' => 'required|string|max:20',
            'merk' => 'required|string|max:100',
            'schedule_id' => 'required|exists:schedules,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $booking = Booking::create($validated);
        return response()->json($booking->load(['user', 'schedule', 'service']), 201);
    }

    /**
     * Menampilkan detail satu booking berdasarkan ID.
     * Endpoint: GET /api/booking/{id}
     */
    public function show(string $id)
    {
        $booking = Booking::with(['user', 'schedule', 'service'])->findOrFail($id);
        return response()->json($booking, 200);
    }

    /**
     * Mengupdate data booking.
     * Endpoint: PUT /api/booking/{id}
     */
    public function update(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plat_nomor' => 'required|string|max:20',
            'merk' => 'required|string|max:100',
            'schedule_id' => 'required|exists:schedules,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $booking->update($validated);
        return response()->json($booking->load(['user', 'schedule', 'service']), 200);
    }

    /**
     * Menghapus data booking.
     * Endpoint: DELETE /api/booking/{id}
     */
    public function destroy(string $id)
    {
        Booking::destroy($id);
        return response()->json(["message" => "Booking berhasil dihapus"], 200);
    }
}
