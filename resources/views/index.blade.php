@extends('layouts.home')


@section('page-css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')


@php
$categories = [
['value' => 'Groceries', 'label' => 'Groceries', 'icon' => 'fas fa-apple-alt'],
['value' => 'Clothing', 'label' => 'Clothing', 'icon' => 'fas fa-tshirt'],
['value' => 'Cosmetic', 'label' => 'Cosmetic', 'icon' => 'fas fa-paint-brush'],
['value' => 'Electronics', 'label' => 'Electronics', 'icon' => 'fas fa-tv'],
['value' => 'Furniture', 'label' => 'Furniture', 'icon' => 'fas fa-couch'],
['value' => 'Restaurant', 'label' => 'Restaurant', 'icon' => 'fas fa-utensils'],
['value' => 'Cakes', 'label' => 'Cakes', 'icon' => 'fas fa-birthday-cake'],
['value' => 'Taxi', 'label' => 'Taxi', 'icon' => 'fas fa-taxi'],
['value' => 'Travel', 'label' => 'Travel', 'icon' => 'fas fa-plane'],
['value' => 'Hotels_villa', 'label' => 'Hotel & Villa', 'icon' => 'fas fa-building'],
['value' => 'Books_stationary', 'label' => 'Books & Stationary', 'icon' => 'fas fa-book'],

];
@endphp

<div class="categories desktop">
    @foreach($categories as $category)
    <div class="category-item-desktop">
        <!-- Added an anchor link for smooth scroll -->
        <a href="{{ route('index') }}?business_type={{ $category['value'] }}#business-section" class="category-toggle" style="text-decoration: none;">
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
                    <a href="{{ route('index') }}?business_type={{ $category['value'] }}" class="category-toggle" style="text-decoration: none;">
                        <i class="{{ $category['icon'] }}"></i>
                        <span>{{ $category['label'] }}</span>
                    </a>
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

<div class="container mt-5" id="business-section">
    <h2>Shops in <span style="color:#72cd3b">Hikkaduwa</span></h2>
    <br>
    <!-- Promotions Section -->
    <div class="row">
        @foreach($business as $biz)
        @if ($biz->user->status != 0) <!-- Only show the promotion if the status is not 0 -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card promotion-card h-100 d-flex flex-column">
                <img class="card-img-top" src="{{ $biz->user && $biz->user->profile ? $biz->user->profile : 'https://via.placeholder.com/120' }}" alt="Promotion Image">
                <div class="card-body d-flex flex-column">
                    <h5>{{ $biz->user->name }}</h5>
                    <small>{{ Str::limit($biz->description, 100, '...') }}</small>
                    <div class="mt-auto">
                        <form action="{{ route('showpromo', ['userId' => $biz->id]) }}" method="GET">
                            <button type="submit" class="btn btn-success btn-block"
                                @if ($biz->user->status == 2)
                                disabled title="This shop is locked"
                                @endif>
                                @if ($biz->user->status == 2)
                                <i class="fas fa-lock"></i>
                                @endif
                                Shop Now
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
                        <!--  -->
                        <a href="{{ route('promotions.view', $promotion->id) }}" class="btn btn-success btn-block">View Promotion</a>

                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection