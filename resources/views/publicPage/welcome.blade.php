@extends('layouts.public')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8 text-center">{{ $category ?? 'Our Products' }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    @if($product->image && count($product->image) > 0)
                        <img src="{{ asset('storage/'.$product->image[0]) }}" class="w-full h-48 object-cover rounded-md mb-4">
                    @endif
                    <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-600 mb-2"><span class="font-bold">৳</span> {{ $product->price1 }}</p>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Add to Cart</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
