<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="https://www.pngall.com/wp-content/uploads/5/Car-Wash-PNG-File-Download-Free.png">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-200">

    <!-- Card Container -->
    <div class="w-[600px] md:w-[700px] bg-white shadow-2xl rounded-xl overflow-hidden flex">
        
        <!-- Left Section (Image) -->
        <div class="w-1/2">
            <img src="https://i.pinimg.com/736x/4a/72/75/4a7275a6a3649c835b3702cd5497d811.jpg" alt="Cuci Mobil" class="h-full w-full object-cover">
        </div>

        <!-- Right Section (Form) -->
        <div class="w-1/2 bg-white text-black flex flex-col justify-center items-center p-6">
            <a href="{{ url('/') }}">
                <img src="https://www.pngall.com/wp-content/uploads/5/Car-Wash-PNG-File-Download-Free.png" alt="Wish Wash Logo" class="h-10 mb-4">
            </a>   
            <h2 class="text-xl font-bold">Welcome!</h2>

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('register') }}" class="w-full flex flex-col space-y-3">
                @csrf
                <div>
                    <label for="username" class="block text-sm">Username</label>
                    <input id="username" class="block mt-1 w-full p-2 bg-gray-100 text-sm rounded-md placeholder-gray-500" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Masukkan Nama" />
                </div>

                <div>
                    <label for="email" class="block text-sm">Email</label>
                    <input id="email" class="block mt-1 w-full p-2 bg-gray-100 text-sm rounded-md placeholder-gray-500" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan Email" />
                </div>

                <div>
                    <label for="phone_number" class="block text-sm">Phone Number</label>
                    <input id="phone_number" class="block mt-1 w-full p-2 bg-gray-100 text-sm rounded-md placeholder-gray-500" type="tel" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="tel" placeholder="Masukkan Nomor Telepon" />
                </div>

                <div>
                    <label for="address" class="block text-sm">Address</label>
                    <input id="address" class="block mt-1 w-full p-2 bg-gray-100 text-sm rounded-md placeholder-gray-500" type="text" name="address" value="{{ old('address') }}" required autocomplete="street-address" placeholder="Masukkan Alamat" />
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm">Password</label>
                    <input id="password" class="block mt-1 w-full p-2 bg-gray-100 text-sm rounded-md placeholder-gray-500" type="password" name="password" required autocomplete="new-password" placeholder="Masukkan Password" />
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class="block text-sm">Password Confirmation</label>
                    <input id="password_confirmation" class="block mt-1 w-full p-2 bg-gray-100 text-sm rounded-md placeholder-gray-500" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password" />
                </div>

                <button class="ms-1 border-2 border-gray-300 text-sm px-4 py-2 rounded-md bg-transparent hover:bg-blue-800 hover:border-white hover:text-white hover:shadow-lg hover:translate-y-[-2px] active:shadow-none active:translate-y-0 transition-all duration-300">
                    {{ __('Register') }}
                </button>
            </form>

            <p class="mt-3 text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500">Login</a></p>
        </div>
    </div>

</body>
</html>
