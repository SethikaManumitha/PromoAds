@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Manage Profile
                    </div>
                    <div class="card-body">
                        <!-- Form -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Circular Avatar -->
                            <div class="text-center mb-4">
                                <label for="profilePhoto" class="d-block">
                                    <div class="rounded-circle mx-auto" style="width: 160px; height: 160px; background-color: #eaeaea; overflow: hidden; position: relative; cursor: pointer;">
                                        <img id="avatarPreview" src="{{ $user->profile ? asset($user->profile) : 'https://via.placeholder.com/120' }}" alt="Profile Avatar" class="img-fluid w-100 h-100" style="object-fit: cover;">
                                        <div style="position: absolute; bottom: 0; background: rgba(0, 0, 0, 0.6); width: 100%; color: white; font-size: 12px;">
                                            Upload Photo
                                        </div>
                                    </div>
                                    <input type="file" id="profilePhoto" accept="image/*" class="d-none" name="profile_photo" onchange="previewAvatar(event)">
                                </label>
                            </div>

                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your name">
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email/Phone Number</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email',$user->email) }}" placeholder="Enter your email">
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
    function previewAvatar(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection