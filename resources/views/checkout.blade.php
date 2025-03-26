<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e8eceb;
        }

        .container-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .driver-item {
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .driver-item.active {
            background-color: #007bff !important;
            color: white !important;
        }

        .driver-item i {
            font-size: 24px;
            margin-right: 15px;
            color: #007bff;
        }

        #paymentError {
            display: none;
            color: red;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row g-4">
            <!-- Delivery Information -->
            <div class="col-md-8 container-info">
                <h3 class="mb-3">Delivery Information</h3>
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('checkout.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('fullName') is-invalid @enderror" id="fullName" name="fullName" value="{{ old('fullName') }}" required>
                        @error('fullName')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
                        @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Driver Selection -->
                    <h4 class="mt-4">Select a Driver</h4>
                    <ul class="list-group" id="driverList">
                        @foreach($drivers as $driver)
                        <li class="list-group-item d-flex align-items-center driver-item" data-driver-id="{{ $driver->NIC }}">
                            @php
                            $icon = '';
                            switch ($driver->vehicle_type) {
                            case 'Three_wheeler':
                            $icon = 'fas fa-truck';
                            break;
                            case 'Car':
                            $icon = 'fas fa-car';
                            break;
                            case 'Van':
                            $icon = 'fas fa-van-shuttle';
                            break;
                            case 'Truck':
                            $icon = 'fas fa-truck';
                            break;
                            case 'Bike':
                            $icon = 'fas fa-motorcycle';
                            break;
                            default:
                            $icon = 'fas fa-question';
                            break;
                            }
                            @endphp
                            <i class="{{ $icon }}"></i>
                            <div>
                                <strong>{{ $driver->name }}</strong><br>
                                <small class="text-muted">Contact: {{$driver->phone}}</small><br>
                                <small class="text-muted">Rating: ⭐ 5</small>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <input type="hidden" id="selectedDriverId" name="driver_id">
                    <div class="mb-3">
                        <input type="hidden" name="total" value="{{ session('cart_total') }}">
                        @error('total')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" mt-4 mb-3 form-group d-flex align-items-center">
                        <i class="fas fa-credit-card" style="font-size: 24px; margin-right: 10px;"></i>
                        <select class="form-select @error('payment_method') is-invalid @enderror" id="paymentMethod" name="payment_method">
                            <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Cash on Delivery</option>
                            <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Credit/Debit Card</option>
                        </select>
                        @error('payment_method')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small id="paymentError">The current business does not support Credit/Debit Card payments.</small>

                    <button type="submit" class="btn btn-success w-100">Proceed to Checkout</button>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="col-md-4 container-info">
                <h3 class="mb-3">Order Summary</h3>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Subtotal</span>
                        <strong>LKR.{{ number_format(session('cart_total'), 2) }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Shipping</span>
                        <strong>LKR.0.00</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong>LKR.{{ number_format(session('cart_total'), 2) }}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Payment Method Error Handling
        document.getElementById("paymentMethod").addEventListener("change", function() {
            let errorText = document.getElementById("paymentError");
            if (this.value === "card") {
                errorText.style.display = "block";
            } else {
                errorText.style.display = "none";
            }
        });

        // Driver Selection Logic
        document.addEventListener("DOMContentLoaded", function() {
            let driverItems = document.querySelectorAll(".driver-item");

            driverItems.forEach(item => {
                item.addEventListener("click", function() {
                    driverItems.forEach(el => el.classList.remove("active"));
                    this.classList.add("active");

                    let driverId = this.getAttribute("data-driver-id");
                    document.getElementById("selectedDriverId").value = driverId;
                });
            });

            // Check if driver is selected when submitting
            document.querySelector('form').addEventListener('submit', function(event) {
                if (!document.getElementById("selectedDriverId").value) {
                    alert("Please select a driver.");
                    event.preventDefault();
                }
            });
        });
    </script>

</body>

</html>