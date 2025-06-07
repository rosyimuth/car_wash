<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Layanan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg px-6 py-4">

                {{-- Filter dan Search --}}
                <div class="flex justify-end mb-4 gap-4 px-10 mt-4">
                    <input type="text" wire:model.live.300ms="search"
                        placeholder="Cari layanan..."
                        class="w-full border border-gray-300 rounded px-6 py-2 flex-grow focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />

                    <select wire:model.live="jenisFilter"
                        class="border border-gray-300 text-gray-500 px-4 py-2 rounded cursor-pointer hover:bg-blue-700 hover:text-white focus:outline-none transition w-40">
                        <option value="">Semua</option>
                        <option value="R">Regular</option>
                        <option value="M">Medium</option>
                        <option value="C">Complete</option>
                        <option value="D">Drywash</option>
                    </select>
                </div>

                {{-- Grid Layanan --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6 px-10">
                    @forelse($layanan as $item)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 flex flex-col justify-between h-full"
                            data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                            {{-- foto tetap proporsional --}}
                            <div class="w-full aspect-[16/9] overflow-hidden rounded-t-lg">
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}"
                                    class="w-auto h-32 object-cover transition duration-300 hover:scale-105" />
                            </div>

                            {{-- Konten --}}
                            <div class="p-4 space-y-1 flex-1 text-center">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $item->nama }}</h3>
                                <p class="text-md text-gray-600">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                                <p class="text-md text-gray-600"><strong>Jenis: </strong>{{ $item->ketJenis }}</p>

                                <button wire:click="showModal({{ $item->id }})"
                                    class="mt-3 px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500">
                            Tidak ada layanan ditemukan.
                        </div>
                    @endforelse
                </div>

                @if($isOpen && $selectedLayanan)
                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6 relative">
                            <button wire:click="closeModal"
                                class="absolute top-2 right-3 text-gray-500 hover:text-gray-800 text-xl">&times;</button>

                            <h2 class="text-xl font-semibold mb-4 text-center">{{ $selectedLayanan->nama }}</h2>

                            <img src="{{ asset('storage/' . $selectedLayanan->foto) }}"
                                class="w-full h-52 object-cover rounded mb-4" />

                            <p class="text-gray-600 mb-2"><strong>Jenis:</strong> {{ ucfirst($selectedLayanan->ketJenis) }}</p>
                            <p class="text-gray-600 mb-2"><strong>Harga:</strong> Rp{{ number_format($selectedLayanan->harga, 0, ',', '.') }}</p>
                            <p class="text-gray-600"><strong>Deskripsi:</strong><br>{{ $selectedLayanan->deskripsi }}</p>
                        </div>
                    </div>
                @endif

                {{-- Pagination & PerPage --}}
                <div class="mt-6 px-10 mb-10">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                        {{-- Dropdown Jumlah Per Halaman --}}
                        <div class="flex items-center gap-2">
                            <label for="perPage" class="text-sm font-medium">Tampilkan</label>
                            <select id="perPage" wire:model.live="perPage"
                                class="border border-gray-300 rounded-md px-7 py-2 text-sm focus:ring focus:border-blue-300 min-w-[110px]">
                                    <option value="4">4 baris</option>
                                    <option value="8">8 baris</option>
                                    <option value="12">12 baris</option>
                            </select>
                        </div>

                        {{-- Navigasi Halaman --}}
                        <div class="text-center md:text-right">
                            {{ $layanan->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="shadow-xl text-gray-500 py-5">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; {{ date('Y') }} WISH WASH. All rights reserved.</p>
        </div>
    </footer>
</div>
