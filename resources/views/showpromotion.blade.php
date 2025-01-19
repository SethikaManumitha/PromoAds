@extends('layouts.home')


@section('page-css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @php $indicatorIndex = 0; @endphp
        @foreach ($promotions as $promotion)
        @php
        $save = round((($promotion->price - $promotion->dis_price) / $promotion->price) * 100);
        @endphp
        @if ($save >= 90)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $indicatorIndex }}" class="{{ $indicatorIndex === 0 ? 'active' : '' }}"></li>
        @php $indicatorIndex++; @endphp
        @endif
        @endforeach
    </ol>
    <div class="carousel-inner">
        @php $itemIndex = 0; @endphp
        @foreach ($promotions as $promotion)
        @php
        $save = round((($promotion->price - $promotion->dis_price) / $promotion->price) * 100);
        @endphp
        @if ($save >= 90)
        <div class="carousel-item {{ $itemIndex === 0 ? 'active' : '' }}">
            <img class="d-block w-100" src="{{ $promotion->image ? asset($promotion->image) : 'https://via.placeholder.com/350x150' }}" alt="Promotion Image">
        </div>
        @php $itemIndex++; @endphp
        @endif
        @endforeach
    </div>
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
    <h2><span class="text-success">{{ $business[0]['business_name'] }}</span> Show Room</h2>

    <div class="row">
        @foreach ($promotions as $promotion)
        @if ($promotion->price != 1)
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card promotion-card">
                <img class="card-img-top" src="{{ $promotion->image ? asset($promotion->image) : 'https://via.placeholder.com/350x150' }}" alt="Promotion Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $promotion->name }}</h5>



                    @if ($promotion->dis_price == $promotion->price)
                    <h5><span class="card-price">LKR {{ $promotion->price }}</span></h5>
                    @else
                    <span class="card-discount">LKR {{ $promotion->price }}</span>
                    <span class="card-price">LKR {{ $promotion->dis_price }}</span><br>
                    <span class="card-save">
                        SAVE: {{ round((($promotion->price - $promotion->dis_price) / $promotion->price) * 100) }}%
                    </span><br>
                    @endif
                    <small>Offer valid until {{ date('F d, Y', strtotime($promotion->end_date)) }}</small>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <form action="{{ route('cart.add', $promotion->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block">Add to Cart</button>
                                </form> -->
                            <form action="{{ route('promotions.view', ['promotion_id' => $promotion->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-block">View Deal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection