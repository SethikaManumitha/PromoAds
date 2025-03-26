@extends('layouts.home')

@section('page-css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{asset('css/showroom.css')}}">
@endsection

@section('content')
<section class="section-products" id="featured-product">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-8 col-lg-6">

            </div>
        </div>
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
                            <li>
                                <a href="javascript:void(0);" class="cart-image"
                                    data-image="{{ $promotion['image'] ? asset($promotion['image']) : 'https://via.placeholder.com/250x150' }}"
                                    data-id="{{ $promotion['id'] }}"
                                    data-title="{{ $promotion['name'] }}"
                                    data-price="{{ $promotion['dis_price'] }}"
                                    data-category="{{ $promotion['category'] }}">
                                    <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                                </a>
                            </li>

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