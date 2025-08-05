<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }
        .sidebar {
            width: 220px;
            background: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main {
            flex-grow: 1;
            padding: 20px;
            background: #f8f9fa;
        }
        .logout-button {
            background: none;
            border: none;
            color: #ddd;
            padding: 10px;
            width: 100%;
            text-align: left;
        }
        .logout-button:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>

<div class="sidebar p-3">
    <h5 class="text-white">Dashboard</h5>
    <a href="{{ route('sites.index') }}">📁 Sites</a>
    <a href="{{ route('sites.create') }}">➕ Create Site</a>
    <hr class="text-secondary">
    <a href="{{ route('short-links.index') }}">🔗 Short Links</a>
    <a href="{{ route('short-links.create') }}">➕ Create Short Link</a>
    <hr class="text-secondary">

    {{-- Logout Button --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-button">🚪 Logout</button>
    </form>
</div>

<div class="main">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>
