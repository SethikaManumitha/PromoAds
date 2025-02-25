@extends('layouts.dashboard')

@section('content')
<div class="content">
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

    <form method="POST" action="{{ isset($promotion) ? route('product.update', $promotion->id) : route('product.add') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($promotion))
        @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="container p-4 mt-4 bg-white rounded shadow-lg">
                    <h2 class="text-center">Product<span class="text-success"> Details</span></h2>

                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="7" required></textarea>
                    </div>

                    <!-- Custom Upload Image Section -->


                    <button type="submit" class="btn btn-success w-100">
                        {{ isset($promotion) ? 'Update Promotion' : 'Add Promotion' }}
                    </button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row">
                    <div class="container p-4 mt-4 bg-white rounded shadow-lg">
                        <h2 class="text-center">Price</h2>

                        <div class="form-group">
                            <label for="price">Price (LKR)</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Sale Price (LKR)</label>
                            <input type="text" class="form-control" id="sale_price" name="sale_price" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="container p-4 mt-4 bg-white rounded shadow-lg">
                        <h2 class="text-center">Product<span class="text-success"> Image</span></h2>


                        <div class="form-group text-center">
                            <label for="image" class="btn btn-outline-success px-4 py-2 d-inline-flex align-items-center">
                                <i class="fas fa-upload mr-2"></i> Upload Images
                            </label>
                            <input type="file" class="d-none" id="image" name="image" onchange="showFileName()">
                            <small id="file-name" class="text-muted d-block mt-2"></small>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </form>

    <script>
        function showFileName() {
            var input = document.getElementById('image');
            var fileName = input.files.length > 0 ? input.files[0].name : "No file chosen";
            document.getElementById('file-name').innerText = fileName;
        }

        document.addEventListener("DOMContentLoaded", function() {
            const toggle = document.getElementById("availability");
            const label = document.getElementById("availability-label");

            toggle.addEventListener("change", function() {
                label.textContent = this.checked ? "Available" : "Unavailable";
            });
        });
    </script>

    <style>
        .toggle-container {
            display: inline-block;
            width: 40px;
            height: 20px;
            background: #ccc;
            border-radius: 10px;
            position: relative;
            cursor: pointer;
            transition: background 0.3s;
        }

        .hidden-checkbox {
            display: none;
        }


        .toggle-switch {
            content: "";
            width: 18px;
            height: 18px;
            background: white;
            border-radius: 50%;
            position: absolute;
            top: 1px;
            left: 2px;
            transition: all 0.3s;
        }

        input[type="checkbox"]:checked+.toggle-switch {
            transform: translateX(20px);
            background: white;
        }

        input[type="checkbox"]:checked~.toggle-container {
            background: #4CAF50;
        }
    </style>

</div>
@endsection