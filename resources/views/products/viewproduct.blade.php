@extends('layouts.dashboard')

@section('content')
<style>
    .card-title {
        font-size: 1.4rem;
        margin-bottom: 10px;
        font-weight: bold;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-text {
        font-size: 1rem;
        color: #555;
    }

    .card-price {
        font-weight: 600;
        color: #28a745;
        font-size: 1.2rem;
    }

    .card-discount {
        color: #dc3545;
        font-size: 1.1rem;
        text-decoration: line-through;
        margin-right: 10px;
    }

    .card-save {
        color: #ffc107;
        font-weight: bold;
        font-size: 1rem;
    }
</style>
<div class="content">
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('addproduct') }}" class="btn btn-success w-100">Add New Product</a>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Product Name...">
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($products as $promotion)
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
                    <span class="card-price">LKR {{ $promotion->special_price }}</span><br>
                    <span class="card-save">Discount Given: LKR {{ $promotion->price - $promotion->special_price }}</span>
                    <br><br>

                    <!-- Add buttons container -->
                    <div class="buttons-container">
                        <a href="{{ route('promo.edit', $promotion) }}" class="btn btn-success w-100" style="margin-bottom: 10px;">Edit Offer</a>
                        <form action="{{ route('promo.destroy', $promotion) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this promotion?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">Delete Offer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    const shareToFacebook = async (title, description, imageUrl) => {
        const accessToken = 'YOUR_FACEBOOK_ACCESS_TOKEN';
        const pageId = 'YOUR_PAGE_ID';
        const postEndpoint = `https://graph.facebook.com/v16.0/${pageId}/photos`;

        try {
            const response = await fetch(postEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    url: imageUrl,
                    message: `🌟 ${title} 🌟\n\n${description}`,
                    published: true,
                    access_token: accessToken
                })
            });

            const data = await response.json();
            if (response.ok) {
                alert('Promotion shared successfully!');
            } else {
                throw new Error(data.error.message || 'Failed to share promotion.');
            }
        } catch (error) {
            console.error('Error sharing promotion:', error);
            alert('An error occurred while sharing the promotion.');
        }
    };
</script>

@endsection