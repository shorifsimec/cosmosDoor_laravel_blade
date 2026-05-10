@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="bg-white p-6 rounded shadow">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Users</h2>
    <a href="{{ route('customers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add User</a>
  </div>

  @if ($customers->isEmpty())
    <p class="text-gray-600">No customers found.</p>
  @else
    <table class="min-w-full divide-y divide-gray-200">
      <thead>
        <tr>
          <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Name
          </th>
          <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Email
          </th>
          <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Actions
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($customers as $customer)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
              {{ $customer->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ $customer->email }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
              {{-- Add delete functionality later --}}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>
@endsection