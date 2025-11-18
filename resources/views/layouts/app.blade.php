<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icon Font --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            background: #f5f6fa;
        }

        .sidebar {
            width: 240px;
            background: #343a40;
            color: white;
            flex-shrink: 0;
            transition: all 0.3s;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }

        .sidebar a:hover, .sidebar a.active {
            background: #495057;
            color: #fff;
        }

        .sidebar h4 {
            color: #f8f9fa;
            text-align: center;
            padding: 20px 0;
            margin: 0;
            border-bottom: 1px solid #495057;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .toggle-btn {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #343a40;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -240px;
                top: 0;
                height: 100%;
            }
            .sidebar.active {
                left: 0;
            }
            .content {
                padding-top: 60px;
            }
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Tombol toggle sidebar untuk mobile --}}
    <i class="bi bi-list toggle-btn" id="toggleSidebar"></i>

    {{-- Konten utama --}}
    <div class="content">
        @yield('content')
    </div>

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.querySelector('.sidebar');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>
</body>
</html>
