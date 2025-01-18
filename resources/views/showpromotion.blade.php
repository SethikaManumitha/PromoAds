<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/showpromo.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <title>Promo Ads</title>
    <style>
        .category-bar a {
            font-size: 1rem;
            color: #72cd3b;
            margin-bottom: 10px;
            margin-right: 5px;
            text-decoration: none;
        }

        .category-bar a:hover {
            color: rgb(187, 206, 195);
        }
    </style>
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


    @php
    $categories = [
    ['value' => 'Fresh_produce', 'label' => 'Fresh Produce', 'icon' => 'fas fa-lemon'],
    ['value' => 'Meat_seafood', 'label' => 'Meat & Seafood', 'icon' => 'fas fa-fish'],
    ['value' => 'Bakery', 'label' => 'Bakery', 'icon' => 'fas fa-bread-slice'],
    ['value' => 'Grocery', 'label' => 'Grocery', 'icon' => 'fas fa-shopping-bag'],
    ['value' => 'Beverages', 'label' => 'Beverages', 'icon' => 'fas fa-cocktail'],
    ['value' => 'Frozen_foods', 'label' => 'Frozen Foods', 'icon' => 'fas fa-snowflake'],
    ['value' => 'Canned_goods', 'label' => 'Canned Goods', 'icon' => 'fas fa-archive'],
    ['value' => 'Health_beauty', 'label' => 'Health & Beauty', 'icon' => 'fas fa-pills'],
    ['value' => 'Dairy', 'label' => 'Dairy Products', 'icon' => 'fas fa-cheese'],
    ];
    @endphp

    <!-- <div class="category-bar categories desktop">
        <div class="container d-flex justify-content-around flex-wrap">
            @foreach($categories as $category)
            <a href="{{ route('showpromo', ['userId' => $userId, 'category' => $category['value']]) }}">
                <i class="{{ $category['icon'] }}"></i>
                <span style="color:black">{{ $category['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div> -->
    <div id="sideMenu" class="offcanvas">
        <div class="offcanvas-header">
            <h5>Menu</h5>
            <button id="menuClose" class="btn btn-close">&times;</button>
        </div>
        <div class="offcanvas-body">
            <!-- Category Items -->
            <div class="category-bar">
                <div class="d-flex justify-content-start flex-column">


                    @foreach($categories as $category)
                    <a href="{{ route('showpromo', ['userId' => $userId, 'category' => $category['value']]) }}">
                        <i class="{{ $category['icon'] }}"></i>
                        <span style="color:black">{{ $category['label'] }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-5">
        <h2><span class="text-success">{{ $business[0]['business_name'] }}</span> Show Room</h2>

        <div class="row">
            @foreach ($promotions as $promotion)
            @if ($promotion->price != 1)
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card promotion-card">
                    <img class="card-img-top" src="{{ $promotion->image ? asset($promotion->image) : 'https://via.placeholder.com/350x150' }}" alt="Promotion Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $promotion->name }}</h5>



                        @if ($promotion->dis_price == $promotion->price)
                        <h5><span class="card-price">LKR {{ $promotion->price }}</span></h5>
                        @else
                        <span class="card-discount">LKR {{ $promotion->price }}</span>
                        <span class="card-price">LKR {{ $promotion->dis_price }}</span><br>
                        <span class="card-save">
                            SAVE: {{ round((($promotion->price - $promotion->dis_price) / $promotion->price) * 100) }}%
                        </span><br>
                        @endif
                        <small>Offer valid until {{ date('F d, Y', strtotime($promotion->end_date)) }}</small>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('cart.add', $promotion->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>


    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sideMenu = document.getElementById('sideMenu');
        const menuClose = document.getElementById('menuClose');

        menuToggle.addEventListener('click', () => {
            sideMenu.classList.add('show');
        });

        menuClose.addEventListener('click', () => {
            sideMenu.classList.remove('show');
        });

        document.addEventListener('click', (event) => {
            if (!sideMenu.contains(event.target) && !menuToggle.contains(event.target)) {
                sideMenu.classList.remove('show');
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>