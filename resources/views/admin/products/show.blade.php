@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="bg-white p-6 rounded shadow" x-data="{ activeImage: '{{ $product->image && count($product->image) > 0 ? asset('storage/'.$product->image[0]) : '' }}' }">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Product Details: {{ $product->name }}</h2>
        <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to Products</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Image Gallery --}}
        <div>
            @if($product->image && count($product->image) > 0)
                <div class="mb-4">
                    <img :src="activeImage" class="w-full h-[400px] object-cover rounded-lg shadow-md transition-all duration-300">
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($product->image as $img)
                        <div 
                            @click="activeImage = '{{ asset('storage/'.$img) }}'"
                            class="cursor-pointer border-2 rounded-md overflow-hidden hover:border-blue-500 transition-colors"
                            :class="activeImage === '{{ asset('storage/'.$img) }}' ? 'border-blue-500' : 'border-transparent'"
                        >
                            <img src="{{ asset('storage/'.$img) }}" class="w-20 h-20 object-cover">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="w-full h-64 bg-gray-100 flex items-center justify-center text-gray-400 rounded-lg border-2 border-dashed">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="mt-2 block text-sm">No Images Available</span>
                    </div>
                </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div class="space-y-4">
            <div class="border-b pb-4">
                <h3 class="text-lg font-semibold text-gray-900">General Information</h3>
                <div class="mt-2 grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-sm text-gray-500 uppercase font-bold">Category</span>
                        <p class="text-gray-900">{{ $product->category->name }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500 uppercase font-bold">Brand</span>
                        <p class="text-gray-900">{{ $product->brand->name }}</p>
                    </div>
                </div>
            </div>

            <div class="border-b pb-4">
                <h3 class="text-lg font-semibold text-gray-900">Pricing & Stock</h3>
                <div class="mt-2 grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-sm text-gray-500 uppercase font-bold">Primary Price</span>
                        <p class="text-2xl font-bold text-green-600">${{ number_format($product->price1, 2) }}</p>
                    </div>
                    @if($product->price2)
                    <div>
                        <span class="text-sm text-gray-500 uppercase font-bold">Secondary Price</span>
                        <p class="text-xl text-gray-400 line-through">${{ number_format($product->price2, 2) }}</p>
                    </div>
                    @endif
                    <div>
                        <span class="text-sm text-gray-500 uppercase font-bold">Stock Quantity</span>
                        <p class="text-gray-900">{{ $product->quantity }} units</p>
                    </div>
                </div>
            </div>

            <div class="border-b pb-4">
                <h3 class="text-lg font-semibold text-gray-900">Specifications</h3>
                <div class="mt-2 grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-sm text-gray-500 uppercase font-bold">Size</span>
                        <p class="text-gray-900">{{ $product->size ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500 uppercase font-bold">Color</span>
                        <p class="text-gray-900">{{ $product->color ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-900">Description</h3>
                <p class="mt-2 text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $product->description }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
