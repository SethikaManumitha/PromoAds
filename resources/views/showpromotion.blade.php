<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <title>{{ $business->business_name }}</title>
    <link rel="stylesheet" href="{{asset('css/showroom.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- MDBootstrap JS (if using MDBootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en', // Set your page language
                includedLanguages: 'en,si,ta,ru,es,fr,de,it', // Set available languages
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <a class="navbar-brand text-dark" href="#">{{ $business->business_name }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#featured-product">Featured Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#all-products">All Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#">Contact Us</a>
                </li>
            </ul>

            <!-- Language Translator Dropdown -->


            <!-- Cart Icon -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{route('cart.index')}}" data-toggle="tooltip" data-placement="bottom" title="View Cart">
                        <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                    </a>
                </li>
            </ul>
            <form class="form-inline">
                <div id="google_translate_element"></div>
            </form>
        </div>
    </nav>



    <!-- Banner Section -->
    @foreach ($banner as $b)
    <style>
        .banner {
            position: relative;
            width: 100%;
            height: 100vh;
            background: url("{{ asset($b->image) }}") center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 50px;
            color: white;
        }
    </style>
    <div class="banner">
        <div class="banner-content">
            <h1>Welcome to {{ $business->business_name }}</h1>
            <p>{{ $b->description }}</p>
            <a href="#featured-product" class="shop-now">Shop Now</a>
        </div>
    </div>
    @endforeach

    <section class="sect-cateogry" style="display:none">
        <button class="btn">Category</button>
        <button class="btn">Category</button>
        <button class="btn">Category</button>
        <button class="btn">Category</button>
    </section>

    <section class="section-products" id="featured-product">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8 col-lg-6">
                    <div class="header">
                        <h3>Featured Deals</h3>
                        <h2>Special Offers</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($promotions as $key => $promotion)
                @php
                $isLoyaltyMember = Auth::check() && \App\Models\Loyalty::where('user_id', Auth::id())
                ->exists();

                @endphp
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-{{ $key + 1 }}" class="single-product">
                        <div class="part-1" style="background: url('{{ $promotion['image'] ? asset($promotion['image']) : 'https://via.placeholder.com/250x150' }}') no-repeat center; background-size: contain; transition: all 0.3s;">
                            @php
                            $displayPrice = $isLoyaltyMember && isset($promotion['loy_price']) ? $promotion['loy_price'] : $promotion['dis_price'];
                            $originalPrice = $isLoyaltyMember && isset($promotion['loy_price']) ? $promotion['price'] : $promotion['price'];
                            $discountPercentage = round((($originalPrice - $displayPrice) / $originalPrice) * 100);
                            @endphp
                            <span class="discount">{{ $discountPercentage }}% off</span>
                            <ul>
                                <li>
                                    <a href="javascript:void(0);" class="cart-image"
                                        data-image="{{ $promotion['image'] ? asset($promotion['image']) : 'https://via.placeholder.com/250x150' }}"
                                        data-id="{{ $promotion['id'] }}"
                                        data-title="{{ $promotion['name'] }}"
                                        data-price="{{ $displayPrice }}"
                                        data-category="{{ $promotion['category'] }}">
                                        <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                                    </a>
                                </li>

                                <!-- WhatsApp Link -->
                                <li>
                                    <a href="{{ route('promotions.view', ['promotion_id' => $promotion['id']]) }}">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>

                                <!-- Facebook Link -->
                                <li>
                                    <a href="{{ route('promotions.view', ['promotion_id' => $promotion['id']]) }}">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">{{ $promotion['name'] }}</h3>
                            <h4 class="product-old-price">LKR {{ $originalPrice }}</h4>
                            <h4 class="product-price">LKR {{ $displayPrice }}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>



    <div class="about-section" id="about">
        <div class="about-image">
            <img src="{{asset($aboutImg)}}" alt="About Us">
        </div>
        <div class="about-content">
            <h2>ABOUT US</h2>
            <p>{{$business->description }}</p>
            <button class="read-more">Read More</button>
        </div>
    </div>

    <section class="section-products" id="all-products">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-8 col-lg-6">
                    <div class="header">
                        <h2>All Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $key => $product)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-{{ $key + 1 }}" class="single-product">
                        <div class="part-1" style="background: url('{{ $product['image'] ? asset($product['image']) : 'https://via.placeholder.com/250x150' }}') no-repeat center; background-size: contain; transition: all 0.3s;">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);" class="cart-image" data-image="{{ $product['image'] ? asset($product['image']) : 'https://via.placeholder.com/250x150' }}"
                                        data-id="{{ $product['id'] }}"
                                        data-title="{{ $product['name'] }}"
                                        data-price="{{ $product['price'] }}"
                                        data-category="{{ $product['category'] }}">
                                        <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                                    </a>
                                </li>


                            </ul>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">{{ $product['name'] }}</h3>
                            <h4 class="product-price">LKR {{ $product['price'] }}</h4>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </section>
    <!-- About Us Section -->

    <style>
        .offer-section {
            position: relative;
            width: 100%;
            margin: auto;
        }

        .offer-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            max-height: 650px;
        }


        .offer-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Black overlay with 50% opacity */
            z-index: 1;
            /* Ensure it appears above the image but below the text */
        }

        .offer-content {
            position: absolute;
            top: 20%;
            left: 10%;
            color: white;
            font-family: 'Arial', sans-serif;
            z-index: 2;
            /* Make sure the text appears above the overlay */
        }

        .offer-content h1 {
            font-size: 2rem;
            font-weight: bold;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        .offer-content .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 16px;
            color: #f3a683;
            background-color: transparent;
            border: 2px solid #f3a683;
            border-radius: 0;
            width: 200px;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .offer-content .btn:hover {
            background-color: #f3a683;
            color: white;
        }
    </style>

    <div class="offer-section">
        <img src="{{asset('images/loyalty.jpeg')}}" alt="Jewelry Offer">
        <div class="offer-content">
            <h1>Become a Loaylty Customer</h1>
            <p style="color:#ddd">
                Become a valued member and enjoy exclusive rewards, special discounts, and early access to our latest collections.
            </p>
            <p style="color:#ddd">Elevate your shopping experience with perks designed just for you. Sign up today and start enjoying the benefits!</p>
            <a href="#" class="btn">Register Now</a>
        </div>
    </div>
    <!-- Carousel wrapper -->

    <!-- Feedback Section -->

    <!-- Add Feedback Form Section -->
    <div class=" container mt-5">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="border p-3 rounded shadow-sm">
            <h5>Add Your Review</h5>
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf
                <input type="hidden" name="promotion_id" value="{{ $business->id }}">
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select name="rating" id="rating" class="form-control" required>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Your Review</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Submit Review</button>
            </form>
        </div>
    </div>

    <div class="container mt-5">
        <h4>Customer Reviews</h4>

        @if($feedbacks->isEmpty())
        <p>No reviews yet. Be the first to leave a review!</p>
        @else
        <!-- Display Existing Reviews -->
        <div class="reviews-list">
            @foreach ($feedbacks as $feedback)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $feedback->user ? $feedback->user->name : 'Anonymous' }}</h5>
                    <div class="rating mb-2">
                        @for ($i = 5; $i >=1; $i--)
                        <i class="fas fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-muted' }}"></i>
                        @endfor
                    </div>
                    <p class="card-text">{{ $feedback->comment }}</p>

                    <p class="text-muted">{{ $feedback->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <style>
            .card-title {
                font-size: 1.4rem;
                margin-bottom: 10px;
                font-weight: bold;
                color: #333;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .card-text {
                font-size: 1rem;
                color: #555;
            }

            .card-price {
                font-weight: 600;
                color: #28a745;
                font-size: 1.2rem;
            }

            .card-discount {
                color: #dc3545;
                font-size: 1.1rem;
                text-decoration: line-through;
                margin-right: 10px;
            }

            .card-save {
                color: #ffc107;
                font-weight: bold;
                font-size: 1rem;
            }
        </style>


        <!-- Displaying Recommended Shops -->
        @php
        use Illuminate\Support\Str;
        @endphp

        @if(count($recommendedShops) > 0)
        <div class="recommended-shops">
            <h3>Recommended Shops</h3>
            <div class="row">
                @foreach ($recommendedShops as $shop)
                <div class="col-md-4">
                    <div class="card promotion-card">
                        <!-- Display Shop Image -->
                        <img src="{{ $shop['image_url'] ? asset($shop['image_url']) : 'https://placehold.co/600x400' }}"
                            class="card-img-top"
                            alt="{{ $shop['business_name'] }}"
                            style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title">{{ $shop['business_name'] }}</h5>

                            <!-- Display Business Type -->
                            <p class="card-text">
                                <b>Business Type:</b> {{ $shop['business_type'] }}
                            </p>

                            <!-- Display Business Description with Limit -->
                            <p class="card-text">
                                <b>Description:</b> {{ Str::limit($shop['description'], 100, '...') }}
                            </p>

                            <!-- Add buttons container -->
                            <div class="buttons-container">
                                <a href="{{ url('/showpromo/' . $shop['id']) }}" class="btn btn-success w-100" style="margin-bottom: 10px;">Visit Shop</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="text-muted">No recommendations available.</p>
        @endif




    </div>


    <br>

    @php
    $isLoyaltyMember = Auth::check() && \App\Models\Loyalty::where('user_id', Auth::id())
    ->exists();
    @endphp

    @if ($isLoyaltyMember)
    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customOrderModal">
        Place Custom Order
    </button>

    <!-- Custom Order Modal -->
    <div class="modal fade" id="customOrderModal" tabindex="-1" aria-labelledby="customOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customOrderModalLabel">Place Custom Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('custom_orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="business_id" value="{{ $business->id }}">

                        <div class="mb-3">
                            <label for="description" class="form-label">Additional Details</label>
                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Describe your custom order requirements" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Submit Custom Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif


    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif



    <!-- Carousel wrapper -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; {{$business->business_name }}. All rights reserved.</p>
            <div class="social-links">
                <a href="https://wa.me/yourwhatsapplink" class="text-white mx-3" target="_blank" title="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="mailto:youremail@example.com" class="text-white mx-3" title="Email">
                    <i class="fas fa-envelope"></i>
                </a>
                <a href="https://facebook.com/yourfacebooklink" class="text-white mx-3" target="_blank" title="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
            </div>
            <p class="mt-2">
                Created by <a href="https://promoads.lk" class="text-white font-weight-bold" target="_blank">Promoads.lk</a>
            </p>
        </div>
    </footer>

    <style>
        .modal-content {
            padding: 20px;
            border-radius: 10px;
        }

        .modal-image-container img {
            width: 100%;
            max-height: 300px;
            /* Adjust as needed */
            object-fit: contain;
            /* Ensures the aspect ratio is maintained */
            border-radius: 10px;
        }


        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
        }

        .modal-body {
            text-align: left;
        }

        .price {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .modal-description {
            color: #666;
            font-size: 14px;
        }

        .color-options {
            list-style: none;
            padding: 0;
            color: #555;
        }

        .color-options li {
            margin-bottom: 5px;
        }

        .qty-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .qty-btn {
            width: 30px;
            height: 30px;
            text-align: center;
            font-size: 18px;
            cursor: pointer;
            border: 1px solid #ddd;
            background-color: #f5f5f5;
            border-radius: 5px;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn-orange {
            background-color: #ff7f50;
            color: white;
            font-weight: bold;
            width: 100%;
            padding: 10px;
            border: none;
            transition: background 0.3s ease-in-out;
        }

        .btn-orange:hover {
            background-color: black;
        }
    </style>

    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-image-container">
                        <img src="" alt="Cart Image" id="cartModalImage" class="img-fluid">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="modal-title" id="cartModalLabel">Running Shoes For Men</h3>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <h1> <span aria-hidden="true">&times;</span></h1>
                            </button>
                        </div>
                    </div>
                    <h2 class="price">$99</h2>
                    <p class="modal-description">
                        Buy good shoes and a good mattress, because when you're not in one, you're in the other. With four pairs of shoes, I can travel the world.
                    </p>

                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <a style="text-decoration: none;color:white" href="{{route('cart.index')}}" class="btn btn-orange">View Cart</a>
                        </div>
                        <div class="col-md-6">
                            <a id="addToCartBtn" style="text-decoration: none;color:white" href="#" class="btn btn-orange">Add to Cart</a>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        document.querySelectorAll('.cart-image').forEach(function(element) {
            element.addEventListener('click', function() {
                const imageUrl = this.getAttribute('data-image');
                const title = this.getAttribute('data-title');
                const price = this.getAttribute('data-price');
                const category = this.getAttribute('data-category');
                const id = this.getAttribute('data-id');

                // Set modal image and text dynamically
                document.getElementById('cartModalImage').src = imageUrl;
                document.getElementById('cartModalLabel').textContent = title;
                document.querySelector('.price').textContent = 'LKR.' + price;
                document.querySelector('.modal-description').textContent = category;

                // Update the Add to Cart link dynamically with the product ID
                const addToCartLink = document.getElementById('addToCartBtn');
                addToCartLink.setAttribute('href', "/cart/add/" + id); // Update the URL using JavaScript

                // Show modal
                $('#cartModal').modal('show');
            });
        });

        // Add an event listener for the "Add to Cart" button to trigger the navigation
        document.getElementById('addToCartBtn').addEventListener('click', function() {
            // Get the dynamically set href from the button
            const addToCartLink = document.getElementById('addToCartBtn');

            // Redirect to the Add to Cart URL
            window.location.href = addToCartLink.getAttribute('href');
        });

        // Clear image sources when modals are closed
        $('#cartModal').on('hidden.bs.modal', function() {
            this.querySelector('img').src = ''; // Clear the image source
        });
    </script>



    <script>
        document.querySelectorAll('.cart-image').forEach(function(element) {
            element.addEventListener('click', function() {
                const imageUrl = this.getAttribute('data-image');
                const title = this.getAttribute('data-title');
                const price = this.getAttribute('data-price');
                const category = this.getAttribute('data-category');
                const id = this.getAttribute('data-id');

                // Set modal image and text dynamically
                document.getElementById('cartModalImage').src = imageUrl;
                document.getElementById('cartModalLabel').textContent = title;
                document.querySelector('.price').textContent = 'LKR.' + price;
                document.querySelector('.modal-description').textContent = category;

                // Update the Add to Cart link dynamically with the product ID
                const addToCartLink = document.getElementById('addToCartBtn');
                // Set the URL dynamically
                addToCartLink.setAttribute('href', "/cart/add/" + id); // Update the URL using JavaScript

                // Show modal
                $('#cartModal').modal('show');
            });
        });

        // Clear image sources when modals are closed
        $('#cartModal').on('hidden.bs.modal', function() {
            this.querySelector('img').src = ''; // Clear the image source
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myCarousel = new mdb.Carousel(document.querySelector("#carouselExampleControls"));
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 70, // Adjust for navbar height
                            behavior: "smooth"
                        });
                    }
                });
            });
        });
    </script>



    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>