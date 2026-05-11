<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(empty($cart))
            <p>Your cart is empty.</p>
            <a href="{{ route('home') }}" class="text-blue-500 underline">Continue Shopping</a>
        @else
            @php $grandTotal = 0; @endphp
            <table class="w-full bg-white rounded shadow p-4">
                <thead>
                    <tr>
                        <th class="text-left p-2">Product</th>
                        <th class="text-left p-2">Price</th>
                        <th class="text-left p-2">Quantity</th>
                        <th class="text-left p-2">Subtotal</th>
                        <th class="text-left p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        @php 
                            $subtotal = $item['price'] * $item['quantity'];
                            $grandTotal += $subtotal;
                        @endphp
                        <tr>
                            <td class="p-2">{{ $item['name'] }}</td>
                            <td class="p-2">${{ $item['price'] }}</td>
                            <td class="p-2">
                                <form action="{{ route('cart.update', $id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 border rounded p-1">
                                    <button type="submit" class="text-blue-500 ml-2">Update</button>
                                </form>
                            </td>
                            <td class="p-2">${{ $subtotal }}</td>
                            <td class="p-2">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-6 flex justify-end">
                <h2 class="text-xl font-bold">Grand Total: ${{ $grandTotal }}</h2>
            </div>
            <div class="mt-4 flex space-x-4">
                <a href="{{ route('home') }}" class="text-blue-500 underline">Continue Shopping</a>
                <a href="{{ route('checkout.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Checkout</a>
            </div>
        @endif
    </div>
</body>
</html>
