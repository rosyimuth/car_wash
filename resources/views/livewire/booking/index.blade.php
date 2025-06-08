<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg px-6 py-4">

                <div class="flex flex-wrap justify-between items-center mb-4 px-10 gap-4 mt-4">
                {{-- Tombol Tambah Booking (di kiri) --}}
                <div class="flex-shrink-0">
                    <button
                        wire:click="openAddModal"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    >
                        Tambah Booking
                    </button>
                </div>

                {{-- Search dan Filter (di kanan) --}}
                <div class="flex items-center gap-4 flex-grow">
                    {{-- Search - paling panjang --}}
                    <input
                        type="text"
                        wire:model.live.300ms="search"
                        placeholder="Cari nama, plat nomor, merk..."
                        class="border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition flex-grow"
                    />

                    {{-- Filter Schedule --}}
                    <select wire:model.live="filterSchedule" class="border border-gray-300 text-gray-700 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 transition w-48">
                        <option value="">Semua Jadwal</option>
                        @foreach ($jadwalList as $id => $tgl)
                            <option value="{{ $id }}">{{ \Carbon\Carbon::parse($tgl)->translatedFormat('l, d M Y') }}</option>
                        @endforeach
                    </select>

                    {{-- Filter Merk --}}
                    <select wire:model.live="filterMerk" class="border border-gray-300 text-gray-700 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 transition w-48">
                        <option value="">Semua Merk</option>
                        @foreach ($merkList as $merk)
                            <option value="{{ $merk }}">{{ $merk }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

                {{-- Tabel Booking --}}
                <div class="overflow-x-auto px-10">
                    <table class="w-full border border-gray-300 mt-4 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">Nama Customer</th>
                                <th class="border px-4 py-2">Plat Nomor</th>
                                <th class="border px-4 py-2">Merk</th>
                                <th class="border px-4 py-2">Tanggal</th>
                                <th class="border px-4 py-2">Jam</th>
                                <th class="border px-4 py-2">Layanan</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ $item->user->name ?? '-' }}</td>
                                    <td class="border px-4 py-2">{{ $item->plat_nomor }}</td>
                                    <td class="border px-4 py-2">{{ $item->merk }}</td>
                                    <td class="border px-4 py-2">
                                        {{ \Carbon\Carbon::parse($item->schedule->tanggal)->translatedFormat('l, d M Y') }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $item->schedule->jam_mulai }} - {{ $item->schedule->jam_selesai }}
                                    </td>
                                    <td class="border px-4 py-2">{{ $item->service->nama ?? '-' }}</td>
                                    <td class="border px-4 py-2 text-center space-x-2">
                                        <button
                                            wire:click="openDetailModal({{ $item->id }})"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm"
                                        >Lihat</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-gray-500 py-4">Data booking tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination & PerPage --}}
                <div class="mt-6 px-10 mb-10">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                        {{-- Per Page --}}
                        <div class="flex items-center gap-2">
                            <label for="perPage" class="text-sm font-medium">Tampilkan</label>
                            <select id="perPage" wire:model.live="perPage"
                                class="border border-gray-300 rounded-md px-7 py-2 text-sm focus:ring focus:border-blue-300 min-w-[110px]">
                                <option value="10">10 baris</option>
                                <option value="20">20 baris</option>
                                <option value="50">50 baris</option>
                            </select>
                        </div>

                        {{-- Pagination --}}
                        <div class="text-center md:text-right">
                            {{ $bookings->links() }}
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

    {{-- Modal Tambah Booking --}}
    @if ($showModalAdd)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                <h3 class="text-xl font-semibold mb-4">Tambah Booking</h3>
                
                <form wire:submit.prevent="saveBooking">
                    {{-- Plat Nomor --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Plat Nomor</label>
                        <input type="text" wire:model.defer="newBooking.plat_nomor" class="w-full border rounded px-3 py-2" />
                        @error('newBooking.plat_nomor') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Merk --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Merk</label>
                        <input type="text" wire:model.defer="newBooking.merk" class="w-full border rounded px-3 py-2" />
                        @error('newBooking.merk') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Jadwal --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Pilih Jadwal</label>
                        <select wire:model.defer="newBooking.schedule_id" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Jadwal</option>
                            @foreach ($jadwalList as $id => $tgl)
                                <option value="{{ $id }}">{{ \Carbon\Carbon::parse($tgl)->translatedFormat('l, d M Y') }}</option>
                            @endforeach
                        </select>
                        @error('newBooking.schedule_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Layanan --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Layanan</label>
                        <select wire:model.defer="newBooking.service_id" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Layanan</option>
                            @foreach ($serviceList as $id => $nama)
                                <option value="{{ $id }}">{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('newBooking.service_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Modal Detail Booking --}}
    @if ($showModalDetail && $selectedBooking)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                <h3 class="text-xl font-semibold mb-4">Detail Booking</h3>

                <div class="mb-2"><strong>Nama Customer:</strong> {{ $selectedBooking->user->name ?? '-' }}</div>
                <div class="mb-2"><strong>Plat Nomor:</strong> {{ $selectedBooking->plat_nomor }}</div>
                <div class="mb-2"><strong>Merk:</strong> {{ $selectedBooking->merk }}</div>
                <div class="mb-2"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($selectedBooking->schedule->tanggal)->translatedFormat('l, d M Y') }}</div>
                <div class="mb-2"><strong>Jam:</strong> {{ $selectedBooking->schedule->jam_mulai }} - {{ $selectedBooking->schedule->jam_selesai }}</div>
                <div class="mb-4"><strong>Layanan:</strong> {{ $selectedBooking->service->nama ?? '-' }}</div>

                @if(auth()->id() === $selectedBooking->user_id)
                    {{-- Tombol Edit & Hapus --}}
                    <div class="flex justify-end gap-2 mt-6">
                        <button wire:click="openEditModal({{ $selectedBooking->id }})" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                        <button wire:click="deleteBooking" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700" onclick="confirm('Yakin ingin menghapus booking ini?') || event.stopImmediatePropagation()">Hapus</button>
                        <button wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Tutup</button>
                    </div>
                @else
                    <div class="flex justify-end mt-6">
                        <button wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Tutup</button>
                    </div>
                @endif
            </div>
        </div>
    @endif

    {{-- Modal Edit Booking --}}
    @if ($showModalEdit && $editBooking)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                <h3 class="text-xl font-semibold mb-4">Edit Booking</h3>

                <form wire:submit.prevent="updateBooking">
                    {{-- Plat Nomor --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Plat Nomor</label>
                        <input type="text" wire:model.defer="editBooking.plat_nomor" class="w-full border rounded px-3 py-2" />
                        @error('editBooking.plat_nomor') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Merk --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Merk</label>
                        <input type="text" wire:model.defer="editBooking.merk" class="w-full border rounded px-3 py-2" />
                        @error('editBooking.merk') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Jadwal --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Jadwal</label>
                        <select wire:model.defer="editBooking.schedule_id" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Jadwal</option>
                            @foreach ($jadwalList as $id => $tgl)
                                <option value="{{ $id }}">{{ \Carbon\Carbon::parse($tgl)->translatedFormat('l, d M Y') }}</option>
                            @endforeach
                        </select>
                        @error('editBooking.schedule_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Layanan --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Layanan</label>
                        <select wire:model.defer="editBooking.service_id" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih Layanan</option>
                            @foreach ($serviceList as $id => $nama)
                                <option value="{{ $id }}">{{ $nama }}</option>
                            @endforeach
                        </select>
                        @error('editBooking.service_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endif


</div>
