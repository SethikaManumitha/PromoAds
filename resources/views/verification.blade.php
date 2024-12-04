<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Enter OTP</h2>
    
    <!-- Show error message if OTP is invalid -->
    @if ($errors->has('otp'))
        <div class="alert alert-danger">
            {{ $errors->first('otp') }}
        </div>
    @endif

    <form id="otp-form" action="{{ route('verifyOtp') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="otp">OTP</label>
            <input type="text" class="form-control" id="otp" name="otp" required>
        </div>
        <button type="submit" class="btn btn-primary">Verify OTP</button>
    </form>

    @if (session('otp_verified'))
        <div class="alert alert-success mt-3">
            OTP Verified Successfully!
        </div>
    @endif
</div>

</body>
</html>
