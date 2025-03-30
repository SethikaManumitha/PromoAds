@extends('layouts.dashboard')

@section('content')
<style>
    body {
        background-color: #f5f5f5;
    }

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

    .dashboard {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .kpi-cards {
        display: flex;
        gap: 20px;
        margin: 20px;
    }

    .card {
        flex: 1;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
    }

    .card h4 {
        font-size: 18px;
        color: #333333;
        margin-bottom: 10px;
    }

    .card .value {
        font-size: 24px;
        font-weight: bold;
        color: #4caf50;
    }
</style>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Welcome <span class="text-success">{!! session('user_name') !!}</span></h1>
            </div>
        </div>

        <div class="kpi-cards">
            <div class="card">
                <h4>Total Page Views</h4>
                <p class="value" id="totalPageViews">{{ number_format($totalViews) }}</p>
            </div>

            <div class="card">
                <h4>Unique Visitors</h4>
                <p class="value" id="uniqueVisitors">{{ number_format($uniqueVisitorsCount) }}</p>
            </div>

            <div class="card">
                <h4>Engagement Rate</h4>
                <p class="value" id="engagementRate">60%</p>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Potential Loyalty Customer</th>
                    <th>Number of Items Purchased</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groupedCarts as $userId => $promotions)
                @foreach ($promotions as $promotionGroup)
                <tr>
                    <td>{{ $promotionGroup['user']->name }}</td>
                    <td>{{ $promotionGroup['total_quantity'] }}</td>
                    <td>
                        <form action="{{ route('notifications.send', $promotionGroup['user']->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Send Request</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>

        <!-- Chart Canvas -->
        <div class="row">
            <div class="col-md-6">
                <h2><span class="text-success">Sales</span> Chart</h2>
                <canvas id="salesChart" style="max-width: 400px; max-height: 350px;"></canvas>

            </div>
            <div class="col-md-6">
                <h2><span class="text-success">Customer Retention</span> Rate</h2>
                <canvas id="retentionRateChart" style="max-width: 400px; max-height: 350px;"></canvas>
            </div>
        </div>

        <br>
        <h2><span class="text-success">Top</span> Products</h2>


        <div class="row">
            @foreach ($topProducts as $cartItem)
            @php
            $promotion = $cartItem->promotion;
            @endphp
            @if ($promotion)
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
                        <small>Offer valid until {{ date('F d, Y', strtotime($promotion->end_date)) }}</small><br>
                        <small>Sold Quantity: {{ $cartItem->total_quantity }}</small>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>


        <br>

        @php
        use Illuminate\Support\Str;
        @endphp

        @if(count($recommendedShops) > 0)
        <div class="recommended-shops">
            <h2><span class="text-success">Similar</span> Shops</h2>
            <div class="row">
                @foreach ($recommendedShops as $shop)
                <div class="col-md-4">
                    <div class="card promotion-card">
                        <!-- Display Shop Image -->
                        <img src="{{ $shop['image_url'] ? asset($shop['image_url']) : 'https://placehold.co/600x400' }}"
                            class="card-img-top"
                            alt="{{ $shop['business_name'] }}"
                            style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="card-title">{{ $shop['business_name'] }}</h5>

                            <!-- Display Business Type -->
                            <p class="card-text">
                                <b>Business Type:</b> {{ $shop['business_type'] }}
                            </p>

                            <!-- Display Business Description with Limit -->
                            <p class="card-text">
                                <b>Description:</b> {{ Str::limit($shop['description'], 100, '...') }}
                            </p>

                            <!-- Add buttons container -->
                            <div class="buttons-container">
                                <a href="{{ url('/showpromo/' . $shop['id']) }}" class="btn btn-success w-100" style="margin-bottom: 10px;">Visit Shop</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <p class="text-muted">No recommendations available.</p>
        @endif





        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById('salesChart').getContext('2d');

                // PHP data passed to JavaScript
                const monthlyOrderCounts = @json($monthlyOrderCounts);

                // Prepare the data array for the chart
                const orderData = [
                    monthlyOrderCounts['Jan'],
                    monthlyOrderCounts['Feb'],
                    monthlyOrderCounts['Mar'],
                    monthlyOrderCounts['Apr'],
                    monthlyOrderCounts['May'],
                    monthlyOrderCounts['Jun'],
                    monthlyOrderCounts['Jul'],
                    monthlyOrderCounts['Aug'],
                    monthlyOrderCounts['Sep'],
                    monthlyOrderCounts['Oct'],
                    monthlyOrderCounts['Nov'],
                    monthlyOrderCounts['Dec']
                ];

                const salesChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Orders Received',
                            data: orderData, // Dynamic data for orders per month
                            borderColor: 'blue',
                            borderWidth: 2,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            });
        </script>


        <script>
            const ctx = document.getElementById('retentionRateChart').getContext('2d');
            const retentionRateChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Retained Customers', 'Lost Customers'], // Labels for retention and churn
                    datasets: [{
                        label: 'Customer Retention',
                        data: [20, 80],
                        backgroundColor: ['#4caf50', '#f44336'], // Green for retained, red for lost
                        borderColor: ['#4caf50', '#f44336'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    let percentage = tooltipItem.raw;
                                    return tooltipItem.label + ': ' + percentage + '%';
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </div>
</div>
@endsection