<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos App</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        aside {
            width: 240px;
            background-color: white;
            color: #333;
            border-right: 1px solid #ccc;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: width 0.3s ease;
            overflow: hidden;
        }

        aside.collapsed {
            width: 70px;
        }

        .sidebar-toggle {
            cursor: pointer;
            padding: 10px 20px;
            font-size: 1.2em;
            border-bottom: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        aside ul {
            list-style: none;
            padding: 10px;
            margin: 0;
            flex-grow: 1;
        }

        aside ul li {
            width: 100%;
            margin-bottom: 8px;
        }

        aside ul li a,
        aside ul li form button {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: none;
            background: #f5f5f5;
            width: 100%;
            text-align: left;
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            border-radius: 10px;
            transition: background-color 0.2s;
        }

        aside ul li a:hover,
        aside ul li form button:hover {
            background-color: #e0e0e0;
        }

        aside ul li a.active,
        aside ul li form button.active {
            background-color: #dcdcdc;
        }

        aside.collapsed ul li a span,
        aside.collapsed ul li form button span {
            display: none;
        }

        aside.collapsed i {
            margin-right: 0;
            text-align: center;
            width: 100%;
        }

        aside i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            min-width: 20px;
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0 10px 0;
        }

        .footer {
            padding: 10px 20px;
            font-size: 0.85em;
            background-color: #f1f1f1;
            border-top: 1px solid #ccc;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #555;
            line-height: 1.4em;
        }

        main {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        form {
            margin: 0;
        }

        @media (max-width: 768px) {
            aside {
                width: 70px;
            }

            aside ul li a {
                flex-direction: column;
                align-items: center;
                padding: 10px;
                font-size: 12px;
            }

            aside ul li a span {
                display: block;
                font-size: 10px;
                text-align: center;
                margin-top: 5px;
            }

            aside ul li a i {
                font-size: 20px;
            }
        }

    </style>
</head>
<body>
@include('components.notification')
<aside id="sidebar">
    <div>
        <!-- Toggle button -->
        <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>

        <ul>
            <!-- Home Section -->
            <li><a href="{{ route('videos.index') }}" class="{{ request()->routeIs('videos.index') ? 'active' : '' }}"><i class="fas fa-home"></i> <span>Inici</span></a></li>
{{--            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>--}}
            <hr>

            <!-- Videos Section -->
            <li><a href="{{ route('videos.manage.create') }}" class="{{ request()->routeIs('videos.manage.create') ? 'active' : '' }}"><i class="fas fa-plus-circle"></i> <span>Afegir video</span></a></li>
            <li><a href="{{ route('videos.manage.index') }}" class="{{ request()->routeIs('videos.manage.index') ? 'active' : '' }}"><i class="fas fa-video"></i> <span>Controlar videos</span></a></li>
            <hr>

            <!-- Series Section -->
            <li><a href="{{ route('series.manage.index') }}" class="{{ request()->routeIs('series.index') ? 'active' : '' }}"><i class="fas fa-folder"></i> <span>Series</span></a></li>
            <li><a href="{{ route('series.manage.create') }}" class="{{ request()->routeIs('series.create') ? 'active' : '' }}"><i class="fas fa-plus"></i> <span>Afegir Series</span></a></li>
            <hr>

            <!-- Users Section -->
            <li><a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}"><i class="fas fa-users"></i> <span>Usuaris</span></a></li>
            <li><a href="{{ route('users.manage.index') }}" class="{{ request()->routeIs('users.manage.index') ? 'active' : '' }}"><i class="fas fa-user-cog"></i> <span>Controlar Users</span></a></li>
            <hr>

            <!-- Logout -->
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="{{ request()->routeIs('logout') ? 'active' : '' }}"><i class="fas fa-sign-out-alt"></i> <span>Tancar sessio</span></button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; 2025 VideosApp. <br>
        All rights reserved. <br>
        Made by Vladislav
    </div>
</aside>

<main>
    @yield('content')
</main>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('collapsed');
    }
</script>

</body>
</html>
