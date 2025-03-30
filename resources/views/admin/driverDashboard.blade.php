@extends('layouts.driverdashboard')

@section('content')
<div class="content">
    <div class="container">
        <!-- Welcome Header -->
        <div class="row">
            <div class="col-md-12">
                <h1>Welcome, <span class="text-success">{!! session('user_name') !!}</span></h1>
            </div>
        </div>

        <!-- Analytics Cards -->
        <div class="row mt-4">
            <!-- Total Earnings -->
            <div class="col-md-4">
                <div class="card shadow-sm p-3 text-center">
                    <h5>Total Earnings</h5>
                    <h2 class="text-success">LKR 1,000</h2>
                </div>
            </div>

            <!-- Completed Rides -->
            <div class="col-md-4">
                <div class="card shadow-sm p-3 text-center">
                    <h5>Completed Rides</h5>
                    <h2 class="text-primary">5</h2>
                </div>
            </div>

            <!-- Average Rating -->
            <div class="col-md-4">
                <div class="card shadow-sm p-3 text-center">
                    <h5>Average Rating</h5>
                    <h2 class="text-warning">4.5 ⭐</h2>
                </div>
            </div>


        </div>

        <!-- Charts Section -->
        <div class="row mt-4">
            <!-- Monthly Earnings Chart -->
            <div class="col-md-6">
                <div class="card shadow-sm p-3">
                    <h5 class="text-center">Monthly Earnings</h5>
                    <canvas id="earningsChart" style="max-width: 100%; max-height: 400px;"></canvas>
                </div>
            </div>

            <!-- Ride Activity Chart -->
            <div class="col-md-6">
                <div class="card shadow-sm p-3">
                    <h5 class="text-center">Ride Activity</h5>
                    <canvas id="ridesChart" style="max-width: 100%; max-height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Dummy data for charts
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var monthlyEarnings = [200, 500, 0, 300, 0, 0, 0, 0, 0, 0, 0, 0];
    var monthlyRides = [1, 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0];

    // Monthly Earnings Chart (Line Chart)
    var earningsChart = new Chart(document.getElementById("earningsChart"), {
        type: "line",
        data: {
            labels: months,
            datasets: [{
                label: "Earnings (LKR)",
                data: monthlyEarnings,
                backgroundColor: "rgba(0, 128, 0, 0.2)",
                borderColor: "green",
                borderWidth: 2,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // Ride Activity Chart (Bar Chart)
    var ridesChart = new Chart(document.getElementById("ridesChart"), {
        type: "bar",
        data: {
            labels: months,
            datasets: [{
                label: "Completed Rides",
                data: monthlyRides,
                backgroundColor: "rgba(0, 0, 255, 0.2)",
                borderColor: "blue",
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>
@endsection