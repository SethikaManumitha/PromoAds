<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Promotion</title>
    <style>
        .sidebar {
            height: 100vh;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            color: white;
        }

        .sidebar a {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Business Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <h5 class="text-center">Menu</h5>
        <a href="{{ route('admin.businessDashboard') }}">Dashboard</a>
        <a href="{{ route('getqr') }}">QR Code</a>
        <a href="{{ route('addpromo') }}">Add Promotions</a>
        <a href="{{ route('viewpromo') }}">View Promotions</a>
        <a href="#">Analytics</a>
        <a href="#">Users</a>
        <a href="#">Settings</a>
        <a href="{{ route('login') }}">Log Out</a>
    </div>

    <!-- Content -->
    <div class="content">

        <h2 class="text-center">{{ isset($promotion) ? 'Edit ' : 'Add ' }}<span class="text-success">Promotion</span></h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ isset($promotion) ? route('promo.update', $promotion->id) : route('promo.add') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($promotion))
            @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Promotion Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ isset($promotion) ? $promotion->name : '' }}" placeholder="Enter Promotion Name" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" value="{{ isset($promotion) ? $promotion->category : '' }}" required>
                    <option value="Fresh_produce">Fresh Produce</option>
                    <option value="Meat_seafood">Meat & Seafood</option>
                    <option value="Bakery">Bakery</option>
                    <option value="Grocery">Grocery</option>
                    <option value="Beverages">Beverages</option>
                    <option value="Frozen_foods">Frozen Foods</option>
                    <option value="Canned_goods">Canned Goods</option>
                    <option value="Health_beauty">Health & Beauty</option>
                    <option value="Household_items">Household Items</option>
                    <option value="Dairy">Dairy Products</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description">{{ isset($promotion) ? $promotion->description : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Original Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ isset($promotion) ? $promotion->price : '' }}" placeholder="Enter Price" required>
            </div>
            <div class="form-group">
                <label for="dis_price">Discount Price</label>
                <input type="text" class="form-control" id="dis_price" name="dis_price" value="{{ isset($promotion) ? $promotion->dis_price : '' }}" placeholder="Enter Discount Price" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ isset($promotion) ? $promotion->end_date : '' }}" required>
            </div>

            <div class="form-group">
                <label for="image">Upload Image</label>
                <input type="file" name="image" class="form-control">
                @if(isset($promotion) && $promotion->image)
                <br>
                <img src="{{ asset($promotion->image) }}" alt="Current Image" height="100">
                @endif
            </div>
            <button type="submit" class="btn btn-success">{{ isset($promotion) ? 'Update Promotion' : 'Add Promotion' }}</button>
            <input type="hidden" class="form-control" id="business" name="business" value="Lasantha Stores">

        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>