<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Store</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome via CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom Font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Sidebar Styling */
        .sidebar {
            transition: all 0.3s ease-in-out;
            width: 16rem;
            z-index: 50;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
            background:rgb(255, 255, 255);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }

        /* Custom Scrollbar for Webkit browsers */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 2px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.25);
        }

        /* Sidebar Item Styling */
        .sidebar-item {
            transition: all 0.2s ease-in-out;
            position: relative;
            border-radius: 0.375rem;
            font-size: 0.95rem;
            font-weight: 400;
            margin-bottom: 2px;
            letter-spacing: 0.2px;
            color: #4b5563;
        }

        /* Hover Effect for Sidebar Items */
        .sidebar-item:hover {
            transform: translateX(4px);
            background-color: rgba(0, 0, 0, 0.04);
        }

        /* Styling untuk menu aktif */
        .sidebar-item.active {
            background-color: rgb(62, 107, 206) !important;
            color: white !important;
            font-weight: 600 !important;
            border-radius: 0.5rem !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.2s ease-in-out !important;
        }

        .sidebar-item.active:hover {
            background-color: rgb(0, 78, 245) !important;
            transform: translateX(5px) !important;
        }

        /* Pastikan ikon pada menu aktif juga terlihat jelas */
        .sidebar-item.active i {
            color: white !important;
        }

        /* Logo styling */
        .logo-text {
            background: linear-gradient(to right,rgb(62, 107, 206),rgb(62, 107, 206));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
        }

        /* Divider styling */
        .sidebar-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(0, 0, 0, 0.1), transparent);
            margin: 1rem 0;
        }

        /* Main content area */
        .main-content {
            background-color: #f8f9fa;
        }
        
        /* Logout button */
        .logout-button {
            color: #ff6b6b;
        }
        
        .logout-button:hover {
            color: #ff5252;
            background-color: rgba(255, 107, 107, 0.1) !important;
        }
        
        /* Category headings */
        .category-heading {
            color: #9ca3af;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        /* Icon styling */
        .sidebar-icon {
            color: #6b7280;
        }
    </style>
</head>
<body class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <nav class="sidebar w-64 space-y-6 py-7 px-2 fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out">
        <!-- Brand Logo -->
        <div class="flex items-center justify-center space-x-2 px-4 mb-8">
            <span class="text-2xl logo-text">Smart Store</span>
        </div>

        <!-- Nav Items -->
        <div class="space-y-1 px-3">
            @auth
                <a href="{{ url('/dashboard') }}" class="sidebar-item {{ request()->is('dashboard') || request()->is('/') ? 'active' : '' }} flex items-center space-x-3 py-3 px-4 rounded-md">
                    <i class="fas fa-tachometer-alt w-5 text-center sidebar-icon"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Pembatas untuk Dashboard -->
                <div class="sidebar-divider my-3"></div>

                <p class="category-heading ml-4 mb-2">Manajemen Data</p>
                
                <a href="{{ url('/barang') }}" class="sidebar-item {{ request()->is('barang') ? 'active' : '' }} flex items-center space-x-3 py-3 px-4 rounded-md">
                    <i class="fas fa-box-open w-5 text-center sidebar-icon"></i>
                    <span>Barang</span>
                </a>
                <a href="{{ url('/kategori') }}" class="sidebar-item {{ request()->is('kategori') ? 'active' : '' }} flex items-center space-x-3 py-3 px-4 rounded-md">
                    <i class="fas fa-tags w-5 text-center sidebar-icon"></i>
                    <span>Kategori Barang</span>
                </a>
                <a href="{{ url('/supplier') }}" class="sidebar-item {{ request()->is('supplier') ? 'active' : '' }} flex items-center space-x-3 py-3 px-4 rounded-md">
                    <i class="fas fa-truck w-5 text-center sidebar-icon"></i>
                    <span>Supplier</span>
                </a>
                <a href="{{ url('/pembeli') }}" class="sidebar-item {{ request()->is('pembeli') ? 'active' : '' }} flex items-center space-x-3 py-3 px-4 rounded-md">
                    <i class="fas fa-users w-5 text-center sidebar-icon"></i>
                    <span>Pembeli</span>
                </a>

                <!-- Pembatas untuk Transaksi -->
                <div class="sidebar-divider my-3"></div>

                <p class="category-heading ml-4 mb-2">Transaksi</p>
                
                <a href="{{ url('/pembelian') }}" class="sidebar-item {{ request()->is('pembelian') ? 'active' : '' }} flex items-center space-x-3 py-3 px-4 rounded-md">
                    <i class="fas fa-shopping-cart w-5 text-center sidebar-icon"></i>
                    <span>Pembelian</span>
                </a>
                <a href="{{ url('/penjualan') }}" class="sidebar-item {{ request()->is('penjualan') ? 'active' : '' }} flex items-center space-x-3 py-3 px-4 rounded-md">
                    <i class="fas fa-cash-register w-5 text-center sidebar-icon"></i>
                    <span>Penjualan</span>
                </a>

                <!-- Pembatas untuk Laporan -->
                <div class="sidebar-divider my-3"></div>

                <p class="category-heading ml-4 mb-2">Laporan</p>
                
                <a href="{{ url('/laporan-penjualan') }}" class="sidebar-item {{ request()->is('laporan-penjualan') ? 'active' : '' }} flex items-center space-x-3 py-3 px-4 rounded-md">
                    <i class="fas fa-file-alt w-5 text-center sidebar-icon"></i>
                    <span>Laporan Penjualan</span>
                </a>

                <div class="sidebar-divider my-3"></div>

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="logout-button sidebar-item {{ request()->is('logout') ? 'active' : '' }} flex items-center space-x-3 py-3 px-4 rounded-md">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="sidebar-item {{ request()->is('login') ? 'active' : '' }} flex items-center space-x-3 py-3 px-4 rounded-md">
                    <i class="fas fa-sign-in-alt w-5 text-center sidebar-icon"></i>
                    <span>Login</span>
                </a>
                <a href="{{ route('register') }}" class="sidebar-item {{ request()->is('register') ? 'active' : '' }} flex items-center space-x-3 py-3 px-4 rounded-md">
                    <i class="fas fa-user-plus w-5 text-center sidebar-icon"></i>
                    <span>Register</span>
                </a>
            @endauth
        </div>

        <!-- Mobile Toggle Button (hidden on desktop) -->
        <button class="md:hidden absolute top-4 right-4 text-gray-400 hover:text-gray-600" onclick="toggleSidebar()">
            <i class="fas fa-times text-xl"></i>
        </button>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden md:ml-64 main-content">
        <!-- Mobile Header -->
        <header class="md:hidden bg-white text-gray-800 p-4 flex justify-between items-center shadow-sm">
            <button onclick="toggleSidebar()" class="text-gray-500 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <span class="text-xl font-bold logo-text">Smart Store</span>
            <div class="w-6"></div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 bg-gray-50">
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
</body>
</html>