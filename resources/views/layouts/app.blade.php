<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Blogmine</title>  
    @vite('resources/js/app.js')  
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">  
    <!-- <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> Pastikan ini ada   -->
</head>  
<body class="bg-gray-100">  
    <div class="container mx-auto p-4">  
        <header class="mb-4 bg-white shadow-md rounded p-4">  
            <h1 class="text-3xl font-bold text-gray-800">BlogMine</h1>  
            <nav class="mt-2">  
                <a href="{{ route('articles.index') }}" class="text-blue-500 hover:text-blue-700 transition">Articles</a>  
                <a href="{{ route('categories.index') }}" class="ml-4 text-blue-500 hover:text-blue-700 transition">Categories</a>  
                <a href="{{ route('tags.index') }}" class="ml-4 text-blue-500 hover:text-blue-700 transition">Tags</a>  
            </nav>  
        </header>  

        @if(session('success'))  
            <div class="bg-green-500 text-white p-2 rounded mb-4">  
                {{ session('success') }}  
            </div>  
        @endif  

        @yield('content')  
    </div>  
</body>  
</html>