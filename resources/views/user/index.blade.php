<!DOCTYPE html>
<html>
<head>
    <title>User List</title>

    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f2f2f2; }

        .form-row{
            display:flex;
            gap:40px;
            align-items:flex-start;
        }

        .left{
            flex:1;
        }

        .right{
            width:250px;
        }

        .image-box{
            width:200px;
            height:200px;
            border:2px dashed #ccc;
            border-radius:10px;
            display:flex;
            align-items:center;
            justify-content:center;
            cursor:pointer;
            overflow:hidden;
            background:#fafafa;
        }

        .image-box img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .placeholder{
            color:#888;
            font-size:14px;
            text-align:center;
        }

        .user-img{
            width:50px;
            height:50px;
            object-fit:cover;
            border-radius:50%;
        }

        input[type="file"]{
            display:none;
        }

    </style>

</head>
<body>

<h2>Add New User</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-row">

        <div class="left">
            <label>Name</label><br>
            <input type="text" name="name" required><br><br>

            <label>Email</label><br>
            <input type="email" name="email" required><br><br>

            <label>Password</label><br>
            <input type="password" name="password" required><br><br>
        </div>

        <div class="right">
            <label>Image</label><br><br>

            <div class="image-box" onclick="document.getElementById('imageInput').click()">
                <span class="placeholder" id="placeholder">
                    Click to upload image
                </span>
                <img id="preview" style="display:none;">
            </div>

            <input
                type="file"
                name="image"
                id="imageInput"
                accept="image/*"
                onchange="previewImage(event)"
            >
        </div>

    </div>

    <br>
    <button type="submit">Add User</button>
</form>

<hr>

<h2>User List</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>

                <td>
                    @if($user->image)
                        <img src="{{ asset('storage/'.$user->image) }}" class="user-img">
                    @endif
                </td>

                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at?->format('d M Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No users found</td>
            </tr>
        @endforelse
    </tbody>
</table>


<script>
function previewImage(event){
    const input = event.target;
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');

    if(input.files && input.files[0]){
        const reader = new FileReader();

        reader.onload = function(e){
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>
