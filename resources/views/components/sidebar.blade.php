<div x-data="{ open: false }" class="min-h-screen bg-gray-100">

    <!-- SIDEBAR -->
    <aside 
        class="w-64 bg-gray-800 text-gray-300 flex flex-col 
               fixed inset-y-0 left-0
               transform transition-transform duration-200 ease-in-out
               z-60
               lg:translate-x-0"
        :class="open ? 'translate-x-0' : '-translate-x-full'">

        <!-- Logo -->
        <div class="flex items-center h-16 px-4 border-b border-gray-700">
            <a href="/" class="flex items-center space-x-2">
                <img src="{{ asset('assets/icons/Santosa.png') }}" class="h-8" alt="Logo" />
                <!--<span class="text-white font-bold text-xl tracking-tight">IT SHBK</span>-->
            </a>
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-4 py-4 space-y-1">
        <div class="flex items-center h-8 px-4 border-b border-gray-700">
            <strong><h2>Santosacare</h2></strong>
        </div>
            <a href="/updatesep" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-white">Update SEP</a>
            <a href="/elementdetail" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-white">Element Detail</a><br>
        <div class="flex items-center h-8 px-4 border-b border-gray-700">
            <strong><h2>Farmasi</h2></strong>
        </div>
            <a href="/updatesep" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-white">Pembatalan Cancel (Inprogress)</a><br>
        <div class="flex items-center h-8 px-4 border-b border-gray-700">
            <strong><h2>Logistic 2017</h2></strong>
        </div>
            <a href="/mutasilogistik" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-white">Mutasi</a>
            <a href="/rologistik" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-white">Receive Order</a>
            <a href="/purchasinglogistik" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-white">Purchasing Order</a>
        </nav>
    </aside>

    <!-- OVERLAY -->
    <div 
        class="fixed inset-0 bg-black bg-opacity-50 lg:hidden z-51"
        x-show="open"
        x-transition.opacity
        x-on:click="open = false">
    </div>

    <!-- CONTENT -->
    <div class="flex-1 flex flex-col min-h-screen lg:ml-64">

        <!-- TOPBAR MOBILE -->
        <div class="bg-white shadow-sm flex items-center h-14 px-4 lg:hidden">
            <button class="text-gray-700" @@click="open = true">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="ml-3 text-xl font-semibold">Menu</span>
        </div>

        <!-- HEADER -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    @yield('header')
                </h1>
            </div>
        </header>


        <!-- PAGE CONTENT -->
        <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

</div>
