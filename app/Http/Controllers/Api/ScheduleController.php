<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Menampilkan semua data schedule.
     * Endpoint: GET /api/schedule
     */
    public function index()
    {
        return response()->json(Schedule::all(), 200);
    }

    /**
     * Menyimpan data schedule baru.
     * Endpoint: POST /api/schedule
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
        ]);

        $schedule = Schedule::create($validated);
        return response()->json($schedule, 201);
    }

    /**
     * Menampilkan detail satu schedule berdasarkan ID.
     * Endpoint: GET /api/schedule/{id}
     */
    public function show(string $id)
    {
        $schedule = Schedule::findOrFail($id);
        return response()->json($schedule, 200);
    }

    /**
     * Mengupdate data schedule.
     * Endpoint: PUT /api/schedule/{id}
     */
    public function update(Request $request, string $id)
    {
        $schedule = Schedule::findOrFail($id);

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
        ]);

        $schedule->update($validated);
        return response()->json($schedule, 200);
    }

    /**
     * Menghapus data schedule.
     * Endpoint: DELETE /api/schedule/{id}
     */
    public function destroy(string $id)
    {
        Schedule::destroy($id);
        return response()->json(['message' => 'Schedule berhasil dihapus'], 200);
    }
}
