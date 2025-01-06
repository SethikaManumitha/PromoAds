<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Promo Ads</title>
    <style>
        .promotion-card {
            height: 350px;
            display: flex;
            flex-direction: column;
        }

        .promotion-card img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Promo<span style="color:#72cd3b">Ads</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <form class="d-flex w-50 mx-auto">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="txtsearch" id="txtsearch">
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-heart icon-heart fa-icon"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-shopping-cart fa-icon icon-cart"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-signIn" href="{{ route('signin') }}"><i class="fas fa-user fa-icon icon-user"></i>Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-signUp" href="{{ route('role') }}"><i class="fas fa-user-plus icon-user"></i>Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Category Bar -->
    <div class="category-bar">
        <div class="container d-flex justify-content-around flex-wrap">
            <div class="category-item">
                <i class="fas fa-car"></i>
                <span>Automobile</span>
            </div>
            <div class="category-item">
                <i class="fas fa-heart"></i>
                <span>Beauty & Health</span>
            </div>
            <div class="category-item">
                <i class="fas fa-book"></i>
                <span>Books & Stationery</span>
            </div>
            <div class="category-item">
                <i class="fas fa-tv"></i>
                <span>Electronics</span>
            </div>
            <div class="category-item">
                <i class="fas fa-tshirt"></i>
                <span>Fashion</span>
            </div>
            <div class="category-item">
                <i class="fas fa-couch"></i>
                <span>Furniture</span>
            </div>
            <div class="category-item">
                <i class="fas fa-apple-alt"></i>
                <span>Groceries</span>
            </div>
            <div class="category-item">
                <i class="fas fa-blender"></i>
                <span>Appliances</span>
            </div>
            <div class="category-item">
                <i class="fas fa-tools"></i>
                <span>Services</span>
            </div>
            <div class="category-item">
                <i class="fas fa-star"></i>
                <span>Special Offers</span>
            </div>
            <div class="category-item">
                <i class="fas fa-basketball-ball"></i>
                <span>Sports</span>
            </div>
            <div class="category-item">
                <i class="fas fa-gamepad"></i>
                <span>Toys</span>
            </div>
            <div class="category-item">
                <i class="fas fa-suitcase"></i>
                <span>Travel</span>
            </div>
        </div>
    </div>

    <!-- Promotions Section -->
    <div class="container mt-5">
        <div class="row">
            @foreach($business as $biz)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card promotion-card">
                    <img class="card-img-top" src="{{ $biz->user && $biz->user->profile ? $biz->user->profile : 'https://via.placeholder.com/120' }}" alt="Promotion Image">
                    <div class="card-body">
                        <h4>{{ $biz->user->name }}</h4>
                        <div class="rating">
                            @for($i = 0; $i < 5; $i++)
                                <i class="fas fa-star text-warning"></i>
                                @endfor
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('showpromo', ['userId' => $biz->user->id]) }}" class="btn btn-success btn-block">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS & dependencies -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>