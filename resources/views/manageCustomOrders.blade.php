@extends('layouts.dashboard')

@section('content')
<div class="content">
    <h3>Custom Orders</h3>
    @if ($customOrders->isEmpty())
    <div class="alert alert-warning">
        No custom orders found for this business.
    </div>
    @else
    <ul class="list-group">
        @foreach ($customOrders as $order)
        <li class="list-group-item">
            <strong>Description:</strong> {{ $order->description }} <br>
            <strong>Placed by:</strong> {{ $order->user->name }} <br>
            <strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection