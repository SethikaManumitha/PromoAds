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
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en', // Set your page language
                includedLanguages: 'en,si,ta,ru,es,fr,de,it', // Set available languages
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <style>
        .banner {
            position: relative;
            width: 100%;
            height: 100vh;
            background: url("{{ asset($business->business_type == 'Retail' ? 'images/slider-bg.jpeg' : 'images/' . $business->business_type . '.jpg') }}") center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 50px;
            color: white;
        }
    </style>
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
                    <a class="nav-link text-dark" href="#" data-toggle="tooltip" data-placement="bottom" title="View Cart">
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
    <div class="banner">
        <div class="banner-content">
            <h1>Welcome to {{ $business->business_name }}</h1>
            <p>{{$business->description }}</p>
            <a href="#featured-product" class="shop-now">Shop Now</a>
        </div>
    </div>
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
                        <h3>Featured Product</h3>
                        <h2>Popular Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($promotions->where('category','Special') as $key => $promotion)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-{{ $key + 1 }}" class="single-product">
                        <div class="part-1" style="background: url('{{ $promotion['image'] ? asset($promotion['image']) : 'https://via.placeholder.com/250x150' }}') no-repeat center; background-size: contain; transition: all 0.3s;">
                            @php
                            // Calculate the discount percentage
                            $discountPercentage = round((($promotion['price'] - $promotion['dis_price']) / $promotion['price']) * 100);
                            @endphp

                            @if ($discountPercentage > 15)
                            <span class="discount">{{ $discountPercentage }}% off</span>
                            @endif
                            <ul>
                                <li>
                                    <a href="javascript:void(0);" class="cart-image" data-image="{{ $promotion['image'] ? asset($promotion['image']) : 'https://via.placeholder.com/250x150' }}"
                                        data-id="{{ $promotion['id'] }}"
                                        data-title="{{ $promotion['name'] }}"
                                        data-price="{{ $promotion['dis_price'] }}"
                                        data-category="{{ $promotion['category'] }}">
                                        <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>

                                    </a>
                                </li>

                                <li>
                                    <a href="https://wa.me/" target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://facebook.com/" target="_blank">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>

                            </ul>

                        </div>
                        <div class="part-2">
                            <h3 class="product-title">{{ $promotion['name'] }}</h3>
                            <h4 class="product-old-price">LKR {{ $promotion['price'] }}</h4>
                            <h4 class="product-price">LKR {{ $promotion['dis_price'] }}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <div class="about-section" id="about">
        <div class="about-image">
            <img src="{{asset($user->profile)}}" alt="About Us">
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


                @foreach ($promotions->where('category','!=','Special') as $key => $promotion)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div id="product-{{ $key + 1 }}" class="single-product">
                        <div class="part-1" style="background: url('{{ $promotion['image'] ? asset($promotion['image']) : 'https://via.placeholder.com/250x150' }}') no-repeat center; background-size: contain; transition: all 0.3s;">
                            @php
                            // Calculate the discount percentage
                            $discountPercentage = round((($promotion['price'] - $promotion['dis_price']) / $promotion['price']) * 100);
                            @endphp

                            @if ($discountPercentage > 15)
                            <span class="discount">{{ $discountPercentage }}% off</span>
                            @endif
                            <!-- <span class="new">new</span> -->
                            <ul>
                                <li>
                                    <a href="javascript:void(0);" class="cart-image" data-image="{{ $promotion['image'] ? asset($promotion['image']) : 'https://via.placeholder.com/250x150' }}"
                                        data-id="{{ $promotion['id'] }}"
                                        data-title="{{ $promotion['name'] }}"
                                        data-price="{{ $promotion['dis_price'] }}"
                                        data-category="{{ $promotion['category'] }}">
                                        <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                                    </a>
                                </li>



                                <li>
                                    <a href="https://wa.me/" target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://facebook.com/" target="_blank">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="part-2">
                            <h3 class="product-title">{{ $promotion['name'] }}</h3>
                            <h4 class="product-old-price">LKR {{ $promotion['price'] }}</h4>
                            <h4 class="product-price">LKR {{ $promotion['dis_price'] }}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- About Us Section -->


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
                    <!-- <ul class="color-options">
                        <li><b>Color:</b> Red, White, Black</li>
                        <li><b>Style:</b> SM3018-100</li>
                    </ul> -->
                    <div class="row align-items-center">
                        <div class="col-md-4 qty-container">
                            <button class="qty-btn" onclick="decreaseQty()">-</button>
                            <input type="text" class="qty-input" id="qty" value="1">
                            <button class="qty-btn" onclick="increaseQty()">+</button>
                        </div>
                        <div class="col-md-4">
                            <a style="text-decoration: none;color:white" href="{{route('cart.index')}}" class="btn btn-orange">View Cart</a>
                        </div>
                        <div class="col-md-4">
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