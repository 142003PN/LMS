<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!--bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!--chart.js-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <!--custom css-->
    @vite('resources/css/style.css')
    <!--custom js-->
    @vite('resources/js/index.js')
</head>
<body>
    <nav class="top-nav" aria-label="Main navigation">
        <button id="sidebar-toggle" class="nav-icon-btn sidebar-toggle" type="button" aria-label="Open navigation" aria-controls="sidebar" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>
        <div class="top-nav-heading">
            <span class="top-nav-eyebrow">Learning management system</span>
            <h1>Dashboard</h1>
        </div>
        <div class="top-nav-actions">
            <div class="user-menu">
                <button class="user-menu-toggle" type="button" aria-expanded="false" aria-controls="user-menu-dropdown">
                    <span class="user-avatar">{{ mb_substr(auth()->user()->first_name, 0, 1) }}{{ mb_substr(auth()->user()->last_name, 0, 1) }}</span>
                    <span class="user-details">
                        <strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>
                        <small>{{ str_replace('_', ' ', auth()->user()->role) }}</small>
                    </span>
                    <i class="fas fa-chevron-down" aria-hidden="true"></i>
                </button>
                <div id="user-menu-dropdown" class="user-menu-dropdown" hidden>
                    <div class="user-menu-profile">
                        <span class="user-avatar">{{ mb_substr(auth()->user()->first_name, 0, 1) }}{{ mb_substr(auth()->user()->last_name, 0, 1) }}</span>
                        <div>
                            <strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>
                            <small>{{ auth()->user()->email }}</small>
                        </div>
                    </div>
                    <a href="#"><i class="fas fa-user"></i> Profile</a>
                    <a href="#"><i class="fas fa-sliders-h"></i> Account settings</a>
                    <button id="dark-mode-toggle" type="button">
                        <i class="fas fa-moon"></i>
                        <span>Dark mode</span>
                        <span class="theme-status">Off</span>
                    </button>
                    <div class="user-menu-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button id="logout-btn" class="logout-btn" type="submit">
                        <i class="fas fa-sign-out-alt"></i> Log out
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div id="sidebar-overlay" class="sidebar-overlay"></div>
    <aside id="sidebar">
        <ul>
            <li class="active">
                <a href="#">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('department.index') }}">
                    <i class="fas fa-building"></i>
                    <span>Departments</span>
                </a>
            </li>
            <li>
                <button onclick="toggleSubmenu(this)" class="dropdown-btn">
                    <i class="fas fa-book"></i>
                    <span>Subjects</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <ul class="submenu">
                    <div>
                        <li><a href="">Add</a></li>
                        <li><a href="">List</a></li>
                    </div>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-users"></i>
                    <span>Learners</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-cog"></i>
                    <span>Classes</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Teachers</span>
                </a>
            </li>
        </ul>
    </aside>
    @yield('content')
    </body>
</html>

