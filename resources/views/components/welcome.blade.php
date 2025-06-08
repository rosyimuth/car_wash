<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="flex items-center space-x-4 mt-4">
    <x-application-logo class="block h-12 w-auto" />
    
    <h1 class="text-xl font-semibold text-gray-800 mb-2">
        Selamat Datang {{ Auth::user()->name }}!
    </h1>
</div>


    <p class="mt-6 text-gray-600 leading-relaxed">
    Jelajahi fitur layanan kami seperti Booking, Daftar Layanan, dan Jadwal. Semuanya telah tersedia untuk memudahkan kebutuhan Anda!
    </p>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Booking</h2>
            <p class="text-sm text-gray-500 mb-4">Pesan layanan dengan mudah secara online.</p>
            <a href="{{ route('booking.index') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded hover:bg-indigo-700 transition">
                Lihat Booking
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Layanan</h2>
            <p class="text-sm text-gray-500 mb-4">Lihat daftar layanan yang kami tawarkan.</p>
            <a href="{{ route('layanan.index') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded hover:bg-indigo-700 transition">
                Lihat Layanan
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Jadwal</h2>
            <p class="text-sm text-gray-500 mb-4">Lihat jadwal layanan dan ketersediaan.</p>
            <a href="{{ route('jadwal.index') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded hover:bg-indigo-700 transition">
                Lihat Jadwal
            </a>
        </div>
    </div>
</div>
