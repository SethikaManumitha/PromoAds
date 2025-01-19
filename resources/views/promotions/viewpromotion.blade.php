@extends('layouts.dashboard')

@section('content')

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
@endsection