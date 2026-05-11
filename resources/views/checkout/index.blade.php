<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8">Checkout</h1>
        <form action="{{ route('checkout.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block">Name</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block">Mobile</label>
                    <input type="text" name="mobile" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block">Email</label>
                    <input type="email" name="email" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block">Address</label>
                    <textarea name="address" class="w-full border p-2 rounded" required></textarea>
                </div>
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Place Order</button>
            </div>
        </form>
    </div>
</body>
</html>
