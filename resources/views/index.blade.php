@extends('layouts.home')


@section('page-css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')




@php
$categories = [
['value' => 'Retail', 'label' => 'Retail & Supermarkets', 'icon' => 'fas fa-store'],
['value' => 'Hotels', 'label' => 'Hotels & Villas', 'icon' => 'fas fa-hotel'],
['value' => 'Food', 'label' => 'Food & Beverages', 'icon' => 'fas fa-utensils'],
['value' => 'Clothing', 'label' => 'Textile & Costume', 'icon' => 'fas fa-tshirt'],
['value' => 'Herbal_Spice', 'label' => 'Herbal & Spices', 'icon' => 'fas fa-leaf'],
['value' => 'Home', 'label' => 'Electronics & Furniture', 'icon' => 'fas fa-couch'],
['value' => 'Automobile', 'label' => 'Automobile & Transport', 'icon' => 'fas fa-car'],

['value' => 'Construction', 'label' => 'Construction & Hardware', 'icon' => 'fas fa-hammer'],
['value' => 'Stationery', 'label' => 'Books & Stationery', 'icon' => 'fas fa-book'],
['value' => 'Gardening', 'label' => 'Gardening & Landscaping', 'icon' => 'fas fa-tree'],

['value' => 'Handicrafts', 'label' => 'Handicrafts & Local Art', 'icon' => 'fas fa-hand-paper'],
['value' => 'Mobile', 'label' => 'Computers & Phones', 'icon' => 'fas fa-mobile-alt'],




];
@endphp


<div class="banner d-flex align-items-center justify-content-center text-center position-relative"
    style="height: 500px; background: url('{{ asset('images/img1.jpeg') }}') center/cover no-repeat;">

    <!-- Greenish Overlay -->
    <div style="position: absolute; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 100%; 
                background: rgba(0, 120,0, 0.2); /* Greenish overlay */
                z-index: 1;"></div>

    <!-- Glassmorphism Effect -->
    <div class="banner-content p-4 position-relative"
        style="background: rgba(255, 255, 255, 0.4);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border-radius: 15px;
                padding: 20px;
                width: 90%;
                max-width: 600px;
                z-index: 2;">

        <p class="text-dark">Find the best services and products tailored just for you</p>

        <!-- Search Box -->
        <div class="search-box mt-3 mx-auto" style="max-width: 650px;">
            <div class="input-group">
                <input type="text" class="form-control rounded-start" placeholder="Search for business"
                    style="border: none; padding: 12px; font-size: 16px;">

                <!-- Location Dropdown -->
                <div class="input-group-prepend">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="locationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 12px 15px; border: none; transition: 0.3s;">
                        <i class="fas fa-map-marker-alt"></i> <span id="selectedLocation">Hikkaduwa</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="locationDropdown">
                        <div class="dropdown-submenu">
                            <a class="dropdown-item" href="#" onclick="setLocation('Hikkaduwa')">Hikkaduwa</a>
                        </div>

                    </div>
                </div>
                <style>
                    /* Style for dropdown submenu */
                    .dropdown-submenu {
                        position: relative;
                    }

                    .dropdown-submenu .dropdown-menu {
                        top: 0;
                        left: 100%;
                        margin-top: -5px;
                        display: none;
                        position: absolute;
                    }

                    .dropdown-submenu:hover .dropdown-menu {
                        display: block;
                    }

                    .dropdown-item.dropdown-toggle::after {

                        font-family: 'FontAwesome';
                        padding-left: 2px;
                    }
                </style>
                <script>
                    function setLocation(location) {
                        // Update the text of the button with the selected location
                        document.getElementById('selectedLocation').textContent = location;
                    }
                </script>


                <button class="btn btn-success rounded-end" style="padding: 12px 15px; border: none; transition: 0.3s;">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>

    </div>
</div>




