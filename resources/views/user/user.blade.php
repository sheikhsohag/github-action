<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { margin: 0; padding: 0; }
    </style>
</head>
<body class="bg-light">
    @include('partials.topbar')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">User Details</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><strong>ID:</strong> {{ $user->id }}</p>
                        <p class="mb-2"><strong>Name:</strong> {{ $user->name }}</p>
                        <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>

                        @if($user->image)
                            <div class="mt-3">
                                <strong>Image:</strong><br>
                                <img src="{{ Storage::disk('s3')->url($user->image) }}" alt="User Image" class="img-fluid rounded mt-2" style="max-height: 220px; object-fit: cover;">
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-sm">Back to User List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
