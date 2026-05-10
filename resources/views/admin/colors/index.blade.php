@extends('layouts.app')

@section('title', 'Colors')

@section('content')
<div class="bg-white p-6 rounded shadow mb-4" x-data="{ open: false }">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Colors</h2>
        <button @click="open = !open" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Add Color
        </button>
    </div>

    {{-- Session Status --}}
    @if (session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition class="mb-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    </div>
    @endif

    {{-- Collapsible Form --}}
    <div x-show="open" @click.outside="open = false" x-transition class="mt-4 p-4 border rounded">
        <h3 class="text-lg font-semibold mb-2">Create New Color</h3>
        <form action="{{ route('colors.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Color Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required placeholder="e.g. Royal Blue">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="code" class="block text-sm font-medium text-gray-700">Color Selection</label>
                    <div class="flex items-center space-x-2">
                        <input type="color" name="code" id="code" class="h-10 w-20 rounded border-gray-300" value="#000000">
                        <span class="text-gray-500 text-sm">Choose color from picker</span>
                    </div>
                    @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save Color</button>
        </form>
    </div>

    {{-- Colors Table List --}}
    <div class="mt-8">
        <h3 class="text-xl font-bold mb-4">Existing Colors</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hex Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($colors as $color)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $color->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-8 h-8 rounded-full border shadow-sm" style="background-color: {{ $color->code }}"></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $color->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-sm">{{ $color->code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <form action="{{ route('colors.destroy', $color) }}" method="POST" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this color?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No colors found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
