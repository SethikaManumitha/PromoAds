@extends('layouts.dashboard')

@section('content')
<style>
    body {
        background-color: #f5f5f5;
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
                        <!-- Send Request Button -->
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
    </div>
</div>
@endsection