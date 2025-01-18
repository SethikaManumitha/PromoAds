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

        .price {
            color: #dc3545;
            text-decoration: line-through;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="cart-container">
            <h1 class="mb-4 text-center">Shopping Cart</h1>

            @if(!empty($cartItems) && count($cartItems) > 0)
            <ul class="list-group">
                @foreach ($cartItems as $item)
                <li class="list-group-item d-flex align-items-center flex-wrap">
                    <div class="d-flex align-items-center me-3">
                        <img src="{{ $item['promotion']->image ? asset($item['promotion']->image) : 'https://placehold.co/60x60' }}" alt="{{ $item['promotion']->name }}" class="rounded me-3" style="width: 60px; height: 60px;">
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1"><strong>{{ Str::limit($item['promotion']->name, 30) }}</strong></h6>
                        <p class="mb-0 text-muted">Unit Price: <span class="price">LKR.{{$item['promotion']->price}}.00</span> LKR.{{ number_format($item['promotion']->dis_price, 2) }}</p>
                        <p class="mb-0 text-muted">Total Price: LKR.{{ number_format($item['promotion']->dis_price * $item['quantity'], 2) }}</p>
                    </div>
                    <div class="d-flex align-items-center ms-auto">
                        <form action="{{ route('cart.update', $item['promotion']->id) }}" method="POST" class="me-2">
                            @csrf
                            <input type="hidden" name="quantity" value="-1">
                            <button type="submit" class="btn btn-secondary btn-sm">-</button>
                        </form>
                        <span class="mx-2">{{ $item['quantity'] }}</span>
                        <form action="{{ route('cart.update', $item['promotion']->id) }}" method="POST" class="ms-2">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary btn-sm">+</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>

            <div class="order-summary mt-4 text-end">
                <p><strong>Total Price: </strong>LKR. @php
                    $total = 0;
                    foreach ($cartItems as $item) {
                    $total += $item['promotion']->dis_price * $item['quantity'];
                    }
                    echo number_format($total, 2); @endphp</p>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <a href="/" class="btn btn-info w-100">Add More Items</a>
                </div>

                <div class="col-md-6">
                    <a href="{{ route('downloadCartPDF') }}" class="btn btn-success w-100">Download PDF</a>
                </div>
            </div>
            @else
            <p class="empty-message text-center">Your cart is empty!</p>
            @endif
        </div>
    </div>


    <!-- Add Bootstrap 4 JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>