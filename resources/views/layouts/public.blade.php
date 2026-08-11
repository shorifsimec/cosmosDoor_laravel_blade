<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Home</a>
                    <a href="{{ route('about') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">About</a>
                    <div x-data="{ open: false }" class="relative flex items-center">
                        <button @click="open = !open" class="text-sm font-medium text-gray-700 hover:text-gray-900 focus:outline-none">
                            Categories
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute top-full mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
                            @foreach($categories ?? [] as $categoryItem)
                                <a href="{{ route('home.category', $categoryItem->name) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $categoryItem->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    <a href="{{ route('cart.index') }}" class="text-sm text-gray-700 underline mr-4">Cart</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
