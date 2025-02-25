@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        About Section
                    </div>
                    <div class="card-body">
                        <!-- Form -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Display Validation Errors -->
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center mb-4">
                                        <label for="bannerPhoto" class="d-block">
                                            <div class="mx-auto d-flex justify-content-center align-items-center"
                                                style="width: 100%; height: 250px; background-color: #f5f5f5; border: 2px dashed #007bff; position: relative; cursor: pointer;">

                                                <!-- Ensure $banner is not null before accessing properties -->
                                                @php $imagePath = isset($banner) && $banner->image ? asset($banner->image) : ''; @endphp

                                                <img id="bannerPreview"
                                                    src="{{ $imagePath }}"
                                                    alt="Banner Preview"
                                                    class="img-fluid w-100 h-100"
                                                    style="object-fit: cover; display: {{ $imagePath ? 'block' : 'none' }};">

                                                <div id="uploadPlaceholder" class="text-center"
                                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #007bff; font-size: 16px; display: {{ $imagePath ? 'none' : 'block' }};">
                                                    <img src="{{ asset('path-to-upload-icon.png') }}" alt="Upload Icon" style="width: 40px; height: 40px;">
                                                    <p>Upload Images</p>
                                                </div>
                                            </div>
                                            <input type="file" id="bannerPhoto" accept="image/*" class="d-none" name="image" onchange="previewBanner(event)">
                                        </label>

                                        <!-- Error for banner photo -->
                                        @error('banner_photo')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="8"
                                            placeholder="Enter description">{{ old('description', $description ?? '') }}</textarea>
                                        <!-- Error for description -->
                                        @error('description')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Save Button -->
                            <button type="submit" class="btn btn-success btn-block">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewBanner(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('bannerPreview').src = e.target.result;
                document.getElementById('bannerPreview').style.display = "block";
                document.getElementById('uploadPlaceholder').style.display = "none";
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection