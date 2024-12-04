<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/otp.css') }}">
</head>
<body>
<div class="form-container">
    <h2>Sign Up</h2>
    <form action="{{ route('sendOtp') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
        </div>
        <hr>
        <button type="submit" class="btn btn-login mt-3">Continue</button>
    </form>
</div>
</body>
</html>
