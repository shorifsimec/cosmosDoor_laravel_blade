<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Customer Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body
    class="bg-gray-100 overflow-x-hidden"
    x-data="{
        sidebarOpen: window.innerWidth >= 1024
    }"
    x-init="
        window.addEventListener('resize', () => {
            sidebarOpen = window.innerWidth >= 1024
        })
    ">

    {{-- Mobile Overlay --}}
    <div
        x-cloak
        x-show="sidebarOpen && window.innerWidth < 1024"
        @click="sidebarOpen = false"
        x-transition.opacity
        class="fixed inset-0 bg-black/50 z-40 lg:hidden">
    </div>

    {{-- Customer Sidebar --}}
    @include('partials.customer-sidebar')

    {{-- Main Wrapper --}}
    <div
        x-cloak
        class="min-h-screen flex flex-col transition-[margin] duration-300 ease-in-out"
        :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'">

        {{-- Navbar --}}
        @include('partials.navbar')

        {{-- Main Content --}}
        <main class="flex-1 p-6 overflow-x-hidden">
            @yield('content')
        </main>

    </div>

</body>

</html>