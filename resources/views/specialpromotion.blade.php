@extends('layouts.home')

@section('page-css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/showroom.css')}}">
@endsection

@section('content')
<section class="section-products" id="featured-product">
    <div class="container">


        <h2>Recommended Promotions</h2>
        <div class="row" style="background-color: #ccc;padding:20px">
            @foreach ($recommendedPromotions['recommendations'] as $key => $promotion)
            @php
            $discountPercentage = round((($promotion['price'] - $promotion['dis_price']) / $promotion['price']) * 100);
            @endphp

            <div class="col-md-3 col-lg-4 col-xl-3">
                <div id="product-{{ $key + 1 }}" class="single-product" style="background-color: white;">
                    <div class="part-1" style="background: url('{{ $promotion['image'] ? asset($promotion['image']) : 'https://via.placeholder.com/250x150' }}') no-repeat center; background-size: contain; transition: all 0.3s;">
                        <span class="discount">{{ $discountPercentage }}% off</span>
                        <ul>


                            <!-- WhatsApp Link -->
                            <li>
                                <a href="{{ route('promotions.view', ['promotion_id' => $promotion['id']]) }}">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>

                            <!-- Facebook Link -->
                            <li>
                                <a href="{{ route('promotions.view', ['promotion_id' => $promotion['id']]) }}">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="part-2">
                        <h3 class="product-title">{{ $promotion['name'] }}</h3>
                        <h4 class="product-old-price">LKR {{ $promotion['price'] }}</h4>
                        <h4 class="product-price">LKR {{ $promotion['dis_price'] }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <br>
        <h2>Top Promotions</h2>

        <div class="row" style="background-color: #ccc;padding:20px">
            @foreach ($toppromotions as $key => $promotion)
            <div class="col-md-6 col-lg-4 col-xl-3" style="background-color: white;">
                <div id="product-{{ $key + 1 }}" class="single-product">
                    <div class="part-1" style="background: url('{{ $promotion['image'] ? asset($promotion['image']) : 'https://via.placeholder.com/250x150' }}') no-repeat center; background-size: contain; transition: all 0.3s;">
                        <span class="discount">{{ $discountPercentage }}% off</span>
                        <ul>

                            <!-- WhatsApp Link -->
                            <li>
                                <a href="{{ route('promotions.view', ['promotion_id' => $promotion['id']]) }}">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>

                            <!-- Facebook Link -->
                            <li>
                                <a href="{{ route('promotions.view', ['promotion_id' => $promotion['id']]) }}">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="part-2">
                        <h3 class="product-title">{{ $promotion['name'] }}</h3>
                        <h4 class="product-old-price">LKR {{ $promotion['price'] }}</h4>
                        <h4 class="product-price">LKR {{ $promotion['dis_price'] }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <br>
        <h2>All Promotions</h2>

        <!-- Regular Promotions Section -->
        <div class="row">
            @foreach ($promotions as $key => $promotion)
            @php
            $discountPercentage = round((($promotion['price'] - $promotion['dis_price']) / $promotion['price']) * 100);
            @endphp

            @if ($discountPercentage > 5) <!-- Show only if discount is greater than 5% -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div id="product-{{ $key + 1 }}" class="single-product">
                    <div class="part-1" style="background: url('{{ $promotion['image'] ? asset($promotion['image']) : 'https://via.placeholder.com/250x150' }}') no-repeat center; background-size: contain; transition: all 0.3s;">
                        <span class="discount">{{ $discountPercentage }}% off</span>
                        <ul>


                            <!-- WhatsApp Link -->
                            <li>
                                <a href="{{ route('promotions.view', ['promotion_id' => $promotion['id']]) }}">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>

                            <!-- Facebook Link -->
                            <li>
                                <a href="{{ route('promotions.view', ['promotion_id' => $promotion['id']]) }}">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="part-2">
                        <h3 class="product-title">{{ $promotion['name'] }}</h3>
                        <h4 class="product-old-price">LKR {{ $promotion['price'] }}</h4>
                        <h4 class="product-price">LKR {{ $promotion['dis_price'] }}</h4>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endsection