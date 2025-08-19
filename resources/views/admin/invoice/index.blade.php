<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        h2 {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <h2>Invoice #{{ $order->id }}</h2>
    <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

    <h3>Customer Information</h3>
    <p><strong>Name:</strong> {{ $order->customer_name }}</p>
    <p><strong>Phone:</strong> {{ $order->phone }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>

    <h3>Order Items</h3>
    <table>
        <thead>
            <tr>
                <th>Food</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->food->name ?? 'N/A' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align: right; margin-top: 20px;">
        Total: ${{ number_format($order->total_amount, 2) }}
    </h3>
</body>

</html>

