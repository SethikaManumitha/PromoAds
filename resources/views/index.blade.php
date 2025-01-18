<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <title>Promo Ads</title>
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
    ['value' => 'Groceries', 'label' => 'Groceries', 'icon' => 'fas fa-apple-alt'],
    ['value' => 'Clothing', 'label' => 'Clothing', 'icon' => 'fas fa-tshirt'],
    ['value' => 'Fashion_accessories', 'label' => 'Fashion', 'icon' => 'fas fa-glasses'],
    ['value' => 'Electronics', 'label' => 'Electronics', 'icon' => 'fas fa-tv'],
    ['value' => 'Furniture', 'label' => 'Furniture', 'icon' => 'fas fa-couch'],
    ['value' => 'Home_appliances', 'label' => 'Home Appliances', 'icon' => 'fas fa-blender'],
    ['value' => 'Toys_gifts', 'label' => 'Toys & Gifts', 'icon' => 'fas fa-gamepad'],
    ['value' => 'Taxi', 'label' => 'Taxi', 'icon' => 'fas fa-taxi'],
    ['value' => 'Real_estate', 'label' => 'Real Estate', 'icon' => 'fas fa-building'],
    ['value' => 'Books_stationary', 'label' => 'Books & Stationary', 'icon' => 'fas fa-book'],
    ['value' => 'Automobile', 'label' => 'Automobile', 'icon' => 'fas fa-cogs'],

    ];
    @endphp



    <div class="categories desktop">
        @foreach($categories as $category)
        <div class="category-item-desktop">
            <a href="#" class="category-toggle">
                <i class="{{ $category['icon'] }}"></i>
                <span>{{ $category['label'] }}</span>
            </a>

        </div>
        @endforeach
    </div>



    <!-- Offcanvas Menu -->
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
                    <div class="category-item">
                        <i class="{{ $category['icon'] }}"></i>
                        <span>{{ $category['label'] }}</span>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>


    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <!-- Carousel Indicators -->
        <ol class="carousel-indicators">
            @foreach ($promotions as $index => $promotion)
            @php
            $save = round((($promotion->price - $promotion->dis_price) / $promotion->price) * 100);
            @endphp

            @if ($save >= 90)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
            @endif
            @endforeach
        </ol>

        <!-- Carousel Inner -->
        <div class="carousel-inner">
            @foreach ($promotions as $index => $promotion)
            @php
            $save = round((($promotion->price - $promotion->dis_price) / $promotion->price) * 100);
            @endphp

            @if ($save >= 90)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img class="d-block w-100" src="{{ $promotion->image ? asset($promotion->image) : 'https://via.placeholder.com/350x150' }}" alt="Promotion Image">
            </div>
            @endif
            @endforeach
        </div>

        <!-- Carousel Controls -->
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container mt-5">
        <h2>Shops in <span style="color:#72cd3b">Hikkaduwa</span></h2>
        <br>
        <!-- Promotions Section -->
        <div class="row">
            @foreach($business as $biz)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card promotion-card h-100 d-flex flex-column">
                    <img class="card-img-top" src="{{ $biz->user && $biz->user->profile ? $biz->user->profile : 'https://via.placeholder.com/120' }}" alt="Promotion Image">
                    <div class="card-body d-flex flex-column">
                        <h5>
                            {{ $biz->user->name }}

                        </h5>
                        <small>{{ Str::limit($biz->description, 100, '...') }}</small>
                        <!-- Spacer to push content above the button -->
                        <div class="mt-auto">
                            <form action="{{ route('showpromo', ['userId' => $biz->id]) }}" method="GET">
                                <button
                                    type="submit"
                                    class="btn btn-success btn-block"
                                    @if (!$loop->first)
                                    disabled
                                    title="This shop is locked"
                                    @endif>
                                    @if (!$loop->first) <!-- Lock icon for disabled buttons -->
                                    <i class="fas fa-lock"></i>
                                    @endif
                                    Shop Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>



    <div class="container mt-5">
        <h2>Recommended <span class="text-success">Offers</span></h2>
        <br>
        <div class="row">
            @foreach ($promotions as $promotion)
            @if ($promotion->price != 1)
            <div class="col-md-3 col-sm-6 col-6">
                <div class="card promotion-card">
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
                            <form action="{{ route('cart.add', $promotion->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-block">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>


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
</body>

</html>