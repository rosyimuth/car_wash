<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Menampilkan semua data service.
     * Endpoint: GET /api/service
     */
    public function index()
    {
        return response()->json(Service::all(), 200);
    }

    /**
     * Menyimpan data service baru.
     * Endpoint: POST /api/service
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'nullable|string', // jika pakai file upload nanti bisa ubah jadi file/image
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        $service = Service::create($validated);
        return response()->json($service, 201);
    }

    /**
     * Menampilkan detail satu service berdasarkan ID.
     * Endpoint: GET /api/service/{id}
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service, 200);
    }

    /**
     * Mengupdate data service.
     * Endpoint: PUT /api/service/{id}
     */
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'foto' => 'nullable|string',
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        $service->update($validated);
        return response()->json($service, 200);
    }

    /**
     * Menghapus data service.
     * Endpoint: DELETE /api/service/{id}
     */
    public function destroy(string $id)
    {
        Service::destroy($id);
        return response()->json(['message' => 'Service berhasil dihapus'], 200);
    }
}
