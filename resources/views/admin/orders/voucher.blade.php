<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Order Voucher #{{ $order->id }}</h1>
    <p>Customer: {{ $order->user->name ?? 'N/A' }}</p>
    <p>Date: {{ $order->created_at->format('Y-m-d') }}</p>
    <table>
        <thead>
            <tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr>
        </thead>
        <tbody>
            @foreach($products as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>${{ $item['price'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>${{ $item['price'] * $item['quantity'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Grand Total: ${{ $order->total_price }}</h3>
</body>
</html>
