@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Product Details: {{ $product->name }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-auto rounded shadow-sm">
            @else
                <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500 rounded">No Image</div>
            @endif
        </div>
        <div>
            <p class="text-gray-600 mb-2"><strong>Category:</strong> {{ $product->category->name }}</p>
            <p class="text-gray-600 mb-2"><strong>Brand:</strong> {{ $product->brand->name }}</p>
            <p class="text-gray-600 mb-2"><strong>Price 1:</strong> ${{ $product->price1 }}</p>
            @if($product->price2)
                <p class="text-gray-600 mb-2"><strong>Price 2:</strong> ${{ $product->price2 }}</p>
            @endif
            <p class="text-gray-600 mb-2"><strong>Quantity:</strong> {{ $product->quantity }}</p>
            <p class="text-gray-600 mb-2"><strong>Size:</strong> {{ $product->size ?? 'N/A' }}</p>
            <p class="text-gray-600 mb-2"><strong>Color:</strong> {{ $product->color ?? 'N/A' }}</p>
        </div>
        <div class="col-span-1 md:col-span-2">
            <h4 class="font-bold text-lg mb-2">Description</h4>
            <p class="text-gray-700">{{ $product->description }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to Products</a>
    </div>
</div>
@endsection
