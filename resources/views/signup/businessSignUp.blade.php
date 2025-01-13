<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Business - Sign Up</title>
    <link rel="stylesheet" href="{{ asset('css/businessSignUp.css') }}">
</head>

<body>
    <div class="form-container">
        <h2 class="text-center">Sign Up</h2>

        <form action="{{ route('business.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="business_name">Business Name</label>
                    <input type="text" class="form-control" id="business_name" name="business_name"
                        value="{{ old('business_name') }}"
                        placeholder="Enter your business name" required>
                    @error('business_name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="business_type">Business Type</label>
                    <select class="form-control" id="business_type" name="business_type" required>
                        <option value="Groceries">Groceries</option>
                        <option value="Clothing">Clothing</option>
                        <option value="Fashion_accessories">Fashion</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Home_appliances">Home Appliances</option>
                        <option value="Toys_gifts">Toys & Gifts</option>
                        <option value="Taxi">Taxi</option>
                        <option value="Real_estate">Real Estate</option>
                        <option value="Books_stationary">Books & Stationary</option>
                        <option value="Automobile">Automobile</option>
                    </select>
                    @error('business_type')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="descript">Description</label>
                    <textarea class="form-control" id="descript" name="descript"
                        placeholder="Enter a description">{{ old('descript') }}</textarea>
                    @error('descript')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email" required>
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="{{ old('phone_number') }}"
                        placeholder="Enter your phone number" required>
                    @error('phone_number')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter your password" required>
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-block mt-3">Sign Up</button>
        </form>

        <!-- Add link to sign in -->
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