<!DOCTYPE html>
<html>
<head>
    <title>CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    
<nav class="navbar nav-light bg-light">
    <span class="navbar-brand mb-0 h1">CRUD App</span>
</nav>
<div class="container">
    
    @yield('content')
</div>
    
</body>

<script src="{{ asset('js/app.js') }}" defer></script>
</html>