@extends('layouts.driverdashboard')

@section('content')
<div class="content">
    <h2 class="text-center">{{ isset($promotion) ? 'Edit ' : 'Add ' }}<span class="text-success">Service</span></h2>

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

    <form method="POST" action="{{ isset($promotion) ? route('service.update', $promotion->id) : route('service.add') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($promotion))
        @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Service Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset($promotion) ? $promotion->name : '' }}" placeholder="Enter Promotion Name" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category" value="{{ isset($promotion) ? $promotion->category : '' }}" required>
                <option value="Travel">Travel</option>
                <option value="Travel">Courier</option>
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
            <label for="image">Upload Image</label>
            <input type="file" name="image" class="form-control">
            @if(isset($promotion) && $promotion->image)
            <br>
            <img src="{{ asset($promotion->image) }}" alt="Current Image" height="100">
            @endif
        </div>
        <input type="hidden" class="form-control" id="nic" name="nic" value="{{ auth()->user()->id }}">
        <button type="submit" class="btn btn-success">{{ isset($promotion) ? 'Update Promotion' : 'Add Promotion' }}</button>

    </form>

</div>
@endsection