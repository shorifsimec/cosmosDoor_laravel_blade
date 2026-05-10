<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: window.innerWidth > 1024 }">

    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen && window.innerWidth < 1024"
        @click="sidebarOpen = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden">
    </div>

    @include('partials.sidebar')

    <div :class="{
	'lg:ml-64': sidebarOpen,
	'lg:ml-20': !sidebarOpen,
	'ml-0': true
}"
        class="min-h-screen flex flex-col transition-all duration-300">

        @include('partials.navbar')

        <main class="p-6 flex-1">
            @yield('content')
        </main>

    </div>

</body>

</html>