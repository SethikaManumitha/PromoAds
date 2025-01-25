<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Admin Dashboard</h1>

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif


        <!-- Search Bar -->
        <div class="mb-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Search for users" onkeyup="searchTable()">
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Users</h3>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        @foreach ($users as $user)
                        @if ($user->status == 0)
                        <tr class="user-row" data-status="{{ $user->status }}">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <div style="display: flex; gap: 10px; align-items: center;">
                                    <!-- Update Profile Button -->
                                    <form action="{{ route('admin.changeBusinessProfile', $user->id) }}" method="POST" enctype="multipart/form-data" style="margin: 0;">
                                        @csrf
                                        <input type="file" name="profile_picture" style="display: none;" id="fileInput{{ $user->id }}" onchange="this.form.submit()">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="document.getElementById('fileInput{{ $user->id }}').click();">
                                            Change Profile Picture
                                        </button>
                                    </form>
                                    <!-- Change Status Form -->
                                    <form action="{{ route('editUser', $user->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">Change Status</button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-6">

                        <a href="{{route('createBusiness')}}" class="btn btn-success w-100">Create Business</a>

                    </div>
                    <div class="col-md-6">
                        <a href="{{route('createDriver')}}" class="btn btn-info w-100">Create Driver</a>

                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Bootstrap 4 JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <script>
        // Function to search the table
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows (skip the first row which is the header)
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                let matchFound = false;

                // Loop through each cell in the row and check for matches
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            matchFound = true;
                        }
                    }
                }

                // Display row if match is found, otherwise hide it
                if (matchFound) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>