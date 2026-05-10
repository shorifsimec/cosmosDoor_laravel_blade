@extends('layouts.app')

@section('title', 'Brands')

@section('content')
<div class="bg-white p-6 rounded shadow mb-4" x-data="{ 
    open: false, 
    editingBrand: null,
    editBrand(brand) {
        this.editingBrand = brand;
        this.open = false;
    }
}">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Brands</h2>
    <button @click="open = !open" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
      Add Brand
    </button>
  </div>

  {{-- Session Status --}}
  @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
      <span class="block sm:inline">{{ session('success') }}</span>
    </div>
  @endif

  {{-- Collapsible Form --}}
  <div x-show="open" @click.outside="open = false" x-transition.duration.300ms class="mt-4 p-4 border rounded">
      <h3 class="text-lg font-semibold mb-2">Create New Brand</h3>
      <form action="{{ route('brands.store') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700">Brand Name</label>
          <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
          @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Brand</button>
      </form>
    </div>

  {{-- Brands Table List --}}
  <div class="mt-8">
    <h3 class="text-xl font-bold mb-4">Existing Brands</h3>
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($brands as $brand)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">{{ $brand->id }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $brand->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <button @click="editBrand({{ json_encode($brand) }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900 ml-2" onclick="return confirm('Are you sure you want to delete this brand?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">No brands found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Edit Modal --}}
  <div x-show="editingBrand !== null" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4">
      <div class="fixed inset-0 bg-gray-500 opacity-75" @click="editingBrand = null"></div>
      <div class="bg-white rounded-lg p-6 w-full max-w-lg z-10">
        <h3 class="text-lg font-semibold mb-4">Edit Brand</h3>
        <form x-bind:action="'/admin/brands/' + (editingBrand ? editingBrand.id : '')" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-4">
            <label for="edit_name" class="block text-sm font-medium text-gray-700">Brand Name</label>
            <input type="text" name="name" id="edit_name" x-model="editingBrand ? editingBrand.name : ''" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
          </div>
          <div class="flex justify-end">
            <button type="button" @click="editingBrand = null" class="bg-gray-300 text-gray-700 px-4 py-2 rounded mr-2">Cancel</button>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Brand</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
