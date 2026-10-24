
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Game Collection - Beheer</title>

    <style>
        body {
            margin: 0;
            color: #172f40;
        }

        .top-menu {
            background-color: #192f3e;
            color: white;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .beheer-layout {
    display: flex;
    width: 100%;
    min-height: calc(100vh - 65px);
    border: 1px solid #d3dcdf;
    box-sizing: border-box;
}

        .sidebar {
    width: 235px;
    flex: 0 0 235px;
    background-color: #f0f3f4;
    padding: 20px 12px;
    box-sizing: border-box;
}

        .sidebar h6 {
            color: #63727a;
            padding: 0 12px;
            margin-bottom: 18px;
        }

        .sidebar a {
            display: block;
            color: #172f40;
            text-decoration: none;
            padding: 12px;
            margin-bottom: 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #dceeea;
            color: #218779;
        }

        .beheer-inhoud {
    flex: 1;
    min-width: 0;
    padding: 25px 30px;
    box-sizing: border-box;
    overflow-x: auto;
}



        @media (max-width: 700px) {
            .beheer-layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .beheer-inhoud {
                padding: 20px 12px;
            }
        }
    </style>
</head>

<body>
    <header class="top-menu">
        <div>
            <a href="{{ route('permissions.index') }}">Game Collection</a>
            <span> | Beheer</span>
        </div>

        <div>Admin ▼</div>
    </header>

    <div class="beheer-layout">
        <nav class="sidebar">
            <h6>BEHEER</h6>

            <a href="{{ route('permissions.index') }}"
               class="{{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                Permissies
            </a>

            <a href="{{ route('roles.index') }}"
               class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                Rollen
            </a>

            <a href="{{ route('role-permissions.index') }}"
               class="{{ request()->routeIs('role-permissions.*') ? 'active' : '' }}">
                Rol-permissies
            </a>

            <a href="{{ route('user-roles.index') }}"
               class="{{ request()->routeIs('user-roles.*') ? 'active' : '' }}">
                Gebruiker-rollen
            </a>
        </nav>

        <main class="beheer-inhoud">
            @yield('content')
        </main>
    </div>
</body>
</html>
