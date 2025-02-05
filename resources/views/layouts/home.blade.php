<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <title>@yield('title', 'Promo Ads')</title>
    @yield('additional-head')
    @yield('page-css')

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GT8C633H8J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GT8C633H8J');
    </script>

    <!-- Custom CSS for Solid Navbar -->
    <style>
        .solid-navbar {
            background-color: #e9ecef !important;
            /* Change to any solid color you prefer */
            transition: background-color 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: rgb(255, 255, 255); box-shadow: none;">
        <div class="container">
            <div class="d-flex d-lg-none align-items-center">
                <button class="btn btn-link d-lg-none" style="font-size: 1.5rem; color: #28a745;" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/" id="appText">Promo<span style="color:rgb(25, 135, 84)">Ads</span></a>
            </div>

            <!-- Navbar Brand for Desktop and larger screens -->
            <a class="navbar-brand d-none d-lg-block" href="/" id="appText">Promo<span style="color:rgb(25, 135, 84)">Ads</span></a>

            <!-- Navbar Items for Larger Screens -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto d-none d-lg-flex align-items-center">
                    <li class="nav-item">
                        <a class="btn btn-success mx-2" href="signup/businessSignUp">
                            <i class="bi bi-briefcase"></i>
                            Register Your Business
                        </a>
                    </li>

                    <a class="btn btn-success mx-2" href="{{ route('signin') }}">
                        <i class="fas fa-user fa-icon icon-user"></i> Log In
                    </a>
                </ul>
            </div>



        </div>
    </nav>


    @yield('content')

    <!-- JavaScript for Offcanvas -->
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

    <!-- Bootstrap JS & dependencies -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Scroll Event to Toggle Navbar Background Color -->
    <script>
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('solid-navbar');
            } else {
                navbar.classList.remove('solid-navbar');
            }
        });
    </script>
</body>

</html>