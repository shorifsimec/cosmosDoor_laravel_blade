@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="bg-white p-6 rounded shadow">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Users</h2>
    <a href="{{ route('customers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add User</a>
  </div>
  <p class="text-gray-600">This is the users list page.</p>
</div>
@endsection