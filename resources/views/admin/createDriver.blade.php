<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Driver - Sign Up</title>
    <link rel="stylesheet" href="{{ asset('css/businessSignUp.css') }}">
</head>

<body>
    <div class="form-container">
        <h2 class="text-center">Create Driver</h2>

        <form action="{{ route('driver.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="nic">NIC</label>
                    <input type="text" class="form-control" id="nic" name="nic"
                        value="{{ old('nic') }}"
                        placeholder="Enter your NIC" required>
                    @error('nic')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter your full name" required>
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="{{ old('phone_number') }}"
                        placeholder="Enter your phone number" required>
                    @error('phone_number')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password" required>
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="vehicle_type">Vehicle Type</label>
                    <select class="form-control" id="vehicle_type" name="vehicle_type" required>
                        <option value="Three_wheeler">Three-Wheeler</option>
                        <option value="Car">Car</option>
                        <option value="Van">Van</option>
                        <option value="Truck">Truck</option>
                        <option value="Bike">Bike</option>
                    </select>
                    @error('vehicle_type')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-12">
                    <label for="registration_number">Registration Number</label>
                    <input type="text" class="form-control" id="registration_number" name="registration_number"
                        value="{{ old('registration_number') }}"
                        placeholder="Enter your registration number" required>
                    @error('registration_number')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="license_number">License Number</label>
                    <input type="text" class="form-control" id="license_number" name="license_number"
                        value="{{ old('license_number') }}"
                        placeholder="Enter your license number" required>
                    @error('license_number')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-block mt-3">Sign Up</button>
        </form>

        <!-- Add link to sign in -->
        <p class="text-center mt-3">
            Already have an account?
            <a href="{{ route('getAdmin') }}" class="text-success">Go Back</a>
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>