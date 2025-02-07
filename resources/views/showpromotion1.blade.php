@extends('layouts.home')

@section('additional-head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

@endsection

@section('page-css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
<style>
    .banner {
        position: relative;
        background: rgb(24, 77, 52);
        background: linear-gradient(90deg, rgba(24, 77, 52, 1) 7%, rgba(25, 135, 84, 1) 51%, rgba(86, 181, 137, 1) 90%);
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    .banner::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
    }

    .banner-content {
        position: relative;
        z-index: 1;
    }

    .search-box {
        max-width: 500px;
        width: 100%;
    }

    .search-box .form-control {
        padding: 12px 20px;
        border: none;
        outline: none;
    }

    .search-box .btn-search {
        background-color: #28a745;
        /* Green button */
        color: white;
        padding: 10px 20px;
        border: none;
    }

    .search-box .btn-search:hover {
        background-color: #218838;
        /* Darker green */
    }

    .carousel {
        margin: 30px auto 60px;
        padding: 0;
    }

    .carousel .carousel-item {
        text-align: center;
        overflow: hidden;
    }

    .carousel .carousel-item h4 {
        font-family: 'Varela Round', sans-serif;
    }

    .carousel .carousel-item img {
        max-width: 100%;
        display: inline-block;
    }

    .carousel .carousel-item .btn {
        border-radius: 0;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: bold;
        border: none;
        background: #a177ff;
        padding: 6px 15px;
        margin-top: 5px;
    }

    .carousel .carousel-item .btn:hover {
        background: #8c5bff;
    }

    .carousel .carousel-item .btn i {
        font-size: 14px;
        font-weight: bold;
        margin-left: 5px;
    }

    .carousel .thumb-wrapper {
        margin: 5px;
        text-align: left;
        background: #fff;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }

    .carousel .thumb-content {
        padding: 15px;
        font-size: 13px;
    }

    .carousel-control-prev,
    .carousel-control-next {
        height: 44px;
        width: 44px;
        background: none;
        margin: auto 0;
        border-radius: 50%;
        border: 3px solid rgba(0, 0, 0, 0.8);
    }

    .carousel-control-prev i,
    .carousel-control-next i {
        font-size: 36px;
        position: absolute;
        top: 50%;
        display: inline-block;
        margin: -19px 0 0 0;
        z-index: 5;
        left: 0;
        right: 0;
        color: rgba(0, 0, 0, 0.8);
        text-shadow: none;
        font-weight: bold;
    }

    .carousel-control-prev i {
        margin-left: -3px;
    }

    .carousel-control-next i {
        margin-right: -3px;
    }

    .carousel-indicators {
        bottom: -50px;
    }

    .carousel-indicators li,
    .carousel-indicators li.active {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin: 4px;
        border: none;
    }

    .carousel-indicators li {
        background: #ababab;
    }

    .carousel-indicators li.active {
        background: #555;
    }
</style>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .featured-products {
        padding: 20px;
        text-align: center;
    }

    .swiper-container {
        width: 80%;
        margin: auto;
    }

    .swiper-slide {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .product img {
        width: 100px;
        height: auto;
    }

    .product h4 {
        margin: 10px 0;
    }

    .price {
        color: green;
        font-weight: bold;
    }

    .old-price {
        text-decoration: line-through;
        color: gray;
    }

    .discount {
        background: lightgray;
        padding: 5px;
        border-radius: 5px;
        font-size: 12px;
    }

    .img-box {
        height: 200px;
        /* Adjust as needed */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .img-box img {
        max-height: 100%;
        width: auto;
        /* Maintain aspect ratio */
        object-fit: contain;
        /* Ensures the full image is visible */
    }
</style>


<div class="banner">
    <div class="banner-content">
        <h1>Welcome to {{ $business[0]['business_name'] }}</h1>

        <!-- Search Box -->
        <div class="search-box mt-3 mx-auto">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Offers">
                <button class="btn btn-search">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row" style="border-left: 5px solid #28a745;padding-left:50px;margin:20px;background-color:#f3faef;">
        <h2>About Us</h2>
        <p>{{ $business[0]['description'] }}</p>
    </div>
</div>

<div class="container-xl">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                <!-- Carousel indicators -->
                <ol class="carousel-indicators">
                    @foreach (array_chunk($promotions->toArray(), 3) as $index => $chunk)
                    <li data-target="#myCarousel" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

                <!-- Wrapper for carousel items -->
                <div class="carousel-inner">
                    @foreach (array_chunk($promotions->toArray(), 3) as $index => $chunk)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($chunk as $promotion)
                            <div class="col-sm-4">
                                <div class="thumb-wrapper">
                                    <div class="img-box">
                                        <img src="{{ $promotion['image'] ? asset($promotion['image']) : 'https://via.placeholder.com/250x150' }}" class="img-fluid" alt="{{ $promotion['name'] }}">
                                    </div>
                                    <div class="thumb-content">
                                        <h4>{{ $promotion['name'] }}</h4>
                                        <p>Offer valid until {{ date('F d, Y', strtotime($promotion['end_date'])) }}</p>
                                        @if ($promotion['dis_price'] == $promotion['price'])
                                        <h5><span class="card-price">LKR {{ $promotion['price'] }}</span></h5>
                                        @else
                                        <span class="card-discount text-danger">LKR {{ $promotion['price'] }}</span>
                                        <span class="card-price font-weight-bold">LKR {{ $promotion['dis_price'] }}</span>
                                        <span class="card-save text-success">
                                            SAVE: {{ round((($promotion['price'] - $promotion['dis_price']) / $promotion['price']) * 100) }}%
                                        </span>
                                        @endif
                                        <form action="{{ route('promotions.view', ['promotion_id' => $promotion['id']]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">View Deal</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Carousel controls -->
                <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid mt-5">

    <div class="row justify-content-center text-center">
        <h2 style="position: relative; display: inline-block; border-bottom: 4px solid #28a745; padding-bottom: 5px;">
            Our Offers
        </h2>
    </div>
    <br>
    <div class="row p-4" style="background-color: #f8f9fa;">
        @foreach ($promotions as $promotion)
        @if ($promotion->price != 1)
        <div class="col-md-4 col-sm-6 col-12 mb-4">
            <div class="card promotion-card shadow-lg">
                <!-- Image Container -->
                <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                    <img class="img-fluid" src="{{ $promotion->image ? asset($promotion->image) : 'https://via.placeholder.com/250x150' }}"
                        alt="Promotion Image"
                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>

                <div class="card-body text-center">
                    <h5 class="card-title">{{ $promotion->name }}</h5>
                    @if ($promotion->dis_price == $promotion->price)
                    <h5><span class="card-price">LKR {{ $promotion->price }}</span></h5>
                    @else
                    <span class="card-discount text-danger">LKR {{ $promotion->price }}</span>
                    <span class="card-price font-weight-bold">LKR {{ $promotion->dis_price }}</span>
                    <span class="card-save text-success">
                        SAVE: {{ round((($promotion->price - $promotion->dis_price) / $promotion->price) * 100) }}%
                    </span>
                    @endif
                    <small class="text-muted">Offer valid until {{ date('F d, Y', strtotime($promotion->end_date)) }}</small>
                    <br>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <form action="{{ route('promotions.view', ['promotion_id' => $promotion->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-block">View Deal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        <div class="container my-5">
            <div class="row justify-content-center">
                <!-- Register Your Hotel Card -->
                <div class="col-md-12">
                    <div class="card text-center shadow-sm border-0 p-4">
                        <div class="card-body">
                            <div class="mb-12">
                                <i class="bi bi-house-door" style="font-size: 2rem; color: #17a2b8;"></i>
                            </div>
                            <h5>Become a Loyalty Customer in {{ $business[0]['business_name'] }} </h5>
                            <p class="text-muted">Welcome! We offer more discounts than others, so become a special customer and enjoy exclusive savings with us!<br>
                                Register now to get started!</p>
                            <a href="../signup/customerSignUp" class="btn btn-primary">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <style>
            /* Footer Styles */
            .footer {
                background-color: #000;
                /* Black background */
                color: #fff;
                text-align: center;
                padding: 30px 0;
                margin-top: 50px;
                width: 100%;
            }

            .footer a {
                color: #28a745;
                /* Green color for icons */
                margin: 0 15px;
                font-size: 24px;
                transition: 0.3s;
            }

            .footer a:hover {
                color: #ffffff;
                /* White on hover */
            }

            .footer .contact-details {
                font-size: 16px;
                margin-top: 10px;
            }

            .footer .social-icons {
                margin-top: 10px;
            }

            .footer .copyright {
                margin-top: 15px;
                font-size: 14px;
                opacity: 0.8;
            }
        </style>

        <!-- Footer -->


        <!-- FontAwesome for icons -->
    </div>
</div>

<div class="footer">
    <div class="social-icons">
        <a href="https://web.facebook.com/profile.php?id=61571632296002" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://wa.me/0763487858" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>

    <div class="contact-details">
        <p>📞 Contact: {{ $business[0]['phone_number'] }} | ✉ Email: {{ $business[0]['email'] }}</p>
    </div>

    <div class="copyright">
        <p>&copy; {{ date('Y') }} PromoAds. All rights reserved.</p>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


@endsection