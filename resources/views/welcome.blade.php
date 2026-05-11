<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <div x-data="{ open: false }" class="relative flex items-center">
                            <button @click="open = !open" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                Categories
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute top-full mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50">
                                @foreach($categories as $category)
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $category->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
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

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8 text-center">Our Products</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    @if($product->image && count($product->image) > 0)
                        <img src="{{ asset('storage/'.$product->image[0]) }}" class="w-full h-48 object-cover rounded-md mb-4">
                    @endif
                    <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-600 mb-2">${{ $product->price1 }}</p>
                    <button class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Add to Cart</button>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
