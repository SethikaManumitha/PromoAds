<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    @yield('additional-head')
    @yield('page-css')
    <title>@yield('title', 'Promo Ads')</title>

    <style>
        /* Solid Navbar */
        .solid-navbar {
            background-color: #e9ecef !important;
            transition: background-color 0.3s ease-in-out;
        }

        /* Side Menu Styling */
        .side-menu {
            position: fixed;
            top: 0;
            left: -300px;
            /* Initially hidden */
            width: 300px;
            height: 100%;
            background: #fff;
            box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.2);
            transition: left 0.3s ease-in-out;
            z-index: 1000;
            padding: 20px;
        }

        .side-menu.show {
            left: 0;
            /* Slide in */
        }

        .side-menu .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .side-menu .menu-items {
            margin-top: 50px;
        }

        .side-menu .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        /* Overlay Effect */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: none;
            z-index: 999;
        }

        .overlay.show {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
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
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

                    <!-- Location Dropdown -->
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle btn" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-language"></i> Language
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#" onclick="changeLanguage('en')">
                                English
                            </a>
                            <a class="dropdown-item" href="#" onclick="changeLanguage('si')">
                                සිංහල (Sinhala)
                            </a>
                            <a class="dropdown-item" href="#" onclick="changeLanguage('ta')">
                                தமிழ் (Tamil)
                            </a>

                            <a class="dropdown-item" href="#" onclick="changeLanguage('ru')">
                                Русский (Russian)
                            </a>

                            <a class="dropdown-item" href="#" onclick="changeLanguage('es')">
                                Español (Spanish)
                            </a>
                            <a class="dropdown-item" href="#" onclick="changeLanguage('fr')">
                                Français (French)
                            </a>
                            <a class="dropdown-item" href="#" onclick="changeLanguage('de')">
                                Deutsch (German)
                            </a>
                            <a class="dropdown-item" href="#" onclick="changeLanguage('it')">
                                Italiano (Italian)
                            </a>
                            <a class="dropdown-item" href="#" onclick="changeLanguage('pt')">
                                Português (Portuguese)
                            </a>

                            <!-- Add more languages here as needed -->
                        </div>
                    </li>



                </ul>
            </div>
        </div>
    </nav>




    <!-- Side Menu -->
    <div class="side-menu" id="sideMenu">
        <div class="menu-items">

            <a class="btn btn-success" href="signup/businessSignUp">
                <i class="fas fa-briefcase"></i> Register Your Business
            </a>
            <a class="btn btn-success" href="{{ route('signin') }}">
                <i class="fas fa-user"></i> Log In
            </a>
            <a class="btn btn-success" style="color:white;" id="menuClose">
                <i class="fas fa-times"></i> Close
            </a>



        </div>

    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    @yield('content')

    <!-- JavaScript -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sideMenu = document.getElementById('sideMenu');
        const menuClose = document.getElementById('menuClose');
        const overlay = document.getElementById('overlay');

        // Show Side Menu
        menuToggle.addEventListener('click', () => {
            sideMenu.classList.add('show');
            overlay.classList.add('show');
        });

        // Close Side Menu
        menuClose.addEventListener('click', () => {
            sideMenu.classList.remove('show');
            overlay.classList.remove('show');
        });

        // Close menu when clicking outside
        overlay.addEventListener('click', () => {
            sideMenu.classList.remove('show');
            overlay.classList.remove('show');
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

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