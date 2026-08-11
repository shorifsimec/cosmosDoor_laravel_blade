@extends('layouts.public')

@section('title', $product->name)

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="bg-white p-6 rounded-lg shadow-md">
                @if($product->image && count($product->image) > 0)
                    <img src="{{ asset('storage/'.$product->image[0]) }}" class="w-full h-96 object-cover rounded-md">
                @else
                    <div class="w-full h-96 bg-gray-100 rounded-md flex items-center justify-center text-gray-500">No image available</div>
                @endif
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                <div class="mb-4">
                    <span class="text-2xl font-semibold">৳ {{ $product->price1 }}</span>
                    @if($product->price2)
                        <span class="text-sm text-gray-500 line-through ml-3">৳ {{ $product->price2 }}</span>
                    @endif
                </div>
                <div class="mb-4 text-sm text-gray-500">
                    <p><strong>Category:</strong> {{ $product->category?->name ?? 'N/A' }}</p>
                    <p><strong>Brand:</strong> {{ $product->brand?->name ?? 'N/A' }}</p>
                    <p><strong>Stock:</strong> {{ $product->quantity ?? '0' }}</p>
                </div>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 transition">Add to Cart</button>
                </form>
                <a href="{{ route('home') }}" class="inline-block mt-4 text-sm text-gray-600 hover:text-gray-900">← Back to products</a>
            </div>
        </div>
    </div>
@endsection
