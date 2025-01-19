<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Business Dashboard</title>
    <style>
        .sidebar {
            height: 100vh;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            color: white;
            display: none;
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
            margin-left: 220px;
            padding: 20px;
        }

        @media (min-width: 768px) {
            .sidebar {
                display: block;
            }

            .content {
                margin-left: 220px;
            }
        }

        @media (max-width: 767.98px) {
            .content {
                margin-left: 0;
            }
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.profile') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>

                <!-- Sidebar Links in Dropdown for Mobile -->
                <li class="nav-item dropdown d-block d-md-none">
                    <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="menuDropdown">
                        <a class="dropdown-item" href="#">Dashboard</a>
                        <a class="dropdown-item" href="{{ route('getqr') }}">QR Code</a>
                        <a class="dropdown-item" href="{{ route('addpromo') }}">Add Promotions</a>
                        <a class="dropdown-item" href="{{ route('viewpromo') }}">View Promotions</a>
                        <a class="dropdown-item" href="#">Analytics</a>
                        <a class="dropdown-item" href="#">Users</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="{{ route('login') }}">Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar d-none d-md-block">
        <h5 class="text-center">Menu</h5>
        <a href="#">Dashboard</a>
        <a href="{{ route('getqr') }}">QR Code</a>
        <a href="{{ route('addpromo') }}">Add Promotions</a>
        <a href="{{ route('viewpromo') }}">View Promotions</a>
        <a href="{{ route('login') }}">Log Out</a>
    </div>

    @yield('content')

    <!-- Content -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>