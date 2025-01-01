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
            max-width: 100%;
            max-height: 350px;
            object-fit: cover;
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
            <a class="navbar-brand" href="#">Promo<span style="color:#72cd3b">Ads</span></a>
            <form class="d-flex w-50 mx-auto">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="txtsearch" id="txtsearch">
            </form>
            <ul class="navbar-nav ms-auto">
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
    </nav>
    <div class="row">
        @foreach ($promotions as $promotion)
        <div class="col-md-4">
            <div class="card promotion-card">
                <img class="card-img-top" src="{{ $promotion->image ? asset($promotion->image) : 'https://via.placeholder.com/350x150' }}" alt="Promotion Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $promotion->name }}</h5>
                    <p class="card-text">
                        <b>Category:</b> {{ ucfirst(str_replace('_', ' ', $promotion->category)) }}<br>
                        {{ $promotion->description }}
                    </p>
                    <span class="card-discount">LKR {{ $promotion->price }}</span>
                    <span class="card-price">LKR {{ $promotion->dis_price }}</span><br>
                    <span class="card-save">SAVE: LKR {{ $promotion->price - $promotion->dis_price }}</span>
                    <small>Offer valid until {{ date('F d, Y', strtotime($promotion->end_date)) }}</small>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-success btn-block">Redeem Offer</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>