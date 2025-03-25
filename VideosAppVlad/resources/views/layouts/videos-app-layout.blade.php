<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos App</title>
    <style>

        header {
            background-color: blue;
            padding: 10px 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li form button {
            background: none;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        main {
            flex: 1;
        }

        footer {
            background-color: lightgray;
            color: black;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        /* Añade esto a tu archivo CSS */
        .horizontal-card {
            display: flex;
            flex-direction: row;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .horizontal-card .card-img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .horizontal-card .card-body {
            padding: 15px;
        }

        .horizontal-card .card-title {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .horizontal-card .card-text {
            font-size: 0.875rem;
            color: #555;
        }

        .horizontal-card .btn {
            margin-top: 10px;
        }

        /* Añade esto a tu archivo CSS */
        .create-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .create-card .card-header {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .rounded-input {
            border-radius: 5px;
        }

        .form-group label {
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Add this to your CSS file */
        .video-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .video-card .card-body {
            padding: 15px;
        }

        .video-card .card-title {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .video-card .card-text {
            font-size: 0.875rem;
            color: #555;
        }

        .embed-card {
            cursor: pointer;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .embed-card .card-body {
            padding: 0;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
    <!-- Add your CSS files here -->
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="{{ route('videos.index') }}">Home</a></li>
            @auth
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('videos.manage.create') }}">Add Video</a></li>
                <li><a href="{{ route('videos.manage.index') }}">Manage Videos</a></li>
                <li><a href="{{ route('users.index') }}">Users</a></li>
                <li><a href="{{ route('users.manage.index') }}">Manage Users</a></li>
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
