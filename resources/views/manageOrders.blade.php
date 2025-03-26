@extends('layouts.dashboard')

@section('content')

<div class="content">
    <div class="container">
        <h2 class="mb-4">Orders</h2>

        @if($orders->isEmpty())
        <p>No orders availabl e.</p>
        @else
        <ul class="list-group">
            @foreach ($orders as $order)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Customer:</strong> {{ $order->fullname }} <br>
                        <strong>Address:</strong> {{ $order->address }}, {{ $order->city }} <br>
                        <strong>Phone:</strong> {{ $order->phone }} <br>
                    </div>
                    <div class="col-md-6">
                        <strong>Business Status:</strong> {{ $order->business_status }} <br>
                        <strong>Driver Status:</strong> {{ $order->driver_status }} <br>
                        <strong>Total:</strong> LKR {{ number_format($order->total, 2) }} <br>
                        <strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }} <br>
                    </div>
                </div>



                <!-- Order Items Table -->
                <div class="table-responsive mt-2">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Price (LKR)</th>
                                <th>Quantity</th>
                                <th>Subtotal (LKR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->product->name ?? 'N/A' }}</td>
                                <td>{{ number_format($item->product->price ?? 0, 2) }}</td>
                                <td>{{ $item->quantity ?? 1 }}</td>
                                <td>{{ number_format(($item->product->price ?? 0) * ($item->quantity ?? 1), 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <!-- Cancel Order Button -->
                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">Cancel Order</button>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <!-- Prepare Order Button -->
                        <form action="{{ route('orders.prepare', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">Prepare Order</button>
                        </form>
                    </div>

                    <div class="col-md-4">
                        <form action="{{ route('orders.processed', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Order Done</button>
                        </form>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</div>

@endsection