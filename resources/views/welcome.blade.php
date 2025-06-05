<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WISH WASH - Booking Cuci Mobil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-white text-gray-800">

    <!-- Navbar -->
    <header class="w-full py-4 px-6 lg:px-12 flex justify-between items-center shadow-sm bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-200">
        <!-- Logo -->
        <div class="text-xl font-bold text-blue-600">WISH WASH</div>

        <!-- Navigasi Utama -->
        <nav class="hidden md:flex items-center space-x-6 text-sm text-gray-700">
            <a href="#fitur" class="hover:text-blue-600 transition duration-200 font-medium">Fitur</a>
            <a href="#mengapa" class="hover:text-blue-600 transition duration-200 font-medium">Mengapa Kami</a>
            <a href="#cara" class="hover:text-blue-600 transition duration-200 font-medium">Cara Kerja</a>
            <a href="#testimoni" class="hover:text-blue-600 transition duration-200 font-medium">Testimoni</a>
            <a href="#kontak" class="hover:text-blue-600 transition duration-200 font-medium">Kontak</a>

             @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition shadow"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded text-sm transition"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition shadow">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </nav>
    </header>

    <!-- Hero -->
<section class="bg-gradient-to-r from-blue-50 via-white to-blue-100 py-24">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Solusi Mudah Booking Cuci Mobil</h2>
            <p class="text-lg text-gray-600 mb-6">Pesan layanan cuci mobil secara online dengan cepat dan praktis menggunakan <strong>WISH WASH</strong>, layanan terpercaya untuk kendaraan Anda.</p>
            <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700 transition">Booking Sekarang</a>
        </div>
        <div class="hidden md:block">
            <img src="https://www.pngall.com/wp-content/uploads/5/Car-Wash-PNG-File-Download-Free.png" alt="Ilustrasi Cuci Mobil" class="w-full h-auto" />
        </div>
    </div>
</section>

<!-- Pengenalan Aplikasi -->
<section class="relative py-24 bg-gradient-to-br from-blue-100 via-white to-blue-50">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Gambar Ilustrasi -->
        <div class="order-2 md:order-1">
            <img src="https://i.pinimg.com/736x/48/15/6d/48156d0b461632742767c7b953ebdf62.jpg" alt="Ilustrasi Layanan Cuci Mobil" class="w-full h-auto rounded-md shadow-lg">
        </div>

        <!-- Konten Teks -->
        <div class="order-1 md:order-2">
            <h3 class="text-3xl md:text-4xl font-bold mb-6 text-gray-800">
                Apa Itu <span class="text-blue-600">WISH WASH</span>?
            </h3>
            <p class="text-lg text-gray-600 mb-4 leading-relaxed">
                <strong>WISH WASH</strong> adalah platform booking layanan cuci mobil online yang memudahkan Anda mendapatkan layanan berkualitas dengan jadwal yang fleksibel dan harga terjangkau.
            </p>
            <ul class="list-disc list-inside text-gray-700 mb-6">
                <li>Pilih paket cuci mobil sesuai kebutuhan Anda</li>
                <li>Booking mudah dan cepat tanpa antri</li>
                <li>Layanan profesional dan ramah pelanggan</li>
            </ul>
            <a href="#fitur" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md shadow hover:bg-blue-700 transition">
                Lihat Fitur Unggulan
            </a>
        </div>
    </div>
</section>

    <!-- Fitur -->
    <section id="fitur" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-12 text-gray-800">Fitur Unggulan WISH WASH</h3>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="p-6 border rounded-lg hover:shadow-lg transition">
                    <img src="https://img.icons8.com/fluency/96/easy.png" class="mx-auto mb-4" />
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Booking Online Mudah</h4>
                    <p class="text-gray-600">Pesan layanan cuci mobil kapan saja dan di mana saja tanpa ribet.</p>
                </div>
                <div class="p-6 border rounded-lg hover:shadow-lg transition">
                    <img src="https://img.icons8.com/fluency/96/calendar--v1.png" class="mx-auto mb-4" />
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Jadwal Fleksibel</h4>
                    <p class="text-gray-600">Pilih waktu booking sesuai jadwal Anda tanpa bentrok.</p>
                </div>
                <div class="p-6 border rounded-lg hover:shadow-lg transition">
                    <img src="https://img.icons8.com/fluency/96/customer-support.png" class="mx-auto mb-4" />
                    <h4 class="text-xl font-semibold mb-2 text-gray-800">Layanan Profesional</h4>
                    <p class="text-gray-600">Tim profesional siap memberikan hasil cuci maksimal dan memuaskan.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Mengapa Kami -->
    <section id="mengapa" class="bg-blue-50 py-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-10 text-gray-800">Mengapa Memilih WISH WASH?</h3>
            <div class="grid md:grid-cols-4 gap-8 text-left">
                <div>
                    <h4 class="text-xl font-semibold mb-2 text-blue-700">✅ Praktis</h4>
                    <p class="text-gray-600">Booking layanan cuci mobil tanpa perlu datang ke tempat terlebih dahulu.</p>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-2 text-blue-700">🧼 Bersih Maksimal</h4>
                    <p class="text-gray-600">Gunakan layanan kami untuk hasil cuci mobil yang bersih, rapi, dan memuaskan.</p>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-2 text-blue-700">📅 Terjadwal</h4>
                    <p class="text-gray-600">Atur jadwal cuci mobil yang sesuai dengan waktu luang Anda.</p>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-2 text-blue-700">👍 Layanan Profesional</h4>
                    <p class="text-gray-600">Siap memberikan hasil cuci mobil terbaik dengan standar kualitas tinggi.</p>
                </div>
            </div>
        </div>
    </section>


