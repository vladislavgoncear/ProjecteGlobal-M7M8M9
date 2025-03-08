<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos App</title>
    <!-- Add your CSS files here -->
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="{{ route('videos.index') }}">Home</a></li>
            @auth
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('videos.create') }}">Add Video</a></li>
                <li><a href="{{ route('videos.index') }}">Manage Videos</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }} Videos App. All rights reserved.</p>
</footer>
</body>
</html>
