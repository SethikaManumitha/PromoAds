@extends('layouts.dashboard')

@section('content')

<style>
    .promotion-card {
        margin-bottom: 25px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        height: 450px;
        /* Set a fixed height for all cards */
    }

    .promotion-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        height: 100%;
    }

    .card-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        /* Ensure the content fills the height */
    }

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

    .promotion-card img {
        width: auto;
        height: 150px;
        /* Set image height smaller */
        object-fit: contain;
        /* Ensures image is centered within the defined box */
        display: block;
        margin-left: auto;
        margin-right: auto;
        border-bottom: 4px solid #f5f5f5;
        margin-bottom: 10px;
    }

    .btn-block {
        font-size: 0.85rem;
        padding: 8px;
        width: 100%;
        text-align: center;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.9rem;
        margin-right: 10px;
        /* Space between buttons */
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .row {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .col-md-4 {
        flex: 1 0 30%;
    }

    small {
        display: block;
        font-size: 0.9rem;
        color: #888;
    }

    .promotion-heading {
        margin: 40px 0 20px;
        font-size: 2rem;
        font-weight: bold;
        text-align: center;
        color: #333;
    }

    .buttons-container {
        display: flex;
        justify-content: space-between;
        /* Align buttons on a single line */
        align-items: center;
        /* Vertically center buttons */
    }
</style>

<div class="content">
    <h2 class="promotion-heading">Active <span class="text-success">Promotions</span></h2>

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
                    <br><br>

                    <!-- Add buttons container -->
                    <div class="buttons-container">
                        <a href="{{ route('promo.edit', $promotion) }}" class="btn btn-success btn-sm">Edit Offer</a>
                        <form action="{{ route('promo.destroy', $promotion) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this promotion?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete Offer</button>
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