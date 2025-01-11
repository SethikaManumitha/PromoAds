<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Promotion</title>
    <style>
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            color: white;
        }

        .sidebar a {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        /* Hide sidebar on smaller screens, show in navbar */
        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
            }

            .navbar-nav {
                display: flex;
                flex-direction: column;
                width: 100%;
            }

            .navbar-nav .nav-item {
                text-align: left;
            }
        }

        /* For larger screens, sidebar remains visible */
        @media (min-width: 992px) {
            .sidebar {
                display: block;
            }

            .navbar-nav .nav-item {
                display: none;
            }
        }

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
            max-height: 150px;
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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Business Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
                <!-- Sidebar Links for Small Screens -->
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.businessDashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('getqr') }}">QR Code</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('addpromo') }}">Add Promotions</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('viewpromo') }}">View Promotions</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Analytics</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Log Out</a></li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <h5 class="text-center">Menu</h5>
        <a href="{{ route('admin.businessDashboard') }}">Dashboard</a>
        <a href="{{ route('getqr') }}">QR Code</a>
        <a href="{{ route('addpromo') }}">Add Promotions</a>
        <a href="{{ route('viewpromo') }}">View Promotions</a>
        <a href="#">Analytics</a>
        <a href="#">Users</a>
        <a href="#">Settings</a>
        <a href="{{ route('login') }}">Log Out</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h2 class="text-center">Active <span class="text-success">Promotions</span></h2>

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
                            <div class="col-md-6">
                                <a href="{{ route('promo.edit', $promotion) }}" class="btn btn-success btn-block">Edit Offer</a>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('promo.destroy', $promotion) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this promotion?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block">Delete Offer</button>
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