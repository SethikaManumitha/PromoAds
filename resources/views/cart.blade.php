<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <!-- Add Bootstrap 4 CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .cart-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1 {
            color: #28a745;
            /* Green color */
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            margin-top: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .btn-submit {
            background-color: #28a745;
            /* Green button color */
            color: white;
        }

        .btn-submit:hover {
            background-color: #218838;
            /* Darker green */
            color: white;
        }

        .total-amount {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .empty-message {
            font-size: 1.2rem;
            color: #dc3545;
            /* Red color for empty message */
            text-align: center;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="cart-container">
            <h1>Your Cart</h1>

            @if (empty($cart) || (is_array($cart) && count($cart) === 0) || ($cart instanceof \Illuminate\Support\Collection && $cart->isEmpty()))
            <p class="empty-message">Your cart is empty!</p>
            @else
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $cartItem)
                    <tr>
                        <td>{{ $cartItem->promotion->name ?? $cartItem['name'] }}</td>
                        <td>{{ number_format($cartItem->promotion->price ?? $cartItem['price'], 2) }}</td>
                        <td>{{ $cartItem->quantity ?? $cartItem['quantity'] }}</td>
                        <td>{{ number_format(($cartItem->promotion->price ?? $cartItem['price']) * ($cartItem->quantity ?? $cartItem['quantity']), 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <hr>

            <div class="total-amount">
                Total Amount:
                @php
                $totalAmount = 0;
                foreach ($cart as $cartItem) {
                $totalAmount += ($cartItem->promotion->price ?? $cartItem['price']) * ($cartItem->quantity ?? $cartItem['quantity']);
                }
                @endphp
                ${{ number_format($totalAmount, 2) }}
            </div>

            <div class="text-center mt-4">
                <button class="btn btn-submit">Proceed to Checkout</button>
            </div>
            @endif
        </div>
    </div>

    <!-- Add Bootstrap 4 JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>