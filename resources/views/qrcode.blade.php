@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>QR <span class="text-success">Code</span></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Display QR Code here -->
                {!! $qrCode !!}
            </div>
        </div>
    </div>
</div>
@endsection