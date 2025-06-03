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
            --primary-orange: #ff8c00;
            --primary-yellow: #ffc107;
            --dark-brown: #8b4513;
            --light-cream: #fff8dc;
            --shadow-color: rgba(255, 140, 0, 0.2);
        }

        body {
            background: linear-gradient(135deg, #fff8dc 0%, #f5f5dc 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(90deg, var(--primary-orange), var(--primary-yellow)) !important;
            box-shadow: 0 4px 20px var(--shadow-color);
            border-bottom: 3px solid var(--dark-brown);
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--dark-brown) !important;
            transform: translateY(-2px);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
        }

        .dropdown-item {
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: linear-gradient(90deg, var(--primary-orange), var(--primary-yellow));
            color: white;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-yellow));
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="3" fill="rgba(255,255,255,0.05)"/><circle cx="40" cy="70" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: float 20s infinite linear;
            pointer-events: none;
        }

        @keyframes float {
            0% {
                transform: translateX(-100px) translateY(-100px) rotate(0deg);
            }

            100% {
                transform: translateX(100px) translateY(100px) rotate(360deg);
            }
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 40px var(--shadow-color);
            border: 2px solid var(--primary-yellow);
            margin-bottom: 2rem;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            border-left: 5px solid var(--primary-orange);
            transition: all 0.3s ease;
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-yellow));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: var(--primary-orange);
        }

        .product-image {
            height: 200px;
            background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
            position: relative;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .price-tag {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-yellow));
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin: 0.5rem 0;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-yellow));
            border: none;
            border-radius: 25px;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px var(--shadow-color);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px var(--shadow-color);
            background: linear-gradient(135deg, var(--primary-yellow), var(--primary-orange));
        }

        .category-badge {
            background: var(--light-cream);
            color: var(--dark-brown);
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid var(--primary-yellow);
        }

        .carousel {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
            margin-bottom: 3rem;
        }

        .carousel-item img {
            height: 400px;
            object-fit: cover;
        }

        .section-title {
            color: var(--dark-brown);
            font-weight: bold;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-orange), var(--primary-yellow));
            border-radius: 2px;
        }

        .quick-action-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            height: 100%;
        }

        .quick-action-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-orange);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .action-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-yellow));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin: 0 auto 1rem;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 1rem;
            }

            .welcome-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    @include('partials.user-navbar')

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