<!-- Cara Kerja -->
<section id="cara" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-center mb-12 text-gray-800">Bagaimana Cara Kerja WISH WASH?</h3>
        <div class="grid md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-blue-600 text-4xl font-bold mb-2">1</div>
                <h4 class="font-semibold text-lg mb-2 text-gray-800">Pilih Paket</h4>
                <p class="text-gray-600">Pilih jenis layanan cuci mobil yang sesuai dengan kebutuhan Anda.</p>
            </div>
            <div>
                <div class="text-blue-600 text-4xl font-bold mb-2">2</div>
                <h4 class="font-semibold text-lg mb-2 text-gray-800">Booking Online</h4>
                <p class="text-gray-600">Isi data dan jadwal melalui platform kami dengan mudah dan cepat.</p>
            </div>
            <div>
                <div class="text-blue-600 text-4xl font-bold mb-2">3</div>
                <h4 class="font-semibold text-lg mb-2 text-gray-800">Konfirmasi & Persiapan</h4>
                <p class="text-gray-600">Tim kami mengonfirmasi booking dan menyiapkan layanan sesuai jadwal.</p>
            </div>
            <div>
                <div class="text-blue-600 text-4xl font-bold mb-2">4</div>
                <h4 class="font-semibold text-lg mb-2 text-gray-800">Nikmati Layanan</h4>
                <p class="text-gray-600">Mobil Anda dicuci secara profesional dan siap digunakan kembali.</p>
            </div>
        </div>
    </div>
</section>

    <!-- Testimoni -->
    <section id="testimoni" class="relative py-24 bg-gradient-to-br from-blue-200 via-white to-blue-100">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-10 text-gray-800">Apa Kata Mereka</h3>
            <div class="swiper testimoni-swiper">
                <div class="swiper-wrapper">
                    @foreach([
                        ['"Booking cuci mobil jadi cepat dan praktis lewat platform ini. Gak perlu antre lama lagi!"', 'Nabila Nur Azizah'],
                        ['"Saya suka karena bisa pilih jadwal dan layanan cuci mobil sesuai kebutuhan saya."', 'Nur Chesya Puspitasari'],
                        ['"Pelayanannya profesional dan mobil saya selalu bersih maksimal setelah booking lewat sini."', 'Rosyidah Muthmainnah'],
                        ['"Fitur notifikasi dan pengingat jadwal cuci mobilnya sangat membantu saya yang sibuk."', 'Sabian Raka Pramuditya'],
                        ['"Sebagai pemilik tempat cuci mobil, saya terbantu dengan sistem booking yang teratur dan mudah dipantau."', 'Sugiarto'],
                        ['"Sekarang saya bisa kelola pesanan cuci mobil pelanggan dengan lebih rapi dan efisien."', 'Yunianto Hermawan']
                    ] as [$msg, $author])
                    <div class="swiper-slide">
                        <div class="bg-white p-6 rounded shadow hover:shadow-lg transition h-full">
                            <p class="italic text-gray-700">{{ $msg }}</p>
                            <h5 class="mt-4 font-semibold text-blue-600">– {{ $author }}</h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="bg-blue-600 text-white py-20">
        <div class="max-w-5xl mx-auto px-6">
            <h3 class="text-3xl font-bold text-center mb-12">Hubungi Kami</h3>
            <div class="grid md:grid-cols-2 gap-10 text-white text-base">
                
                <div class="flex items-start space-x-4">
                    <div>
                        <x-heroicon-o-envelope class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" />
                    </div>
                    <div>
                        <p class="font-semibold">Email</p>
                        <p>info@laravel.com</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div>
                        <x-heroicon-o-phone class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" />
                    </div>
                    <div>
                        <p class="font-semibold">Telepon</p>
                        <p>+62 878 8353 8770</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div>
                        <x-heroicon-o-map-pin class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" />
                    </div>
                    <div>
                        <p class="font-semibold">Alamat</p>
                        <p>Jl. STM Pembangunan, Daerah Istimewa Yogyakarta, Indonesia</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div>
                        <x-heroicon-o-at-symbol class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" />
                    </div>
                    <div>
                        <p class="font-semibold">Media Sosial</p>
                        <p>
                            <a href="https://instagram.com/rosyimuth" target="_blank" class="underline hover:text-gray-200">@wishwash.car</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; {{ date('Y') }} WISH WASH. All rights reserved.</p>
            <div class="space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:underline">Kebijakan Privasi</a>
                <a href="#" class="hover:underline">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>


    <!-- SwiperJS JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
    new Swiper('.mitra-swiper', {
        loop: true,
        autoplay: {
        delay: 2000,
        disableOnInteraction: false,
        },
        slidesPerView: 2,
        spaceBetween: 20,
        breakpoints: {
        640: {
            slidesPerView: 3,
        },
        768: {
            slidesPerView: 4,
        },
        1024: {
            slidesPerView: 5,
        },
        },
    });

    new Swiper('.testimoni-swiper', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        slidesPerView: 1,
        spaceBetween: 20,
        breakpoints: {
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        },
    });
    </script>
</body>
</html>