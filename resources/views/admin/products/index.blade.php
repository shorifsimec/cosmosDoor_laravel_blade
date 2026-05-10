@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="bg-white p-6 rounded shadow" x-data="{ showForm: false }">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Products</h2>
        <button @click="showForm = !showForm" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            <span x-text="showForm ? 'Hide Form' : 'Add Product'"></span>
        </button>
    </div>

    {{-- Collapsible Add Product Form --}}
    <div x-show="showForm" x-cloak class="mb-8 p-4 border border-gray-200 rounded-lg bg-gray-50">
        <h3 class="text-lg font-semibold mb-4">Create New Product</h3>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="brand_id" class="block text-sm font-medium text-gray-700">Brand</label>
                    <select name="brand_id" id="brand_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
                </div>
                <div>
                    <label for="price1" class="block text-sm font-medium text-gray-700">Price 1</label>
                    <input type="number" step="0.01" name="price1" id="price1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>
                <div>
                    <label for="price2" class="block text-sm font-medium text-gray-700">Price 2 (Optional)</label>
                    <input type="number" step="0.01" name="price2" id="price2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>
                <div>
                    <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                    <input type="text" name="size" id="size" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                    <input type="text" name="color" id="color" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Product</button>
            </div>
        </form>
    </div>

    {{-- Product List --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Brand</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Size</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Color</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                <tr>
                    <td class="px-6 py-4">
                        @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="w-16 h-16 object-cover">
                        @else
                        <span class="text-gray-400">No image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $product->name }}</td>
                    <td class="px-6 py-4">{{ $product->category->name }}</td>
                    <td class="px-6 py-4">{{ $product->brand->name }}</td>
                    <td class="px-6 py-4">{{ $product->price1 }}</td>
                    <td class="px-6 py-4">{{ $product->quantity }}</td>
                    <td class="px-6 py-4 w-[40px] text-justify" x-data="{ expanded: false }">
                        <div x-show="!expanded" class="text-sm text-gray-900">
                            {{ \Illuminate\Support\Str::words($product->description, 5, '...') }}
                        </div>
                        <div x-show="expanded" x-cloak class="text-sm text-gray-900">
                            {{ $product->description }}
                        </div>
                        @if(\Illuminate\Support\Str::wordCount($product->description) > 5)
                        <button @click="expanded = !expanded" class="text-blue-500 hover:text-blue-700 text-xs font-semibold focus:outline-none mt-1" x-text="expanded ? 'Show Less' : 'More'"></button>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $product->size }}</td>
                    <td class="px-6 py-4">{{ $product->color }}</td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{ route('products.show', $product->id) }}" class="text-green-600 hover:text-green-900">Details</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection