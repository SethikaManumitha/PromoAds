<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/showpromo.css') }}">
    <title>Promo Ads</title>
    <style>
        .promotion-card {
            margin-bottom: 15px;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 10px;
        }

        .card-title {
            font-size: 1.2rem;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-text {
            font-size: 0.9rem;
        }

        .card-price {
            font-weight: bold;
            color: #28a745;
        }

        .card-discount {
            color: #dc3545;
            text-decoration: line-through;
        }

        .card-save {
            color: #ffc107;
            font-weight: bold;
        }

        .promotion-card img {
            max-width: 200px;
            max-height: 150px;

        }

        .btn-block {
            font-size: 0.9rem;
            padding: 5px;
        }

        small {
            display: block;
            font-size: 0.8rem;
            color: #6c757d;
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
    ['value' => 'Household_items', 'label' => 'Household Items', 'icon' => 'fas fa-tshirt'],
    ['value' => 'Dairy', 'label' => 'Dairy Products', 'icon' => 'fas fa-cheese'],
    ];
    @endphp


    <!--<div class="category-bar">-->
    <!--    <div class="container d-flex justify-content-around flex-wrap">-->
    <!--        @foreach($categories as $category)-->
    <!--        <div class="category-item">-->
    <!--            <a href="{{ route('showpromo', ['userId' => $userId, 'category' => $category['value']]) }}">-->
    <!--                <i class="{{ $category['icon'] }}"></i>-->
    <!--                <span>{{ $category['label'] }}</span>-->
    <!--            </a>-->
    <!--        </div>-->
    <!--        @endforeach-->
    <!--    </div>-->
    <!--</div>-->
    <div class="container mt-5">
        <div class="row">
            @foreach ($promotions as $promotion)
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card promotion-card">
                    <img class="card-img-top" src="{{ $promotion->image ? asset($promotion->image) : 'https://via.placeholder.com/350x150' }}" alt="Promotion Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $promotion->name }}</h5>

                        <span class="card-discount">LKR {{ $promotion->price }}</span>
                        <span class="card-price">LKR {{ $promotion->dis_price }}</span><br>
                        <span class="card-save">SAVE: {{ ceil((($promotion->price - $promotion->dis_price) / $promotion->price) * 100) }}%</span>
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
            @endforeach
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>