<div class="categories p-3 d-flex flex-wrap justify-content-center align-items-center shadow-lg"
    style="background: rgba(240, 239, 237, 0.2); 
            backdrop-filter: blur(10px); 
            -webkit-backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2); 
            max-width: 100%; /* Limit max width for better alignment */
            margin: auto;">

    <div class="row w-100 justify-content-center">
        @foreach($categories as $category)
        <!-- Mobile: col-4 (3 items per row), Desktop: col-lg-1 (8 items per row) -->
        <div class="col-4 col-md-4 col-lg-1 d-flex justify-content-center mb-3">
            <div class="category-item text-center"
                style="padding: 5px; border-radius: 15px; 
                            background: rgba(255, 255, 255, 0.15); 
                            backdrop-filter: blur(8px);
                            -webkit-backdrop-filter: blur(8px);
                            border: 1px solid rgba(255, 255, 255, 0.2);
                            transition: all 0.3s ease-in-out;
                            cursor: pointer;
                            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                            width: 120px; /* Control button width */
                            height: 120px;">

                <!-- Category Link -->
                <a href="{{ route('index') }}?business_type={{ $category['value'] }}#business-section"
                    class="category-toggle d-flex flex-column align-items-center text-dark"
                    style="text-decoration: none; font-weight: 500;">

                    <!-- Icon Wrapper -->
                    <div class="icon-circle">
                        <i class="{{ $category['icon'] }} text-success" style="font-size: 30px;"></i>
                    </div>

                    <span class="fw-bold mt-1" style="font-size: 14px;">{{ $category['label'] }}</span> <!-- Reduced margin -->
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .icon-circle {
        width: 60px;
        /* Adjusted size */
        height: 60px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease-in-out;
    }

    .category-item {
        transition: all 0.3s ease-in-out;
    }

    .category-item:hover {
        transform: translateY(-5px) scale(1.08);
        box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.2);
        background: rgba(255, 255, 255, 0.3);
        /* Change background color on hover */
    }

    .category-item:hover .icon-circle {
        background: rgba(0, 255, 0, 0.6);
        /* Change the icon circle color on hover */
        transform: scale(1.15);
    }

    .category-item:hover .category-toggle {
        color: #ffffff;
        /* Change text color on hover */
    }
</style>






<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">





<div class="container mt-5 p-4 text-white rounded shadow-sm" id="business-section"
    style="background: rgba(144, 238, 144, 0.2); /* Light green with transparency */
            backdrop-filter: blur(15px); /* Frosted glass effect */
            -webkit-backdrop-filter: blur(15px); /* Safari support */
            border-radius: 15px;
            border: 1px solid rgba(144, 238, 144, 0.3);">

    <h3 class="text-center fw-bold" style="color: black;">Most Popular Places in Hikkaduwa</h3>
    <br>

    <!-- Promotions Section -->
    <div class="row">
        @foreach($business as $biz)
        @if ($biz->user->status == 1)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card promotion-card h-100 d-flex flex-column align-items-center text-center shadow-sm"
                style="border-radius: 15px; overflow: hidden; background: rgba(255, 255, 255, 0.1); 
                        backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); transition: transform 0.3s ease-in-out; box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px;">

                <img class="card-img-top mt-3 rounded-circle"
                    src="{{ $biz->user && $biz->user->profile ? $biz->user->profile : 'https://via.placeholder.com/120' }}"
                    alt="Promotion Image"
                    style="width: 100px; height: 100px; object-fit: cover; border: 3px solid white;">

                <div class="card-body d-flex flex-column text-dark">
                    <h5 class="fw-bold">{{ $biz->user->name }}</h5>
                    <small class="text-muted">{{ Str::limit($biz->description, 100, '...') }}</small>

                    <div class="mt-auto">
                        <form action="{{ route('showpromo', ['userId' => $biz->id]) }}" method="GET">
                            <button type="submit" class="btn btn-success fw-bold shadow-sm px-4 py-2 rounded-pill"
                                @if ($biz->user->status == 2)
                                disabled title="This shop is locked"
                                style="background: gray; border: none;"
                                @endif>
                                @if ($biz->user->status == 2)
                                <i class="fas fa-lock"></i>
                                @endif
                                Visit Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

