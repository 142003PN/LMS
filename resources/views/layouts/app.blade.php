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
    <!--sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <form method="POST" action="{{ route('logout') }}" data-confirm='{"title":"Log out","message":"Are you sure you want to log out?","icon":"question","confirmButtonText":"Yes, log out","cancelButtonText":"Stay logged in"}'>
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
                <a href="{{ route('staff.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Staff</span>
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

    @php
        $flashMessages = [
            'success' => session('success'),
            'error' => session('error'),
            'warning' => session('warning'),
            'info' => session('info'),
        ];
    @endphp

    <script>
        window.flashMessages = @json($flashMessages);

        document.addEventListener('DOMContentLoaded', function () {
            Object.entries(window.flashMessages).forEach(([type, message]) => {
                if (!message) return;

                Swal.fire({
                    icon: type === 'error' ? 'error' : type === 'warning' ? 'warning' : type === 'info' ? 'info' : 'success',
                    title: type.charAt(0).toUpperCase() + type.slice(1),
                    text: message,
                    timer: type === 'success' ? 2200 : 3200,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });

            document.querySelectorAll('[data-confirm]').forEach((element) => {
                element.addEventListener('submit', function (event) {
                    event.preventDefault();

                    const config = JSON.parse(element.dataset.confirm || '{}');
                    const message = config.message || 'Are you sure?';
                    const confirmButtonText = config.confirmButtonText || 'Yes, continue';
                    const cancelButtonText = config.cancelButtonText || 'Cancel';

                    Swal.fire({
                        title: config.title || 'Are you sure?',
                        text: message,
                        icon: config.icon || 'warning',
                        showCancelButton: true,
                        confirmButtonText,
                        cancelButtonText,
                        reverseButtons: true,
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-danger',
                            cancelButton: 'btn btn-secondary ms-2'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            element.submit();
                        }
                    });
                });
            });
        });
    </script>
    </body>
</html>

