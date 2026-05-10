@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Product: {{ $product->name }}</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="brand_id" class="block text-sm font-medium text-gray-700">Brand</label>
                <select name="brand_id" id="brand_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" id="name" value="{{ $product->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div x-data="{ 
                newImages: [],
                previewImages(event) {
                    this.newImages = [];
                    const files = event.target.files;
                    for (let i = 0; i < files.length; i++) {
                        this.newImages.push(URL.createObjectURL(files[i]));
                    }
                }
            }">
                <label for="images" class="block text-sm font-medium text-gray-700">Images (Add More)</label>
                <input type="file" name="images[]" id="images" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" multiple @change="previewImages">
                
                {{-- New Images Preview --}}
                <template x-if="newImages.length > 0">
                    <div class="mt-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase">New Selections:</span>
                        <div class="flex flex-wrap gap-2 mt-1">
                            <template x-for="(image, index) in newImages" :key="index">
                                <img :src="image" class="w-16 h-16 object-cover rounded border shadow-sm">
                            </template>
                        </div>
                    </div>
                </template>

                {{-- Existing Images --}}
                @if($product->image && count($product->image) > 0)
                    <div class="mt-4">
                        <span class="text-xs font-semibold text-gray-500 uppercase">Current Images:</span>
                        <div class="flex flex-wrap gap-2 mt-1">
                            @foreach($product->image as $img)
                                <img src="{{ asset('storage/'.$img) }}" class="w-16 h-16 object-cover rounded border opacity-75">
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">{{ $product->description }}</textarea>
            </div>
            <div>
                <label for="price1" class="block text-sm font-medium text-gray-700">Price 1</label>
                <input type="number" step="0.01" name="price1" id="price1" value="{{ $product->price1 }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div>
                <label for="price2" class="block text-sm font-medium text-gray-700">Price 2 (Optional)</label>
                <input type="number" step="0.01" name="price2" id="price2" value="{{ $product->price2 }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div>
                <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                <input type="text" name="size" id="size" value="{{ $product->size }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
            </div>
            <div>
                <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Colors</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 border rounded-md p-3 bg-white max-h-40 overflow-y-auto">
                    @php $selectedColors = is_array($product->color) ? $product->color : []; @endphp
                    @foreach($colors as $color)
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-1 rounded transition-colors">
                        <input type="checkbox" name="color[]" value="{{ $color->code }}" 
                            class="rounded text-blue-600 focus:ring-blue-500"
                            {{ in_array($color->code, $selectedColors) ? 'checked' : '' }}>
                        <div class="w-4 h-4 rounded-full border shadow-sm" style="background-color: {{ $color->code }}"></div>
                        <span class="text-sm text-gray-700">{{ $color->name }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Product</button>
            <a href="{{ route('products.index') }}" class="text-gray-600 ml-4">Cancel</a>
        </div>
    </form>
</div>
@endsection
