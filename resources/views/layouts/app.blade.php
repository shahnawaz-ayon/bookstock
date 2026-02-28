
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8f9fa; margin: 0; padding: 0; }
        nav { background: #343a40; padding: 1rem; color: white; margin-bottom: 2rem; }
        nav a { color: white; text-decoration: none; margin-right: 15px; font-weight: bold; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn { padding: 8px 16px; border-radius: 4px; text-decoration: none; cursor: pointer; border: none; font-size: 14px; }
        .btn-primary { background: #007bff; color: white; }
        .table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        .table th, .table td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        .badge { background: #6c757d; color: white; padding: 3px 8px; border-radius: 12px; font-size: 12px; }
        .alert-success { background: #d4edda; color: #155724; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; }
    </style>
</head>
<body>

<nav>
    <div style="max-width: 1000px; margin: auto;">
        <a href="{{ route('books.index') }}">📚 My Library</a>
        <a href="{{ route('books.create') }}">Add Book</a>
        
        <a href="{{ route('authors.create') }}" style="font-size: 12px; float: right;">+ Add New Author</a>
        
         
        <a href="{{ route('categories.create') }}" style="font-size: 12px; float: right;">+ Add New Categories</a>
        
    </select>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>