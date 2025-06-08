<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan semua data user.
     * Endpoint: GET /api/user
     */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * Menyimpan data user baru.
     * Endpoint: POST /api/user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|min:6',
            'address'      => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
        ]);

        // Enkripsi password
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        return response()->json($user, 201);
    }

    /**
     * Menampilkan detail satu user berdasarkan ID.
     * Endpoint: GET /api/user/{id}
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    /**
     * Mengupdate data user.
     * Endpoint: PUT /api/user/{id}
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'password'     => 'nullable|min:6',
            'address'      => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
        ]);

        // Update password jika dikirim
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return response()->json($user, 200);
    }

    /**
     * Menghapus data user.
     * Endpoint: DELETE /api/user/{id}
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return response()->json(['message' => 'User berhasil dihapus'], 200);
    }
}
