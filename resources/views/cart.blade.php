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
            text-align: center;
            margin-bottom: 20px;
        }

        .total-amount {
            font-size: 1.25rem;
            font-weight: bold;
            text-align: right;
        }

        .btn-submit {
            background-color: #28a745;
            color: white;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        .btn-add-items {
            background-color: #007bff;
            color: white;
        }

        .btn-add-items:hover {
            background-color: #0056b3;
        }

        .empty-message {
            text-align: center;
            font-size: 1.2rem;
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="cart-container">
            <h1>Your Cart</h1>

            @if(count($cartItems) > 0)
            <ul class="list-group">
                @foreach ($cartItems as $item)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div class="item-details">
                            <p><strong>Product Name:</strong> {{ $item['promotion']->name }}</p>
                            <p><strong>Price:</strong> LKR.{{ $item['promotion']->price }}</p>
                            <p><strong>Quantity:</strong> {{ $item['quantity'] }}</p>
                            <p><strong>Discounted Price:</strong> LKR.{{ $item['promotion']->dis_price }}</p>
                        </div>
                        <div>
                            <img src="{{ $item['promotion']->image ? asset($item['promotion']->image) : 'https://placehold.co/200x200' }}" alt="{{ $item['promotion']->name }}" style="max-height: 100px; max-width: 100px;">
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>

            <!-- Calculate and display the total amount -->
            <div class="total-amount">
                <p><strong>Total Amount: </strong>
                    LKR.
                    @php
                    $total = 0;
                    foreach ($cartItems as $item) {
                    $total += $item['promotion']->dis_price * $item['quantity'];
                    }
                    echo number_format($total, 2); // Format the total amount
                    @endphp
                </p>
            </div>

            @else
            <p class="empty-message">Your cart is empty!</p>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-info" style="width: 100%;" onclick="window.history.back()">Add More Items</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-success" style="width: 100%;">Process Payment</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function removeItem(itemId) {
            alert(`Remove item with ID: ${itemId}`);
        }
    </script>

    <!-- Add Bootstrap 4 JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>