<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Smart Store</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome via CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .login-card {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.95));
            backdrop-filter: blur(8px);
        }
        .input-group {
            transition: all 0.3s ease;
        }
        .input-group:focus-within {
            transform: translateY(-2px);
        }
        .image-side {
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 1200" fill="none"%3E%3Crect width="800" height="1200" fill="%232563EB"%3E%3C/rect%3E%3Cpath d="M0 0L800 0L800 1200L0 1200L0 0Z" fill="url(%23paint0_linear)"%3E%3C/path%3E%3Cdefs%3E%3ClinearGradient id="paint0_linear" x1="400" y1="0" x2="400" y2="1200" gradientUnits="userSpaceOnUse"%3E%3Cstop stop-color="%234F46E5" stop-opacity="0.8"%3E%3C/stop%3E%3Cstop offset="0.5" stop-color="%232563EB" stop-opacity="0.9"%3E%3C/stop%3E%3Cstop offset="1" stop-color="%231E40AF"%3E%3C/stop%3E%3C/linearGradient%3E%3C/defs%3E%3Ccircle cx="650" cy="200" r="150" fill="%238B5CF6" opacity="0.2"%3E%3C/circle%3E%3Ccircle cx="150" cy="400" r="100" fill="%233B82F6" opacity="0.3"%3E%3C/circle%3E%3Ccircle cx="400" cy="900" r="200" fill="%236366F1" opacity="0.4"%3E%3C/circle%3E%3C/svg%3E');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .image-side::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.6) 0%, rgba(37, 99, 235, 0.7) 100%);
            backdrop-filter: blur(2px);
        }
        .store-icon {
            height: 90px;
            width: 90px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 40px;
            color: white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column-reverse;
            }
            .image-side {
                height: 200px;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="login-container max-w-5xl w-full flex rounded-2xl overflow-hidden shadow-2xl">
        <!-- Form Side -->
        <div class="login-card w-full md:w-1/2 p-0">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-center text-white">
                <i class="fa-solid fa-cart-shopping text-4xl mb-3"></i>
                <!-- fa-solid fa-cart-shopping -->
                <h1 class="text-3xl font-bold">Smart Store</h1>
                <p class="opacity-90">silahkan login terlebih dahulu</p>
            </div>
            
            <!-- Form Container -->
            <div class="p-8">
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <strong class="font-bold">Oops! </strong>
                            <span class="block sm:inline ml-1">There were some problems with your input.</span>
                        </div>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Username Field -->
                    <div class="input-group">
                        <label for="username" class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus 
                                class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 @error('username') border-red-500 @enderror" 
                                placeholder="Enter your username">
                        </div>
                        @error('username')
                            <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="input-group">
                        <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" type="password" name="password" required 
                                class="pl-10 w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 @error('password') border-red-500 @enderror" 
                                placeholder="Enter your password">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword()">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs italic mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-600">Remember me</label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-3 px-4 rounded-lg font-medium hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 flex items-center justify-center">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </button>
                    </div>
                </form>

                <!-- Footer / Register Link -->
                <!-- <div class="mt-6 text-center text-sm text-gray-600">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500 font-medium">Create one</a></p>
                </div> -->
            </div>
        </div>
        
        <!-- Image Side -->
        <div class="image-side hidden md:block w-1/2 relative overflow-hidden">
    <!-- Ganti URL_GAMBAR_ANDA dengan URL gambar yang Anda inginkan -->
    <img src="https://reti.edu.my/wp-content/uploads/2021/04/17.jpg" alt="Store Image" class="absolute inset-0 w-full h-full object-cover">
    
    <!-- Overlay untuk memastikan teks dapat terbaca dengan baik -->
    <div class="absolute inset-0 bg-gradient-to-r from-blue-900/70 to-indigo-900/70"></div>
    
    <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-8 z-10">
        <div class="store-icon mb-8">
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
        <h2 class="text-4xl font-bold mb-4 text-center">Smart Store</h2>
        <p class="text-xl opacity-90 text-center mb-8">Sistem Manajemen Toko Modern</p>
        <div class="w-20 h-1 bg-white opacity-50 mb-8"></div>
        <p class="text-center opacity-80 max-w-md">Login untuk mengakses sistem manajemen inventori, penjualan, dan laporan bisnis Anda.</p>
    </div>
</div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>