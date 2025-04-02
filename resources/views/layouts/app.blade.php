<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: -250px;
            top: 56px; /* Push below navbar */
            background-color: #3a1c5c; /* Darker Purple */
            color: white;
            transition: 0.3s;
            padding-top: 20px;
            z-index: 1000;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 15px;
            text-decoration: none;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #2d1448; /* Even Darker Purple */
            border-radius: 5px;
        }
        .sidebar.show {
            left: 0;
        }

        /* Content Styling */
        .content {
            transition: margin-left 0.3s;
            padding: 20px;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #4b237b !important; /* Darkest Purple */
            z-index: 1050; /* Ensures navbar is always on top */
            position: fixed;
            width: 100%;
            top: 0;
        }
        .navbar-toggler {
            border: none;
        }

        /* Adjust Sidebar on Larger Screens */
        @media (min-width: 992px) { /* Laptop/Desktop */
            .sidebar {
                left: 0;
            }
            .content {
                margin-left: 250px;
            }
        }

        /* Fix Page Content from Being Hidden Behind Fixed Navbar */
        .container {
            margin-top: 80px; /* Adjust for fixed navbar */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler text-white" type="button" id="menu-toggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand text-white ms-3" href="#">Dashboard</a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4 class="text-center">Dashboard</h4>
        <a href="#"><i class="fas fa-home"></i> Home</a>
        <a href="#"><i class="fas fa-user"></i> Profile</a>
        <a href="#"><i class="fas fa-cogs"></i> Settings</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content" id="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        document.querySelector("#menu-toggle").addEventListener("click", function() {
            let sidebar = document.querySelector("#sidebar");
            sidebar.classList.toggle("show");
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('script')
</body>
</html>
