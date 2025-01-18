<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <title>Product Details</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/" id="appText">Promo<span style="color:#72cd3b">Ads</span></a>

            <!-- Navbar Items for Larger Screens -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex w-50 mx-auto d-none d-lg-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="txtsearch" id="txtsearch">
                </form>
                <ul class="navbar-nav ml-auto d-none d-lg-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-heart icon-heart fa-icon"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart fa-icon icon-cart"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-signIn mx-2" href="{{ route('signin') }}">
                            <i class="fas fa-user fa-icon icon-user"></i> Log In
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Navbar Items for Mobile -->
            <div class="d-flex d-lg-none align-items-center">
                <button class="btn btn-link d-lg-none" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="nav-link" href="#"><i class="fas fa-search icon-search fa-icon"></i></a>
                <a class="nav-link" href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart fa-icon icon-cart"></i></a>
                <a class="btn btn-signIn" href="{{ route('signin') }}">
                    <i class="fas fa-user fa-icon icon-user"></i>
                </a>

            </div>

        </div>

        </div>
    </nav>
    <div class="container my-5">
        <!-- Product Details Section -->
        <div class="row">
            <!-- Product Image Section -->
            <div class="col-md-4 text-center">
                <img class="img-fluid" src="{{ $promotion->image ? asset($promotion->image) : 'https://via.placeholder.com/350x150' }}" alt="Promotion Image">
            </div>

            <!-- Product Description Section -->
            <div class="col-md-8">
                <h3>{{ $promotion->name }}</h3>
                <p><strong>Price:</strong> LKR {{ $promotion->price }}</p>
                <p>{{ $promotion->description }}</p>
                <p><strong>Category:</strong> {{ $promotion->category }}</p>
            </div>
        </div>

        <!-- Action Buttons Section -->
        <div class="row mt-4">
            <div class="col-md-6">
                <!-- Share Button -->
                <button class="btn btn-primary w-100" id="whatsappShare">
                    <i class="fas fa-share-alt"></i> Share
                </button>
            </div>
            <div class="col-md-6">
                <form action="{{ route('cart.add', $promotion->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-block w-100"><i class="fas fa-cart-plus"></i> Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('whatsappShare').addEventListener('click', function() {
            var productID = "{{ $promotion->id }}";
            var productName = "{{ $promotion->name }}";
            var productDescription = "{{ $promotion->description }}";
            var imageUrl = "https://promoads.lk/promotions/getpromotions/" + productID;

            // Compose WhatsApp message
            var message = encodeURIComponent("Check out this product: " + productName + "\n\n" + productDescription + "\n\nCheck it out at: " + imageUrl);

            // WhatsApp share URL
            var whatsappURL = "https://api.whatsapp.com/send?text=" + message;

            // Open WhatsApp to send the message
            window.open(whatsappURL, '_blank');
        });
    </script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>