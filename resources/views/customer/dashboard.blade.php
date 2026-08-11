@extends('layouts.customer')

@section('title', 'My Orders')

@section('content')
<div class="bg-white p-6 rounded shadow overflow-x-auto">
    <h1 class="text-3xl font-bold mb-8">My Orders</h1>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order #</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date/Time</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($orders as $order)
                <tr>
                    <td class="px-6 py-4">{{ $order->id }}</td>
                    <td class="px-6 py-4">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-6 py-4"><span class="font-bold">৳</span> {{ $order->total_price }}</td>
                    <td class="px-6 py-4 capitalize">{{ $order->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
