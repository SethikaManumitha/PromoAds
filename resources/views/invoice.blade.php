<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Shopping Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td>{{ $item['promotion']->name }}</td>
                <td>LKR {{ number_format($item['promotion']->dis_price, 2) }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>LKR {{ number_format($item['promotion']->dis_price * $item['quantity'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total Price: </strong>LKR. @php
        $total = 0;
        foreach ($cartItems as $item) {
        $total += $item['promotion']->dis_price * $item['quantity'];
        }
        echo number_format($total, 2); @endphp</p>
</body>

</html>