<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    {{-- Vite CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { margin: 0; padding: 0; }
    </style>
</head>
<body>
    @include('partials.topbar')
    <div style="padding: 20px;">
    <h1>🏠 Home Page</h1>
    <p>This is Blade based Home Page</p>
    </div>
</body>
</html>
