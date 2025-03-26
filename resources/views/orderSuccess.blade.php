<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Successful</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .success-container {
            text-align: center;
            margin-top: 10%;
        }

        .success-icon {
            font-size: 80px;
            color: #28a745;
            animation: pop 0.5s ease-in-out;
        }

        @keyframes pop {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .card {
            max-width: 500px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="success-container">
            <div class="card p-4">
                <i class="bi bi-check-circle-fill success-icon"></i>
                <h2 class="mt-3 text-success">Order Placed Successfully!</h2>
                <p class="text-muted">Thank you for your purchase. Your order has been successfully placed and will be processed shortly.</p>

                <hr>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Back to Home</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>