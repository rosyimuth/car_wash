<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Jadwal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg px-6 py-4">

                {{-- Filters dan Search --}}
                <div class="flex justify-end mb-4 gap-4 px-10 mt-4">
                    {{-- Input pencarian (mengisi ruang kosong) --}}
                    <input
                        type="text"
                        wire:model.live.300ms="search"
                        placeholder="Cari tanggal, jam, kuota..."
                        class="w-full border border-gray-300 rounded px-6 py-2 flex-grow focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    />
                    {{-- Filter dropdown (pojok kanan, ukuran tetap) --}}
                    <select wire:model.live="hariFilter" class="border border-gray-300 text-gray-500 px-4 py-2 rounded cursor-pointer hover:bg-blue-700 hover:text-white focus:outline-none transition w-48">
                        <option value="">Semua Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>

                {{-- Tabel Jadwal --}}
                <div class="overflow-x-auto px-10">
                    <table class="w-full border border-gray-300 mt-4 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">Tanggal</th>
                                <th class="border px-4 py-2">Jam Mulai</th>
                                <th class="border px-4 py-2">Jam Selesai</th>
                                <th class="border px-4 py-2">Kuota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwal as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d M Y') }}</td>
                                    <td class="border px-4 py-2">{{ $item->jam_mulai }}</td>
                                    <td class="border px-4 py-2">{{ $item->jam_selesai }}</td>
                                    <td class="border px-4 py-2">{{ $item->kuota }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-gray-500 py-4">Jadwal tidak ada ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination & PerPage --}}
                <div class="mt-6 px-10 mb-10">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                        {{-- Dropdown Jumlah Per Halaman --}}
                        <div class="flex items-center gap-2">
                            <label for="perPage" class="text-sm font-medium">Tampilkan</label>
                            <select id="perPage" wire:model.live="perPage"
                                class="border border-gray-300 rounded-md px-7 py-2 text-sm focus:ring focus:border-blue-300 min-w-[110px]">
                                    <option value="5">5 baris</option>
                                    <option value="10">10 baris</option>
                                    <option value="20">20 baris</option>
                            </select>
                        </div>

                        {{-- Navigasi Halaman --}}
                        <div class="text-center md:text-right">
                            {{ $jadwal->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="shadow-xl text-gray-500 py-5">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; {{ date('Y') }} ShineUp. All rights reserved.</p>
        </div>
    </footer>
</div>
