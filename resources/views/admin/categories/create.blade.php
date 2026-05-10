@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="bg-white p-6 rounded shadow">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Categories</h2>
    <!-- <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Category</a> -->
  </div>
  <p class="text-gray-600">This is the categories Form.</p>
</div>
@endsection