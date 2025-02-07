@extends('layouts.home')


@section('page-css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')



<style>
    .banner {
        position: relative;
        background: rgb(24, 77, 52);
        background: linear-gradient(90deg, rgba(24, 77, 52, 1) 7%, rgba(25, 135, 84, 1) 51%, rgba(86, 181, 137, 1) 90%);
        height: 600px;
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
</style>


<div class="banner">
    <div class="banner-content">
        <h1>Welcome to PromoAds</h1>
        <p>Find the best services and products tailored just for you</p>

        <!-- Search Box -->
        <div class="search-box mt-3 mx-auto">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by Location">
                <button class="btn btn-search">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container my-5">
    <div class="row justify-content-center">

        <!-- Register Your Business Card -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 p-4">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-briefcase" style="font-size: 2rem; color: #28a745;"></i>
                    </div>
                    <h5 class="fw-bold">Register Your Business</h5>
                    <p class="text-muted">Take your business to the next level by showcasing your products to a larger audience. With our platform, you can reach more customers, boost visibility, and increase sales. </p>
                    <a href="signup/businessSignUp" class="btn btn-success">Register</a>
                </div>
            </div>
        </div>

        <!-- Be a Member Card -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 p-4">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-person-circle" style="font-size: 2rem; color: #007bff;"></i>
                    </div>
                    <h5 class="fw-bold">Become a Loyalti Customer</h5>
                    <p class="text-muted">Explore a wide range of services and products that cater to your needs. From exceptional deals to trusted providers, discover everything you're looking for in one place!</p>
                    <a href="signup/customerSignUp" class="btn btn-primary">Register</a>
                </div>
            </div>
        </div>



        <!-- Register Your Taxi Card -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 p-4">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-truck" style="font-size: 2rem; color: #ffc107;"></i>
                    </div>
                    <h5 class="fw-bold">Register Your Taxi</h5>
                    <p class="text-muted">Join our network of trusted taxis and provide fast, reliable service to customers. Sign up today and help people get to their destinations with ease!</p>
                    <a href="signup/driverSignUp" class="btn btn-warning">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



<div class="container mt-5 p-4 bg-success text-white rounded" id="business-section">
    <h3>Most Popular Shops<span style="color:#fff;"></span></h3>
    <br>
    <!-- Promotions Section -->
    <div class="row">
        @foreach($business as $biz)
        @if ($biz->user->status == 1 && $biz->user->role == 'business') <!-- Only show the promotion if the status is not 0 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card promotion-card h-100 d-flex flex-column">
                <img class="card-img-top" src="{{ $biz->user && $biz->user->profile ? $biz->user->profile : 'https://via.placeholder.com/120' }}" alt="Promotion Image">
                <div class="card-body d-flex flex-column text-dark">
                    <h5>{{ $biz->user->name }}</h5>
                    <small>{{ Str::limit($biz->description, 100, '...') }}</small>
                    <div class="mt-auto">
                        <form action="{{ route('showpromo', ['userId' => $biz->id]) }}" method="GET">
                            <button type="submit" class="btn btn-light btn-block text-success fw-bold"
                                @if ($biz->user->status == 2)
                                disabled title="This shop is locked"
                                @endif>
                                @if ($biz->user->status == 2)
                                <i class="fas fa-lock"></i>
                                @endif
                                Shop Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        @endif
        @endforeach
    </div>
    <center> <a href="#" class="btn btn-warning text-dark fw-bold" style="font-size: 18px; padding: 12px 24px;">View All Shops</a>
    </center>
</div>





<div class="container my-5">
    <div class="row justify-content-center">
        <!-- Register Your Hotel Card -->
        <div class="col-md-12">
            <div class="card text-center shadow-sm border-0 p-4">
                <div class="card-body">
                    <div class="mb-12">
                        <i class="bi bi-house-door" style="font-size: 2rem; color: #17a2b8;"></i>
                    </div>
                    <h5 class="fw-bold">Register Your Hotel</h5>
                    <p class="text-muted">We offer a platform for hotel owners and managers to showcase their properties to a wider audience. Join us today to list your hotel and attract more guests!</p>
                    <a href="signup/businessSignUp" class="btn btn-info text-white">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container mt-5 p-4 bg-success text-white rounded" id="business-section">
    <h3>Most Popular Hotels <span style="color:#fff;"></span> </h3>

    <br>
    <!-- Promotions Section -->
    <div class="row">
        @foreach($business as $biz)
        @if ($biz->user->status == 1 && $biz->user->role == 'hotel') <!-- Only show the promotion if the status is not 0 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card promotion-card h-100 d-flex flex-column">
                <img class="card-img-top" src="{{ $biz->user && $biz->user->profile ? $biz->user->profile : 'https://via.placeholder.com/120' }}" alt="Promotion Image">
                <div class="card-body d-flex flex-column text-dark">
                    <h5>{{ $biz->user->name }}</h5>
                    <small>{{ Str::limit($biz->description, 100, '...') }}</small>
                    <div class="mt-auto">
                        <form action="{{ route('showpromo', ['userId' => $biz->id]) }}" method="GET">
                            <button type="submit" class="btn btn-light btn-block text-success fw-bold"
                                @if ($biz->user->status == 2)
                                disabled title="This shop is locked"
                                @endif>
                                @if ($biz->user->status == 2)
                                <i class="fas fa-lock"></i>
                                @endif
                                Book Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <center> <a href="#" class="btn btn-warning text-dark fw-bold" style="font-size: 18px; padding: 12px 24px;">View All Hotels</a>
    </center>

</div>


<div class="container mt-5 p-4" style="background-color: #e0e0e0; color: #333;">

    <h3>Special <span class="text-success"> Offers</span></h3>
    <br>
    <div class="row">
        @foreach ($promotions as $promotion)
        @if ($promotion->category == 'Special')
        <div class="col-md-3 col-sm-12 col-12">
            <div class="card promotion-card" style="background-color: #f1f1f1;">
                <img class="card-img-top" src="{{ $promotion->image ? asset($promotion->image) : 'https://via.placeholder.com/350x150' }}" alt="Promotion Image">
                <div class="card-body d-flex flex-column">
                    <p class="card-title mb-2">{{ $promotion->name }}</p>
                    <div class="prices mb-2">
                        @if ($promotion->dis_price == $promotion->price)
                        <span class="card-price">LKR {{ $promotion->price }}</span>
                        @else
                        <span class="card-discount text-muted"><s>LKR {{ $promotion->price }}</s></span>
                        <span class="card-price text-success ml-2">LKR {{ $promotion->dis_price }}</span>
                        @endif
                    </div>
                    <small class="text-muted">Offer valid until {{ date('F d, Y', strtotime($promotion->end_date)) }}</small>
                    <div class="mt-auto">
                        <a href="{{ route('promotions.view', $promotion->id) }}" class="btn btn-success btn-block">View Promotion</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    <br>
    <center> <a href="#" class="btn btn-warning text-dark fw-bold" style="font-size: 18px; padding: 12px 24px;">View Big Deals</a>
</div>


<div class="container mt-5 p-4 bg-success text-white rounded" id="business-section">
    <h3>Coming Soon!</h3>
    <br>
    <!-- Promotions Section -->
    <div class="row">
        @foreach($business as $biz)
        @if ($biz->user->status == 2 && $biz->user->role == 'business')
        <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-4"> <!-- Adjusted col to 2 for 6 items in a row on large screens -->
            <div class="card promotion-card h-100 d-flex flex-column">
                <img class="card-img-top" src="{{ $biz->user && $biz->user->profile ? $biz->user->profile : 'https://via.placeholder.com/120' }}" alt="Promotion Image">
                <div class="card-body d-flex flex-column text-dark">
                    <small>{{ $biz->user->name }}</small>
                </div>
            </div>
        </div>
        @endif
        @endforeach
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
<div class="footer">
    <div class="social-icons">
        <a href="https://web.facebook.com/profile.php?id=61571632296002" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://wa.me/0763487858" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>

    <div class="contact-details">
        <p>📞 Contact: +94 76 691 7207 | ✉ Email: sethika7@gmail.com</p>
    </div>

    <div class="copyright">
        <p>&copy; {{ date('Y') }} PromoAds. All rights reserved.</p>
    </div>
</div>

<!-- FontAwesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection