<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Order List</h2>
    <table>
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Total Price</th>
                <th>Products</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>₹{{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <ul>
                            @foreach ($order->items as $item)
                                <li>{{ $item->product->name }} ({{ $item->quantity }}x) - ₹{{ number_format($item->price_at_purchase, 2) }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
