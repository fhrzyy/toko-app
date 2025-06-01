<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Rozi</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome via CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Sidebar Styling */
        .sidebar {
            transition: all 0.3s ease-in-out;
            width: 16rem;
            z-index: 50;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
        }

        /* Custom Scrollbar for Webkit browsers */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Sidebar Item Styling */
        .sidebar-item {
            transition: all 0.2s ease-in-out;
            position: relative;
            border-radius: 0.5rem;
            font-size: 0.95rem;
        }

        /* Hover Effect for Sidebar Items */
        .sidebar-item:hover {
            transform: translateX(5px);
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
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

        /* Override Tailwind Hover */
        .sidebar-item.active:hover:bg-blue-700 {
            background-color: rgb(0, 78, 245) !important;
        }
    </style>
</head>
<body class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <nav class="sidebar bg-gradient-to-b from-blue-600 to-blue-800 text-white w-64 space-y-6 py-7 px-2 fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out shadow-xl">
        <!-- Brand Logo -->
        <div class="text-white flex items-center space-x-2 px-4 mb-10">
            <i class="fas fa-store text-2xl"></i>
            <span class="text-2xl font-extrabold">Toko Rozi</span>
        </div>

        <!-- Nav Items -->
        <div class="space-y-2">
            @auth
                <a href="{{ url('/dashboard') }}" class="sidebar-item {{ request()->is('dashboard') || request()->is('/') ? 'active' : '' }} flex items-center space-x-2 py-3 px-4 rounded-lg hover:bg-blue-700 hover:bg-opacity-50">
                    <i class="fas fa-tachometer-alt w-6 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Pembatas untuk Dashboard -->
                <div class="border-t border-blue-500 my-4"></div>

                <a href="{{ url('/barang') }}" class="sidebar-item {{ request()->is('barang') ? 'active' : '' }} flex items-center space-x-2 py-3 px-4 rounded-lg hover:bg-blue-700 hover:bg-opacity-50">
                    <i class="fas fa-box-open w-6 text-center"></i>
                    <span>Barang</span>
                </a>
                <a href="{{ url('/kategori') }}" class="sidebar-item {{ request()->is('kategori') ? 'active' : '' }} flex items-center space-x-2 py-3 px-4 rounded-lg hover:bg-blue-700 hover:bg-opacity-50">
                    <i class="fas fa-tags w-6 text-center"></i>
                    <span>Kategori Barang</span>
                </a>
                <a href="{{ url('/supplier') }}" class="sidebar-item {{ request()->is('supplier') ? 'active' : '' }} flex items-center space-x-2 py-3 px-4 rounded-lg hover:bg-blue-700 hover:bg-opacity-50">
                    <i class="fas fa-truck w-6 text-center"></i>
                    <span>Supplier</span>
                </a>
                <a href="{{ url('/pembeli') }}" class="sidebar-item {{ request()->is('pembeli') ? 'active' : '' }} flex items-center space-x-2 py-3 px-4 rounded-lg hover:bg-blue-700 hover:bg-opacity-50">
                    <i class="fas fa-users w-presso w-6 text-center"></i>
                    <span>Pembeli</span>
                </a>

                <!-- Pembatas untuk Transaksi -->
                <div class="border-t border-blue-500 my-4"></div>

                <a href="{{ url('/pembelian') }}" class="sidebar-item {{ request()->is('pembelian') ? 'active' : '' }} flex items-center space-x-2 py-3 px-4 rounded-lg hover:bg-blue-700 hover:bg-opacity-50">
                    <i class="fas fa-shopping-cart w-6 text-center"></i>
                    <span>Pembelian</span>
                </a>
                <a href="{{ url('/penjualan') }}" class="sidebar-item {{ request()->is('penjualan') ? 'active' : '' }} flex items-center space-x-2 py-3 px-4 rounded-lg hover:bg-blue-700 hover:bg-opacity-50">
                    <i class="fas fa-cash-register w-6 text-center"></i>
                    <span>Penjualan</span>
                </a>

                <!-- Pembatas untuk Laporan -->
                <div class="border-t border-blue-500 my-4"></div>

                <a href="{{ url('/laporan-penjualan') }}" class="sidebar-item {{ request()->is('laporan-penjualan') ? 'active' : '' }} flex items-center space-x-2 py-3 px-4 rounded-lg hover:bg-blue-700 hover:bg-opacity-50">
                    <i class="fas fa-file-alt w-6 text-center"></i>
                    <span>Laporan Penjualan</span>
                </a>

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="sidebar-item {{ request()->is('logout') ? 'active' : '' }} flex items-center space-x-2 py-3 px-4 rounded-lg hover:bg-blue-700 hover:bg-opacity-50 text-red-200 hover:text-red-100">
                    <i class="fas fa-sign-out-alt w-6 text-center"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="sidebar-item {{ request()->is('login') ? 'active' : '' }} flex items-center space-x-2 py-3 px-4 rounded-lg hover:bg-blue-700 hover:bg-opacity-50">
                    <i class="fas fa-sign-in-alt w-6 text-center"></i>
                    <span>Login</span>
                </a>
                <a href="{{ route('register') }}" class="sidebar-item {{ request()->is('register') ? 'active' : '' }} flex items-center space-x-2 py-3 px-4 rounded-lg hover:bg-blue-700 hover:bg-opacity-50">
                    <i class="fas fa-user-plus w-6 text-center"></i>
                    <span>Register</span>
                </a>
            @endauth
        </div>

        <!-- Mobile Toggle Button (hidden on desktop) -->
        <button class="md:hidden absolute top-4 right-4 text-white" onclick="toggleSidebar()">
            <i class="fas fa-times text-xl"></i>
        </button>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden md:ml-64">
        <!-- Mobile Header -->
        <header class="md:hidden bg-blue-600 text-white p-4 flex justify-between items-center">
            <button onclick="toggleSidebar()" class="text-white focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <span class="text-xl font-bold">Toko Rozi</span>
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