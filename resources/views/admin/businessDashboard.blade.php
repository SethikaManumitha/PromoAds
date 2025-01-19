@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Welcome <span class="text-success">{!! session('user_name') !!}</span></h1>
            </div>
        </div>
    </div>
</div>
@endsection