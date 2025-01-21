@extends('layouts.home')

@section('page-css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
<div class="container my-5">

    <!-- Promotion Details Section -->
    <div class="row">
        <!-- Promotion Image Section -->
        <div class="col-md-4 text-center">
            <img class="img-fluid" src="{{ $promotion->image ? asset($promotion->image) : 'https://via.placeholder.com/350x150' }}" alt="Promotion Image">
        </div>

        <!-- Promotion Description Section -->
        <div class="col-md-8">
            <h3>{{ $promotion->name }}</h3>
            <p><strong>Price:</strong> LKR {{ number_format($promotion->price, 2) }}</p>
            @if ($promotion->dis_price)
            <p><strong>Discounted Price:</strong> LKR {{ number_format($promotion->dis_price, 2) }}</p>
            <p><strong>You Save:</strong> LKR {{ number_format($promotion->price - $promotion->dis_price, 2) }}</p>
            @endif
            <p>{{ $promotion->description }}</p>
            <p><strong>Category:</strong> {{ $promotion->category }}</p>

            @if($feedbacks->isEmpty())
            <p>No reviews yet. Be the first to leave a review!</p>
            @else
            <!-- Display Average Rating -->
            <div class="mb-3">
                <strong>Average Rating:</strong>
                <div class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= round($averageRating) ? 'text-warning' : 'text-muted' }}"></i>
                        @endfor
                        ({{ round($averageRating, 1) }})
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons Section -->
    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <!-- WhatsApp Share Button -->
            <button class="btn btn-info w-100" id="whatsappShare">
                <i class="fas fa-share-alt"></i> Share on WhatsApp
            </button>
        </div>
        <div class="col-md-6">
            <form action="{{ route('cart.add', $promotion->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success w-100">
                    <i class="fas fa-cart-plus"></i> Add to Cart
                </button>
            </form>
        </div>
    </div>

    <!-- Feedback Section -->
    <div class="mt-5">
        <h4>Customer Reviews</h4>

        @if($feedbacks->isEmpty())
        <p>No reviews yet. Be the first to leave a review!</p>
        @else
        <!-- Display Existing Reviews -->
        <div class="reviews-list">
            @foreach ($feedbacks as $feedback)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $feedback->users ? $feedback->users->name : 'Anonymous' }}</h5>
                    <div class="rating mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                    </div>
                    <p class="card-text">{{ $feedback->comment }}</p>
                    <p class="text-muted">{{ $feedback->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Add Feedback Form Section -->
    <div class="mt-5">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="border p-3 rounded shadow-sm">
            <h5>Add Your Review</h5>
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf
                <input type="hidden" name="promotion_id" value="{{ $promotion->id }}">
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select name="rating" id="rating" class="form-control" required>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Your Review</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Submit Review</button>
            </form>
        </div>
    </div>

</div>

<script>
    document.getElementById('whatsappShare').addEventListener('click', function() {
        const productID = "{{ $promotion->id }}";
        const productName = "{{ $promotion->name }}";
        const productDescription = "{{ $promotion->description }}";
        const originalPrice = "{{ $promotion->price }}";
        const discountedPrice = "{{ $promotion->dis_price }}";
        const amountSaved = originalPrice - discountedPrice;
        const endDate = "{{ $promotion->end_date }}";
        const businessName = "{{ $business->business_name }}";

        const message = encodeURIComponent(
            `🌟 Limited-Time Offer from *${businessName}* 🌟\n\n` +
            `🔥 *${productName}* 🔥\n` +
            `💰 Price: ~LKR ${originalPrice}~ LKR ${discountedPrice}\n` +
            `🛒 You Save: LKR ${amountSaved}!\n\n` +
            `📅 Hurry! Offer valid until: ${endDate}\n\n` +
            `👉 Check it out here: https://promoads.lk/promotions/getpromotions/${productID}\n\n` +
            `*Don't miss this amazing deal!*`
        );

        const whatsappURL = `https://api.whatsapp.com/send?text=${message}`;
        window.open(whatsappURL, '_blank');
    });
</script>

@endsection