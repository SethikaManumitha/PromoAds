<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Customer - Sign Up</title>
    <link rel="stylesheet" href="{{ asset('css/businessSignUp.css') }}">
</head>

<body>
    <div class="form-container">
        <h2 class="text-center">Sign Up</h2>

        <form action="{{ route('customer.insert') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required>
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="Enter your phone number" required>
                    @error('phone_number')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>



            <!-- Password -->
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Address -->
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" placeholder="Enter your address" required>{{ old('address') }}</textarea>
                    @error('address')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- City Dropdown -->
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="city">City</label>
                    <select class="form-control" id="city" name="city" required>
                        <option value="Colombo">Colombo</option>
                        <option value="Hikkaduwa">Hikkaduwa</option>
                        <option value="Ambalangoda">Ambalangoda</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Galle">Galle</option>
                        <option value="Matara">Matara</option>
                        <option value="Kurunegala">Kurunegala</option>
                        <option value="Negombo">Negombo</option>
                        <option value="Anuradhapura">Anuradhapura</option>
                        <option value="Jaffna">Jaffna</option>
                        <option value="Batticaloa">Batticaloa</option>
                        <option value="Trincomalee">Trincomalee</option>
                        <option value="Ratnapura">Ratnapura</option>
                        <option value="Mullaitivu">Mullaitivu</option>
                        <option value="Vavuniya">Vavuniya</option>
                        <option value="Badulla">Badulla</option>
                        <option value="Nuwara Eliya">Nuwara Eliya</option>
                        <option value="Polonnaruwa">Polonnaruwa</option>
                        <option value="Puttalam">Puttalam</option>
                        <option value="Matale">Matale</option>
                        <option value="Kalutara">Kalutara</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Mihintale">Mihintale</option>
                        <option value="Kegalle">Kegalle</option>
                        <option value="Dambulla">Dambulla</option>
                        <option value="Haputale">Haputale</option>
                        <option value="Bandaragama">Bandaragama</option>
                        <option value="Weligama">Weligama</option>
                    </select>
                    @error('city')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success btn-block mt-3">Sign Up</button>
        </form>

        <!-- Link to Sign In -->
        <p class="text-center mt-3">
            Already have an account?
            <a href="{{ route('signin') }}" class="text-success">Sign In</a>
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>