</div>
















<div class="container my-5">
    <div class="row justify-content-center g-4">

        <!-- Register Your Business Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card text-center border-0 shadow-lg p-4 position-relative"
                style="background: rgba(255, 255, 255, 0.6); 
                        backdrop-filter: blur(12px); 
                        -webkit-backdrop-filter: blur(12px); 
                        border-radius: 15px; 
                        transition: transform 0.3s ease;">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-briefcase" style="font-size: 3rem; color: #28a745;"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Register Your Business</h5>
                    <p class="text-muted">Take your business to the next level by showcasing your products to a larger audience. Gain visibility, reach more customers, and boost your sales.</p>
                    <a href="signup/businessSignUp" class="btn btn-success fw-bold shadow-sm">Register</a>
                </div>
            </div>
        </div>

        <!-- Be a Member Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card text-center border-0 shadow-lg p-4 position-relative"
                style="background: rgba(255, 255, 255, 0.6); 
                        backdrop-filter: blur(12px); 
                        -webkit-backdrop-filter: blur(12px); 
                        border-radius: 15px; 
                        transition: transform 0.3s ease;">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-person-circle" style="font-size: 3rem; color: #007bff;"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Become a Loyalty Customer</h5>
                    <p class="text-muted">Discover exclusive deals and trusted providers. Enjoy a seamless shopping experience with the best services in one place.</p>
                    <a href="signup/customerSignUp" class="btn btn-primary fw-bold shadow-sm">Register</a>
                </div>
            </div>
        </div>

        <!-- Register Your Taxi Card -->
        <div class="col-lg-4 col-md-6">
            <div class="card text-center border-0 shadow-lg p-4 position-relative"
                style="background: rgba(255, 255, 255, 0.6); 
                        backdrop-filter: blur(12px); 
                        -webkit-backdrop-filter: blur(12px); 
                        border-radius: 15px; 
                        transition: transform 0.3s ease;">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-truck" style="font-size: 3rem; color: #ffc107;"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Register Your Taxi</h5>
                    <p class="text-muted">Join our network of trusted taxis and provide fast, reliable service. Sign up today and help people reach their destinations with ease.</p>
                    <a href="signup/driverSignUp" class="btn btn-warning fw-bold shadow-sm">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Hover effect for interactive feel */
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }
</style>




<!-- Footer -->
<div class="footer py-4" style="background: rgba(0, 0, 0); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); color: #fff; text-align: center;">
    <div class="container">
        <!-- Social Icons -->
        <div class="social-icons mb-3">
            <a href="https://web.facebook.com/profile.php?id=61571632296002" target="_blank" class="mx-3 text-white">
                <i class="fab fa-facebook-f" style="font-size: 1.5rem;"></i>
            </a>
            <a href="https://wa.me/0763487858" target="_blank" class="mx-3 text-white">
                <i class="fab fa-whatsapp" style="font-size: 1.5rem;"></i>
            </a>
        </div>

        <!-- Contact Details -->
        <div class="contact-details mb-3">
            <p>📞 Contact: <a href="tel:+94766917207" class="text-white fw-bold">+94 76 691 7207</a> | ✉ Email: <a href="mailto:sethika7@gmail.com" class="text-white fw-bold">info@promoads.lk</a></p>
        </div>

        <!-- Copyright -->
        <div class="copyright">
            <p class="mb-0">&copy; {{ date('Y') }} PromoAds. All rights reserved.</p>
        </div>
    </div>
</div>

<!-- FontAwesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<style>
    /* Hover effect for social icons */
    .social-icons a:hover {
        transform: scale(1.2);
        transition: transform 0.3s ease;
        color: #32CD32;
        /* Light green hover effect */
    }

    /* Contact link hover effect */
    .contact-details a:hover {
        color: #32CD32;
        /* Light green hover effect */
        transition: color 0.3s ease;
    }
</style>



@endsection