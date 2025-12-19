<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Skripsi Project</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body class="antialiased font-sans bg-gray-100">

<div class="min-h-screen bg-gradient-to-br from-red-200 via-white to-amber-100 flex flex-col justify-center px-4 py-12 sm:px-6 lg:px-8">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-md transition-all duration-500">
        <!-- <div class="flex justify-center text-red-600 mb-2">
            <i class='bx bxs-lock-alt text-5xl'></i>
        </div> -->
        <h2 class="text-center text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
            Selamat Datang Kembali
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Silahkan masuk ke akun Anda
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-10 px-6 shadow-xl rounded-2xl sm:px-10 border border-gray-100">
            
            <form class="space-y-6" action="/login-form" method="POST">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700">
                        Username
                    </label>
                    <div class="mt-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class='bx bxs-user'></i>
                        </div>
                        <input id="username" name="username" type="text" required placeholder="username anda" 
                            class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 sm:text-sm transition duration-200">
                    </div>
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        Kata Sandi
                    </label>
                    <div class="mt-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class='bx bxs-key'></i>
                        </div>
                        <input id="password" name="password" :type="show ? 'text' : 'password'" autocomplete="current-password" placeholder="••••••••" required 
                            class="appearance-none block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 sm:text-sm transition duration-200">
                        
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" @click="show = !show" class="text-gray-400 hover:text-red-500 focus:outline-none">
                                <i class='bx' :class="show ? 'bx-show' : 'bx-hide'"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer">Ingat saya</label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-red-600 hover:text-red-500">Lupa password?</a>
                    </div>
                </div> -->

                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-md hover:shadow-lg transition-all duration-300 active:scale-95">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3 text-red-300 group-hover:text-white transition duration-200">
                            <i class='bx bx-log-in-circle text-lg'></i>
                        </span>
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-8 border-t border-gray-100 pt-6">
                <div class="text-center text-xs text-gray-400 uppercase tracking-widest">
                    Project Skripsi &copy; 2025
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>