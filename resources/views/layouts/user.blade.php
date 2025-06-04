<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') - Dakun99 Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #ffb347;
            --secondary: #ffcc70;
            --text: #333;
            --text-muted: #888;
            --bg: #fdfdfd;
            --shadow: rgba(0, 0, 0, 0.08);
        }

        body {
            background: var(--bg);
            font-family: 'Segoe UI', sans-serif;
            color: var(--text);
        }

        .navbar {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            box-shadow: 0 3px 10px var(--shadow);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #2d2d2d !important;
        }

        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .product-card {
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 6px 15px var(--shadow);
            transition: 0.3s ease;
            border: none;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px var(--shadow);
        }

        .product-card img {
            height: 180px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 25px;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        .carousel {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px var(--shadow);
        }

        .carousel-item img {
            height: 350px;
            object-fit: cover;
        }

        .section-title {
            font-weight: bold;
            font-size: 1.6rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 0.5rem;
            display: inline-block;
        }

        @media (max-width: 768px) {
            .carousel-item img {
                height: 200px;
            }
        }
    </style>
</head>

<body>
    @include('partials.user-navbar')

    <div class="container py-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
