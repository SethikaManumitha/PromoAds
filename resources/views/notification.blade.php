@extends('layouts.home')

@section('content')
<div class="content">
    <div class="container">
        <h1>Your Notifications</h1>
        <ul class="list-group">
            @foreach ($notifications as $notification)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <p>{{ $notification->notification }}</p>
                    <small class="text-muted">Received on: {{ $notification->created_at->format('F j, Y, g:i a') }}</small>
                </div>
                <form action="{{ route('notifications.confirm', $notification->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                </form>
            </li>
            @endforeach

            @if($notifications->isEmpty())
            <li class="list-group-item text-center">
                <p>No notifications yet.</p>
            </li>
            @endif
        </ul>
    </div>
</div>
@endsection